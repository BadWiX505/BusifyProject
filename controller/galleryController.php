<?php 

  function displayGalleryAction(){
    require 'view/Gallery.php';
  }

function getGalleryPage(){
  require 'model/Database.php';
  $page = $_GET['page'];
  $gallery = Database::getGallery($page);
  echo getHtml($gallery);
}


function getHtml($gallery){
  $html = '';
  foreach($gallery as $gal){
 $html.= '<div class="image-container">';
 $html.= '<img src="data:image;base64,' . base64_encode($gal->getImage()) . '">';
 $html.= '</div>';
  }
  return $html;
}
?>