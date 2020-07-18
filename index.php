<!DOCTYPE html>
<?php

if(isset($_POST['submit_cred'])){
  $user_id =$_POST["InputEmail"];
  $password=$_POST["InputPassword"];
  $host="localhost";
  $user="root";
  $pass="";
  $db="college_project";
  $conn=new mysqli($host,$user,$pass,$db);
  $user_id =mysqli_real_escape_string($conn,$user_id);
  $password=mysqli_real_escape_string($conn,$password);
  $ct_query = "SELECT COUNT(*) FROM `teacher_acc_db` WHERE id ='$user_id'";
  $ct_result = mysqli_query($conn,$ct_query) or die("ERROR".mysqli_error($conn));
  $ct_row = mysqli_fetch_array($ct_result);
  if($ct_row['COUNT(*)'] !=0)
  { 
    $query="SELECT * FROM `teacher_acc_db` WHERE id ='$user_id'";
    $result = mysqli_query($conn,$query) or die("ERROR".mysqli_error($conn));
    $row = mysqli_fetch_array($result);
    if($row['id'] == $user_id AND $row['password']== $password){
      session_start();
      $_SESSION["user_id"] = $row['id'];
      $_SESSION["desgn"] = $row['designation'];
      $_SESSION["branch"] = $row['branch'];
      $_SESSION["f_name"]= $row['f_name'];
      $_SESSION["s_name"]= $row['s_name'];
    }
    else{
      echo '<script>alert("Entered credentials are incorrect")</script>';
    }
  }
  else{
    echo '<script>alert("User not found !!")</script>';
  }
}
elseif(isset($_POST['add_user'])){
 $fname = $_POST['f_name'];
 $sname = $_POST['s_name']; 
 $uid = $_POST['u_id'];
 $pass_add = $_POST['pass_add'];
 $desgn =$_POST['desgn'];
 $branch = $_POST['branch'];
 $host="localhost";
  $user="root";
  $pass="";
  $db="college_project";
  $conn=new mysqli($host,$user,$pass,$db);
  $fname = mysqli_real_escape_string($conn,$fname);
  $sname = mysqli_real_escape_string($conn,$sname);
  $uid = mysqli_real_escape_string($conn,$uid);
  $branch = mysqli_real_escape_string($conn,$branch);
  $pass_add = mysqli_real_escape_string($conn,$pass_add);

  if ($desgn=='TEACHER'){
    $num=3;
  }
  elseif($desgn=='HOD'){
    $num=2;
  }
  else{
    $num=1;
  }
  if($num==3){
  $q1="SELECT COUNT(*) FROM `teacher_acc_db` WHERE id ='$uid'";
  $result = mysqli_query($conn,$q1) or die("ERROR".mysqli_error($conn));
  $row = mysqli_fetch_array($result);
  if($row['COUNT(*)'] == 0){
   $q_insert="INSERT INTO `teacher_acc_db`(`f_name`, `s_name`, `id`, `password`, `branch`, `designation`) VALUES ('$fname','$sname','$uid','$pass_add','$branch',$num)";
   $resultq = mysqli_query($conn,$q_insert) or die("ERROR".mysqli_error($conn));
   echo '<script>alert("Account Created Successfully")</script>';
  }
  else{
    echo '<script>alert("Choose another User ID")</script>';
  }
  }
  else{
    $hod_query="SELECT COUNT(*) FROM `teacher_acc_db` WHERE designation=$num AND branch='$branch'";
    $result = mysqli_query($conn,$hod_query) or die("ERROR".mysqli_error($conn));
    $row = mysqli_fetch_array($result);
    if($row['COUNT(*)'] == 0){
      $q_insert="INSERT INTO `teacher_acc_db`(`f_name`, `s_name`, `id`, `password`, `branch`, `designation`) VALUES ('$fname','$sname','$uid','$pass_add','$branch',$num)";
      $resultq = mysqli_query($conn,$q_insert) or die("ERROR".mysqli_error($conn));
      echo '<script>alert("Account for HOD Created Successfully")</script>';
    }
    else{ echo "<script>alert('Only one Account for HOD can be allocated in a particular branch !!')</script>";}
  }
}


?>

<!--HTML CODE FOR THE FRONTEND -->

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" integrity="sha384-KA6wR/X5RY4zFAHpv/CnoG2UW1uogYfdnP67Uv7eULvTveboZJg0qUpmJZb5VqzN" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light" style="padding: 1%;">
        <a class="navbar-brand" href="#" style="font-weight:bold">OBE Tool</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
            <?php
                        if(session_status() == PHP_SESSION_NONE){
                          echo'<a href="#" onclick="login_error()" class="nav-link">Dashboard</a> ';       
                        }
                        else{
                        echo '<a href="dash.php" class="nav-link">Dashboard</a> ';
                        }
                        
                        
                        ?>
            </li>
            <li class="nav-item">
              
            <?php
                        if(session_status() == PHP_SESSION_NONE){
                          echo'<a href="#" onclick="login_error()" class="nav-link" >Curriculum</a> ';       
                        }
                        elseif ($_SESSION['desgn']==3){
                        echo '<a href="SPEC_CO.php" class="nav-link">Curriculum</a> ';
                        }
                        elseif($_SESSION['desgn']==1 or $_SESSION['desgn']==2 ){
                          echo'<a href="set_curr.php" class="nav-link">Curriculum</a> ';
                        }
                        
                        ?>    
            </li>
            <li class="nav-item">
            <?php
                        if(session_status() == PHP_SESSION_NONE){
                          echo'<a href="#" onclick="login_error()" class="nav-link" >Report</a> ';       
                        }
                        else{
                        echo '<a href="report.php" class="nav-link">Report</a> ';
                        }
                        
                        
            ?>     
              </li>
          </ul>

          <?php 
          
          if(session_status() == PHP_SESSION_NONE){ 
            echo '<button class="btn btn-light" data-toggle="modal" data-target="#Modal2" style="margin-right: 1%;">
            SIGN UP <i class="fas fa-user-plus"></i>
            </button>';
          
          echo '<button class="btn btn-light" data-toggle="modal" data-target="#Modal" style="margin-right: 1%;">
                LOGIN <i class="fas fa-sign-in-alt"></i>
                </button>';
         }
          else {
          echo '<a href="profile.php" class="btn btn-light" style="margin-right: 1%;">
          <strong>'.$_SESSION["f_name"].' '.$_SESSION["s_name"].'</strong></a>';
          echo '<form method="post"><button type="submit" class="btn btn-danger" name="can_cred">LOGOUT</button></form>';
          if(isset($_POST['can_cred'])){
            header("Location:index.php");
            session_destroy();
            } 
          }
          ?>
            
          
        </div>
      </nav>
      <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" style="color: black">LOGIN</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: black">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="needs-validation" method="post" action="" novalidate >
            <div class="modal-body">
                    <div class="form-group">
                      <label for="InputEmail1">USER-ID</label>
                      <input type="text" class="form-control" name="InputEmail" id="InputEmail" " placeholder="ENTER USER-ID" required>
                      <div class="invalid-feedback">
                        Please enter login id.
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="InputPassword1">PASSWORD</label>
                      <input type="password" class="form-control" id="InputPassword" name="InputPassword" placeholder="ENTER PASSWORD" required>
                      <div class="invalid-feedback">
                        Please enter password.
                      </div>
                    </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" onclick="pass_forgot()">Forgot Password</button>
              <button type="submit"  name="submit_cred" class="btn btn-success">Login</button>
            </div>
          </form>
          </div>
        </div>
      </div>

<div class="modal fade" id="Modal2" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" style="color:black">CREATE NEW USER</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:black">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="needs-validation" method="post" action="" novalidate >
      <div class="modal-body">
      <div class="form-row">
      <div class="form-group col-md-6">
        <label for="first name">ENTER FIRST NAME</label>
        <input type="text" class="form-control" id="f_name" name="f_name" placeholder="FIRST NAME" required>
        
      </div>
      <div class="form-group col-md-6">
        <label for="s_name">ENTER SURNAME</label>
        <input type="text" class="form-control" name="s_name" id="s_name" placeholder="SURNAME" required>
      </div>
      </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="UID">ENTER USER-ID</label>
        <input type="text" class="form-control" name="u_id" placeholder="USER-ID" required>
      </div>
      <div class="form-group col-md-6">
        <label for="inputPassword">ENTER PASSWORD</label>
        <input type="password" class="form-control" name="pass_add" placeholder="PASSWORD" required>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
      <label >DESIGNATION</label>
        <select id="desgn" name="desgn" class="form-control custom-select" required>
          <option value="" disabled selected>CHOOSE DESIGNATION</option>
          <option>TEACHER</option>
          <option>HOD</option>
          <option>PRINCIPAL</option>
        </select>
      </div>
      <div class="form-group col-md-6">
        <label>BRANCH</label>
        <select id="branch" name="branch" class="form-control custom-select" required >
        <option value="" disabled selected>CHOOSE BRANCH</option>
          <option>Computers</option>
          <option>IT</option>
          <option>College - Principal</option>
        </select>
      </div>
    </div>
  </div>
      <div class="modal-footer">
              <button type="submit"  name="add_user" class="btn btn-success">ADD USER</button>
            </div>
          </form>
          </div>
        </div>
</div>

      <div class="container-fluid" style="margin-top:1%">
        <div class="row">
          <div class="col-lg-6" >
            <div class="card" style="padding: 6%;">
                <center>
                  <i class="fas fa-clipboard-list fa-10x"></i>
                <div class="card-body">                  
                  <h5 class="card-title">DASHBOARD</h5>
                  <?php
                        if(session_status() == PHP_SESSION_NONE){
                          echo'<a href="#" onclick="login_error()" class="btn btn-success" >Go to DASHBOARD</a> ';       
                        }
                        else{
                        echo '<a href="dash.php" class="btn btn-success">Go to DASHBOARD</a> ';
                        }
                        
                        
                        ?>                
                </div>
              </center>
              </div>
          </div>
          <div class="col-lg-6" >
                <div class="card" style="padding: 6%;">
                  <center>
                    <i class="fas fa-book-reader fa-10x"></i>
                        <div class="card-body">
                          <h5 class="card-title">CURRICULUM</h5>
                        <?php
                        if(session_status() == PHP_SESSION_NONE){
                          echo'<a href="#" onclick="login_error()" class="btn btn-success" >Go to CURRICULUM</a> ';
                          
                        }
                        elseif ($_SESSION['desgn']==3){
                        echo '<a href="SPEC_CO.php" class="btn btn-success">Go to CURRICULUM</a> ';
                        }
                        elseif($_SESSION['desgn']==1 or $_SESSION['desgn']==2 ){
                          echo'<a href="set_curr.php" class="btn btn-success">Go to CURRICULUM</a> ';
                        }
                        
                        ?>                                  
                        </div>
                      </center>
                      </div>
          </div>
        </div>
        <div class="row" style="margin-top:1%">
          <div class="col-lg-6" >
                <div class="card" style="padding: 6%;">
                  <center>
                  <i class="fas fa-chart-bar fa-10x"></i>
                        <div class="card-body">
                          <h5 class="card-title">REPORT</h5>
                        <?php
                        if(session_status() == PHP_SESSION_NONE){
                          echo'<a href="#" onclick="login_error()" class="btn btn-success" >Go to REPORT</a> ';       
                        }
                        else{
                        echo '<a href="report.php" class="btn btn-success">Go to REPORT</a> ';
                        }
                        ?>                             
                        </div>
                      </center>
                      </div>
          </div>
          <div class="col-lg-6">
                <div class="card" style="padding: 6%;">
                  <center>
                  <i class="fas fa-address-card fa-10x"></i>
                        <div class="card-body">         
                          <h5 class="card-title">PROFILE</h5>
                          <?php
                        if(session_status() == PHP_SESSION_NONE){
                          echo'<a href="#" onclick="login_error()" class="btn btn-success" >Go to PROFILE</a> ';       
                        }
                        else{
                        echo '<a href="profile.php"  class="btn btn-success">Go to PROFILE</a> ';
                        }                      
                        ?>                             
                        </div>
                      </center>
                      </div>
          </div>
        </div>
      </div>


</body>
<script>
function login_error() {
  alert("Please Login to Continue");
}
function pass_forgot(){
  alert("Please Contact the Admin");
}
</script>
<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();

</script>
</html>