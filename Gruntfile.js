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
			prod: {
				options: {
					sassDir: '<%= pkg.srcUrl %>styles',
					cssDir: '<%= pkg.themeUrl %>',
					environment: 'production'
				}
			},
			dev: {
				options: {
					sassDir: '<%= pkg.srcUrl %>styles',
					cssDir: '<%= pkg.themeUrl %>',
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
			}
		},
		concat: {
			scripts: {
				options: {
					banner: '/* Moodley Brand Identity / www.moodley.at\r\nProject: <%= pkg.name %> – Build Version: <%= pkg.version %> - Build Time: <%= grunt.template.today() %> */\r\n'
				},
				files: {
					'<%= pkg.buildUrl %>js/header.js': getScripts('header'),
					'<%= pkg.buildUrl %>js/scripts.js': getScripts('footer')
				}
			}
		},
		uglify: {
			target_scripts: {
				files: {
					'<%= pkg.buildUrl %>js/scripts.js': '<%= pkg.buildUrl %>/js/scripts.js'
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
				tasks: ['concat']
				// options: {
				// 	spawn: false,
				// }
			},
			css: {
				files: ['<%= pkg.srcUrl %>/styles/*.scss'],
				tasks: ['compass:dev', 'cssc']
				// options: {
				// 	spawn: false,
				// }
			},
			html: {
				files: ['<%= pkg.themeUrl %>/**/*.php']
				// options: {
				// 	spawn: false,
				// }
			}
		},
		// deployments: {
		// 	options: {},
		// 	// "Local" target
		// 	"local": {
		// 		"title": "Local",
		// 		"database": "fuhrwerk",
		// 		"user": "root",
		// 		"pass": "",
		// 		"host": "127.0.0.1",
		// 		"url": "http://10.0.0.31/fuhrwerk"
		// 	},
		// 	// "Remote" target
		// 	"production": {
		// 		"title": "Production",
		// 		"database": "fuhrwerkcc",
		// 		"user": "fuhrwerkcc",
		// 		"pass": "Nyxmjkp8",
		// 		"host": "127.0.0.1",
		// 		"url": "http://fuhrwerkcc.clients.moodley.at/",
		// 		"ssh_host": "root@rs203775.rs.hosteurope.de"
		// 	}
		// },
		// jshint: {
		// 	options: {
		// 		curly: true,
		// 		eqeqeq: true,
		// 		eqnull: true,
		// 		browser: true,
		// 		globals: {
		// 			jQuery: true
		// 		}
		// 	},
		// 	all: ['Gruntfile.js', '<%= pkg.buildUrl %>/js/**/*.js']
		// }
	});

	grunt.registerTask('default', ['watch']);
	grunt.registerTask('build', ['compass:prod', 'cssc', 'concat', 'uglify']);
};