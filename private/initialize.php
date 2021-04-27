<?php

ob_start(); // turn on output buffering

  // session_start(); // turn on sessions if needed

  // Assign file paths to PHP constants
  // __FILE__ returns the current path to this file
  // dirname() returns the path to the parent directory

 define("PRIVATE_PATH", dirname(__FILE__)); //..\private
 define("PROJECT_PATH", dirname(PRIVATE_PATH)); //.. 
 define("PUBLIC_PATH", PROJECT_PATH . '/public');
 define("SHARED_PATH", PRIVATE_PATH . '/shared');
 

 $public_end = strpos($_SERVER['SCRIPT_NAME'], '/public') + 7;
 $doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
 define("WWW_ROOT", $doc_root);
 
 require_once('functions.php');


 //Loading all the existing classes

 //Findind all the present files in class dir
//  foreach(glob('classes/*.class.php')as $file) {
//      require_once($file);
//  }

//adherence to sequence
   require_once('DbConnector.php');
   require_once('models/User.php');
   require_once('models/Worker.php');
   require_once('models/Customer.php');
   require_once('models/Billing.php');
   require_once('models/OrderedProject.php');
   require_once('models/ProjectInProgress.php');
?>