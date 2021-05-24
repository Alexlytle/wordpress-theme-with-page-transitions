const addCartCounter = ()=>{

    let button =  document.querySelectorAll('.thecart')
   
    button.forEach((but,index)=>{
        // but.insertAdjacentHTML('beforeend',`
        //  <div  class="" id="cart${index}">
        //          <button-cart class = 'explore' ></button-cart>
        //      </div>
        // `)
 
        const app = Vue.createApp({})
 
        // Define a new global component called button-cart
        app.component('button-cart', {
          data() {
            return {
              count: 1,
              items: [{ message: 'Foo' }, { message: 'Bar' }]
            }
          },
          
         methods:{
            increase(){
                this.count++
            },
            decrese(){
                if(this.count == 0){
                    // this.count = 0
                    this.count = 0
                }else{
                    this.count--
                }
             
            },

         },

          template: `
            <span class = 'plusminus' v-on:click="increase">+</span>
            <span  class = 'plusminus' v-on:click="decrese">-</span>
            <button class = 'count' >
              {{count}}
            </button>
    `
        })
        
        app.mount(`#cart${index}`)
 
      
    })

}

export default addCartCounter;