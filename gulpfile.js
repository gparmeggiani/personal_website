// Load plugins
const autoprefixer = require("gulp-autoprefixer");
const browsersync = require("browser-sync").create();
const cleanCSS = require("gulp-clean-css");
const gulp = require("gulp");
const header = require("gulp-header");
const plumber = require("gulp-plumber");
const rename = require("gulp-rename");
const sass = require("gulp-sass");
const uglify = require("gulp-uglify");
const pkg = require('./package.json');

// Set the banner content
const banner = ['/*!\n',
  ' * <%= pkg.title %> v<%= pkg.version %> (<%= pkg.homepage %>)\n',
  ' * Copyright (c) 2014 - ' + (new Date()).getFullYear(), ' <%= pkg.author %>\n',
  ' * All Rights reserved\n',
  ' */\n',
  '\n'
].join('');

// Copy third party libraries from /node_modules into /vendor
gulp.task('vendor', function(cb) {

  // Bootstrap
  gulp.src([
      './node_modules/bootstrap/dist/**/*',
      '!./node_modules/bootstrap/dist/css/bootstrap-grid*',
      '!./node_modules/bootstrap/dist/css/bootstrap-reboot*'
    ])
    .pipe(gulp.dest('./www/vendor/bootstrap'))

  // Font Awesome
  gulp.src([
      './node_modules/@fortawesome/**/*',
    ])
    .pipe(gulp.dest('./www/vendor'))

  // jQuery
  gulp.src([
      './node_modules/jquery/dist/*',
      '!./node_modules/jquery/dist/core.js'
    ])
    .pipe(gulp.dest('./www/vendor/jquery'))

  // jQuery Easing
  gulp.src([
      './node_modules/jquery.easing/*.js'
    ])
    .pipe(gulp.dest('./www/vendor/jquery-easing'))

  // Magnific Popup
  gulp.src([
      './node_modules/magnific-popup/dist/*'
    ])
    .pipe(gulp.dest('./www/vendor/magnific-popup'))

  cb();

});

// CSS task
//TODO: how to pass through the already minified css?
function css() {
  return gulp
    .src("./src/scss/*.scss")
    .pipe(plumber())
    .pipe(sass({
      outputStyle: "expanded"
    }))
    .on("error", sass.logError)
    .pipe(autoprefixer({
      browsers: ['last 2 versions'],
      cascade: false
    }))
    .pipe(header(banner, {
      pkg: pkg
    }))
    .pipe(rename({
      suffix: ".min"
    }))
    .pipe(cleanCSS())
    .pipe(gulp.dest("./www/static/css"))
    .pipe(browsersync.stream());
}

// JS task
//TODO: how to pass through the already minified js?
function js() {
  return gulp
    .src([
      './src/js/*.js',
      '!./src/js/*.min.js'
    ])
    .pipe(uglify())
    .pipe(header(banner, {
      pkg: pkg
    }))
    .pipe(rename({
      suffix: '.min'
    }))
    .pipe(gulp.dest('./www/static/js'))
    .pipe(browsersync.stream());
}

function build(cb){
    gulp.src([
        './src/**',
        '!./src/js{,/**}',
        '!./src/scss{,/**}'
      ])
      .pipe(gulp.dest('./www'))

    cb();
}

// Tasks
//TODO: add Vendor task
gulp.task("css", css);
gulp.task("js", js);
gulp.task("build", build);

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
  gulp.watch(["./src/**/*", "!./src/js/**", "!./src/scss{,/**}"], build);
  gulp.watch(["./www/**/*"], browserSyncReload);
}

gulp.task("default", gulp.parallel('vendor', build, css, js));

// dev task
gulp.task("dev", gulp.parallel(watchFiles, browserSync));
