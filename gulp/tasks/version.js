var gulp = require('gulp');
var rev = require('gulp-rev');
var config = require('../config').version;

gulp.task('version', function () {
    // by default, gulp would pick `assets/css` as the base,
    // so we need to set it explicitly:
    return gulp.src(config.src, {base: './public'})
        .pipe(gulp.dest(config.dest))  // copy original assets to build dir
        .pipe(rev())
        .pipe(gulp.dest(config.dest))  // write rev'd assets to build dir
        .pipe(rev.manifest())
        .pipe(gulp.dest(config.dest)); // write manifest to build dir
});