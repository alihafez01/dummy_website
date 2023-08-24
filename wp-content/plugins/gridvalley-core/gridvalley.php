<?php
/**
 * Plugin Name: GridValley Core
 * Description: A plugin to use with Dronza theme
 * Plugin URI: https://gridvalley.net/
 * Author: gridvalley.net
 * Version: 2.9.7
 * Author URI: https://gridvalley.net
 *
 * Text Domain: gridvalley-core
 *
 * @package Dronza
 * @category Core
 
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */
	
	add_action( 'init', 'dronza_load_plugin_textdomain' );
  
	/**
	 * Load plugin textdomain.
	 */
	function dronza_load_plugin_textdomain() {
	  load_plugin_textdomain( 'gridvalley-core', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
	}
 
	require_once('widgets/about/class-widget-about.php');
	require_once('widgets/recent-posts-entry/class-widget-recent-posts-entry.php');
	require_once('widgets/newsletter/class-widget-newsletter.php');
	require_once('widgets/popular-products/class-widget-popular-products.php');
	/**
	 * Fix skip link focus in IE11.
	 *
	 * This does not enqueue the script because it is tiny and because it is only for IE11,
	 * thus it does not warrant having an entire dedicated blocking script being loaded.
	 *
	 * @link https://git.io/vWdr2
	 */
	function dronza_skip_link_focus_fix() {
		// The following is minified via `terser --compress --mangle -- assets/js/skip-link-focus-fix.js`.
		?>
		<script>
		/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
		</script>
		<?php
	}
	add_action( 'wp_print_footer_scripts', 'dronza_skip_link_focus_fix' );
	
	if( in_array('elementor/elementor.php', apply_filters( 'active_plugins', get_option('active_plugins' )))){
			
		
		function add_elementor_widget_categories( $elements_manager ) {

			$elements_manager->add_category(
				'dronza',
				[
					'title' => __( 'Dronza', 'gridvalley-core' ),
					'icon' => 'fa fa-plug',
				]
			);
		}
		add_action( 'elementor/elements/categories_registered', 'add_elementor_widget_categories' );
		
		include('elementor-gridvalley/elementor-gridvalley.php');
	}
	
	add_action('wp_ajax_subscribe_user', 'dronza_subscribe_user_to_mailchimp');
	add_action('wp_ajax_nopriv_subscribe_user', 'dronza_subscribe_user_to_mailchimp');
	 
	function dronza_subscribe_user_to_mailchimp() {
		check_ajax_referer('subscribe_user', 'security');
		$email = $_POST['email'];
		$audience_id = '8ca5543b75';
		$api_key = '101bcb5329ca2c9600bc0a8b4ffb05a5-us19';
		$data_center = substr($api_key,strpos($api_key,'-')+1);
		$url = 'https://'. $data_center .'.api.mailchimp.com/3.0/lists/'. $audience_id .'/members';
		$auth = base64_encode( 'user:' . $api_key );
		$arr_data = json_encode(array( 
			'email_address' => $email, 
			'status' => 'subscribed' //pass 'subscribed' or 'pending'
		));
	 
		$response = wp_remote_post( $url, array(
				'method' => 'POST',
				'headers' => array(
					'Content-Type' => 'application/json',
					'Authorization' => "Basic $auth"
				),
				'body' => $arr_data,
			)
		);
	 
		if ( is_wp_error( $response ) ) {
		   $error_message = $response->get_error_message();
		   echo "Something went wrong: $error_message";
		} else {
			$status_code = wp_remote_retrieve_response_code( $response );
			switch ($status_code) {
				case '200':
					echo $status_code;
					break;
				case '400':
					$api_response = json_decode( wp_remote_retrieve_body( $response ), true );
					echo $api_response['title'];
					break;
				default:
					echo 'Something went wrong. Please try again.';
					break;
			}
		}
		wp_die();
	}
	
	if( !function_exists('dronza_get_social_shares') ){
		function dronza_get_social_shares($post_url){	
			
			if(class_exists('ACF')){
				$facebook = get_field('facebook','option');
				$google_plus = get_field('google_plus','option');
				$linkedin = get_field('linkedin','option');
				$pinterest = get_field('pinterest','option');
				$twitter = get_field('twitter','option');
				?>
				<ul>
					<?php 
					if($facebook == 'enable'){ ?>
						<li>
							<a title="<?php echo esc_attr__('Facebook','gridvalley-core'); ?>" data-placement="top" data-toggle="tooltip" href="http://www.facebook.com/share.php?u=<?php echo esc_url($post_url); ?>"><i class="fa fa-facebook"></i></a>
						</li><?php 
					} 
					if($google_plus == 'enable'){ ?>
						<li>
							<a title="<?php echo esc_attr__('Google Plus','gridvalley-core'); ?>" data-placement="top" data-toggle="tooltip" class="thbg-colorhover fa fa-google-plus" href="https://plus.google.com/share?url=<?php echo esc_url($post_url); ?>" data-original-title="Google PLus"></a>
						</li>
						<?php 
					}
					if($linkedin == 'enable'){ ?>
						<li>
							<a title="<?php echo esc_attr__('Linkedin','gridvalley-core'); ?>" href="http://www.linkedin.com/shareArticle?mini=true&#038;url=<?php echo esc_url($post_url); ?>"><i class="fa fa-linkedin"></i></a>
						</li>
						<?php 
					} 
					if($pinterest == 'enable'){ ?>
						<li>
							<a title="<?php echo esc_attr__('Pinterest','gridvalley-core'); ?>" href="http://pinterest.com/pin/create/button/?url=<?php echo esc_url($post_url); ?>"><i class="fa fa-pinterest"></i></a>
						</li>
						<?php 
					}
					if($twitter == 'enable'){ ?>
						<li>
							<a title="<?php echo esc_attr__('Twitter','gridvalley-core'); ?>" href="http://twitter.com/home?status=<?php echo esc_url($post_url); ?>"><i class="fa fa-twitter"></i></a>
						</li>
						<?php 
					} ?>
				</ul>
				<?php
			}			
		}
	}
	
	if(!function_exists('dronza_pagination')){
		function dronza_pagination($the_query, $range = 4){		
			/* Don't print empty markup if there's only one page. */
			if ( $the_query->max_num_pages < 2 ) {
				return;
			}
			
			$paged = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
						
			$pagenum_link = html_entity_decode( get_pagenum_link() );
			$query_args   = array();
			$url_parts    = explode( '?', $pagenum_link );

			if ( isset( $url_parts[1] ) ) {
				wp_parse_str( $url_parts[1], $query_args );
			}

			$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
			$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

			$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
			$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';
			
			/* Set up paginated links.*/
			$links = paginate_links( array(
				'base'     => $pagenum_link,
				'format'   => $format,
				'total'    => $the_query->max_num_pages,
				'current'  => $paged,
				'mid_size' => 1,
				'add_args' => array_map( 'urlencode', $query_args ),
				'prev_text' => '<i class="fa fa-angle-double-left"></i>',
				'next_text' => '<i class="fa fa-angle-double-right"></i>',
				'before_page_number' => '',
				'after_page_number'  => ''
			) );

			html_entity_decode($links);
			
			if ( $links ) :
				return '<nav class="pagination-section"><div class="dronza-pagination">'. $links . '</div></nav>';
			endif;
		}	
	}
	
	//Get posts Views
	if( !function_exists('gridvalley_set_post_views') ){	
		function gridvalley_set_post_views($postID) {
			$count_key = 'post_views';
			$count = get_post_meta($postID, $count_key, true);
			if($count==''){
				$count = 0;
				delete_post_meta($postID, $count_key);
				add_post_meta($postID, $count_key, '0');
			}else{
				$count++;
				update_post_meta($postID, $count_key, $count);
			}
		}
	}
	
	//Get Post Views
	if( !function_exists('gridvalley_post_views') ){	
		function gridvalley_post_views ($post_id) {
			if ( !is_single() ) return;
			if ( empty ( $post_id) ) {
				global $post;
				$post_id = $post->ID;    
			}
			gridvalley_set_post_views($post_id);
		}
	}
	add_action( 'wp_head', 'gridvalley_post_views');
	
	if( !function_exists('gridvalley_get_post_views') ){	
		function gridvalley_get_post_views($postID){
			$count_key = 'post_views';
			$count = get_post_meta($postID, $count_key, true);
			if($count==''){
				delete_post_meta($postID, $count_key);
				add_post_meta($postID, $count_key, '0');
				return esc_attr__('0','gridvalley-core');
			}
			return $count;
		}
	}
	
	include_once('custom-posts/services/services.php');
	include_once('custom-posts/gallery/gallery.php');
	include_once('custom-posts/team/team.php');