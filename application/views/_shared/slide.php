
<div class="container slideshow p-0">
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <?php
    function getDirContents($dir, &$results = array()) {
        $files = scandir($dir);
        foreach ($files as $key => $value) {
            $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
            if (!is_dir($path)) {
                $results[] = BASEURL."/public/assets/img/slide/".$value;
            }
        }
    
        return $results;
    }
    
    $arr = getDirContents("../public/assets/img/slide");

    echo '<div class="carousel-inner">';
    foreach ($arr as $key => $value) {
        if($key == 0) {
            echo '<div class="carousel-item active">';
            echo '<img class="d-block w-100" src="'.$value.'">';
            echo '</div>';
        } else {
            echo '<div class="carousel-item">';
            echo '<img class="d-block w-100" src="'.$value.'">';
            echo '</div>';
        }
    }
    echo '  </div>';
    echo '<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">';
    echo '  <span class="carousel-control-prev-icon" aria-hidden="true"></span>';
    echo '  <span class="sr-only">Previous</span>';
    echo '</a>';
    echo '<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">';
    echo '  <span class="carousel-control-next-icon" aria-hidden="true"></span>';
    echo '  <span class="sr-only">Next</span>';
    echo '</a>';
  ?>

</div>
</div>