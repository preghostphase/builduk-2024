<?php
// Template Name: Contact page
?>

<?php get_header(); ?>
<?php get_template_part('templates/parts/banner'); ?>

<main id="primary">
	<article class="content__wrapper clean-empty-tags-js">
		<div class="contact">
			<div class="contact__wrapper">
				<div class="contact__info">
					<div class="contact__info-text user-content">
						<?php the_content(); ?>
					</div>
					<div class="contact__info-map">
						<div class="acf-map">

						<?php if(have_rows('map_locations')) : ?>

							<?php while( have_rows('map_locations') ): the_row() ; ?>

							<?php
							$mapLocation = get_sub_field('map_location_items');
							$lat = $mapLocation['lat'];
							$lng = $mapLocation['lng'];
							$mapLocationTitle = get_sub_field('map_location_title');
							?>
							<div class="marker" data-lat="<?php echo $lat; ?>" data-lng="<?php echo $lng; ?>">
								<p class="marker__title"><?php echo $mapLocationTitle; ?></p>
								<?php
									if( $mapLocation ) {

										// Construct the address.
										$address = '';

										// Combine street number and street name in a single segment
										if( isset( $mapLocation['street_number'] ) || isset( $mapLocation['street_name'] ) ) {
											$address .= '<span class="segment-street">';
											if( isset( $mapLocation['street_number'] ) ) {
												$address .= $mapLocation['street_number'] . ' ';
											}
											if( isset( $mapLocation['street_name'] ) ) {
												$address .= $mapLocation['street_name'];
											}
											$address .= '</span>';
										}

										// Add the remaining address components
										foreach( array('city', 'post_code', 'country') as $k ) {
											if( isset( $mapLocation[ $k ] ) ) {
												$address .= sprintf( '<span class="segment-%s">%s</span>', $k, $mapLocation[ $k ] );
											}
										}

										// Trim trailing comma or space.
										$address = trim( $address, ', ' );

										// Display HTML.
										echo '<div class="marker__address">' . $address . '</div>';
									}
								?>
							</div>

							<?php endwhile; ?>

					<?php endif; ?>

						
						</div>
					</div>
				</div>
				<?php if(get_field('ninja_forms_shortcode')) : ?>
					<div class="contact__form">

						<?php $shortcode = get_field('ninja_forms_shortcode'); ?>

						<?php echo do_shortcode($shortcode); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>

	</article>
</main>

<?php get_footer(); ?>


<script type="text/javascript">
(function( $ ) {

/**
 * initMap
 *
 * Renders a Google Map onto the selected jQuery element
 *
 * @date    22/10/19
 * @since   5.8.6
 *
 * @param   jQuery $el The jQuery element.
 * @return  object The map instance.
 */
function initMap( $el ) {

    // Find marker elements within map.
    var $markers = $el.find('.marker');

	console.log('init map');

    // Create gerenic map.
    var mapArgs = {
        zoom        : $el.data('zoom') || 6,
        mapTypeId   : google.maps.MapTypeId.ROADMAP,
		styles: [
			
			{
				"featureType": "all",
				"elementType": "labels.text",
				"stylers": [
					{
						"color": "#878787"
					}
				]
			},
			{
				"featureType": "all",
				"elementType": "labels.text.stroke",
				"stylers": [
					{
						"visibility": "off"
					}
				]
			},
			{
				"featureType": "landscape",
				"elementType": "all",
				"stylers": [
					{
						"color": "#f9f5ed"
					}
				]
			},
			{
				"featureType": "road.highway",
				"elementType": "all",
				"stylers": [
					{
						"color": "#f5f5f5"
					}
				]
			},
			{
				"featureType": "road.highway",
				"elementType": "geometry.stroke",
				"stylers": [
					{
						"color": "#c9c9c9"
					}
				]
			},
			{
				"featureType": "water",
				"elementType": "all",
				"stylers": [
					{
						"color": "#aee0f4"
					}
				]
			}

		]
    };
    var map = new google.maps.Map( $el[0], mapArgs );

    // Add markers.
    map.markers = [];
    $markers.each(function(){
        initMarker( $(this), map );
    });

    // Center map based on markers.
    centerMap( map );

    // Return map instance.
    return map;
}

/**
 * initMarker
 *
 * Creates a marker for the given jQuery element and map.
 *
 * @date    22/10/19
 * @since   5.8.6
 *
 * @param   jQuery $el The jQuery element.
 * @param   object The map instance.
 * @return  object The marker instance.
 */
function initMarker( $marker, map ) {
	

    // Get position from marker.
    var lat = $marker.data('lat');
    var lng = $marker.data('lng');
    var latLng = {
        lat: parseFloat( lat ),
        lng: parseFloat( lng )
    };

    // Create marker instance.
    var marker = new google.maps.Marker({
        position : latLng,
        map: map
    });

    // Append to reference for later use.
    map.markers.push( marker );

    // If marker contains HTML, add it to an infoWindow.
    if( $marker.html() ){

        // Create info window.
        var infowindow = new google.maps.InfoWindow({
            content: $marker.html()
        });

        // Show info window when marker is clicked.
        google.maps.event.addListener(marker, 'click', function() {
            infowindow.open( map, marker );
        });
    }
}

/**
 * centerMap
 *
 * Centers the map showing all markers in view.
 *
 * @date    22/10/19
 * @since   5.8.6
 *
 * @param   object The map instance.
 * @return  void
 */
function centerMap(map) {
    // Create map boundaries from all map markers.
    var bounds = new google.maps.LatLngBounds();
    map.markers.forEach(function(marker) {
        bounds.extend(marker.getPosition());
    });

    // Case: Single marker.
    if (map.markers.length === 1) {
        map.setCenter(bounds.getCenter());

    // Case: Multiple markers.
    } else {
        map.fitBounds(bounds);
        // Set custom zoom level after fitting bounds
        var desiredZoom = 5; // Set your desired zoom level here
        google.maps.event.addListenerOnce(map, 'bounds_changed', function() {
            // console.log("Bounds changed");
            // console.log("Current zoom level:", map.getZoom());
            // console.log("Desired zoom level:", desiredZoom);
            if (map.getZoom() > desiredZoom) {
                console.log("Adjusting zoom level");
                map.setZoom(desiredZoom);
            }
        });
    }
}


// Render maps on page load.
$(document).ready(function(){
    $('.acf-map').each(function(){
        var map = initMap( $(this) );
    });
});

})(jQuery);
</script>