
let pageN=0;
let isItEnd=false;

fetchReview(pageN);

$('#nextreview').click(()=>{
    if(!isItEnd)
    nextReview();
})

$('#previousreview').click(()=>{
    isItEnd=false;
    if(pageN>0)
    previousReview();
})


function nextReview() {
    $('.fade').fadeToggle(500).promise().done(function() {
        pageN++;
        fetchReview(pageN);
    });
}

function previousReview() {
    $('.fade').fadeToggle(500).promise().done(function() {
        pageN--;
        fetchReview(pageN);
    });
}




function fetchReview(PN){
    $.ajax({
        url: "index.php?action=Treview", // URL of the PHP script to load food items
        type: "POST",
        dataType: "json",
        data: {
            page: PN, 
        },
        success: function(review){
           if(review['error']==='none'){
          let dataUrl = 'data:image;base64,' + review['image'];
          $('.cusimage img').attr('src', dataUrl);
             $('.comment').text(review['description']);
              $('#cusname').text( review['firstName']);
              $('.fade').fadeIn(500);
           }
           else{
            $('.fade').fadeIn(500);
            isItEnd=true;
            pageN--;
            console.log('none');
           }
        },
        error: function(xhr, status, error){
            console.error(xhr.responseText+"    "+error);
           // window.location.href = "index.php?action=err";
        }
    });
}