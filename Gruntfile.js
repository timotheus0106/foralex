module.exports = function(grunt) {
	// load all grunt tasks matching the `grunt-*` pattern
	require('load-grunt-tasks')(grunt);

	// var scriptConf = require('./content/themes/mbi-theme/assets/conf/scripts.json');
	// function getScripts(section){
	// 	return scriptConf[section];
	// }

	grunt.file.defaultEncoding = 'utf8';
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		sass: {
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
		},
		// compass: {
		// 	options: {
		// 		cacheDir: '<%= pkg.srcUrl %>styles/.sass-cache'

		// 	},
		// 	prod: {
		// 		options: {
		// 			sassDir: '<%= pkg.srcUrl %>styles',
		// 			cssDir: '<%= pkg.themeUrl %>',
		// 			environment: 'production',
		// 			outputStyle: 'compressed'
		// 		}
		// 	},
		// 	dev: {
		// 		options: {
		// 			sassDir: '<%= pkg.srcUrl %>styles',
		// 			cssDir: '<%= pkg.themeUrl %>',
		// 			outputStyle: 'expanded',
		// 			raw: "sass_options = {:sourcemap => true}\n"
		// 		}
		// 	}
		// },
		autoprefixer: {
			options: {
				// Task-specific options go here.
			},
			prefix: {
				src: '<%= pkg.themeUrl %>style.css',
				dest: '<%= pkg.themeUrl %>style.css'
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
			},
			reqtask: {
				options: {
					mainConfigFile: "<%= pkg.assetsUrl %>conf/build.js"
				}
			},
		},
		uglify: {
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
		},
		watch: {
			options: {
				livereload: true,
				spawn: false
			},
			scripts: {
				files: ['<%= pkg.srcUrl %>/js/**/*.js'],
				tasks: ['requirejs']
				// tasks: ['requirejs:head', 'requirejs:main']
			},
			css: {
				files: ['<%= pkg.srcUrl %>/styles/**/*.scss'],
				tasks: ['sass:dev' , 'autoprefixer']
			},
			html: {
				files: ['<%= pkg.themeUrl %>/**/*.php']
			}
		}
	});

	grunt.registerTask('default', ['watch']);
	grunt.registerTask('req', ['requirejs']);
	grunt.registerTask('build', ['sass:prod', 'autoprefixer', 'cssc:prod', 'requirejs','uglify']);
};