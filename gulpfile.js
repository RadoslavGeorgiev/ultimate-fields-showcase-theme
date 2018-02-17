'use strict';

var gulp = require('gulp');
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');

gulp.task('default', function () {
  return gulp.src('./assets/sass/*.scss')
    .pipe(sourcemaps.init())
    .pipe(sass().on('error', sass.logError))
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest('.'));
});

gulp.task('watch', function () {
  gulp.watch('./assets/sass/*.scss', ['default']);
  gulp.watch('./assets/sass/**/*.scss', ['default']);
});
