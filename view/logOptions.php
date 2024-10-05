
<?php 
 if(isset($_COOKIE["id"])){
    $_SESSION['idClient']=$_COOKIE["id"];
}
if(isset($_SESSION['idClient']))  { ?>

<div class="acount-options">
<div onclick='javascript:  window.location.href = "logout";'> <i class="fa-solid fa-arrow-right-from-bracket"></i> logout</div>
    <div><a href="manageDisplay"><i class="fa-solid fa-gears"></i> manage</a></div>
</div>

<?php } ?>
