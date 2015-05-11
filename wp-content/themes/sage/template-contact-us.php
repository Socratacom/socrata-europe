<?php
/**
 * Template Name: Contact Us
 */
?>
<?php while (have_posts()) : the_post(); ?>
	<section>
		<div id="map" style="width:100%; height:300px;"></div>
	</section>
	<?php get_template_part('templates/content', 'page'); ?>
	<?php get_template_part('templates/content', 'contact-form'); ?>	
<?php endwhile; ?>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCFRLOqMI36jBDQB7BQDljVAA3FlMBmCfI&sensor=false"></script>       
<script type="text/javascript">
    // When the window has finished loading create our google map below
    google.maps.event.addDomListener(window, 'load', init);

    function init() {
        // Basic options for a simple Google Map
        // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
        var mapOptions = {
            // How zoomed in you want the map to start at (always required)
            zoom: 15,
			scrollwheel:false,
			mapTypeControl:false,

            // The latitude and longitude to center the map (always required)
            center: new google.maps.LatLng(51.5213559, -0.0766862),

            // How you would like to style the map. 
            // This is where you would paste any style found on Snazzy Maps.
            styles: [{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#444444"}]},{"featureType":"administrative.country","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#f6f6f6"}]},{"featureType":"administrative.locality","elementType":"labels.text.fill","stylers":[{"color":"#ae895d"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#f2f2f2"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#d0d0d0"},{"visibility":"on"}]}]
        };

        // Get the HTML DOM element that will contain your map 
        // We are using a div with id="map" seen below in the <body>
        var mapElement = document.getElementById('map');

        // Create the Google Map using our element and options defined above
        var map = new google.maps.Map(mapElement, mapOptions);

        // Let's also add a marker while we're at it
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(51.5213559, -0.0766862),
            map: map,
            title: 'Snazzy!'
        });
    }
</script>