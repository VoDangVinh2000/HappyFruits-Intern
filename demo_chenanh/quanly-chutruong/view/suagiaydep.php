<?php include '../include/header.php' ?>

<?php include '../include/sidebar.php' ?>
<?php 
     spl_autoload_register(function($class){
          require '../models/' . $class . ".php";
     });
?>


<?php include '../include/main.php' ?>