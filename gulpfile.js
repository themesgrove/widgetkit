var gulp = require('gulp');
var zip = require('gulp-zip');
var wpPot = require('gulp-wp-pot');
var sort = require('gulp-sort');


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
