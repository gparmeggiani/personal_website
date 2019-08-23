// Load plugins
const del = require('del');
const fs = require('fs');
const gulp = require("gulp");
const browsersync = require("browser-sync").create();
const cleanCSS = require("gulp-clean-css");
const header = require("gulp-header");
const plumber = require("gulp-plumber");
const rename = require("gulp-rename");
const sass = require("gulp-sass");
const uglify = require("gulp-uglify");
const mustache = require("gulp-mustache");
var concat = require('gulp-concat');

const pkg = require('./package.json');

// C-Style banner for css and js files
const cstyle_banner = ['/*!\n',
  ' * <%= pkg.title %> v<%= pkg.version %> (<%= pkg.homepage %>)\n',
  ' * Copyright (c) 2014 - ' + (new Date()).getFullYear(), ' <%= pkg.author %>\n',
  ' * All Rights reserved\n',
  ' */\n',
  '\n'
].join('');


function clean(done) {
    del([
        'www/**/*'
    ]);

    done();
}

// create the 'vendor' folder by copying third party libraries from /node_modules into /www/vendor
function vendor(done) {
    // Bootstrap
    gulp.src([
        'node_modules/bootstrap/dist/**/*',
        '!node_modules/bootstrap/dist/css/bootstrap-grid*',
        '!node_modules/bootstrap/dist/css/bootstrap-reboot*'
    ])
    .pipe(gulp.dest('www/vendor/bootstrap'))

    // Font Awesome
    gulp.src([
        'node_modules/@fortawesome/**/*',
    ])
    .pipe(gulp.dest('www/vendor'))

    // jQuery
    gulp.src([
        'node_modules/jquery/dist/*',
        '!node_modules/jquery/dist/core.js'
    ])
    .pipe(gulp.dest('www/vendor/jquery'))

    // jQuery Easing
    gulp.src([
        'node_modules/jquery.easing/*.js'
    ])
    .pipe(gulp.dest('www/vendor/jquery-easing'))

    // Typed.js
    gulp.src([
        'node_modules/typed.js/lib/typed.min.js'
    ])
    .pipe(gulp.dest('www/vendor/typed.js'))

    // Prism.js
    gulp.src([
        'node_modules/prismjs/components/prism-core.min.js',
        'node_modules/prismjs/components/prism-clike.min.js',
        'node_modules/prismjs/components/prism-c.min.js',
        'node_modules/prismjs/components/prism-python.min.js'
    ])
    .pipe(concat('prism.min.js'))
    .pipe(gulp.dest('www/vendor/prism.js'))

    gulp.src([
        'node_modules/prismjs/themes/prism.css',
        'node_modules/prismjs/themes/prism-okaidia.css'
    ])
    .pipe(gulp.dest('www/vendor/prism.js'))

    done();
}

// CSS task
function css(done) {
    gulp.src("./src/scss/*.scss")
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
    .pipe(gulp.dest("./www/static/css"))
    .pipe(browsersync.stream());

    done();
}

// JS task
function js(done) {

    //Minify js files
    gulp.src([
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
    .pipe(gulp.dest('./www/static/js'))
    .pipe(browsersync.stream());

    //pass-through already minifed js files
    gulp.src([
        './src/js/*.min.js'
    ])
    .pipe(gulp.dest('./www/static/js'))
    .pipe(browsersync.stream());

    done();
}

// Render the html pages
function pages(done){

    projects = JSON.parse(fs.readFileSync('./src/pages/data/projects.json', 'utf8'));
    timeline = JSON.parse(fs.readFileSync('./src/pages/data/timeline.json', 'utf8'));

    //Cleanup
    del([
        'www/projects/**/*'
    ]);

    //Homepage
    gulp.src("./src/pages/home.mustache")
    .pipe(mustache({
        projects: projects,
        timeline: timeline
    },{},{}))
    .pipe(rename("index.html"))
    .pipe(gulp.dest("./www"))
    .pipe(browsersync.stream());

    //Projects pages
    projects.forEach(function(project){

        if(project.draft) {
            return
        }

        var extra_partial = "n/a"; //Stupid behavior
        if(project.extra) {
            extra_partial = fs.readFileSync('./src/pages/'+project.extra, 'utf8')
        }

        gulp.src("./src/pages/project.mustache")
        .pipe(mustache(
            project,
            {},
            {
                "extra_partial": extra_partial
            }
        ))
        .pipe(rename(project.id+".html"))
        .pipe(gulp.dest("./www/projects"))
        .pipe(browsersync.stream());
    });

    done();
}

// Copy the src content into the www folder, except for the files that have to be processed
function copysrc(done){

    gulp.src([
        "./src/**/*",
        "!./src/js{,/**}*",
        "!./src/scss{,/**}",
        "!./src/pages{,/**}"
    ])
    .pipe(gulp.dest("./www"))
    .pipe(browsersync.stream());

    done();
}

// Register tasks
gulp.task("clean", clean);
gulp.task("vendor", vendor);
gulp.task("css", css);
gulp.task("js", js);
gulp.task("pages", pages);
gulp.task("copysrc", copysrc);

// BrowserSync
function browserSync(done) {
    browsersync.init({
        online: false,
        server: {
            baseDir: "./www"
        }
    });

    done();
}

// BrowserSync Reload
function browserSyncReload(done) {
    browsersync.reload();
    done();
}

// Watch files
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

//default task
gulp.task("default", gulp.parallel(vendor, copysrc, pages, css, js));

//dev task
gulp.task("dev", gulp.series("default", gulp.parallel(watchFiles, browserSync)));
