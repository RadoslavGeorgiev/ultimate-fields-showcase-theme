'use strict';

var gulp       = require('gulp');
var sass       = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');
var notify     = require('gulp-notify');

gulp.task('default', function () {
  return gulp.src('./assets/sass/*.scss')
    .pipe(sourcemaps.init())
    .pipe(sass().on('error', err => notify().write( err )))
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest('.'));
});

gulp.task('watch', function () {
  gulp.watch('./assets/sass/*.scss', ['default']);
  gulp.watch('./assets/sass/**/*.scss', ['default']);
});
