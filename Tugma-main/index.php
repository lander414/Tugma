<?php



$request = $_SERVER['REQUEST_URI'];
if($request !=''){

  switch ($request) {
    case '/s' :
      include('path/start.php');
      break;
      case '' :
        require '/path/start.php';
        break;
      }
    }else{
      echo"not working";
    }


echo"hello";

$current_url = $_SERVER['REQUEST_URI']; echo $current_url; ?>