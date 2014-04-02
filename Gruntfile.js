module.exports = function(grunt) {
	// load all grunt tasks matching the `grunt-*` pattern
	require('load-grunt-tasks')(grunt);

	var scriptConf = require('./content/themes/mbi-theme/assets/conf/scripts.json');
	function getScripts(section){
		return scriptConf[section];
	}

	grunt.file.defaultEncoding = 'utf8';
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		// sass: {
		// 	prod: {
		// 		options: {
		// 			style: 'compressed',
		// 			sourcemap: false,
		// 			cacheLocation: '<%= pkg.srcUrl %>styles/.sass-cache'
		// 		},
		// 		files: {
		// 			'<%= pkg.themeUrl %>style.css': '<%= pkg.srcUrl %>styles/style.scss',
		// 		}
		// 	},
		// 	dev:{
		// 		options: {
		// 			style: 'expanded',
		// 			sourcemap: true,
		// 			cacheLocation: '<%= pkg.srcUrl %>styles/.sass-cache'
		// 		},
		// 		files: {
		// 			'<%= pkg.themeUrl %>style.css': '<%= pkg.srcUrl %>styles/style.scss',
		// 		}
		// 	}
		// },
		compass: {
			options: {
				cacheDir: '<%= pkg.srcUrl %>styles/.sass-cache'

			},
			prod: {
				options: {
					sassDir: '<%= pkg.srcUrl %>styles',
					cssDir: '<%= pkg.themeUrl %>',
					environment: 'production',
					outputStyle: 'compressed'
				}
			},
			dev: {
				options: {
					sassDir: '<%= pkg.srcUrl %>styles',
					cssDir: '<%= pkg.themeUrl %>',
					outputStyle: 'expanded',
					raw: "sass_options = {:sourcemap => true}\n"
				}
			}
		},
		cssc: {
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
		},
		requirejs: {
			options: {
				baseUrl: "<%= pkg.srcUrl %>js",
				mainConfigFile: "<%= pkg.srcUrl %>/js/build.js",
				out: "<%= pkg.buildUrl %>/js/main.js",
				name: "./main",
				paths: {
					requireLib: 'vendor/require'
				},
				include: 'requireLib'
			},
			prod: {
				options: {
					optimize: "uglify",
					preserveLicenseComments: false,
				}
			},
			dev: {
				options: {
					optimize: "none"
				}
			}
		},
		uglify: {
			target_scripts: {
				files: {
					'<%= pkg.buildUrl %>js/main.js': '<%= pkg.buildUrl %>/js/main.js'
				}
			}
		},
		watch: {
			options: {
				livereload: true,
				spawn: false
			},
			scripts: {
				files: ['<%= pkg.srcUrl %>/js/**/*.js'],
				tasks: ['requirejs:dev']
			},
			css: {
				files: ['<%= pkg.srcUrl %>/styles/**/*.scss'],
				tasks: ['compass:dev', 'cssc:dev']
			},
			html: {
				files: ['<%= pkg.themeUrl %>/**/*.php']
			}
		}
	});

	grunt.registerTask('default', ['watch']);
	grunt.registerTask('build', ['compass:prod', 'cssc:prod', 'requirejs:prod','uglify']);
};