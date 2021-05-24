let test = ()=>{
    let button =  document.querySelectorAll('#tester')
   
    button.forEach((but,index)=>{
        but.insertAdjacentHTML('beforeend',`
         <div id="counter${index}">
                 <button-counter></button-counter>
             </div>
        `)
 
        const app = Vue.createApp({})
 
        // Define a new global component called button-counter
        app.component('button-counter', {
          data() {
            return {
              count: 0
            }
          },
          template: `
            <button v-on:click="count++">
              You clicked me {{ count }} times.
            </button>`
        })
        
        app.mount(`#counter${index}`)
 
      
    })
}

export default test;
