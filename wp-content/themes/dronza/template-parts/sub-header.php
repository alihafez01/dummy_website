<?php
// Sub headers

	if( is_home() ){
		$page_id = '';
	} else{
		$page_id = get_the_ID();
	}
	
	if( is_page()){
		if(class_exists('ACF')){
			
			$header_style = get_field('select_header_style', 'option');
			$page_sub_header_status = get_field('sub_header_status', $page_id);
			if(isset($page_sub_header_status)){
				$page_sub_header_status = $page_sub_header_status;
			}else{
				$page_sub_header_status = 'enable';
			}
			
			if(isset($page_sub_header_status) && $page_sub_header_status == 'enable'){
				
				$page_title = get_the_title(); 
				
				?>
				<div class="wt-bnr-inr overlay-wraper bg-center theme-banner">
					<div class="overlay-main site-bg-primary opacity-09"></div>
					<div class="container">
						<div class="wt-bnr-inr-entry">
							<div class="banner-title-outer">
								<div class="banner-title-name">
									<h2 class="site-text-white"><?php echo esc_attr($page_title); ?></h2>
								</div>
							</div>
							<!-- BREADCRUMB ROW END -->     
							<?php dronza_breadcrumbs(); ?>
						</div>
					</div>
				</div>
				<?php	
			} 	
		} else{
			$page_title = get_the_title(); 
			
			?>
			<div class="wt-bnr-inr overlay-wraper bg-center ">
				<div class="overlay-main site-bg-primary opacity-09"></div>
				<div class="container">
					<div class="wt-bnr-inr-entry">
						<div class="banner-title-outer">
							<div class="banner-title-name">
								<h2 class="site-text-white"><?php echo esc_attr($page_title); ?></h2>
							</div>
						</div>
						<!-- BREADCRUMB ROW END -->     
						<?php dronza_breadcrumbs(); ?>
					</div>
				</div>
			</div>
			<?php 
		}
	}else if( is_single() && $post->post_type == 'post' ){
		
		$page_title = 'Blog';
	
		 ?>
		<div class="wt-bnr-inr overlay-wraper bg-center">
			<div class="overlay-main site-bg-primary opacity-09"></div>
			<div class="container">
				<div class="wt-bnr-inr-entry">
					<div class="banner-title-outer">
						<div class="banner-title-name">
							<h2 class="site-text-white"><?php echo esc_attr($page_title); ?></h2>
						</div>
					</div>
					<div>
						<?php dronza_breadcrumbs(); ?>
					</div>                       
				</div>
			</div>
		</div>
		<?php
	}else if( is_single()){
		
		$page_title = get_the_title();
		?>
		
		<div class="wt-bnr-inr overlay-wraper bg-center">
			<div class="overlay-main site-bg-primary opacity-09"></div>
			<div class="container">
				<div class="wt-bnr-inr-entry">
					<div class="banner-title-outer">
						<div class="banner-title-name">
							<h2 class="site-text-white"><?php echo esc_attr($page_title); ?></h2>
						</div>
					</div>
					<!-- BREADCRUMB ROW END -->     
					<?php dronza_breadcrumbs(); ?>
				</div>
			</div>
		</div>
		<?php
	}else if( is_404() ){
		 
	}else if( is_archive() || is_search() || is_author() ){
		
		if( is_search() ){
			$page_title = esc_html__('Search Results', 'dronza');
		}else if( is_category()){
			$page_title = single_cat_title('', false);
		}else if( is_tag() || is_tax('work_tag') || is_tax('product_tag') ){
			$page_title = single_cat_title('', false);
		}else if( is_day() ){
			$page_title = get_the_archive_title();
		}else if( is_month() ){
			$page_title = get_the_archive_title();
		}else if( is_year() ){
			$page_title = get_the_archive_title();
		}else if( is_author() ){
			$author_id = get_query_var('author');
			$author = get_user_by('id', $author_id);
			$page_title = esc_html__('By','dronza') . esc_attr($author->display_name);
		}else if( is_post_type_archive('product') ){
			$page_title = esc_html__('Shop', 'dronza');
		}else{
			$page_title = esc_html__('Archives','dronza');
		}
		?>
		
		<div class="wt-bnr-inr overlay-wraper bg-center">
			<div class="overlay-main site-bg-primary opacity-09"></div>
			<div class="container">
				<div class="wt-bnr-inr-entry">
					<div class="banner-title-outer">
						<div class="banner-title-name">
							<h2 class="site-text-white"><?php echo esc_attr(strip_tags($page_title)); ?></h2>
						</div>
					</div>
					<div>
						<?php dronza_breadcrumbs(); ?>
					</div>                       
				</div>
			</div>
		</div>
		<?php 
	} else{ ?>
		<div class="wt-bnr-inr overlay-wraper bg-center">
			<div class="overlay-main site-bg-primary opacity-09"></div>
			<div class="container">
				<div class="wt-bnr-inr-entry">
					<div class="banner-title-outer">
						<div class="banner-title-name">
							<h2 class="site-text-white"><?php echo esc_html__('Blog Posts','dronza'); ?></h2>
						</div>
					</div>
					<div>
						<?php dronza_breadcrumbs(); ?>
					</div>                       
				</div>
			</div>
		</div>
		<?php 
	}