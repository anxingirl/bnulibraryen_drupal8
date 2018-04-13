var gulp = require('gulp');
var less = require('gulp-less');

gulp.task('less', ()=>{
	return gulp.src('./css/less/*.less')
		.pipe(less())
                .on('error', (err)=>{
                    console.log(err);
                })
		.pipe(gulp.dest('./css/'));
})

gulp.task('watch', ()=>{
	gulp.watch('./css/less/*.less', ['less'])
})

gulp.task('default', ['less']);
