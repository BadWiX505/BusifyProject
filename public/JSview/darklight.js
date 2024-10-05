
let colors = document.querySelector(":root")

const originalColors = {
    thirdcolor: getComputedStyle(document.documentElement).getPropertyValue('--thirdcolor'),
    normaltextcolor: getComputedStyle(document.documentElement).getPropertyValue('--normaltextcolor'),
    bigtextcolor: getComputedStyle(document.documentElement).getPropertyValue('--bigtextcolor'),
    darkwhitecolor: getComputedStyle(document.documentElement).getPropertyValue('--darkWhite'),
    menuselectorscolor: getComputedStyle(document.documentElement).getPropertyValue('--menuselectorscolor'),
    menuitemsbgcolor: getComputedStyle(document.documentElement).getPropertyValue('--menuitemsbgcolor'),
    servicesbgcolor: getComputedStyle(document.documentElement).getPropertyValue('--servicesbgcolor'),
    chefsbgcolor: getComputedStyle(document.documentElement).getPropertyValue('--chefbgcolor')
};

let modebtn = document.querySelector(".darkmodebtn");

function isElementInLocalStorage(key) {
    // Retrieve the value associated with the key
    var value = localStorage.getItem(key);
  
    // Check if the value is not null (i.e., the key exists in local storage)
    return value !== null;
  }


if(!isElementInLocalStorage("lightingmode")){
localStorage.setItem("lightingmode","light");
}
else{
    loadMode();
}

modebtn.onclick=()=>{
 changeMode();
}



  function loadMode(){
    if(localStorage.getItem("lightingmode")==="dark"){
        darkmode();
    }
    else{
        resetColors();
    }
  }

function setDarkIcon(){
    modebtn.innerHTML='<i class="fa-solid fa-moon"></i>';
    modebtn.style.backgroundColor="var(--bgresposivenavcolor)";
}

function setLightIcon(){
    modebtn.innerHTML='<i class="fa-solid fa-sun"></i>'
    modebtn.style.backgroundColor="var(--secondcolor)";
}

function changeMode(){
        if(localStorage.getItem("lightingmode")==="light"){
            darkmode();
            localStorage.setItem("lightingmode","dark");
        }
        else{
            resetColors();
            localStorage.setItem("lightingmode","light");
        }
}
        











function darkmode(){
colors.style.setProperty("--thirdcolor","#0c1923")
colors.style.setProperty("--normaltextcolor","#f8f8f8")
colors.style.setProperty("--bigtextcolor","#fff")
colors.style.setProperty("--darkWhite","#000")
colors.style.setProperty("--thirdcolor","#17191e")
colors.style.setProperty("--menuselectorscolor","#fff")
colors.style.setProperty("--menuitemsbgcolor","#1d1f28")
colors.style.setProperty("--servicesbgcolor","transparent")
colors.style.setProperty("--chefbgcolor","#17191e")
setLightIcon();

}






function resetColors() {
    colors.style.setProperty("--thirdcolor", originalColors.thirdcolor);
    colors.style.setProperty("--normaltextcolor", originalColors.normaltextcolor);
    colors.style.setProperty("--bigtextcolor", originalColors.bigtextcolor);
    colors.style.setProperty("--darkWhite", originalColors.darkwhitecolor);
    colors.style.setProperty("--menuselectorscolor", originalColors.menuselectorscolor);
    colors.style.setProperty("--menuitemsbgcolor", originalColors.menuitemsbgcolor);
    colors.style.setProperty("--servicesbgcolor", originalColors.servicesbgcolor);
    colors.style.setProperty("--chefbgcolor", originalColors.chefsbgcolor);    
    setDarkIcon(); 
  }







//// Menu dark mode configuration////


/*const thirdcolor = getComputedStyle(document.documentElement).getPropertyValue('--thirdcolor');

const normaltextcolor = getComputedStyle(document.documentElement).getPropertyValue('--normaltextcolor');
const bigextcolor = getComputedStyle(document.documentElement).getPropertyValue('--bigtextcolor');
const darkwhitecolor = getComputedStyle(document.documentElement).getPropertyValue('--darkWhite');
const responav = getComputedStyle(document.documentElement).getPropertyValue('--bgresposivenavcolor');

*/
