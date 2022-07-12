<?php
/**
 * The template for displaying 404 pages (Not Found).
 */

// check for redirects first
$redirs = [
	'/travelguide/things-san-diego-winter/' => '/travelguide/best-time-to-visit-san-diego/',
	'/travelguide/andy-williams-returns-to-branson-with-all-star-variety-show/' => '/travelguide/destination/ozark-mountains/branson/',
	'/travelguide/hamner-barber-variety-show-named-best-show-for-families/' => '/travelguide/destination/ozark-mountains/branson/',
	'/travelguide/comedy-shows-in-myrtle-beach/' => '/travelguide/myrtle-beach-variety-shows/',
	'/travelguide/nelly-to-perform-in-concert-in-branson/' => '/travelguide/destination/ozark-mountains/branson/',
	'/travelguide/grand-strand-freedom-festival-scheduled-for-freestyle-music-park/' => '/travelguide/destination/coastal-carolina/myrtle-beach/',
	'/travelguide/branson-named-top-holiday-lights-vacation-destination/' => '/travelguide/the-best-of-branson-missouri-for-the-holiday-season/',
	'/travelguide/crayola-brings-color-creativity-orlando-crayola-experience/' => '/travelguide/experience-orlando-interactive-attractions-for-family-fun/',
	'/travelguide/save-50-on-tony-orlando-tickets-for-three-days-only/' => '/detail/tony-orlando-branson',
	'/travelguide/get-the-latest-branson-news-deals-by-following-reservebranson-on-facebook-twitter/' => '/us/branson',
	'/travelguide/disney-world-plans-week-long-4th-of-july-celebrations/' => '/travelguide/information/central-florida/orlando/events/',
	'/travelguide/shagging-on-the-riverwalk-concert-series-returns-this-summer/' => '/travelguide/information/mid-atlantic/williamsburg/events/',
	'/travelguide/yakov-smirnoff-announces-final-season-in-branson-mo/' => '/travelguide/destination/ozark-mountains/branson/',
	'/travelguide/southwest-airlines-to-fly-the-friendly-skies-in-branson/' => '/travelguide/destination/ozark-mountains/branson/',
	'/travelguide/myrtle-beach-museums-with-exhibits/' => '/travelguide/myrtle-beach-museums/',
	'/travelguide/disneys-little-mermaid-premiering-live-branson-summer/' => '/travelguide/destination/ozark-mountains/branson/',
	'/travelguide/titanic-violin-on-display-at-pigeon-forge-titanic-museum/' => '/detail/titanic-museum-pigeon-forge',
	'/travelguide/save-15-on-dixie-stampede-tickets-for-limited-time-only/' => '/detail/dolly-partons-stampede-branson',
	'/travelguide/outlaw-run-races-into-silver-dollar-city/' => '/detail/silver-dollar-city-branson',
	'/travelguide/promised-land-zoo-open-for-up-close-animal-encounters/' => '/travelguide/destination/ozark-mountains/branson/',
	'/travelguide/williamsburg-va-hotels-with-free-parking/' => '/us/williamsburg/hotels',
	'/travelguide/disney-world-resorts-debut-on-reserve-orlando/' => '/us/orlando/hotels/hotels-near-disney-world',
	'/travelguide/hotels-in-williamsburg-va-with-lounge/' => '/us/williamsburg/hotels',
	'/travelguide/dixie-stampede-christmas-show-a-pigeon-forge-holiday-delight/' => '/detail/dolly-partons-stampede-pigeon-forge',
	'/travelguide/pawleys-island-festival-of-music-art-kicks-off-22nd-season/' => '/travelguide/information/coastal-carolina/myrtle-beach/events/',
	'/travelguide/fiddle-mastery-showmanship-shines-during-shoji-tabuchi-show/' => '/us/branson/shows',
	'/travelguide/branson-landing-opening-new-shops-restaurants-soon/' => '/travelguide/variety-of-restaurants-available-at-branson-landing/',
	'/travelguide/legends-in-concert-features-an-all-star-line-up/' => '/detail/legends-concert-branson-mo',
	'/travelguide/showboat-branson-belle-celebrates-new-show/' => '/detail/showboat-branson-belle-branson-missouri',
	'/travelguide/myrtle-beach-named-top-beach-destination-for-2012/' => '/travelguide/destination/coastal-carolina/myrtle-beach/',
	'/travelguide/myrtle-beach-clogging-group-all-that-appearing-on-americas-got-talent/' => '/travelguide/information/coastal-carolina/myrtle-beach/events/',
	'/travelguide/christmas-shows-in-gatlinburg-tennessee/' => '/travelguide/in-depth-guide-to-an-amazing-smoky-mountain-christmas/',
	'/travelguide/reserve-direct-destinations-offer-top-roller-coaster-thrills/' => '/travelguide/the-top-10-new-roller-coasters-2019/',
	'/travelguide/bummed-that-arabian-nights-is-closed-check-out-these-orlando-shows-instead/' => '/us/orlando/shows',
	'/travelguide/undercover-boss-features-silver-dollar-city-showboat-branson-belle/' => '/detail/showboat-branson-belle-branson-missouri',
	'/travelguide/join-yakov-smirnoff-for-final-show-in-branson/' => '/us/branson/shows',
	'/travelguide/pearl-harbor-tours-in-oahu/' => '/us/hawaii/things-to-do/pearl_harbor_memorial_tours',
	'/travelguide/silver-dollar-city-hosts-first-ever-independence-day-celebration/' => '/detail/silver-dollar-city-branson',
	'/travelguide/seaworld-rescue-efforts-save-sea-lions/' => '/travelguide/tips-for-visiting-seaworld-san-diego/',
	'/travelguide/art-film-festivals-come-to-myrtle-beach/' => '/travelguide/destination/coastal-carolina/myrtle-beach/',
	'/travelguide/rev-your-engines-at-the-shepherd-super-summer-cruise-in-branson/' => '/detail/shepherd-hills-vigilante-ziprider',
	'/travelguide/myrtle-beach-attractions-now-include-nascar-racing-experience-oceanfront-zip-lining/' => '/us/myrtle-beach/things-to-do',
	'/travelguide/conquer-the-coasters-in-orlando-reservedirect-style/' => '/travelguide/biggest-baddest-thrill-rides-orlando/',
	'/travelguide/dollywood-dollywoods-splash-country-win-five-golden-ticket-awards/' => '/detail/dollywood-tickets-pigeon-forge',
	'/travelguide/upcoming-special-events-at-the-titanic-museum/' => '/detail/titanic-museum-branson',
	'/travelguide/explore-more-for-less-with-gatlinburg-aquarium-coupons/' => '/us/gatlinburg/things-to-do',
	'/travelguide/summer-breeze-concert-series-returns-to-williamsburg-va/' => '/travelguide/information/mid-atlantic/williamsburg/events/',
	'/travelguide/firemans-landing-silver-dollar-city-photo-tour/' => '/detail/silver-dollar-city-branson',
	'/travelguide/an-old-time-christmas-comes-to-silver-dollar-city/' => '/travelguide/the-best-of-branson-missouri-for-the-holiday-season/',
	'/travelguide/dollywoods-harvest-festival/' => '/travelguide/3-days-in-smoky-mountains-this-fall/',
	'/travelguide/legends-golf-returns-branson-unique-pga-event/' => '/travelguide/tee-best-branson-golf-courses/',
	'/travelguide/branson-named-one-of-the-top-ten-friendliest-cities-in-america/' => '/travelguide/destination/ozark-mountains/branson/',
	'/travelguide/times-square-nyc-photo-tour/' => '/travelguide/times-square/',
	'/travelguide/salute-the-american-west-during-national-harvest-cowboy-festival-at-silver-dollar-city/' => '/detail/silver-dollar-city-branson',
	'/travelguide/stringtime-in-the-smokies-cornhole-tournament-at-the-old-mill/' => '/travelguide/information/smoky-mountains/events/',
	'/travelguide/silver-dollar-city-hosts-harlem-globetrotters-summer/' => '/travelguide/information/ozark-mountains/branson/events/',
	'/travelguide/hawaii-songwriting-festival/' => '/travelguide/information/hawaiian-islands/events/',
	'/travelguide/adler-planetarium-tickets/' => '/us/chicago/things-to-do',
	'/travelguide/annual-treel-lighting-ceremony-held-at-broadway-at-the-beach/' => '/travelguide/information/coastal-carolina/myrtle-beach/events/',
	'/travelguide/whale-watching-in-hawaii/' => '/travelguide/best-shoreline-spots-for-whale-watching-in-hawaii/',
	'/travelguide/celebrate-summer-nights-at-busch-gardens-williamsburg/' => '/detail/busch-gardens-williamsburg-tickets',
	'/travelguide/new-york-public-library-photo-tour/' => '/travelguide/new-york-public-library-visitors-guide/',
	'/travelguide/free-tickets-to-pigeon-forge-shows-available-for-kids/' => '/us/pigeon-forge/shows',
	'/travelguide/beach-boogie-bbq-festival-myrtle-beach/' => '/travelguide/information/coastal-carolina/myrtle-beach/events/',
	'/travelguide/moma-glance-photo-tour/' => '/travelguide/plan-day-moma/',
	'/travelguide/myrtle-beach-festivals-events/' => '/travelguide/information/coastal-carolina/myrtle-beach/events/',
	'/travelguide/branson-airport-expands-atlanta-service/' => '/travelguide/destination/ozark-mountains/branson/',
	'/travelguide/usa-today-names-myrtle-beach-boardwalk-best-boardwalk-food/' => '/travelguide/destination/coastal-carolina/myrtle-beach/',
];
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$redir = $redirs[$url];
if ($redir != '') {
	header("Location: " . $redir, true, 301);
	exit();
}

get_header(); ?>

	<section class="error-container error-404 not-found">

	<?php 
	// Check for custom 404 page content
	$error_page = (get_options_data('options-page', 'error-content')) ? get_options_data('options-page', 'error-content') : 'default';

	if ($error_page == 'default') {
		?>
		<header class="page-header">
			<h2 class="page-title"><?php _e( 'Whaaaaat??!?!!!', 'framework' ); ?></h2>
			<p class="lead"><?php _e( "It seems the page you're looking for isn't here.", 'framework' ); ?></p>
		</header><!-- .page-header -->

		<div class="404-search-box">
			<p><?php _e( 'Try looking somewhere else and you might get lucky!', 'framework' ); ?></p>
			<?php get_search_form(); ?>
			<br>
			<br>
		</div><!-- /.404-search-box -->

		<?php
	} else {
		// Get the custom error page
		$errorContent = get_post($error_page);
		if (isset($errorContent) && !empty($errorContent)) {
			echo apply_filters( 'the_content', $errorContent->post_content );
		}
	} ?>

	</section>

<?php get_footer(); ?>
