<!DOCTYPE html>
<html lang="en">
<head>
<?php
// Start the session
session_start();
$host="localhost";
$user="root";
$pass="";
$db="college_project";
$conn=new mysqli($host,$user,$pass,$db);
$branch=$_SESSION['branch'];
$id = $_SESSION['user_id'];
$query="SELECT DISTINCT * FROM $branch WHERE `teacher_id`='$id'";

$result = mysqli_query($conn,$query) or die("ERROR".mysqli_error($conn));
$result1 = mysqli_query($conn,$query) or die("ERROR".mysqli_error($conn));
$result2 = mysqli_query($conn,$query) or die("ERROR".mysqli_error($conn));

#print_r($row);
?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Specify CO</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/3857a76116.js" crossorigin="anonymous"></script>
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
                  <?php if($_SESSION['desgn']==3){?>
                    <a class="nav-link" href="#" onclick=login_error() style="color: black; display: none">Set Curriculum</a>
                    <a class="nav-link" href="#" onclick=login_error() style="color: black; display: none">Specify PO</a>
                  <?php
                  }else
                  {?>
                  <a class="nav-link" href="set_curr.php" style="color: black;">Set Curriculum</a>
                  <a class="nav-link" href="spec_po.php" style="color: black;">Specify PO</a>
                  <?}?>
                    <a class="nav-link active" href="SPEC_CO.php" style="color: green;font-weight: bold;">Specify CO </a>
                    <a class="nav-link" href="CO_PO.php" style="color: black;">CO-PO Mapping</a>
                    <a class="nav-link" href="marks_co.php" style="color: black;">Marks-CO Mapping</a>
                    <a class="nav-link" href="marks.php" style="color: black;">Marks Data</a>
                  </nav>
                </div>
                <div class='col-10'>
                <div class="container-fluid">
                  <div class="row">
                  <form class="needs-validation" method="post" action="" novalidate>
                  <div class="form-row" style="margin: 2%">
                  <div class="form-group" style="margin-right: 2%">
                  <select name="course" class="form-control custom-select" required>
                    <option value="" disabled selected>Choose Course</option>
                    <?php
                      while($row = mysqli_fetch_array($result)){
                    ?>
                <option><?echo "Subject : ".$row['sub_name']." ".$row['subject-code']." Semester : ".$row['semester']." || Year : ".$row['year']; ?></option>
                      <?}?>
                  </select>
                  </div>
                  <button type="submit" name="show_co" class="btn btn-info">View CO Specifications</button>
                  </div>
                  </form>
                  </div>
                  </div>
                  <?if(isset($_POST['show_co'])){?>
                    <div style="height:50vh; overflow-y: scroll">
                        <?php
                        $sub=explode(" ",$_POST['course'])[2];
                        $sub_code=explode(" ",$_POST['course'])[3];
                        $sem=explode(" ",$_POST['course'])[6];
                        $year=explode(" ",$_POST['course'])[10];
                        $search_query="SELECT `co1`, `co2`, `co3`, `co4`, `co5`, `co6` FROM `co_db`  WHERE `branch`='$branch' and
                         `sub_name`='$sub' and `sub_code`='$sub_code' and `sem`='$sem' and  `year`='$year' ";
                        $search_result= mysqli_query($conn,$search_query) or die("ERROR".mysqli_error($conn));
                        $search_row = mysqli_fetch_array($search_result);     
                        if(empty($search_row))
                        {
                          echo '<div class="alert alert-danger" role="alert" style="margin-left: 1%">
                          Please add the Course Outcomes for this subject !!!
                        </div>';
                        }
                        else{
                        ?>
                      <table class="table table-striped" style="margin-left: 1%">
                      <thead style="background-color:white;position: sticky; top: 0;">
                        <tr>
                          <th scope="col">CO Code</th>
                          <th scope="col">Course Outcome</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                        <th scope="row">CO1</th>
                        <td><?echo $search_row['co1']?></td>
                        </tr>
                        <tr>
                          <th scope="row">CO2</th>
                          <td><?echo $search_row['co2']?></td>
                        </tr>
                        <tr>
                          <th scope="row">CO3</th>
                          <td><?echo $search_row['co3']?></td>
                        </tr>  
                        <tr>
                        <th scope="row">CO4</th>
                        <td><?echo $search_row['co4']?></td>
                        </tr>
                        <tr>
                          <th scope="row">CO5</th>
                          <td><?echo $search_row['co5']?></td>
                        </tr>
                        <tr>
                          <th scope="row">CO6</th>
                          <td><?echo $search_row['co6']?></td>
                        </tr>                                       
                      </tbody>
                    </table>
                    </div>
                  <?}
                  }
                  else{
                  ?>
                  <div class="alert alert-info" role="alert" style="margin-left: 1%">
                  Please enter the above details to view the CO specifications
                  </div>
                 <? }?>
                <button type="button" class="btn btn-success"  data-toggle="modal" data-target="#add_co" style="margin-left: 1%;margin-top:1%;margin-right:2%">Add Course Outcomes</button>
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#update_allo" style="margin-top:1%;">Update Course Outcomes</button>

              <!-- Modal -->
                  <div class="modal fade" id="add_co" tabindex="-1">
                    <div class="modal-dialog" >
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Add Course Outcomes</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form class="needs-validation" method="post" action="" novalidate>
                        <div class="modal-body" style="height:400px; overflow-y: scroll">
                        <div class="form-row">
                        <div class="form-group col-md-12">
                          <label>Course</label>
                          <select name="course" class="form-control custom-select" required>
                            <option value="" disabled selected>Choose Course</option>
                            <?php
                              while($row2 = mysqli_fetch_array($result1)){
                            ?>
                            <option><?echo "Subject : ".$row2['sub_name']." ".$row2['subject-code']." Semester : ".$row2['semester']." || Year : ".$row2['year']; ?></option>
                              <?}?>
                          </select>
                        </div>
                      </div>
                        <hr>
                        <div class="form-row" style="margin-top: 2%">
                          <label>CO1-Description</label>
                          <input type="text" class="form-control" name="co1" placeholder="CO1-Description" required>
                        </div>
                        <div class="form-row" style="margin-top: 2%">
                          <label>CO2-Description</label>
                          <input type="text" class="form-control" name="co2" placeholder="CO2-Description" required>
                        </div>
                        <div class="form-row" style="margin-top: 2%">
                          <label>CO3-Description</label>
                          <input type="text" class="form-control" name="co3" placeholder="CO3-Description" required>
                        </div>
                        <div class="form-row" style="margin-top: 2%">
                          <label>CO4-Description</label>
                          <input type="text" class="form-control" name="co4" placeholder="CO4-Description" required>
                        </div>
                        <div class="form-row" style="margin-top: 2%">
                          <label>CO5-Description</label>
                          <input type="text" class="form-control" name="co5" placeholder="CO5-Description" required>
                        </div>
                        <div class="form-row" style="margin-top: 2%"> 
                          <label>CO6-Description</label>
                          <input type="text" class="form-control" name="co6" placeholder="CO6-Description" required>
                        </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-success" name="add_co">Add Course Outcome</button>
                        </div>
                        </form>
                        <?php
                        if (isset($_POST['add_co'])){
                          $sub=explode(" ",$_POST['course'])[2];
                          $sub_code=explode(" ",$_POST['course'])[3];
                          $sem=explode(" ",$_POST['course'])[6];
                          $year=explode(" ",$_POST['course'])[10];
                        $co1=$_POST['co1'];
                        $co2=$_POST['co2'];
                        $co3=$_POST['co3'];
                        $co4=$_POST['co4'];
                        $co5=$_POST['co5'];
                        $co6=$_POST['co6'];
                        $add_query="INSERT INTO `co_db`(`branch`, `sub_name`, `sub_code`, `sem`, `year`, `co1`, `co2`, `co3`, `co4`, `co5`, `co6`) VALUES
                         ('$branch','$sub','$sub_code','$sem','$year','$co1','$co2','$co3','$co4','$co5','$co6')";
                         $add_result = mysqli_query($conn,$add_query) or die("ERROR".mysqli_error($conn));
                          echo'<script>alert("Record added Successfully")</script>';
                        }
                        ?>
                      </div>
                    </div>
                  </div>
              
              <!-- Modal -->
              <div class="modal fade" id="update_allo" tabindex="-1">
                    <div class="modal-dialog" >
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Update Course Outcomes</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form class="needs-validation" method="post" action="" novalidate>
                        <div class="modal-body" style="height:400px; overflow-y: scroll">
                        <div class="form-row">
                        <div class="form-group col-md-12">
                          <label>Course</label>
                          <select name="course" class="form-control custom-select" required>
                            <option value="" disabled selected>Choose Course</option>
                            <?php
                              while($row2 = mysqli_fetch_array($result2)){
                            ?>
                            <option><?echo "Subject : ".$row2['sub_name']." ".$row2['subject-code']." Semester : ".$row2['semester']." || Year : ".$row2['year']; ?></option>
                              <?}?>
                          </select>
                        </div>
                      </div>
                        <hr>
                        <div class="alert alert-warning" role="alert">
                          Only enter the CO's you want to update !!!!
                        </div>
                        <div class="form-row" style="margin-top: 2%">
                          <label>CO1-Description</label>
                          <input type="text" class="form-control" name="co1" placeholder="CO1-Description"   >
                        </div>
                        <div class="form-row" style="margin-top: 2%">
                          <label>CO2-Description</label>
                          <input type="text" class="form-control" name="co2" placeholder="CO2-Description"   >
                        </div>
                        <div class="form-row" style="margin-top: 2%">
                          <label>CO3-Description</label>
                          <input type="text" class="form-control" name="co3" placeholder="CO3-Description"   >
                        </div>
                        <div class="form-row" style="margin-top: 2%">
                          <label>CO4-Description</label>
                          <input type="text" class="form-control" name="co4" placeholder="CO4-Description"   >
                        </div>
                        <div class="form-row" style="margin-top: 2%">
                          <label>CO5-Description</label>
                          <input type="text" class="form-control" name="co5" placeholder="CO5-Description"   >
                        </div>
                        <div class="form-row" style="margin-top: 2%"> 
                          <label>CO6-Description</label>
                          <input type="text" class="form-control" name="co6" placeholder="CO6-Description"   >
                        </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-warning" name="upd_co">Add Course Outcome</button>
                        </div>
                        </form>
                        <?php
                        if (isset($_POST['upd_co'])){
                          $sub=explode(" ",$_POST['course'])[2];
                          $sub_code=explode(" ",$_POST['course'])[3];
                          $sem=explode(" ",$_POST['course'])[6];
                          $year=explode(" ",$_POST['course'])[10];
                        $co1=$_POST['co1'];
                        $co2=$_POST['co2'];
                        $co3=$_POST['co3'];
                        $co4=$_POST['co4'];
                        $co5=$_POST['co5'];
                        $co6=$_POST['co6'];

                  $upd_query="UPDATE `co_db` 
                  set 
                  `co1` = case when '$co1' = '' then `co1` else '$co1' end,
                  `co2` = case when '$co2' = '' then `co2` else '$co2' end,
                  `co3` = case when '$co3' = '' then `co3` else '$co3' end,
                  `co4` = case when '$co4' = '' then `co4` else '$co4' end,
                  `co5` = case when '$co5' = '' then `co5` else '$co5' end,
                  `co6` = case when '$co6' = '' then `co6` else '$co6' end
                    WHERE `branch`='$branch' and `sub_name`='$sub' and `sub_code`='$sub_code' and `sem`='$sem' and  `year`='$year' ";
                        
                         $upd_result = mysqli_query($conn,$upd_query) or die("ERROR".mysqli_error($conn));
                          echo'<script>alert("Record Updated Successfully")</script>';
                        }
                        ?>
                      </div>
                    </div>
                  </div>
            </div>
      </div>
    </div>
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
</body>
</html>