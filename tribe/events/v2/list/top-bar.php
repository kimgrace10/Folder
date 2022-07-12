<?php
/**
 * View: Top Bar
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/list/top-bar.php
 *
 * See more documentation about our views templating system.
 *
 * @link http://evnt.is/1aiy
 *
 * @version 5.0.1
 *
 */
?>
<div class="tribe-events-c-top-bar tribe-events-header__top-bar">
	
	<?php
	$taxonomies = get_terms( array(
		'taxonomy' => 'tribe_events_cat',
		//'hide_empty' => false,
		'hide_empty' => true
	) );

	if ( !empty($taxonomies) ) :
		$output = '<div class="event_url_holder"><select id="event_url">';
	     $output.= '<option value="" disabled selected>Select a Destination</option>';
		foreach( $taxonomies as $category ) {
			if( $category->parent == 0 ) {
				$output.= '<optgroup label="'. esc_attr( $category->name ) .'">';
				foreach( $taxonomies as $subcategory ) {
					if($subcategory->parent == $category->term_id) {
						
					$term_link = get_term_link( $subcategory );
					$term_link_explode = explode("category/",$term_link);
					$term_path = $term_link_explode[1];
						
					$url = site_url().'/information/'.$term_path.'events/';
						
						
					$output.= '<option value="'. esc_attr( $url ) .'">
						'. esc_html( $subcategory->name ) .'</option>';
					}
				}
				$output.='</optgroup>';
			}
		}
		$output.='</select></div>';
		echo $output;
	endif;
	?>

	<?php $this->template( 'list/top-bar/nav' ); ?>

	<?php $this->template( 'components/top-bar/today' ); ?>

	<?php $this->template( 'list/top-bar/datepicker' ); ?>

	<?php $this->template( 'components/top-bar/actions' ); ?>

</div>

<script>
jQuery(document).ready(function(){
  
  jQuery('select#event_url').on('change', function() {
    //alert( this.value );
    window.location.href = this.value;
    });

});
</script>
