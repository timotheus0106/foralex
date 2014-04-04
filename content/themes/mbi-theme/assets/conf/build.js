require.config({
	appDir: "../src/js",
	removeCombined: true,
	baseUrl: "./",
	paths: {
			requireLib: 'vendor/require',
			jquery: 'vendor/jquery-2.1.0',
			base: 'content/themes/mbi-theme/assets/build/js'
	},
	dir: "../build/js",
	optimize: "none",
	modules: [{
			name: 'head',
			include: 'requireLib'
		},{
				name: 'main',
				exclude: ['head']
		}
	]
});