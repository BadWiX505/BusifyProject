let galleryPage=0;
let isFinished =false;

fetchgallery(galleryPage);



function fetchgallery(galPage){
    $.ajax({
        url: "index.php?action=fetchGallery", // URL of the PHP script to load food items
        type: "GET",
        dataType: "html",
        data: {
           page : galPage,
        },
        success: function(response){
           if(response===''){
            isFinished=true; 
            $('.morechefsbtn').hide();
           }
           else{
              $('.gallery').append(response);
              handlegrid();
           }
        },
        error: function(xhr, status, error){
            console.error(xhr.responseText);
            window.location.href = "index.php?action=err";
        }
    });
}

$('.morechefsbtn').click(()=>{
    if(!isFinished){
    galleryPage+=12;
    fetchgallery(galleryPage);
    }
})


    function handlegrid(){
var myImages = document.querySelectorAll('.gallery img');
   myImages.forEach(image=>{
    var img = new Image();

    img.src = image.src;

    // Wait for the Image object to load
    img.onload = function() {
        // Access the naturalWidth and naturalHeight properties
        var originalWidth = img.naturalWidth;
        var originalHeight = img.naturalHeight;
        console.log('Original Width:', originalWidth);
       console.log('Original Height:', originalHeight);
       console.log("===================")
        if(originalHeight>originalWidth+30){
            image.parentNode.classList.add("tall")
        }
    };
   }
   )
}




    