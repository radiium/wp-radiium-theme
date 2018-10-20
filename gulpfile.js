
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
