module.exports = {
	prod: {
		options: {
			consolidateViaDeclarations: false,
			consolidateViaSelectors:    true,
			consolidateMediaQueries:    true
		},
		files: {
			'<%= pkg.themeUrl %>style.css': '<%= pkg.themeUrl %>style.css'
		}
	},
	dev: {
		options: {
			consolidateViaDeclarations: false,
			consolidateViaSelectors:    true,
			consolidateMediaQueries:    true,
			lineBreaks: false,
			compress: false
		},
		files: {
			'<%= pkg.themeUrl %>style.css': '<%= pkg.themeUrl %>style.css'
		}
	}
};