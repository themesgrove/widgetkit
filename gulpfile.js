var gulp = require('gulp');
var sass = require('gulp-sass');
// var minify = require('gulp-minify-css');
var uglify = require('gulp-uglify-es').default;
var wpPot = require('gulp-wp-pot');
var sort = require('gulp-sort');
var zip = require('gulp-zip');
var del = require('del');

gulp.task('styles', () => {
  return gulp.src(['assets/scss/*.scss', 'assets/css/*.css'])
      .pipe(sass().on('error', sass.logError))
      // .pipe(minify())
      .pipe(gulp.dest('./dist/css/'));
});

gulp.task('js', () => {
  return gulp.src('assets/js/*.js')
      .pipe(uglify())
      .pipe(gulp.dest('./dist/js/'));
});

gulp.task('fonts', function () {
  return gulp.src('assets/fonts/*')
      .pipe(gulp.dest('./dist/fonts/'));
});

gulp.task('images', function () {
  return gulp.src('assets/images/*.{jpg,png}')
      .pipe(gulp.dest('./dist/images/'));
});

gulp.task('copy-css-from-node-modules', function(){
  return gulp.src([
      'node_modules/animate.css/animate.min.css',
      'node_modules/bootstrap/dist/css/bootstrap.min.css',
      'node_modules/owl.carousel/dist/assets/owl.carousel.min.css',
      'node_modules/owl.carousel/dist/assets/owl.theme.default.min.css',
      'node_modules/uikit/dist/css/uikit.min.css',
    ])
      .pipe(gulp.dest('./dist/css/'));
});
gulp.task('copy-js-from-node-modules', function(){
  return gulp.src([
      'node_modules/bootstrap/dist/js/bootstrap.min.js',
      'node_modules/owl.carousel/dist/owl.carousel.min.js',
      'node_modules/uikit/dist/js/uikit.min.js',
      'node_modules/uikit/dist/js/uikit-icons.min.js',
    ])
      .pipe(gulp.dest('./dist/js/'));
});

gulp.task('copy-resource', gulp.series(['copy-css-from-node-modules', 'copy-js-from-node-modules']));

gulp.task('clean', () => {
  return del([
      'dist/',
  ]);
});

gulp.task('watch', () => {
  gulp.watch('assets/scss/**/*', gulp.series(['styles']));
  gulp.watch('assets/js/*', gulp.series(['js']));
});

gulp.task('build', gulp.series(['clean', 'copy-resource', 'styles', 'js', 'fonts', 'images']));
gulp.task('default', gulp.series(['build', 'watch']));

gulp.task('package', async function () {
  gulp.src([
      './**',
      './*/**',
      '!./bower_components/**',
      '!./node_modules/**',
      '!./bower_components',
      '!./node_modules',
      '!./assets/**',
      '!./vendor/composer/**',
      '!./vendor/autoload.php',
      '!gulpfile.js',
      '!package.json',
      '!composer.json',
      '!*.json',
      '!*.log',
      '!*.zip',
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
