
<header>
            <button class="bars"><i class="fa-solid fa-bars"></i></button>
            <div class="navbar">
                <ul>
                    <a href="Home">
                        <li>Home</li>
                    </a>
                    <a href="AboutUs">
                    <li>About us</li>
                    </a>
                    <a href="Menu">
                        <li>Menu</li>
                    </a>
                    <a href="Reservation">
                    <li>Reservation</li>
                    </a>
                    <a href="gallery">
                        <li>Gallery</li>
                    </a>
                </ul>
            </div>
            <div class="Logo">
                Logo
            </div>
            <div class="tablecontainer">
                <button class="table">
                    <span>0</span>
                    <i class="fa-solid fa-table"></i>
                </button>
            </div>

            <?php 
            $signUplink ="javascript:";
            if(!isset($_SESSION['idClient'])){
                $signUplink = 'login';
             } ?>

            <div class="Signinbtn" >
              <a href="<?php echo $signUplink ?>">  <button class="button" data-text="Awesome">
                    <span class="actual-text">&nbsp;Account&nbsp;</span>
                    <span aria-hidden="true" class="hover-text">&nbsp;Account&nbsp;</span>
                </button> </a>
            </div>
        </header>

        

