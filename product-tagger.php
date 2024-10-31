<?php
/**
 * Plugin Name: Product Tagger
 * Plugin URI: http://www.1grad.ch
 * Description: List WooCommerce product in Widget Sidebar (Using Keywort), example: [woo_products_by_tags tags="shirt"]
 * Version: 1.2
 * Author: Eric-Oliver M&auml;chler
 * Author URI: http://www.1grad.ch
 * Requires at least: 5.0
 * Tested up to: 5.2
 *
 * Text Domain: -
 * Domain Path: -
 *
 */

/*
 * List WooCommerce Products by tags
 *
 * ex: [woo_products_by_tags tags="shoes,socks"]
 */
function woo_products_by_tags_shortcode( $atts, $content = null ) {
  
	// Get attribuets
	extract(shortcode_atts(array(
		"tags" => ''
	), $atts));
	
	ob_start();

	// Define Query Arguments
	$args = array( 
				'post_type' 	 => 'product', 
				'posts_per_page' => 10, 
				'product_tag' 	 => $tags,
				'orderby' => 'title',
				'order'   => 'ASC'
				);
	
	// Create the new query
	$loop = new WP_Query( $args );
	
	// Get products number
	$product_count = $loop->post_count;
	
	// If results
	if( $product_count > 0 ) :
	
		echo '<ul class="products2">';
		
			// Start the loop
			while ( $loop->have_posts() ) : $loop->the_post(); global $product;
			
				global $post;
				
				echo "<h3>" . $thePostID = $post->post_title. " </h3>";
				
				
				if (has_post_thumbnail( $loop->post->ID )) 
					{
					
					echo '<a href="' . get_permalink( $_post->ID ) . '" title="' . esc_attr( $_post->post_title ) . '">';	
					$image_id = get_post_thumbnail_id();
					$image_attributes = wp_get_attachment_image_src( $image_id, 'full');
					echo "<img src='$image_attributes[0]' width='80%' class='vorschaubild'>";
					echo '</a>';
						
					/*
					echo '<a href="' . get_permalink( $_post->ID ) . '" title="' . esc_attr( $_post->post_title ) . '">';
        			echo get_the_post_thumbnail( $_post->ID, 'full' );
        			echo '</a>';
						*/
					}
					
					
					//echo  get_the_post_thumbnail($loop->post->ID, 'shop_catalog'); 
				else 
				//echo '<img src="'.$woocommerce->plugin_url().'/assets/images/placeholder.png" height="'.$woocommerce->get_image_size('shop_catalog_image_height').'px" />';
				//echo '<img src="' . plugins_url( 'images/placeholder.png', __FILE__ ) . '" >';
	

/*	
<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $loop->post->ID ), 'single-post-thumbnail' );?>
<img src="<?php  echo $image[0]; ?>" data-id="<?php echo $loop->post->ID; ?>">
*/
				$bilderurl = '<img src="' . plugins_url( 'images/placeholder.jpg', __FILE__ ) . '" >';
	
				ECHO $bilderurl;
	
				
			endwhile;

		echo '</ul><!--/.products-->';
	
	else :
	
		_e('No product matching your criteria.');
	
	endif; // endif $product_count > 0
	
	return ob_get_clean();

}

add_shortcode("woo_products_by_tags", "woo_products_by_tags_shortcode");