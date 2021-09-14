<?php

/*
  -- load all class in folder classes
*/
spl_autoload_register(function ($className) {
  include "classes/$className.php";
});

$router = new router();
?>