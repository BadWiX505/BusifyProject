
export function getTotalQTTE(){
    $.ajax({
    url: "index.php?action=getTotalQte", // URL of the PHP script to load food items
    type: "GET",
    dataType: "text",
    success: function (response) {
      $('.table span').text(response);
    },
    error: function (xhr, status, error) {
      console.error(xhr.responseText);
      window.location.href = "index.php?action=err";
    }
  });
}



getHtmlCart();

let foodID;
function showConfirmation() {
  document.getElementById('confirmationModal').style.display = 'block';
}

$(document).on("click", ".removefrompanel", (event) => {
   foodID = $(event.target).parent().parent().data('cartfood-id');
  showConfirmation();
});

function closeConfirmation() {
  document.getElementById('confirmationModal').style.display = 'none';
}



let cartPanel = document.querySelector(".foodpanelcontainer");

function showCart() {
  cartPanel.classList.add("Showcart");
}


function HideCart() {
  cartPanel.classList.remove("Showcart");
}

$(document).on("click", ".tablecontainer .table", () => {
  if($('.foodpanelcontainer').hasClass('Showcart')){
      HideCart();
  }
  else{
    getHtmlCart();
    showCart();
  }
});

$('#confirmbtn').on("click",()=>{
  confirmAction();
})


$('#cancelbtn').on("click",()=>{
  closeConfirmation();
})

function confirmAction() {
  deleteFromCart(foodID);
  closeConfirmation();
}


export function getHtmlCart() {

  $.ajax({
    url: "index.php?action=getCartHtml", // URL of the PHP script to load food items
    type: "GET",
    dataType: "html",
    success: function (response) {
      $('.foodpanelcontainer').html(response);
      $('.totalpriceP').text($('.tot').text()+"$");
      getTotalQTTE();
    },
    error: function (xhr, status, error) {
      console.error(xhr.responseText);
      window.location.href = "index.php?action=err";
    }
  });

}



function deleteFromCart(idFood){
  
  $.ajax({
    url: "index.php?action=delFromCart", // URL of the PHP script to load food items
    type: "GET",
    dataType: "text",
    data: {
      idF : idFood, 
    },
    success: function (response) {
      displayMSG(response);
      getHtmlCart();
      getTotalQTTE();
    },
    error: function (xhr, status, error) {
      console.error(xhr.responseText);
      window.location.href = "index.php?action=err";
    }
  });
}




export function displayMSG(msg){
  let rescont = document.getElementById("addingresult");
  rescont.textContent=msg;
  rescont.style.display="inline-block";
  setTimeout(() => {
   rescont.style.display="none";
  }, 2000);
}

