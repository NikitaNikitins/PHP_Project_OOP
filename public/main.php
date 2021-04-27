<?php require_once('../private/initialize.php');?>
<?php include(SHARED_PATH . '/main-header.php'); ?>

<!-- header  -->
<div class="nav_bar">
<p class="nav_bar_main">Products</p>
<form action="new.php" method="post">
        <button class="nav_bar_right" id="btn_Apply">Add new</button>
</form>
    <button class="nav_bar_right" id="btn_Chck">Check All</button>
<form  action="products/delete.php" method="post">
    <button type="submit" class="nav_bar_right" id="btn_Del" name="delete">Delete</button>
    
    
    
</div>

<hr class="line">
<!-- header  -->
<!-- Displaying info about books  ----------------------------------------------->

<div class="grid-container">

 
<?php

//info about displaying is in classes/productsView
        $discObj = new ProductsView();
        $discObj->showProduct('discSize');

        $bookObj = new ProductsView();
        $bookObj->showProduct('bookWeight');

        $furnitureObj = new ProductsView();
        $furnitureObj->showProduct('furnitureDimension');


    ?>

    <!-- -----------------------------  ----------------------------------------------->
  
</div>
</form>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="assets/js/scripts.js"></script>
<?php include(SHARED_PATH . '/public_footer.php'); ?>
