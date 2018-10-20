
var gulp = require('gulp')
var uglify = require('gulp-uglify');
var rename = require('gulp-rename');

var src = './assets/js';
var dest = './assets/test';

gulp.task('compress', function (cb) {
    return gulp.src([
        'assets/js/**/*.js',
        '!assets/js/**/*.min.js'
    ])
      .pipe(uglify().on('error', function(e){
        console.log(e);
     }))
      .pipe(rename(function(path) {
            path.extname = ".min.js";
      }))
      .pipe(gulp.dest('assets/js'));
  });
