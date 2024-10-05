<section class="promotionsSection">
    <div class="newrecipescontainer promotionscontainer">
      <div class="newsection_textcontent">
        <h3>New Promotions</h3>
        <h1>Enjoy new offers on delicious dishes</h1>
        <p>try new tastes from all categories and from expert master chefs Lorem ipsum dolor sit amet consectetur
          adipisicing elit Magni autem obcaecati labore excepturi </p>
        <div class="btnscontainer"><button id="leftbtn"><i class="fa-solid fa-arrow-left-long"></i></button>
          <button id="rightbtn"><i class="fa-solid fa-arrow-right-long"></i></button>
        </div>
      </div>
      <div class="newsection_imagecontent newsection_imagesformenu">

      <?php foreach ($promofoodList as $item): ?>
        <div>
          <img src="<?php echo "data:image;base64,".base64_encode($item->getImage());?>" alt="food image">
          <span class="promotionticket">-<?php echo $item->getPromo()->getDiscount(); ?>%</span>
          <div>
            <p class="categorie"><?php echo $item->getCategorie(); ?></p>
            <p class="foodname"><?php echo $item->getFoodName(); ?></p>
            <p class="linestyle"></p>
            <p class="promofooddescription"><?php echo $item->getFoodDescription(); ?></p>
          </div>
        </div>
        <?php endforeach; ?>
     
       

      </div>
    </div>
  </section>
<!-- END OF PROMOTIONS ---------------------------->
