<?php
  include 'header.php';
  include 'navbar.php';
?>
 <?php if(isset($_GET['id']) && is_numeric($_GET['id'])):?>
  <?php  $i = $db->find('employees',$_GET['id']);?>
  <?php if($i):?> 


<!--------------------------------------Start Design---------------------------------->
<!-- Start Container -->
  <div class="container">
      <!-- Start Row -->
      <div class="row">   
          <h1 class="p-3 col text-center mt-5 text-white bg-danger">Delete</h1>
      </div>
      <!-- End Row -->
          <h3 class="p-2 col text-center mt-5 alert alert-success"><?php echo $db->destroy('employees', $i['id']);?></h3>
  </div>
<!-- End Container -->
<?php endif;?>

<?php endif;?>
<!--------------------------------------End Design---------------------------------->
<?php include "footer.php";?>