<?php get_header();?>

<main data-barba="container" data-barba-namespace="fashion">
        <?php
        
        $collection = [];
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

                  for($i = 0;$i<count($results);$i++){
                    if($results['id'][$i] == ''){
                      echo '';
                    }else{
                      ?>
                      <section class="fashion1 detail-slide">
                      <div class="fashion-text">
                        <h1><?php  echo $results['name'][$i]; ?></h1>
                        <p>
                          Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate
                          velit voluptates placeat id neque aperiam mollitia consequuntur
                          soluta quibusdam deleniti!
                        </p>
                        <div class="thecart" id="cart<?php echo $i;?>">
                          <button-cart></button-cart>
                        </div>

                        <div data-id= '<?php echo $results['id'][$i];?>' class="thecartbox" id="cartbox<?php echo $i;?>">
                          <button-cartbox></button-cartbox>
                        </div>
                      </div>
                      <div class="fashion-img">
                        <img src=" <?php echo wp_get_attachment_image($results['custom_image'][$i],$size= 'full-size','');?> "  > 
                        
                      </div>
                      
                      <div class="fashion-nr"><span>01</span></div>
                    </section>
                    <?php
                    }
                  }
        
           ?>


           <a href="http://localhost:3000/barba/checkout">checkout</a>
           

       

</main>


      

<?php get_footer();?>