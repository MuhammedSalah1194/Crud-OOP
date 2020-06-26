<?php
  include 'header.php';
  include 'navbar.php';
  ?>
  <?php if(isset($_GET['id']) && is_numeric($_GET['id'])):?>
  <?php  $i = $db->find('employees',$_GET['id']);?>
  <?php if($i):?> 

  <?php
    $departments= ['it', 'cs', 'acc'];
    $error = '';
    $success = '';
    if(isset($_POST['submit'])){
        $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $department = filter_var($_POST['department'], FILTER_SANITIZE_STRING);
        if(empty($name) or empty($email) or empty($department) ){
            $error = 'Please Fill All Fields';
        }else{
             if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                  $department = strtolower($department);
                  if(in_array($department, $departments)){
                      if(!empty($password)){
                          $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
                          if(strlen($password) >= 6){
                            $password = $db->enc_password($password); /* Encrypt Password */
                          }else{
                            $error = 'Password Must Be Greater Than 6 Charcter';
                          }
                      }else{
                          $password = $i['password'];
                      }
                      $q = " UPDATE `employees` SET `name` = '$name', `email` ='$email',`department` ='$department',`password`='$password' WHERE `id` = '$i[id]'";

                      $success = $db->update($q);

                    }else{
                      $error = "This Department Not Found";
                    }
              }else{
                  $error = "Please Type Valid Email";
              }
        }
    }

?>

<!--------------------------------------Start Design---------------------------------->

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h1 class="p-3 col text-center mt-5 text-white bg-primary">Insert</h1>
      <div class="col-md-12">
          <?php if($error !=''):?>
            <h3 class="p-2 col text-center mt-5 alert alert-danger"><?php echo $error;?></h3>
          <?php endif;?>
          
          <?php if($success !=''):?>
            <h3 class="p-2 col text-center mt-5 alert alert-success"><?php echo $success;?></h3>
          <?php endif;?>
          
      </div>
    </div>
  </div>
</div>
<!-- Start Container -->
<div class="container">
    <!-- Start Row -->
    <div class="row">   
        <div class="col-md-12">
          <form method="POST" action="<?php $_SERVER['PHP_SELF'];?>">
            <div class="form-group">
              <label>Name</label>
              <input type="text" class="form-control" name="name" placeholder="Enter Name" value="<?=$i['name'];?>">
            </div>
            <div class="form-group">
              <label >Department</label>
              <input type="text" class="form-control" name="department" placeholder="Enter Department" value="<?=$i['department'];?>">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Email address</label>
              <input type="text" class="form-control" placeholder="Enter Email" name="email" value="<?=$i['email'];?>">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Password</label>
              <input type="password" class="form-control"  id="exampleInputPassword1" placeholder="Enter Password" name="password">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
    </div>
    <!-- End Row -->
</div>
  <!-- End Container -->

    <?php endif;?>

<?php endif;?>


<!--------------------------------------End Design---------------------------------->
<?php include "footer.php";?>