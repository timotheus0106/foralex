module.exports = {
	target_scripts: {
		// files: {
		// 	'<%= pkg.buildUrl %>js/*.js': '<%= pkg.buildUrl %>js/*.js'
		// }
		files: [{
			expand: true,
			cwd: '<%= pkg.buildUrl %>js',
			src: '*.js',
			dest: '<%= pkg.buildUrl %>js'
		}]
	}
};