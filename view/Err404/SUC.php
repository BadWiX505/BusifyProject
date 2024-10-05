<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">


<title>Your Mail Sent Successfully - Bootdey.com</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style type="text/css">
    	body{
            width: 100%;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
.mail-seccess {
    text-align: center;
	background: #fff;
    padding: 0 2%;
}
.mail-seccess .success-inner {
	display: block;
}
.mail-seccess .success-inner h1 {
	font-size: 100px;
	text-shadow: 3px 5px 2px #3333;
	color: #006DFE;
	font-weight: 700;
}
.mail-seccess .success-inner h1 span {
	display: block;
    width: 100%;
	font-size: 25px;
	color: #333;
	font-weight: 600;
	text-shadow: none;
	margin-top: 20px;
}
.mail-seccess .success-inner p {
    width: 100%;
    text-align: center;
}
.mail-seccess .success-inner .btn{
	color:#fff;
}

.fa-circle-check{
animation: anim;
animation-duration: 1s;
animation-iteration-count: infinite;
animation-timing-function: linear;
animation-direction: alternate;
}
@keyframes anim{
    form{
        transform: scale(1);
    }
    to{
      transform: scale(1.1);
    }
}
    </style>
</head>
<body>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

<section class="mail-seccess section">
<div class="container">
<div class="row">
<div class="">

<div class="success-inner">
<h1><i class="fa-solid fa-circle-check" style="color:#fd9900 ;"></i><span>Thank You!</span></h1>
<p>Thank you for your patience , the operation has been done Successfully</p>
</div>

</div>
</div>
</div>
</section>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
	setTimeout(() => {
        window.location.href = "Home";
    }, 2000);
</script>
</body>
</html>