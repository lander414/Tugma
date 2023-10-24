<?php
session_start();
session_destroy(); 

header("Location: ../path/start.php"); 
exit();