let  fileInput = document.querySelector('input[type="file"]');
let sucMsg = document.querySelector('.suc')
let errMsg = document.querySelector('.failed');
let selectedFile=null;

fileInput.addEventListener('change', function(event) {

    // Access the selected file(s)
      selectedFile = event.target.files[0]; // Assuming only one file is selected
    var maxSizeInBytes = 1048576;
    if (selectedFile) {
        if(!(selectedFile.size>maxSizeInBytes)){
        var reader = new FileReader();
        reader.onload = function(event) {
            let img = document.querySelector('img')
            img.src = event.target.result;
        };
        reader.readAsDataURL(selectedFile);
    }
    else{
        let i=0;
       let TimerId = setInterval(() => {
        i++;
        if(i<=6){
        if(!document.querySelector('.cond').classList.contains("red")){
            document.querySelector('.cond').classList.add("red");
        }

        else{
        document.querySelector('.cond').classList.remove("red");
        console.log('white')
        }
        }
        else{
            document.querySelector('.cond').classList.remove("red"); 
             clearInterval(TimerId);
        }
        }, 200);
    }
    }
});




function checkClientInfos(){
    var firstname = document.getElementById('firstname').value;
    var lastname = document.getElementById('lastname').value;
    var curPas = document.getElementById('curPass').value;
    var newPass = document.getElementById('newPass').value;
    var confNewPass = document.getElementById('confNewPass').value;
    var image = selectedFile;

    data = new FormData();
    data.append('firstname',firstname);
    data.append('lastname',lastname);
    data.append('curPass',curPas);
    data.append('newPass',newPass);
    data.append('confNewPass',confNewPass);
    data.append('image',image);

    fetch('index.php?action=checkAcountInfos', {
        method: 'POST',
        body: data,
    })
    .then(response => {
        return response.text();
    })
    .then(dataRes => {
        console.log(dataRes)
        if(dataRes === 'good') {
            document.querySelector('.sucmsg').innerHTML = 'Succesfully Edited';
            showtemp(sucMsg);
        } else {
            document.querySelector('.errmsg').innerHTML = dataRes;
            showtemp(errMsg);
        }
    })
    .catch(error => {
        window.location.href = "index.php?action=err";
        console.error('Error:', error);
    });


    
}


$(document).ready(function(){
    // Loop through each element with class "resState"
    $('.resState').each(function(){
        // Get the text content of the element
        var status = $(this).text().trim();
        
        // Check the status and assign color accordingly
        switch(status) {
            case 'Pending':
                $(this).css('color', 'orange');
                break;
            case 'Cancelled':
                $(this).css('color', 'red');
                break;
            case 'Failed':
                $(this).css('color', 'darkred');
                break;
            case 'Confirmed':
                $(this).css('color', 'green');
                break;
            default:
                // If the status is none of the above, you can handle it here
                // For example, set a default color
                $(this).css('color', 'black');
        }
    });
});




function showtemp(element){
    element.style.display='block';
     time = setTimeout(() => {
         element.style.display='none';
         clearTimeout(time);
    },2500);
}