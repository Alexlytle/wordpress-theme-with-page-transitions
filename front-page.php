<?php get_header();?>

<?php
    $the_query = new WP_Query(array(
          
            'post_status' => 'publish',
            'post_type' => 'Freedom',
            'order' => 'ASC' 
        ));
    ?>
<main data-barba="container" data-barba-namespace="home">
<?php if ($the_query->have_posts()) : ?>
  <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
 
      <section class="mountain slide">
      
        <div class="hero-img">
        <?php
        $images = rwmb_meta( 'image_zwy88vkawtk', array( 'limit' => 1, 'size' => 'fullsize' ) );
        $image = reset( $images );
        ?>
          <img src="<?php echo $image['url']; ?>" alt="forest image" />
          <div class="reveal-img"></div>
        </div>
        <div class="hero-desc">
          <div class="title">
         
            <h2>
               <?php rwmb_the_value( 'text_nlby8g4283c' ); ?>
               <span class="mountain-span"> <?php rwmb_the_value( 'colortext' );?></span>
            </h2>
            <div class="title-swipe t-swipe1"></div>
          </div>
          <p>
              <?php rwmb_the_value( 'hero_text_area' ); ?>
          </p>
          <div id="tester">
        
           
          
          
          
          </div>


         

          

          
          
          <a href = 'http://localhost/barba/fashion' class="explore mountain-exp">Explore</a>
          <div class="reveal-text"></div>
        </div>
        
      </section>

      <?php endwhile; ?>
      <?php 
      // wp_reset_postdata();
       ?>
      <?php else : ?>
          <p><?php __('No News'); ?></p>
      <?php endif; ?>
      </main>
<?php get_footer();?>