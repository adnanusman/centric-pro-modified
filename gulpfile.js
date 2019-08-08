// Include the necessary modules
var gulp = require('gulp'),
	browserSync = require('browser-sync'),
	sass = require('gulp-sass');
	sourcemaps = require('gulp-sourcemaps');

// configure Browsersync
gulp.task('browser-sync', function() {
	var files = [
		'./style.css',
		'./**/*.php'
	];

	// initialize Browsersync with a PHP server
	browserSync.init(files, {
        proxy: 'centric-pro.test',
        logPrefix: 'centric-pro.test',
        reloadDelay: 3000,
        open: false
	});
});

// Configure Sass taks to run when the specified .scss files change.
// Browsersync will also reload browsers.
gulp.task('sass', function() {
	return gulp.src('sass/*.scss')
		.pipe(sourcemaps.init())
		.pipe(sass({
			'outputStyle': 'compressed'
		}))
		.pipe(sourcemaps.write())
		.pipe(gulp.dest('./'))
		.pipe(browserSync.stream());
});

// Create the default task that can be called using 'gulp'.
// The task will process sass, run browser-sync and start watching for changes.
gulp.task('default', ['sass', 'browser-sync'], function() {
	gulp.watch("sass/**/*.scss", ['sass'])
})
