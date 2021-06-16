<?php
   header ("Access-Control-Allow-Origin: *");
   header ("Access-Control-Expose-Headers: Content-Length, X-JSON");
   header ("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
   header ("Access-Control-Allow-Headers: *");

   include_once 'common/helpers.php';
   include_once 'common/FileSystemHelper.php';
   include_once 'processer/Authentication/UserInterface.php';

   include_once 'processer/Authentication/Core/PasswordTrait.php';
   include_once 'processer/Authentication/Token/UserTokenInterface.php';
   include_once 'processer/Authentication/Token/UserToken.php';

   include_once 'processer/Authentication/Core/UserManagerInterface.php';
   include_once 'processer/Authentication/Core/UserManager.php';

   //Models
   include_once 'models/OrderedProject.php';
   include_once 'models/Address.php';
   include_once 'models/User.php';
   include_once 'models/UserRole.php';

   //Get data from request
   $data = \Helpers\getRequestData();
   $router = $data['router'];

   //Validating route
      if (\Helpers\isValidRouter($router)) {

         // Connecting file router
         include_once "routers/$router.php";

         // Executing main function
         getRoute($data);

   } else {
         // Выбрасываем ошибку
         \Helpers\throwHttpError('invalid_router', 'router not found');
   }
