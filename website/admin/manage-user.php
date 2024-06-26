
<?php include('partials/menu.php');

?>
<?php
if($loggedin){
    ?>


        <h1 class="text-center pt-3 font-weight-bold">Manage Users</h1>
        
        

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<style>
    .table td {
        text-align: center;
    }
</style>

<div class="container" style="margin-top:50px">
	
	<div class="row">
        <div class="col-lg-12">
            <button class="btn btn-primary float-left btn-sm mx-3" data-toggle="modal" data-target="#newUser"><i class="fa fa-plus"></i> New user</button>
        </div>
	</div>
	    <br>
        <div class="table-responsive-sm">
        <table class="table w-55 h-30 table-bordered">
    <thead class="table-danger ">

                        <tr>
                            <th>SN</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th> Address</th>
                            <th>Phone No.</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql = "SELECT * FROM users"; 
                            $result = mysqli_query($conn, $sql);
                            $sn = 1;
                            
                            while($row=mysqli_fetch_assoc($result)) {
                                $Id = $row['id'];
                                $username = $row['username'];
                                $email = $row['email'];
                                $address = $row['address'];
                                $phone = $row['phone'];

                                echo '<tr>
                                    <td>' .$sn++. '</td>
                                    <td>' .$username. '</td>
                                    <td>' .$email. '</td>
                                    <td>' .$address. '</td>
                                    <td>' .$phone. '</td>
                                    <td class="text-center">
                                        <div class="row mx-auto" style="width:112px">
                                            ';
                                          
                                           
                                                echo '<form action="_userManage.php" method="POST">
                                                        <button name="removeUser" class="btn btn-sm btn-danger" style="margin-left:9px;">Delete</button>
                                                        <input type="hidden" name="Id" value="'.$Id. '">
                                                    </form>';
                                            

                                    echo '</div>
                                    </td>
                                </tr>';
                            }
                        ?>
                    </tbody>
		        </table>
			</div>
		</div>
	

<!-- newUser Modal -->
<div class="modal fade" id="newUser" tabindex="-1" role="dialog" aria-labelledby="newUser" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:wheat;">
        <h5 class="modal-title" id="newUser">Create New User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>    
      <div class="modal-body">
        <form action="_userManage.php" method="post">

              <div class="form-group">
                  <b><label for="username">Username</label></b>
                  <input class="form-control" id="username" name="username" placeholder="Choose a unique Username" type="text" required minlength="3" maxlength="11">
              </div>
             
              <div class="form-group">
                  <b><label for="firstName">First Name:</label></b>
                  <input class="form-control" id="firstName" name="firstName" placeholder="Enter Your First Name" type="text" required>
              </div>
              <div class="form-group">
                  <b><label for="lastName">Last Name:</label></b>
                  <input class="form-control" id="lastName" name="lastName" placeholder="Enter Your Last Name" type="text" required>
              </div>
             
              <div class="form-group">
                  <b><label for="email">Email:</label></b>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Enter Your Email" required>
              </div>
              <div class="form-group">
                  <b><label for="address">Address:</label></b>
                  <input class="form-control" id="address" name="address" placeholder="Enter Address" type="text" required>
              </div>
              <div class="form-group row my-0">
                    <div class="form-group col-md-6 my-0">
                        <b><label for="phone">Phone No:</label></b>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon">+91</span>
                            </div>
                            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter Phone No" required pattern="[0-9]{10}" maxlength="10">
                        </div>
                    </div>
              </div>
              <div class="form-group">
                  <b><label for="password">Password:</label></b>
                  <input class="form-control" id="password" name="password" placeholder="Enter Password" type="password" required data-toggle="password" minlength="4" maxlength="21">
              </div>
              
              <button type="submit" name="createUser" class="btn btn-success">Submit</button>
            </form>
      </div>
    </div>
  </div>
</div>

<?php 
    $usersql = "SELECT * FROM `users`";
    $userResult = mysqli_query($conn, $usersql);
    while($userRow = mysqli_fetch_assoc($userResult)){
        $Id = $userRow['id'];
        $name = $userRow['username'];
        $email = $userRow['email'];
        $address = $userRow['address'];
        $phone = $userRow['phone'];
        $firstName = $userRow['firstName'];
        $lastName = $userRow['lastName'];
        $phone = $userRow['phone'];


?>


<?php
    }
?>
 


<?php include("./partials/footer.php"); ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<?php
}
else{
    // Redirect to login page if user is not logged in
    $_SESSION ['login'] = "<div class='error'>Please login to access admin pannel.</div>";
    header('location:'.SITEURL.'admin/login.php');
}