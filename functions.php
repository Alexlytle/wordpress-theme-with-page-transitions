<?php



	/**
	 * Sets up theme defaults and registers the various WordPress features that
	 * this theme supports.
	 */
	
	function wpb_adding_scripts() {
		// wp_register_script('main-university-js', 'universityData', array(
		// 	'nonce' => wp_create_nonce('wp_rest')
		//   ));
		//   wp_enqueue_script('main-university-js');

		wp_enqueue_style( 'bootstrapsss', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css', '4.3.1', 'all' );
		wp_register_script('vue', 'https://unpkg.com/vue@next','','1.1', true);
		wp_enqueue_script('vue');

		$time = time();
		wp_register_script('barba', get_template_directory_uri() . '/js/barba.js','','1.1', true);
		wp_enqueue_script('barba');

		wp_register_script('scrollmagic','https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.7/ScrollMagic.min.js','','1.1', true);
		wp_enqueue_script('scrollmagic');


		wp_register_script('scrollmagic','https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.7/ScrollMagic.min.js' ,'','1.1', true);
		wp_enqueue_script('scrollmagic');

		wp_register_script('scrollmagic_anim', 'https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.7/plugins/animation.gsap.min.js','','1.1', true);
		wp_enqueue_script('scrollmagic_anim');

		wp_register_script('gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.2.6/gsap.min.js','','1.1', true);
		wp_enqueue_script('gsap');


		wp_register_script('app', get_template_directory_uri() . '/js/app.js?v=' . $time,'','1.1', true);
		wp_enqueue_script('app');

		wp_register_script('appmix', get_template_directory_uri() . '/dist/app.js','','1.1', true);
		wp_enqueue_script('appmix');


		wp_enqueue_style( 'montfont', 'https://fonts.googleapis.com/css?family=Abril+Fatface|Montserrat&display=swap'. $time,  array(), '4.3.1', 'all' );

		wp_enqueue_style( 'my-css', get_template_directory_uri() . '/css/app.css?v='. $time,  array(), '4.3.1', 'all' );

		// wp_enqueue_style( 'bootstrapy', get_template_directory_uri() . '/css/boostrapy.css?v='. $time,  array(), '4.3.1', 'all' );



	


		}
	add_action( 'wp_enqueue_scripts', 'wpb_adding_scripts' );


	add_filter( 'woocommerce_rest_check_permissions', 'my_woocommerce_rest_check_permissions', 90, 4 ); function my_woocommerce_rest_check_permissions( $permission, $context, $object_id, $post_type ){ return true; }



	//custom rest 


	add_action('rest_api_init', 'productDetails');

	function productDetails() {
	  register_rest_route('productDetails/v1', 'product', array(
		'methods' => "GET",
		'callback' => 'products'
	  ));
	}

	function products(){
		$args = array(
			'post_type' => 'product',
			'posts_per_page' => 12
			);
			
		  $query = new WP_Query( $args );


		  $results = array(
				'id'=>array(),
				'name'=>array(),
				'custom_text'=>array(),
				'custom_image'=>array(), 

		  );

		foreach ($query->posts as $value) {
              $order =  wc_get_product($value);
              $data = $order->get_data();   
              array_push($results['id'], $data['id']);
              array_push($results['name'],$data['name']);

                for($i = 0; $i<count($data['meta_data']);$i++){
                  if($data['meta_data'][$i]->get_data()['key'] == 'producttext'){
                    array_push($results['custom_text'],$data['meta_data'][$i]->get_data()['value'] ); 
                  }

                  if($data['meta_data'][$i]->get_data()['key'] == 'productimage'){
                    array_push($results['custom_image'],$data['meta_data'][$i]->get_data()['value']); 
                  }  
                }
            }


		return $results;
	}
	

//disable nonce for development
	add_filter( 'woocommerce_store_api_disable_nonce_check', '__return_true' );
//wordpress nav menu

function register_my_menu() {
	register_nav_menu('header-menu',__( 'Header Menu' ));
  }
  add_action( 'init', 'register_my_menu' );

