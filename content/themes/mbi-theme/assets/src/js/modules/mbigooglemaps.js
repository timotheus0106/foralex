/**
 * mbiGooglemaps module
 *
 * @version 0.1.3
 *
 * @todo setup arguments on init
 */
define([
	'jquery',
	'async!http://maps.google.com/maps/api/js?sensor=false'
], function(
	$
) {
	'use strict';

	var module = {

		init: function(args) {

			module.map(args);

		},
		map: function(args) {

			var wrapper = '.googlemaps';
			var mapId = '.googlemaps__map';

			var address = $(wrapper).attr('data-location');

			var map;

			var styles = [
				{
					'elementType': 'geometry.fill',
					'stylers': [
						{'visibility': 'simplified'}
					]
				},
				{
					'featureType': 'poi',
					'elementType': 'labels.icon',
					'stylers': [
						{'visibility': 'off'}
					]
				},
				{
					'featureType': 'water',
					'stylers': [
						{'visibility': 'simplified'},
						{'lightness': 83}
					]
				},
				{
					'featureType': 'poi.park',
					'stylers': [
						{'visibility': 'simplified'},
						{'lightness': 24},
						{'saturation': -66}
					]
				},
				{
					'featureType': 'transit.station',
					'elementType': 'labels.icon',
					'stylers': [
						{'saturation': -100}
					]
				}
			];
			var mapOptions = {

				zoom: 17,
				center: new google.maps.LatLng(47.071332, 15.438013),//48.205668, 16.376943
				scrollwheel: false,
				navigationControl: false,
				mapTypeControl: false,
				scaleControl: false,
				panControl: false,
				streetViewControl: false,
				zoomControl: false,
				// zoomControlOptions: {
				// 	style: google.maps.ZoomControlStyle.SMALL
				// },
				mapTypeId: google.maps.MapTypeId.ROADMAP, // This value can be set to define the map type ROADMAP/SATELLITE/HYBRID/
				styles: styles
				/*
				mapTypeControlOptions: {
						mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style']
				}
				*/

			};

			var mapMatches = document.querySelectorAll('div'+mapId);
			map = new google.maps.Map(mapMatches[0], mapOptions);

			var imageL = new google.maps.MarkerImage('http://maps.google.com/mapfiles/ms/icons/blue-dot.png',

				new google.maps.Size(36, 49),
				new google.maps.Point(0, 0)

			);

			var geocoder = new google.maps.Geocoder();

			var lat;
			var lng;

			geocoder.geocode({'address': address}, function(results, status) {

				if (status == google.maps.GeocoderStatus.OK) {

					lat = results[0].geometry.location.lat();
					lng = results[0].geometry.location.lng();

					var markerL = new google.maps.Marker({

						position: new google.maps.LatLng(lat, lng),
						map: map,
						draggable: false,
						//animation: google.maps.Animation.DROP,
						icon: imageL

					});

					var latLng = markerL.getPosition(); // returns LatLng object
					map.setCenter(latLng); // setCenter takes a LatLng object

				}

			});

			google.maps.event.addDomListener(window, 'resize', function() {

				var center = map.getCenter();
				google.maps.event.trigger(map, 'resize');
				map.setCenter(center);

			});

		}

	};

	return module;

});