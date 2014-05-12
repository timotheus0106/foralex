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
				files: [{
					expand: true,
					cwd: '<%= pkg.buildUrl %>js',
					src: '*.js',
					dest: '<%= pkg.buildUrl %>js'
				}]
			}
		},
		// deployments: {
		// 	options: {
		// 		backups_dir: "./backups",
		// 		target: 'stage'
		// 	},
		// 	local: {
		// 		"title": "Local",
		// 		"database": "moodley",
		// 		"user": "root",
		// 		"pass": "",
		// 		"host": "localhost",
		// 		"url": "http://127.0.0.1"
		// 	},
		// 	stage: {
		// 		title: "Staging",
		// 		database: "usr_web176_2",
		// 		user: "web176",
		// 		pass: "zKPtkjgj",
		// 		host: "localhost",
		// 		url: "dev.moodley.at",
		// 		ssh_host: "web176@dev.moodley.at"
		// 	}
		// },
		'ftp-deploy': {
			full: {
				auth: {
					host: 'dev.moodley.at',
					port: 21,
					authKey: 'web176'
				},
				exclusions: ['**/.DS_Store', '**/Thumbs.db', '.ftppass', '.git', '.htaccess', '.gitignore', '.gitmodules', '.git', 'Gruntfile.js', 'node_modules', 'package.json', 'README.md', 'wp-local-config.php', './content/themes/mbi-theme/assets/src', './content/themes/mbi-theme/assets/conf'],
				src: './',
				dest: '/html/moodleyat/'
			},
			theme: {
				auth: {
					host: 'dev.moodley.at',
					port: 21,
					authKey: 'web176'
				},
				exclusions: ['**/.DS_Store', '**/Thumbs.db', '.ftppass', '.git', '.htaccess', '.gitignore', '.gitmodules', '.git', 'Gruntfile.js', 'node_modules', 'package.json', 'README.md', 'wp-local-config.php', './content/themes/mbi-theme/assets/src', './content/themes/mbi-theme/assets/conf'],
				src: './content/themes/mbi-theme',
				dest: '/html/moodleyat/content/themes/mbi-theme'
			},
			plugins: {
				auth: {
					host: 'dev.moodley.at',
					port: 21,
					authKey: 'web176'
				},
				exclusions: ['**/.DS_Store', '**/Thumbs.db', '.ftppass', '.git', '.htaccess', '.gitignore', '.gitmodules', '.git', 'Gruntfile.js', 'node_modules', 'package.json', 'README.md', 'wp-local-config.php', './content/themes/mbi-theme/assets/src', './content/themes/mbi-theme/assets/conf'],
				src: './content/plugins',
				dest: '/html/moodleyat/content/plugins'
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
	grunt.registerTask('deploy', ['ftp-deploy:theme']);
	grunt.registerTask('deploy-plugins', ['ftp-deploy:plugins']);
	grunt.registerTask('deploy-full', ['ftp-deploy:full']);
	grunt.registerTask('build', ['sass:prod', 'autoprefixer', 'cssc:prod', 'requirejs','uglify']);
};