<!DOCTYPE html>
<?php
// Start the session
session_start();
$host="localhost";
$user="root";
$pass="";
$db="college_project";
$id = $_SESSION['user_id'];
$conn=new mysqli($host,$user,$pass,$db);
$branch=$_SESSION['branch'];
$query="SELECT DISTINCT * FROM `$branch` WHERE `teacher_id`='$id'";
$result = mysqli_query($conn,$query) or die("ERROR".mysqli_error($conn));
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Question-CO Mapping</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="padding: 1%">
        <a class="navbar-brand" href="index.php" style="font-weight:bold">OBE Tool</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="dash.php">Dashboard</a>
            </li>
            <li class="nav-item active">
              
            <?php
                        if ($_SESSION['desgn']==3){
                        echo '<a href="SPEC_CO.php" class="nav-link">Curriculum</a> ';
                        }
                        elseif($_SESSION['desgn']==1 or $_SESSION['desgn']==2 ){
                          echo'<a href="set_curr.php" class="nav-link">Curriculum</a> ';
                        }
                        
                        ?>    
            </li>
            <li class="nav-item">
                <a class="nav-link" href="report.php">Report</a>
              </li>
          </ul>
          <?php 
          
          if(session_status() == PHP_SESSION_NONE){ 
            echo '<button class="btn btn-light" data-toggle="modal" data-target="#Modal2" style="margin-right: 1%;">
            <strong>SIGN UP</strong> <i class="fas fa-user-plus"></i>
            </button>';
          
          echo '<button class="btn btn-light" data-toggle="modal" data-target="#Modal" style="margin-right: 1%;">
                <strong>LOGIN</strong> <i class="fas fa-sign-in-alt"></i>
                </button>';
         }
          else {
          echo '<a href="profile.php" class="btn btn-light" style="margin-right: 1%;">
          <strong>'.$_SESSION['f_name'].' '.$_SESSION['s_name'].'</strong></a>';
          echo '<form method="post"><button type="submit" class="btn btn-danger" name="can_cred" href="index.php">LOGOUT</button></form>';
          if(isset($_POST['can_cred'])){
            header("Location:index.php");
            session_destroy();
            } 
          }
          ?>
        </div>
      </nav>

      <div class="container-fluid">
          <div class="row" style="padding: 1%;">
              <div class='col-2'>
      <nav class="nav flex-column" style="margin: 1%;">
      <?php
      if($_SESSION['desgn']==3){
        echo '<a class="nav-link" href="#" onclick="login_error()" style="color: black;display: none">Set Curriculum</a>
        <a class="nav-link" href="#" onclick="login_error()" style="color: black;display: none">Specify PO</a>
        <a class="nav-link" href="SPEC_CO.php" style="color: black;">Specify CO</a>';
        
        }
        else{
          echo '<a class="nav-link" href="set_curr.php" style="color: black;">Set Curriculum</a>
          <a class="nav-link" href="spec_po.php" style="color: black;">Specify PO</a>
        <a class="nav-link" href="SPEC_CO.php" style="color: black;">Specify CO</a>';
        }
        ?>
        <a class="nav-link active" href="CO_PO.php" style="color: black;">CO-PO Mapping</a>
        <a class="nav-link" href="marks_co.php" style="color: green;font-weight: bold;">Marks-CO Mapping</a>
        <a class="nav-link" href="marks.php" style="color: black;">Marks Data</a>

      </nav>
    </div>
    <div class='col-10'>
      <div class="container-fluid">
        
        <form class="needs-validation" method="post" action="" novalidate>
            <div class="form-row" style="margin-top: 2%">
              <div class="form-group" style="margin-right: 1%">
              <select name="type" class="form-control custom-select" required>
              <option value="" disabled selected >Choose Format of Examination</option>
              <option>Unit Test</option>
              <option>Semester</option>
              <option>Assignments</option>
              <option>Orals</option>
              <option>Termwork</option>	  
              </select>
              </div>
              <div class="form-group">
              <button class="btn btn-warning" name="map">Start Mapping</button>
              </div>
              </div>
         </form>
         
        <?php
        if (isset($_POST['map'])){
          if($_POST['type']=='Unit Test'){?>
          <form  class="needs-validation" method="post" action="" novalidate>
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Questions</th>
                <th scope="col">1a</th>
                <th scope="col">1b</th>
                <th scope="col">1c</th>
                <th scope="col">1d</th>
                <th scope="col">1e</th>
                <th scope="col">1f</th>
                <th scope="col">2a</th>
                <th scope="col">2b</th>
                <th scope="col">3a</th>
                <th scope="col">3b</th>
                <th scope="col">Course</th>
                <th scope="col">UT-1/2</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">Course-Outcome</th>
                <td><select class="form-control custom-select" name="1a">
              <option selected>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
              <option>6</option>	  
              </select></td>
              <td><select class="form-control custom-select" name="1b">
              <option selected>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
              <option>6</option>	  
              </select></td>
              <td><select  class="form-control custom-select" name="1c">
              <option selected>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
              <option>6</option>	  
              </select></td>
              <td><select  class="form-control custom-select" name="1d">
              <option selected>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
              <option>6</option>	  
              </select></td>
              <td><select  class="form-control custom-select" name="1e">
              <option selected>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
              <option>6</option>	  
              </select></td>
              <td><select  class="form-control custom-select" name="1f">
              <option selected>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
              <option>6</option>	  
              </select></td>
              <td><select  class="form-control custom-select" name="2a">
              <option selected>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
              <option>6</option>	  
              </select></td>
              <td><select  class="form-control custom-select" name="2b">
              <option selected>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
              <option>6</option>	  
              </select></td>
              <td><select  class="form-control custom-select" name="3a">
              <option selected>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
              <option>6</option>	  
              </select></td>
              <td><select  class="form-control custom-select" name="3b">
              <option selected>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
              <option>6</option>	  
              </select></td>
                
              <td>
                <div class="form-group" style="margin-right: 1%">
                <select name="course" class="form-control custom-select" required>
                            <option value="" disabled selected>Choose Course</option>
                            <?php
                              while($row = mysqli_fetch_array($result)){
                            ?>
                            <option><?echo "Subject : ".$row['sub_name']." ".$row['subject-code']." Semester : ".$row['semester']." || Year : ".$row['year']; ?></option>
                              <?}?>
                          </select>
              </div>
              </td>
              <td>
                <div class="form-group" style="margin-right: 1%">
                <select name="utn" class="form-control custom-select" required>
                            <option value="" disabled selected>Choose Unit Test</option>
                            <option>UT-1</option>
                            <option>UT-2</option>
              </select>
              </div>
              </td>
              </tr>
            </tbody>
          </table>
          <hr>
          <button class="btn btn-success" name="map_final">Map</button>
          </form>
         <?php 
         }
          else if ($_POST['type']=='Assignments'){
          }
          else{
            echo '<div class="alert alert-danger" role="alert" style="margin-left:-0.5%">
                  All questions are mapped to the Course-Outcomes in this format of examination. 
                </div>';
          }
        }
        else{
          echo '<div class="alert alert-info" role="alert" style="width:50%;margin-left:-0.5%">
          No selection done. </div> ';
        }
        ?>   
      </div>   
    </div>
  </div>
</div>
<?php
if(isset($_POST['map_final'])){
  $sub=explode(" ",$_POST['course'])[2];
  $sub_code=explode(" ",$_POST['course'])[3];
  $sem=explode(" ",$_POST['course'])[6];
  $year=explode(" ",$_POST['course'])[10];
  $utn=$_POST['utn'];
  $ques1_a=$_POST['1a'];
  $ques1_b=$_POST['1b'];
  $ques1_c=$_POST['1c'];
  $ques1_d=$_POST['1d'];
  $ques1_e=$_POST['1e'];
  $ques1_f=$_POST['1f'];
  $ques2_a=$_POST['2a'];
  $ques2_b=$_POST['2b'];
  $ques3_a=$_POST['3a'];
  $ques3_b=$_POST['3b'];

  if($utn=='UT-1'){
  $insert_query="INSERT INTO `ut_co_marks`(`sub`, `sub_code`, `sem`, `year`, `1a`, `1b`, `1c`, `1d`, `1e`, `1f`, `2a`, `2b`, `3a`, `3b`, `teacher_id`) 
  VALUES ('$sub','$sub_code','$sem','$year','$ques1_a','$ques1_b','$ques1_c',
  '$ques1_d','$ques1_e','$ques1_f','$ques2_a','$ques2_b','$ques3_a','$ques3_b','$id')";
  }
  elseif($utn=='UT-2'){
    $insert_query="INSERT INTO `ut2_co_marks`(`sub`, `sub_code`, `sem`, `year`, `1a`, `1b`, `1c`, `1d`, `1e`, `1f`, `2a`, `2b`, `3a`, `3b`, `teacher_id`) 
  VALUES ('$sub','$sub_code','$sem','$year','$ques1_a','$ques1_b','$ques1_c',
  '$ques1_d','$ques1_e','$ques1_f','$ques2_a','$ques2_b','$ques3_a','$ques3_b','$id')";
  }
  $insert_result = mysqli_query($conn,$insert_query) or die("ERROR".mysqli_error($conn));
  echo '<script>alert("Data mapped successfully.")</script>';
}
  ?>
</body>
<script>
function login_error() {
  alert("Function not available");
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