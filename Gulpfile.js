/* 
APPALOOSA BOOKS GULPFILE
Used this file to compile the project js and css the proper way
*/
var gulp 		 = require('gulp'),
	sass 		 	 = require('gulp-sass'),
	concat 		 = require('gulp-concat'),
	minify 		 = require('gulp-clean-css'), // for css
	uglify		 = require('gulp-uglify'); 	  // for js
	gulpUtil	 = require('gulp-util');
/* Options */
var options_sass = {
	outputStyle: 'compressed'
};
/* APPALOOSA */
gulp.task('ap-css', function(){
	return gulp.src( './webroot/scss/*.scss' )
	.pipe(sass( options_sass ).on('error', sass.logError))
	.pipe(concat('main.min.css'))
	.pipe(minify())
	.pipe(gulp.dest( './webroot/dist/css' ));});
/* Complies all the js files in /webroot/js folder to webroot/dist/js */
gulp.task('ap-js', function(){
	return gulp.src('./webroot/js/**/*.js')
	.pipe(concat('main.min.js'))
	.pipe(uglify().on('error', gulpUtil.log))
	.pipe(gulp.dest('./webroot/dist/js'));
});
gulp.task('ap-watch', function(){
	// scss watchings
	gulp.watch('./webroot/scss/**/*.scss', ['ap-css']);
	// js watchings
	gulp.watch('./webroot/js/**/*.js', ['ap-js']);
});
/* ADMIN_ROOT */
gulp.task('admin_root-css', function(){
	return gulp.src( './webroot/admin_root/scss/*.scss' )
	.pipe(sass( options_sass ).on('error', sass.logError))
	.pipe(concat('main.min.css'))
	.pipe(minify())
	.pipe(gulp.dest( './webroot/admin_root/dist/css' ));});
gulp.task('admin_root-js', function(){
	return gulp.src('./webroot/admin_root/js/**/*.js')
	.pipe(concat('main.min.js'))
	.pipe(uglify().on('error', gulpUtil.log))
	.pipe(gulp.dest('./webroot/admin_root/dist/js'));
});
gulp.task('admin_root-watch', function(){
	// scss watchings
	gulp.watch('./webroot/admin_root/scss/**/*.scss', ['admin_root-css']);
	// js watchings
	gulp.watch('./webroot/admin_root/js/**/*.js', ['admin_root-js']);
});
/* SHARED */
gulp.task('shared-css', function(){
	return gulp.src( './webroot/shared/scss/*.scss' )
	.pipe(sass( options_sass ).on('error', sass.logError))
	.pipe(concat('main.min.css'))
	.pipe(minify())
	.pipe(gulp.dest( './webroot/shared/dist/css' ));});
gulp.task('shared-js', function(){
	return gulp.src('./webroot/shared/js/**/*.js')
	.pipe(concat('main.min.js'))
	.pipe(uglify().on('error', gulpUtil.log))
	.pipe(gulp.dest('./webroot/shared/dist/js'));
});
gulp.task('shared-watch', function(){
	// scss watchings
	gulp.watch('./webroot/shared/scss/**/*.scss', ['shared-css']);
	// js watchings
	gulp.watch('./webroot/shared/js/**/*.js', ['shared-js']);
});
/* DEFAULTS */
gulp.task('default', [ 
	'ap-css', 
	'admin_root-css',
	'shared-css',
	'ap-js',
	'admin_root-js',
	'shared-js',
	'ap-watch',
	'shared-watch',
	'admin_root-watch',
], function(){
	// default task callback
});