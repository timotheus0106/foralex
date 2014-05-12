module.exports = {
	prod: {
		options: {
			style: 'compressed',
			sourcemap: false,
			cacheLocation: '<%= pkg.srcUrl %>styles/.sass-cache'
		},
		files: {
			'<%= pkg.themeUrl %>style.css': '<%= pkg.srcUrl %>styles/style.scss',
		}
	},
	dev:{
		options: {
			style: 'expanded',
			sourcemap: true,
			cacheLocation: '<%= pkg.srcUrl %>styles/.sass-cache'
		},
		files: {
			'<%= pkg.themeUrl %>style.css': '<%= pkg.srcUrl %>styles/style.scss',
		}
	}
};