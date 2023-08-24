<?php
	/**
	 * Color Schemes this theme.
	 *
	 * @package WordPress
	 * @subpackage Dronza
	 * @since 1.0.0
	 */
	
	if(class_exists('ACF')){
		
		function dronza_color_scheme() {
			$global_custom_css = '';
			$primary_color_scheme = get_field('primary_color_scheme','option');
			$secondary_color_scheme = get_field('secondary_color_scheme','option');
			
			$logo_width = get_field('logo_width','option');
			$logo_height = get_field('logo_height','option');
			$logo_top_margin = get_field('logo_top_margin','option');
			$logo_bottom_margin = get_field('logo_bottom_margin','option');
			
			if(isset($logo_width) && !empty($logo_width)){
				$global_custom_css .= '
					.logo-header-inner a img{width:'.esc_attr($logo_width).'px}
				';
			}
			
			if(isset($logo_height) && !empty($logo_height)){
				$global_custom_css .= '
					.logo-header-inner a img{height:'.esc_attr($logo_height).'px}
					
				';
			}
			
			if(isset($logo_top_margin) && !empty($logo_top_margin)){
				$global_custom_css .= '
					.logo-header-inner a{margin-top:'.esc_attr($logo_top_margin).'px; display: inline-block;}
				';
			}
			
			if(isset($logo_bottom_margin) && !empty($logo_bottom_margin)){
				$global_custom_css .= '
					.logo-header-inner a{margin-bottom:'.esc_attr($logo_bottom_margin).'px; display: inline-block;}
				';
			}
			
			$global_custom_css .= '
			/* Primary background color*/

			.left .wt-small-separator div.sep-leaf-right::before,
			.left .wt-small-separator div.sep-leaf-left::before,
			.center .wt-small-separator div.sep-leaf-right::before,
			.center .wt-small-separator div.sep-leaf-left::before,
			.project-img-effect-1,
			.owl-carousel .owl-dots .owl-dot.active span,
			.owl-prev:hover,
			.owl-prev:active,
			.owl-prev:focus,
			.owl-next:hover,
			.owl-next:active,
			.owl-next:focus,
			.header-style-2 .top-bar .wt-topbar-info li:first-child::before,
			.header-style-2 .header-nav-request a,
			.site-bg-primary,
			.search-bx button,
			.site-list-style-one li::after,
			.date-style-2 .wt-post-meta ul li.post-category span,
			.testimonial-1-content-outer::after,
			.header-style-4 .header-nav-request a,
			.slider-block-red::before,
			.site-button-link::before,
			.card1::before,
			.corner-line:after,
			.corner-line:before,
			.about-drone-three::before ,
			.about-drone-three-info,
			.gallery-large-control ul li a,
			.dot-circle ,
			.blog-style-3:hover,
			.about-drone-two::before ,
			.hover-line-effect-one::after, 
			.hover-line-effect-one::before,
			.quality-video2 .play-now-video,
			.product-show-info2 .p-control2 ul li a:hover,
			.bg-right-half-block,
			.product-show-info .p-control ul li a:hover,
			.masonry-filter > li.active a, .masonry-filter > li a:hover, 
			.masonry-filter > li a:active, 
			.masonry-filter > li a:focus,
			.galleryhvr-mid a,
			.galleryhvr-zoom-out-down,
			.widget_tag_cloud a:hover,
			.ui-widget-header,
			.site-button,
			.quality-section-outer .site-button-link:after,
			.pagination > li > a:hover, .pagination > li > span:hover, 
			.pagination > li > a:focus, 
			.pagination > li > span:focus,
			.site-button:active, .site-button:focus, .site-button:visited, 
			.active > .site-button,
			.default-footer .widget_search input.search-submit.search-btn, 
			.widget_search.sidebar-widget input.search-submit.search-btn,
			.dark-dotts-line.owl-carousel .owl-dots .owl-dot.active span{
				background-color:'.esc_attr($primary_color_scheme).' ;
			}
			
			.hermes .tp-bullet.selected::after ,
			.hermes .tp-bullet:hover {
				background-color: '.esc_attr($primary_color_scheme).' !important;
			}

			/*===================== 
				Primary text color 
			=====================*/

			h1 a:hover,
			h2 a:hover,
			h3 a:hover,
			h4 a:hover,
			h5 a:hover,
			h6 a:hover,
			.header-nav .nav>li .sub-menu li a:hover,
			.header-nav .nav>li .sub-menu li:hover>a,
			.header-nav .nav>li .mega-menu>li ul a:hover,
			.header-nav .nav>li.current-menu-item>a,
			.header-nav .nav li.has-child.nav-active>a,
			ol.comment-list li.comment .reply a,
			.nav-dark.header-nav .nav>li .sub-menu li a:hover,
			.site-button-link::after,
			.our-team-two ul li a:hover,
			.site-text-primary,
			.footer-dark .footer-bottom .copyrights-nav li a,
			.footer-dark .footer-bottom .copyrights-nav li::after,
			.footer-dark .footer-top h1,
			.footer-dark .footer-top h2,
			.footer-dark .footer-top h5,
			.footer-dark .footer-top h6,
			.footer-dark .footer-top h1 a,
			.footer-dark .footer-top h2 a,
			.footer-dark .footer-top h3 a,
			.footer-dark .footer-top h4 a,
			.footer-dark .footer-top h5 a,
			.footer-dark .footer-top h6 a,
			.footer-dark .widget_address li i,
			.site-footer .widget_services ul li a:hover,
			.wt-team-1 .team-social-center ul li a:hover,
			.footer-dark .footer-top a:active,
			.footer-dark .footer-top a:focus,
			.footer-dark .footer-top a:hover,
			blockquote .fa-quote-left,
			.testimonial-2 .testimonial-text .fa-quote-left,
			.wt-team-1-single-info li span:first-child,
			.error-full-page-inner-info strong,
			.wt-product-box .price ins,
			.widget .wt-post-meta li,
			.widget_archives ul li a:hover,
			.widget_services ul li a:hover,
			ol.comment-list li.comment .comment-meta a,
			.blog-post blockquote .fa-quote-left,
			.date-style-2 .wt-post-meta ul li.post-date,
			.date-style-2 .wt-post-meta ul li.post-comment,
			.date-style-2 .wt-post-readmore a,
			.testimonial-1 .testimonial-text .fa-quote-left,
			.footer-dark.footer-style2 .footer-bottom .copyrights-nav li a:hover,
			.wt-team-1 .team-name a:hover,
			.header-nav.nav-animation .nav>li>ul.sub-menu li>a:before,
			.play-now .icon,
			.product-show-info .p-price,
			.blog-style-3 .wt-post-meta ul li.post-date, .blog-style-3 .wt-post-meta ul li.post-comment,
			.blog-style-large .wt-post-meta ul li.post-date, .blog-style-large .wt-post-meta ul li.post-comment,
			.blog-style-3 .wt-post-readmore a,
			.wt-post-title .post-title a:hover,
			.pricingtable-sign,
			.play-now-video .icon,
			.product-show-info2 .p-price2,
			.blog-style-1 .wt-post-meta ul li.post-date, .blog-style-1 .wt-post-meta ul li.post-category, .blog-style-1 .wt-post-meta ul li.post-comment,
			.blog-style-1 .wt-post-readmore a,
			.wt-team-2 .team-name a:hover,
			.service-detail-single-list ul.list-check li::before,
			.gallery-detail-single-list ul.list-check li::before,
			.product-widget-info .price ins,
			.p-single-new-price,
			.wt-tabs.bg-tabs .nav-tabs > li > a.active,
			ol.commentlist li .meta span,
			.shopping-cart-total .sub_total .top li:last-child,
			.shopping-cart-total .total ul li:last-child,
			.your-order-list ul li b {
				color:'.esc_attr($primary_color_scheme).' ;
			}
			

			/*-----border color-----*/
			.about-drone-one,
			.product-showcase:after,
			.product-showcase:before,
			.counter-box:after,
			.counter-box:before,
			.date-style-2:hover ,
			.how-it-drone2-outer .how-it-drone2:after,
			.how-it-drone2-outer .how-it-drone2:before,
			.gallery-large-block-outer::before,
			.slider-block-sky::after ,
			.slider-block-video:after,
			.slider-block-video:before,
			.services-large-block-outer::before,
			.blog-post blockquote,
			.header-style-4 #search-toggle-block,
			.header-style-4.dark-menu #search-toggle-block
			{
				border-color:'.esc_attr($primary_color_scheme).';
			}

			/*-----Secondry background color-----*/

			.site-button-secondry,
			.acc-bg-gray .acod-head .indicator,
			.project-img-effect-1 a.mfp-link,
			.owl-prev,
			.owl-next,
			.site-bg-secondry,
			.overlay-icon a,
			.footer-dark.footer-style2 .footer-top{
				background-color:'.esc_attr($secondary_color_scheme).';
			}
			
			/*-----Secondry text color-----*/
			
			.test{
				color:'.esc_attr($secondary_color_scheme).';
			}

			.test{
				border-top-color:'.esc_attr($secondary_color_scheme).';
			}
			';
			
			if(!empty($primary_color_scheme) || !empty($secondary_color_scheme)){
				wp_enqueue_style('dronza-inline-style',get_template_directory_uri() . '/assets/css/inline-style.css');
				wp_add_inline_style( 'dronza-inline-style', $global_custom_css);	
			}
			
		}
		
		add_action( 'wp_enqueue_scripts', 'dronza_color_scheme' );
	}