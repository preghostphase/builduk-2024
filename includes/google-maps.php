<?php

function siteMapKey($api) {
	$api['key'] = 'AIzaSyBvzxAID0YATXLYGrNMnIQXsJBvSkz8ZjM';
	return $api;
}

add_filter('acf/fields/google_map/api', 'siteMapKey');
