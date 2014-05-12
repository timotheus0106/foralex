module.exports = {
 options: {
		livereload: true,
		spawn: true,
		debounceDelay: 250
 },
 scripts: {
		files: ['<%= pkg.srcUrl %>/js/**/*.js'],
		tasks: ['requirejs']
		// tasks: ['requirejs:head', 'requirejs:main']
 },
 sass: {
    options: {
      livereload: false
    },
		files: ['<%= pkg.srcUrl %>/styles/**/*.scss'],
		tasks: ['sass:dev' , 'autoprefixer']
 },
 css: {
		files: ['<%= pkg.themeUrl %>/style.css'],
		tasks: []
 },
 html: {
		files: ['<%= pkg.themeUrl %>/**/*.php'],
		tasks: []
 }
};