<?php
/*
Plugin Name: Cool Mobile Menu
Description: Make the menu flying for mobile.
Tags: mobile menu, mobile element, mobile, menu
Author URI: https://shopink.dk/
Author: Kjeld Hansen
Text Domain: mobile_menu
Requires at least: 4.0
Tested up to: 4.4.2
Version: 1.0
*/

if ( ! defined( 'ABSPATH' ) ) exit;

add_action('admin_menu','mobile_menu_admin_menu');
function mobile_menu_admin_menu() { 
    add_menu_page(
		"mobile Menu",
		". Mobile Menu",
		8,
		__FILE__,
		"mobile_menu_admin_menu_list",
		plugins_url( 'img/mobile-icon.png', __FILE__) 
	); 
}

function mobile_menu_admin_menu_list(){
	include 'mobile-admin.php';
}

add_action('wp_head','mobile_menu_load_js');

function mobile_menu_load_js(){
	if(get_option( 'ri_mobile_menu_id' )){
		$stky_option = unserialize(get_option( 'ri_mobile_menu_id' ));
		$mc = $stky_option['menuids'];
		$mw = $stky_option['minwidth'];
		$mp = $stky_option['ptop'];
		$mpl = $stky_option['pleft'];
		$mpr = $stky_option['pright'];
		
	if($mc!=''):
		$args = array('menu'=>$mc, 'echo'=>false, 'container_class'=>'ri_mob_menu', 'menu_class'=>'ri-mob-menu', 'after'=>'<span class="catripl"></span>');
	
	wp_enqueue_style( 'cool-mobile-menu', plugins_url( '/font-awesome-4.4.0/css/font-awesome.min.css', __FILE__) );
	?>
    
    <script type="text/javascript">
		jQuery( document ).ready(function() {
			 var mobnav = '';
			 mobnav = '<a id="ri_mob_menu"><i class="fa fa-bars" aria-hidden="true"></i></a><?php echo str_replace(array("\r", "\n"),"",wp_nav_menu( $args ));   ?>';
			 
			 jQuery("body").prepend(mobnav);
			
			jQuery('.sub-menu').hide();
			jQuery('.catripl').click(function(){
				var myri = jQuery(this).attr('class');
				if(myri=='catripl'){
					jQuery(this).addClass('exp1');
					jQuery(this).next().addClass('expanded');
					jQuery(this).next().stop().slideDown( "slow" );
				}else{
					jQuery(this).removeClass('exp1');
					jQuery(this).next().removeClass('expanded');
					jQuery(this).next().stop().slideUp( "slow" );
				}
				
			});
			
			jQuery('#ri_mob_menu').click(function(){
				jQuery(".ri_mob_menu").slideToggle("slow");
			});
			 
		});
    </script>
    <style type="text/css">
	a#ri_mob_menu {
		color: #fff;
		position: absolute;
		z-index: 9999999;
		background: rgba(0,0,0,0.8);
		top: 0;
		padding: 2px 10px;
		font-size: 20px;
		    cursor: pointer; display:none; 
	}
	.ri_mob_menu {
		position: absolute;
		z-index: 999999;
		width: 300px;
		background: #fff; display:none;  top: 34px;
	}
	.ri_mob_menu ul {
		list-style: none;     margin: 0;
	}
	.ri_mob_menu ul li {
		padding: 2px 10px;
		border-bottom: 1px solid #333;
	}
	.ri-mob-menu{
		
	}
	span.catripl {
		margin: 0px 5px;
	}
	.ri_mob_menu .menu-item a::after{
		font-size:0;
	}
	.ri_mob_menu .menu-item.menu-item-has-children a{ display:inline-block; }
	.ri_mob_menu .menu-item.menu-item-has-children span::before, .ri_mob_menu .menu-item.menu-item-has-children .menu-item.menu-item-has-children span::before, .ri_mob_menu .menu-item.menu-item-has-children .menu-item.menu-item-has-children .menu-item.menu-item-has-children span::before{
		  content: "\f107";
		font-family: FontAwesome;
		font-style: normal;
		font-weight: 400;
	    cursor: pointer;
	}
	.ri_mob_menu .menu-item.menu-item-has-children .menu-item span::before, .ri_mob_menu .menu-item.menu-item-has-children .menu-item.menu-item-has-children .menu-item span::before{ 
		content: ""; 
	}
	.ri_mob_menu .menu-item.menu-item-has-children span.exp1::before, .ri_mob_menu .menu-item.menu-item-has-children .menu-item.menu-item-has-children span.exp1::before, .ri_mob_menu .menu-item.menu-item-has-children .menu-item.menu-item-has-children .menu-item.menu-item-has-children span.exp1::before{
		  content: "\f106";
	}
	.ri_mob_menu ul li,  .ri_mob_menu ul li a {
		color: #3E3C3C;
	}
		@media screen and (max-width: <?php echo $mw; ?>px) {
			/*<?php echo $mc; ?>{  position: static; }*/
			.ri-mobile-fixed  {
				position: relative;
				margin-top:<?php echo $mp; ?>px;
			}
			a#ri_mob_menu{ display:block; }
		}
    </style>
    
    <?php
	endif;
	}
}

function mobile_menu_valid_class_id($elm){
	if ( strlen( $elm ) < 30 && strpos($elm, " ") == false ) {
		
	}
	
}

