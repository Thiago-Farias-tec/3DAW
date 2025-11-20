
const controls = document.querySelectorAll(".control");
let currentItem = 0;
const items = document.querySelectorAll(".item");
const maxItens = items.length; 

controls.forEach((control) => {
    control.addEventListener("click", () =>{
        
        const isleft = control.classList.contains("arrow-left"); 
       
    
       if(isleft) {
         currentItem -= 1;
       } else {
         currentItem += 1;
       }
       
       if(currentItem >= maxItens) {
         currentItem = 0;
       }
       
       if(currentItem < 0) {
         currentItem = maxItens -1;
       }
      
       items.forEach(item => item.classList.remove("atual"));
       
       items[currentItem].scrollIntoView({
         inline: "center",
         behavior: "smooth"
       });
      
       items[currentItem].classList.add("atual");
       
    });
});
