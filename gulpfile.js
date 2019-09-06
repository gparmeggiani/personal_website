/**
 * Build script for my personal website
 * 
 * Usage:
 * npm run gulp
 * npm run gulp dev
 */

const del = require('del');
const fs = require('fs');
const gulp = require("gulp");
const merge = require('merge-stream');
const browsersync = require("browser-sync").create();
const cleanCSS = require("gulp-clean-css");
const header = require("gulp-header");
const plumber = require("gulp-plumber");
const rename = require("gulp-rename");
const sass = require("gulp-sass");
const uglify = require("gulp-uglify");
const mustache = require("gulp-mustache");
const htmlmin = require('gulp-htmlmin');
const concat = require('gulp-concat');
const md5File = require('md5-file')

const pkg = require('./package.json');

// Build a C-Style banner to be included in the CSS and JS files
const cstyle_banner = ['/*!\n',
  ' * <%= pkg.title %> v<%= pkg.version %> (<%= pkg.homepage %>)\n',
  ' * Copyright (c) 2014 - ' + (new Date()).getFullYear(), ' <%= pkg.author %>\n',
  ' * All Rights reserved\n',
  ' */\n',
  '\n'
].join('');


/**
 * Delete the contents of the www (output) directory
 */
function clean(cb) {
    del([
        'www/**/*'
    ], cb);
}

/**
 * Copy vendor files to the /js and/or /css folders
 */
function vendor() {

    stm = merge();
    
    // --------------------------------------------------------------------------------------
    //Third party CSS files
    stm.add(gulp.src([
        'node_modules/bootstrap/dist/css/bootstrap.min.css',        // Bootstrap
        'node_modules/prismjs/themes/prism.css',                    // Prism.js
        'node_modules/prismjs/themes/prism-okaidia.css'           
    ])
    .pipe(gulp.dest('www/css')));

    // Font awesome
    stm.add(gulp.src([
        'node_modules/@fortawesome/fontawesome-free/css/all.min.css'           
    ])
    .pipe(rename('fontawesome-all.min.css'))
    .pipe(gulp.dest('www/css')));

    // --------------------------------------------------------------------------------------
    // Third party JS files
    stm.add(gulp.src([
        'node_modules/jquery/dist/jquery.min.js',                   // jQuery
        'node_modules/jquery.easing/jquery.easing.min.js',          // jQuery Easing
        'node_modules/bootstrap/dist/js/bootstrap.bundle.min.js',   // Bootstrap
        'node_modules/typed.js/lib/typed.min.js',                   // Typed.js
        'node_modules/prismjs/plugins/normalize-whitespace/prism-normalize-whitespace.min.js'
    ])
    .pipe(gulp.dest('www/js')));

    // Prism.js (build custom js file by concatenating the required ones)
    stm.add(gulp.src([
        'node_modules/prismjs/components/prism-core.min.js',
        'node_modules/prismjs/components/prism-clike.min.js',
        'node_modules/prismjs/components/prism-c.min.js',
        'node_modules/prismjs/components/prism-python.min.js'
    ])
    .pipe(concat('prism.min.js'))
    .pipe(gulp.dest('www/js')));

    // --------------------------------------------------------------------------------------
    // Other files

    // Font awesome
    stm.add(gulp.src([
        'node_modules/@fortawesome/fontawesome-free/webfonts/*'           
    ])
    .pipe(gulp.dest('www/webfonts')));

    return stm;
}

/**
 * Build SCSS files into a minified CSS
 */
function css() {
    return gulp.src("./src/scss/*.scss")
    .pipe(plumber())
    .pipe(sass({
      outputStyle: "expanded"
    }))
    .on("error", sass.logError)
    .pipe(header(cstyle_banner, {
      pkg: pkg
    }))
    .pipe(rename({
      suffix: ".min"
    }))
    .pipe(cleanCSS())
    .pipe(gulp.dest("./www/css"))
    .pipe(browsersync.stream());
}

/**
 * Minify (or copy) JS files
 */
function js() {

    stm = merge();

    //Minify non minified js files
    stm.add(gulp.src([
        './src/js/*.js',
        '!./src/js/*.min.js'
    ])
    .pipe(uglify())
    .pipe(header(cstyle_banner, {
        pkg: pkg
    }))
    .pipe(rename({
        suffix: '.min'
    }))
    .pipe(gulp.dest('./www/js'))
    .pipe(browsersync.stream()));

    //pass-through already minifed js files
    stm.add(gulp.src([
        './src/js/*.min.js'
    ])
    .pipe(gulp.dest('./www/js'))
    .pipe(browsersync.stream()));

    return stm;
}

/**
 * Build the HTML pages
 * - home page
 * - projects page
 * - error pages
 */
function pages() {

    var stm = merge();

    var projects = JSON.parse(fs.readFileSync('./src/pages/data/projects.json', 'utf8'));
    var timeline = JSON.parse(fs.readFileSync('./src/pages/data/timeline.json', 'utf8'));
    var error_pages = JSON.parse(fs.readFileSync('./src/pages/data/error-pages.json', 'utf8'));

    var append_file_hash = function() {
        return function(text, render) {
            rendered = render(text)
            return rendered + '?v=' +  md5File.sync('www' + rendered).substring(1, 6);
        }
    }

    //Homepage
    stm.add(gulp.src("./src/pages/home.mustache")
    .pipe(mustache({
        "projects": projects,
        "timeline": timeline,
        "afh": append_file_hash
    },{},{}))
    .pipe(rename("index.html"))
    .pipe(htmlmin({ collapseWhitespace: true, removeComments:true, minifyJS: true, minifyCSS: true }))
    .pipe(gulp.dest("./www"))
    .pipe(browsersync.stream()));

    //Projects pages
    projects.forEach(function(project){

        if(project.draft) {
            return
        }

        var body_partial = "n/a"; //Stupid behavior
        if(project.body) {
            body_partial = fs.readFileSync('./src/pages/'+project.body, 'utf8')
        }

        stm.add(gulp.src("./src/pages/project.mustache")
        .pipe(mustache(
            {
                "prj": project,
                "afh": append_file_hash
            },
            {},
            {
                "body_partial": body_partial
            }
        ))
        .pipe(rename(project.id+".html"))
        .pipe(htmlmin({ collapseWhitespace: true, removeComments:true, minifyJS: true, minifyCSS: true }))
        .pipe(gulp.dest("./www/projects"))
        .pipe(browsersync.stream()));
    });

    //Error pages
    error_pages.forEach(function(error_page){
        stm.add(gulp.src("./src/pages/error-page.mustache")
        .pipe(mustache(
            {
                "error": error_page,
                "afh": append_file_hash
            }
        ))
        .pipe(rename("error-"+error_page.code+".html"))
        .pipe(htmlmin({ collapseWhitespace: true, removeComments:true, minifyJS: true, minifyCSS: true }))
        .pipe(gulp.dest("./www/error-pages"))
        .pipe(browsersync.stream()));
    });

    return stm;
}

/**
 * Copy the src content into the www folder, except for the files that have to be processed
 */
function copysrc(){

    return gulp.src([
        "./src/**/*",
        "!./src/js{,/**}*",
        "!./src/scss{,/**}",
        "!./src/pages{,/**}"
    ])
    .pipe(gulp.dest("./www"))
    .pipe(browsersync.stream());
}

/**
 * initialize BrowserSync
 */
function browserSync() {
    return browsersync.init({
        online: false,
        server: {
            baseDir: "./www"
        }
    });
}

/**
 * reload BrowserSync
 */
function browserSyncReload(done) {
    browsersync.reload();
    done();
}

/**
 * Watch Files
 */
function watchFiles() {
    gulp.watch("./src/scss/**/*", css);
    gulp.watch(["./src/js/**/*.js"], js);
    gulp.watch(["./src/pages/**/*"], pages);
    gulp.watch([
        "./src/**/*",
        "!./src/js{,/**}*",
        "!./src/scss{,/**}",
        "!./src/pages{,/**}"
    ], copysrc);
    gulp.watch(["./www/**/*"], browserSyncReload);
}

//Register tasks
gulp.task("clean", clean);
gulp.task("build", gulp.series(gulp.parallel(vendor, copysrc, css, js), pages));
gulp.task("default", gulp.series(clean, "build"));
gulp.task("dev", gulp.series("default", gulp.parallel(watchFiles, browserSync)));
