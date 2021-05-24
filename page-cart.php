<?php get_header();?>



<main data-barba="container" data-barba-namespace="cart">
<div id="carts" >
 <div class="container">
    <div class="row  ">

  


  
        <!-- product image -->
       <div class="col-3  title-cart">
         <h1>Product: </h1>
            <div  class = ' d-flex justify-content-center cartbox' v-for= '(img,index) in cart'>

                <img v-if='imageAvailable' style="width: 100px;"   :src = 'img.images[0].src'/>
            </div>
        </div>
        <!-- price -->
       <div class="col-3 title-cart">
            <h1>Price: </h1>
            <div  class = 'cart-text d-flex justify-content-center cartbox' v-for= '(price,index) in cart'>
                <p>$ {{price.prices.regular_price}}</p>
            </div>
       </div>
        <!-- quantity -->
       <div class="col-3 title-cart">
            <h1>Quantity: </h1>
            <div  class = 'cart-text d-flex justify-content-center cartbox' v-for= '(quantity,index) in cart'>
                <p>{{quantity.quantity}}</p>
                <span class='cartplusminus' @click = 'descreaseCart(quantity)'>-</span>
                <span class='cartplusminus' @click = 'increaseCart(quantity)'>+</span>
                
            </div>
       </div>
        <!-- total -->
       <div class="col-3 title-cart">
             <h1>Total:</h1>
             <div  class = 'cart-text d-flex justify-content-center cartbox'>
             <p> $ {{cartTotal}} </p>
             </div>
       </div>
       <div class="col-3">
           <a href="http://localhost:3000/barba/checkout" class="explore">Checkout</a>
       </div>


  
  
                
       
    </div>
 </div>
</div>

<?php 
// echo do_shortcode('[woocommerce_cart]');
?>
</main>

<?php get_footer();?>