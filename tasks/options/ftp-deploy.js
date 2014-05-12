module.exports = {
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
	},
	functions: {
		auth: {
			host: 'dev.moodley.at',
			port: 21,
			authKey: 'web176'
		},
		exclusions: ['**/.DS_Store', '**/Thumbs.db', '.ftppass', '.git', '.htaccess', '.gitignore', '.gitmodules', '.git', 'Gruntfile.js', 'node_modules', 'package.json', 'README.md', 'wp-local-config.php', './content/themes/mbi-theme/assets/src', './content/themes/mbi-theme/assets/conf', './content/themes/mbi-theme'],
		src: './content/themes/mbi-theme/',
		dest: '/html/moodleyat/content/themes/mbi-theme'
	}
};