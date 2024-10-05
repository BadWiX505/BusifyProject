let mainmenu = document.querySelector(".menusbigelectors");
let mainMenuElements = mainmenu.children;
let submenu;

changebgColor();


console.log("submenu = "+submenu)
for(element of mainMenuElements){
    element.addEventListener("click",e=>{
        let elementname = e.target.innerHTML;
        makeMenuUp();
    switch(elementname){
        case "Breakfast" : submenu= document.getElementById("subbreakfast") ; break;
        case "Lunch" : submenu= document.getElementById("sublunch") ; break;
        case "Snack" : submenu= document.getElementById("subsnack") ; break;
        case "Dinner" : submenu= document.getElementById("subdinner") ; break;
        case "Beverages" : submenu= document.getElementById("subdrinks") ; break;
        case "Desserts" : submenu= document.getElementById("subdessert") ; break;
    }
    makeMenuDown();
});
} 
 


function changebgColor(){
    let btns = document.querySelectorAll(".Menucontainer button");
    for(let btn of btns){
        btn.onclick=()=>{
            getcolorsback(btn);
            btn.style.backgroundColor="var(--secondcolor)";
            btn.style.color="#fff";           
         }
    }
}

function getcolorsback(btn){
    let parentbtns = document.querySelectorAll(".menusbigelectors button");
    if (Array.from(parentbtns).includes(btn)) {
        for(let btn of parentbtns){
            btn.style.backgroundColor="var(--darkWhite)";
            btn.style.color="var(--menuselectorscolor)";    
        }
    } 
    
        let otherbtns = document.querySelectorAll(".Menucontainer button:not(.menusbigelectors button)")
        for(let btn of otherbtns){
            btn.style.backgroundColor="var(--darkWhite)";
            btn.style.color="var(--menuselectorscolor)";         
       }
    
}

function makeMenuDown()
{
    submenu.classList.add("menudown");
}

function makeMenuUp(){
    if(submenu!=undefined)
    submenu.classList.remove("menudown");
}

