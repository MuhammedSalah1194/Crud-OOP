<?php
  include 'header.php';
  include 'navbar.php';
?>


<!--------------------------------------Start Design---------------------------------->
<!-- Start Container -->
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <?php if(count($db->show('employees'))):?>
            <div class="col-md-12">
                <table class="table">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Department</th>
                      <th>Edit</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($db->show('employees') as $i):?>
                      <tr>
                        <td><?=$i['id'];?></td>
                        <td><?=$i['name']?></td>
                        <td><?=$i['email'];?></td>
                        <td><?=$i['department'];?></td>
                        <td>
                          <a href="edit_emp.php?id=<?= $i['id']?>" class="text-primary"><i class="fas fa-edit"></i>Edit</a>
                        </td>
                        <td>
                          <a href="delete_emp.php?id=<?= $i['id']?>" class="text-danger"><i class="fas fa-trash-alt"></i>Delete</a>
                        </td>
                      </tr>      
                    <?php endforeach;?>
                  </tbody>
                </table>
            </div>

        <?php else:?>
          <div class="col-md-12">
          <h3 class="p-2 col text-center mt-5 alert alert-danger">Not Found Data</h3>
          </div>
        <?php endif;?>
      </div>
    </div>
  </div>
<!-- End Container -->

<!--------------------------------------End Design---------------------------------->
<?php include "footer.php";?>