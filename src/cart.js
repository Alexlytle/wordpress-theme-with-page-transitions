
const carts = () =>{
    console.log('hello world')
    const Carts = {
        data(){
            return{
                cart:'',
                imageAvailable:false,
                cartid:'',
                cartimage:'',
                cartTotal:null
            }
        },
        watch:{
            cart(){
                this.cart
            }
        },
       async mounted(){

        //calling data 
        const cartData = await fetch('http://localhost:3000/barba/wp-json/wc/store/cart/',{
          method:'GET',
          headers : {
            'Content-Type': 'application/json',
            },
        credentials: 'same-origin',
            // body:JSON.stringify(data)
        })
        const finalCartData = await cartData.json()
        this.cart = finalCartData.items
        console.log(this.cart)
        
        this.total(this.cart)
    
      
        this.imageAvailable  = true
        
        // console.log(finalCartData)
        
        },
        methods:{
            
            total(e){
                let sum = 0
                for( let i = 0; i<e.length;i++){

                    console.log(e[i].totals.line_total)
                     
                    //  e[i].totals.line_total
                        sum += parseInt(e[i].totals.line_total)
                   
                     
                }
                // return sum
                
                     // let sum = 0
                // e.forEach((a,b)=>{
                //   sum += a.quantity
                // })
                this.cartTotal = sum
                // console.log(cartTotal)
               
            },
            async increaseCart(e){
            
                e.quantity++

                console.log(e.id,'yoooo')
                var data = {
                    id:e.id,
                    quantity:1
                }
                const increase = await fetch('http://localhost:3000/barba/wp-json/wc/store/cart/add-item?consumer_key=ck_05c294b237cb55890981c40fe573c43b4ed1402c&consumer_secret=cs_2c5a296ba2073df24c2e60286c77c8a511b24155',{
                    method : 'POST',
                    headers : {
                    'Content-Type': 'application/json',
                    'X-WP-Nonce' : '29a679af5d' // here you used the wrong name
                    },
                    credentials: 'same-origin',
                    body:JSON.stringify(data)
                   
                
                })
            const increaseTotal = await increase.json()
               console.log(increaseTotal,'asdhfkj')
               this.cart = increaseTotal.items
                // console.log(e)
            },
           async descreaseCart(e){
            e.quantity--
                var datas = {
                    id:e.id,
                    quantity:-1
                }
                const decrease = await fetch('http://localhost:3000/barba/wp-json/wc/store/cart/add-item?consumer_key=ck_05c294b237cb55890981c40fe573c43b4ed1402c&consumer_secret=cs_2c5a296ba2073df24c2e60286c77c8a511b24155',{
                    method : 'POST',
                    headers : {
                    'Content-Type': 'application/json',
                    'X-WP-Nonce' : '29a679af5d' // here you used the wrong name
                    },
                    credentials: 'same-origin',
                    body:JSON.stringify(datas)
                 
                
                })
            const decreaseTotal = await decrease.json()
               console.log(decreaseTotal)
              
             
            }

        }
        
       
    }
    Vue.createApp(Carts).mount('#carts')
}
export default carts