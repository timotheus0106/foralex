require.config({
	"appDir": "../src/js",
	"removeCombined": true,
	"baseUrl": "./",
	"paths": {
			"jquery": "vendor/jquery-2.1.0",
			"async": "vendor/async",
			"mbiswiper": "modules/mbiswiper",
			"mbigooglemaps": "modules/mbigooglemaps",
			"vendor_debounce": "vendor/jquery.debounce",
			"vendor_viewport": "vendor/viewport",
			"vendor_swiper": "vendor/jquery.swiper"
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