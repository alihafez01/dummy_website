<?php
/**
 * Displays the theme header
 *
 * @package WordPress
 * @subpackage Dronza
 * @since 1.0.0
 */
	if( is_404() ){
		return;
	}
	if (class_exists('ACF')) {
		$logo = get_field('logo', 'option');
		$header_style = get_field('select_header_style', 'option');
		$contact_number = get_field('contact_number', 'option');
		$search = get_field('search', 'option');
	
		if(isset($logo) && !empty($logo)){
			$logo_url = $logo;
		}else{
			$logo_url = get_template_directory_uri() . '/assets/images/logo.png'; 
		}
	}
	if(isset($header_style) && $header_style == 'header-1'){
		
		?>
		<!-- HEADER START -->
        <header class="site-header header-style-4">
			<div class="sticky-header navbar-expand-lg">
                <div class="main-bar">                       
					<div class="container d-flex justify-content-between align-items-center"> 
						<div class="logo-header">
							<div class="logo-header-inner logo-header-one">
								<a href="<?php echo esc_url(home_url('/')); ?>">
									<img src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr(get_bloginfo()); ?>" />
								</a>
							</div>
						</div>
						<!-- MAIN Vav -->
						<nav class="maxmenu white-style brackets-style nav-animation fade-down-animation">
							<?php
							// navigation
							if( has_nav_menu('primary') ){
								$args = array(
									'menu'=>'',
									'menu_class'=> 'maxmenu-list',
									'menu_id'=> '',
									'container'=> 'ul',
									'container_class'=> '',
									'container_id'=> '',
									'fallback_cb'=> '',
									'before'=> '',
									'after'=> '',
									'link_before'=> '',
									'link_after'=> '',
									'echo'=> 'true',
									'depth'=> '0',
									'theme_location'=>'primary', 
									'items_wrap'=>'<ul id="%1$s" class="%2$s">%3$s</ul>', 	
									'item_spacing'=>'preserve'	 
								);
								wp_nav_menu( $args);
							} ?>
						</nav>
                        <div class="extra-nav header-4-nav">
							<?php
							if($search == 'enable'){ ?>
								<div class="extra-cell">
									<div class="header-search">
										<a href="javascript:void(0);" class="header-search-icon"><i class="fa fa-search"></i></a>
									</div>                                
								</div>
								<?php
							} ?>
							<?php
							if($contact_number <> ''){ ?>
								<div class="extra-cell">
									<div class="header-nav-request">
										<?php echo esc_attr($contact_number); ?>
									</div>
								</div>
								<?php
							} ?>
							<!-- Mobile Header -->
							<div class="maxmobileheader clearfix ">
								<a id="maxnavtoggle" class="maxanimated-arrow"><span></span></a>
							</div>
							<!-- Mobile Header -->
						</div>
						<!-- SITE Search -->
						<div id="search-toggle-block">
							<div id="search"> 
								<?php get_search_form(); ?>
							</div>
						</div>   
					</div>    
                </div>
            </div>
        </header>
        <!-- HEADER END -->
		<?php
	}else if(isset($header_style) && $header_style == 'header-2'){ ?>

		<?php
	} else{
		
		$logo_url = get_template_directory_uri() . '/assets/images/logo.png';
		
		?>
		<header class="site-header header-style-4 mobile-sider-drawer-menu">
			<div class="sticky-header main-bar-wraper  navbar-expand-lg">
				<div class="main-bar">                       
					<div class="container d-flex justify-content-between align-items-center">
						<div class="logo-header">
							<div class="logo-header-inner logo-header-one">
								<a href="<?php echo esc_url(home_url('/')); ?>">
									<img src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr(get_bloginfo()); ?>" />
								</a>
							</div>
						</div>
						<!-- MAIN Vav -->
						<nav class="maxmenu white-style brackets-style nav-animation fade-down-animation">
							<?php
							// navigation
							if( has_nav_menu('primary') ){
								$args = array(
									'menu'=>'',
									'menu_class'=> 'maxmenu-list',
									'menu_id'=> '',
									'container'=> 'ul',
									'container_class'=> '',
									'container_id'=> '',
									'fallback_cb'=> '',
									'before'=> '',
									'after'=> '',
									'link_before'=> '',
									'link_after'=> '',
									'echo'=> 'true',
									'depth'=> '0',
									'theme_location'=>'primary', 
									'items_wrap'=>'<ul id="%1$s" class="%2$s">%3$s</ul>', 	
									'item_spacing'=>'preserve'	 
								);
								wp_nav_menu( $args);
							}else{
								$args = array(
									'menu'=>'',
									'menu_class'=> 'maxmenu-list',
									'menu_id'=> '',
									'container'=> 'ul',
									'container_class'=> '',
									'container_id'=> '',
									'fallback_cb'=> '',
									'echo'        => true,
									'show_home'   => true,
									'before'=> '',
									'after'=> '',
									'link_before'=> '',
									'link_after'=> '',
									'depth'=> '0',
									'items_wrap'=>'<ul id="%1$s" class="%2$s">%3$s</ul>', 	
									'item_spacing'=>'preserve',
								);
								wp_nav_menu( $args);
							} ?>
						</nav>
						<div class="extra-nav header-4-nav">
							<!-- Mobile Header -->
							<div class="maxmobileheader clearfix ">
								<a id="maxnavtoggle" class="maxanimated-arrow"><span></span></a>
							</div>
							<!-- Mobile Header -->  
						</div> 
					</div>    
				</div>
			</div>
		</header>
		<?php
	}