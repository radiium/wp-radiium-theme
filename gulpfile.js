
var gulp = require('gulp')
var uglify = require('gulp-uglify');
var rename = require('gulp-rename');
var sass = require('gulp-sass');
sass.compiler = require('node-sass');

// Compress JS files
gulp.task('compress', function() {
    return gulp.src([
        'assets/scripts/**/*.js',
        '!assets/scripts/**/*.min.js'
    ])
    .pipe(uglify().on('error', function(e){
        console.log(e);
    }))
    .pipe(rename(function(path) {
        path.extname = ".min.js";
    }))
    .pipe(gulp.dest('assets/scripts'));
});

// Compress photoswipe-ui-default
gulp.task('compress:photoswipe', function() {
    return gulp.src([
        'assets/libs/PhotoSwipe-4.1.2/photoswipe-ui-default.js',
    ])
    .pipe(uglify().on('error', function(e){
        console.log(e);
    }))
    .pipe(rename(function(path) {
        path.extname = ".min.js";
    }))
    .pipe(gulp.dest('assets/libs/PhotoSwipe-4.1.2'));
});

// Watch JS files change
gulp.task('compress:watch', function() {
    gulp.watch('./assets/scripts/**/*.js', ['compress']);
});

// Compil SASS files
gulp.task('sass', function () {
    return gulp.src('./assets/styles/source.scss')
        .pipe(sass({ outputStyle: 'compact' }).on('error', sass.logError))
        .pipe(rename('style.css'))
        .pipe(gulp.dest('./'));
});

// Watch SASS files change
gulp.task('sass:watch', function () {
    gulp.watch('./assets/styles/**/*.scss', ['sass']);
});


// Watch SASS/js files change
gulp.task('all:watch', ['sass:watch', 'compress:watch']);
