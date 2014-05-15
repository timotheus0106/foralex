require.config({
	"appDir": "../src/js",
	"removeCombined": true,
	"baseUrl": "./",
	"paths": {
			"jquery": "vendor/jquery-2.1.0"
	},
	"dir": "../build/js",
	"optimize": "none",
	"modules": [
		{
			"name": "head",
			"include": "vendor/require"
		},
		{
			"name": "main",
			"exclude": ["head"]
		}
	]
});