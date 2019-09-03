var gulp = require('gulp');
var sass = require('gulp-sass');
var gulpFilter = require('gulp-filter');
var minify = require('gulp-minify-css');
var uglify = require('gulp-uglify');
var rename = require('gulp-rename');
var runSequence = require('gulp-run-sequence');
var clean = require('gulp-clean');
var wpPot = require('gulp-wp-pot');
var sort = require('gulp-sort');
var zip = require('gulp-zip');
const del = require('del');

gulp.task('styles', () => {
  return gulp.src('assets/scss/*.scss')
      .pipe(sass().on('error', sass.logError))
      .pipe(minify())
      .pipe(gulp.dest('./dist/'));
});

gulp.task('clean', () => {
  return del([
      'css/main.css',
  ]);
});

gulp.task('watch', () => {
  gulp.watch('assets/scss/*.scss', (done) => {
      gulp.series(['clean', 'styles'])(done);
  });
});

gulp.task('default', gulp.series(['clean', 'styles']));

gulp.task('package', async function () {
  gulp.src([
      './**',
      './*/**',
      '!./bower_components/**',
      '!./node_modules/**',
      '!./bower_components',
      '!./node_modules',
      '!./vendor/composer/**',
      '!./vendor/autoload.php',
      '!gulpfile.js',
      '!package.json',
      '!composer.json',
      '!*.json',
      '!*.config.js',
      '!*.lock',
      '!*.phar',
      '!*.xml',
  ])
    .pipe(zip('widgetkit-for-elementor.zip'))
    .pipe(gulp.dest('.'));
});

gulp.task('generatePot', function () {
  return gulp.src([
        './*.php',
        './*/**.php',
        './*/*/**.php',
        '!./bower_components/**',
        '!./node_modules/**',
        // '!./assets/**',
        '!./bower_components',
        '!./node_modules',
        // '!./assets' 
        ])
      .pipe(sort())
      .pipe(wpPot( {
        domain: 'widgetkit-for-elementor',
        destFile:'widgetkit-for-elementor.pot',
        package: 'WidgetKit_For_Elementor',
        bugReport: 'https://themesgrove.com',
        lastTranslator: 'themesgrove <info@themesgrove.com>',
        team: 'themesgrove <info@themesgrove.com>'
      } ))
      .pipe(gulp.dest('languages'));
});
