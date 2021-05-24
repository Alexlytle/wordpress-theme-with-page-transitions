const addCart = () =>{

let cartbox = document.querySelectorAll('.thecartbox')

cartbox.forEach((value,index)=>{
const app = Vue.createApp({})


app.component('button-cartbox', {
    data() {
      return {
          cartTotal:null,
          showmessage:false
      }
    },
    async mounted(){

        const data = await fetch('http://localhost:3000/barba/wp-json/wc/store/cart/',{
          method:'GET',
          headers : {
            'Content-Type': 'application/json',
            'X-WP-Nonce' : '29a679af5d' // here you used the wrong name
            },
            credentials: 'same-origin',
            // body:JSON.stringify(data)
        })
        const dataTwo = await data.json()
        console.log(dataTwo)
        this.cartTotal = dataTwo.items_count 
        console.log(this.cartTotal)
        document.querySelector("div.cart-total >span").innerText = this.cartTotal

    },
   methods:{
   async updateCart(e){
      e.target.parentElement.parentElement.querySelector('.count').innerText
        var data ={
          'id' : e.target.parentElement.getAttribute('data-id'),
          "quantity" :  e.target.parentElement.parentElement.querySelector('.count').innerText
        }


        try{
        const resOne = await fetch('http://localhost:3000/barba/wp-json/wc/store/cart/add-item?consumer_key=ck_05c294b237cb55890981c40fe573c43b4ed1402c&consumer_secret=cs_2c5a296ba2073df24c2e60286c77c8a511b24155',{
                method : 'POST',
                headers : {
                'Content-Type': 'application/json',
                'X-WP-Nonce' : '29a679af5d' // here you used the wrong name
                },
                credentials: 'same-origin',
                body:JSON.stringify(data)
                
            
            })
        const dataOne = await resOne.json()
        // console.log(dataOne.items)
        this.handleCart(dataOne.items) 
        
          }catch{
            console.log('failed')
          }

        
      },
      handleCart(e){
        let sum = 0
        e.forEach((a,b)=>{
          sum += a.quantity
        })
        this.cartTotal = sum
        // console.log(this.cartTotal)
        document.querySelector("div.cart-total >span").innerText = this.cartTotal
        this.showmessage = true
      }


   },

    template: `
      <button class = 'explore' @click='updateCart($event)' >Add To Cart</button>
      <a  href = 'http://localhost:3000/barba/cart' v-if='showmessage' class = 'explore-red'>View Cart</a>
`
  })



        app.mount(`#cartbox${index}`)
});


}

export default addCart