
import {getTotalQTTE,getHtmlCart} from '../JSview/popupconfig.js';

$('.menusbigelectors button').click(function() {
      ajax($(this).text()) ;
});

$('.subitems button').click(function() {
    ajax($(this).text()) ;
});


var foodId;


function ajax(parameter){
    $.ajax({
        url: "index.php?action=filterFood", // URL of the PHP script to load food items
        type: "GET",
        dataType: "html",
        data: {
            param : parameter, 
        },
        success: function(response){
            $(".menuitems").html(response);
        },
        error: function(xhr, status, error){
            console.error(xhr.responseText);
            window.location.href = "index.php?action=err";
        }
    });
}



$(document).on("click",".addbtn",(event)=>{
        $('.spinnercontainer').css("display","flex");
        if(event.target.tagName==='I')
        foodId = $(event.target).parent().parent().parent().data('food-id');
        else
        foodId = $(event.target).parent().parent().data('food-id');
    });
      
    
    
    $('#cancel').click(()=>{
        $('.spinnercontainer').hide();
        value=1;
        $('#spinnervalue').text(value);
    })
    
    /*$(document).on('click', '.food-card', function() {
        foodId = $(this).data('food-id');
    });*/

    $('#Cadd').click(()=>{
        sendToCart();
        value=1;
        $('#spinnervalue').text(value);
        $('.spinnercontainer').hide();
    })
     // Update the content of the foodMenu div with the response





function sendToCart(){
    $.ajax({
        url: "index.php?action=addToCart", // URL of the PHP script to load food items
        type: "GET",
        dataType: "json",
        data: {
            idFood: foodId, 
            Qte : value,
        },
        success: function(response){
            displayresult(response['status']+':'+response['msg'])
            getHtmlCart();
        },
        error: function(xhr, status, error){
            console.error(xhr.responseText);
            window.location.href = "index.php?action=err";
        }
    });
}





function displayresult(msg){
    let rescont = document.getElementById("addingresult");
    rescont.textContent=msg;
    rescont.style.display="inline-block";
    setTimeout(() => {
     rescont.style.display="none";
    }, 2000);
}







let value=1;
let Max = 15;

spinnerControle();


function spinnerControle(){
   
  $('#spinnerUp').click(()=>{
    if(value<Max){
        value++;
        $('#spinnervalue').text(value);
    }
 })

 $('#spinnerDown').click(()=>{
    if(value>1){
        value--;
        $('#spinnervalue').text(value);
    }
 })
}
