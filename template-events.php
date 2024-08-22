<?php
// Template Name: Events List Page
?>

<?php get_header(); ?>
<?php get_template_part('templates/parts/banner'); ?>

<main id="primary">
	<article class="content__wrapper user-content clean-empty-tags-js">

		<?php the_content(); ?>

		<div class="acf-map">

			<?php
				$today = date('Ymd');
				$args = array(
					'post_type'     => 'events',
					'posts_per_page' => -1,
					'orderby'       => 'meta_value_num',
					'meta_key'      => 'event_date', //ACF date field
					'meta_query'    => array( array(
						'key' => 'event_date',
						'value' => $today,
						'compare' => '>=',
						'type' => 'DATE'
					))
				);
				$upcoming_events = new WP_Query( $args );
			?>
			<?php

			while ($upcoming_events->have_posts()) : $upcoming_events->the_post();

				$mapLocation = get_field('event_location');
				$lat = $mapLocation['lat'];
				$lng = $mapLocation['lng'];

				?>
					<div class="marker" data-lat="<?php echo $lat; ?>" data-lng="<?php echo $lng; ?>">
						<a class="marker__title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						<?php
							if( $mapLocation ) {

								// Loop over segments and construct HTML.
								$address = '';
								foreach( array('name', 'street_number', 'street_name', 'city', 'post_code', 'country') as $i => $k ) {
									if( isset( $mapLocation[ $k ] ) ) {
										$address .= sprintf( '<span class="segment-%s">%s</span>', $k, $mapLocation[ $k ] );
									}
								}
								// Trim trailing comma.
								$address = trim( $address, ', ' );
								// Display HTML.
								echo '<div class="marker__address">' . $address . '</div>';
							}
						?>
					</div>

			<?php endwhile;

			wp_reset_query();

			?>
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

    // Create gerenic map.
    var mapArgs = {
        zoom        : $el.data('zoom') || 16,
        mapTypeId   : google.maps.MapTypeId.ROADMAP,
		// styles: [
			// add snazzy maps code here
		// ]
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
function centerMap( map ) {

    // Create map boundaries from all map markers.
    var bounds = new google.maps.LatLngBounds();
    map.markers.forEach(function( marker ){
        bounds.extend({
            lat: marker.position.lat(),
            lng: marker.position.lng()
        });
    });

    // Case: Single marker.
    if( map.markers.length == 1 ){
        map.setCenter( bounds.getCenter() );

    // Case: Multiple markers.
    } else{
        map.fitBounds( bounds );
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


