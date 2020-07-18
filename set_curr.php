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
  $branch_hod=$_SESSION['branch'];
  $query="SELECT COUNT(*) FROM $branch_hod WHERE 1";
  $teacher_query="SELECT * FROM `teacher_acc_db` WHERE branch='$branch_hod'";
  $teacher_result=mysqli_query($conn,$teacher_query) or die("ERROR".mysqli_error($conn));
  $teacher_result1=mysqli_query($conn,$teacher_query) or die("ERROR".mysqli_error($conn));
  $result = mysqli_query($conn,$query) or die("ERROR".mysqli_error($conn));
  $result1 = mysqli_query($conn,$query) or die("ERROR".mysqli_error($conn));
  $row = mysqli_fetch_array($result);
  $row1 = mysqli_fetch_array($result1);

?>
<?php
  if(isset($_POST['add_alloc'])){
  $t_id_orig=$_POST['t_id'];
  $t_id=explode(" ",$t_id_orig)[3];
  $sub=$_POST['sub'];
  $year=$_POST['year'];
  $sub_code=$_POST['sub_code'];
  $sem=$_POST['sem'];
  $sub_query1="SELECT * FROM `teacher_acc_db` WHERE id='$t_id'";
  $sub_result1 = mysqli_query($conn,$sub_query1) or die("ERROR".mysqli_error($conn));
  $sub_row = mysqli_fetch_array($sub_result1);
  $fname = $sub_row['f_name'];
  $sname = $sub_row['s_name'];
  $sub_query2= "INSERT INTO $branch_hod
  (`Teacher-fname`, `Teacher-sname`, `sub_name`, `teacher_id`, `year`, `semester`, `subject-code`) VALUES 
  ('$fname','$sname','$sub','$t_id','$year','$sem','$sub_code')";
  $sub_result2 = mysqli_query($conn,$sub_query2) or die("ERROR".mysqli_error($conn));
  $sub_query3="INSERT INTO `dash_data`(`t_id`,`f_name`,`s_name`,`sub`, `sem`, `year`, `branch`, `co_spec`, `po_spec`, `co_po_map`, `marks_map`) 
                    VALUES ('$t_id','$fname','$sname','$sub','$sem','$year','$branch_hod',0,0,0,0)";
  $sub_result3 = mysqli_query($conn,$sub_query3) or die("ERROR".mysqli_error($conn));
  echo '<script>alert("Allocation Successful")</script>';
  }
?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Set Curriculum</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/3857a76116.js" crossorigin="anonymous"></script>

    <style>
      .fa-edit
      {
        color: rgb(11,97,255)
      }
      .fa-window-close
      {
        color: red;
      }
      
    </style>
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
          <a class="nav-link" href="set_curr.php" style="color: green; font-weight: bold;">Set Curriculum</a>
          <a class="nav-link" href="spec_po.php" style="color: black;">Specify PO</a>
          <a class="nav-link active" href="SPEC_CO.php" style="color: black;">Specify CO </a>
          <a class="nav-link" href="CO_PO.php" style="color: black;">CO-PO Mapping</a>
          <a class="nav-link" href="marks_co.php" style="color: black;">Marks-CO Mapping</a>
          <a class="nav-link" href="marks.php" style="color: black;">Marks Data</a>
        </nav>
        </div>
        <div class='col-10'>
          <div class="container-fluid">
              <div class="row">
                <div style="margin-top: 1%;">
                  <?php
                  if($row['COUNT(*)'] == 0){
                    echo '<div class="alert alert-danger" role="alert">
                    No data of allocation found in the Database !!!!
                    </div>';}
                    else{
                      echo '<p style="font-weight:bold;font-size: large;">Allocation Details:</p>';
                    }
                    ?>
                  </div>
              </div>
              <?php
              if ($row['COUNT(*)'] !=0 ){?>
                  <div class="row" style="height:60vh; overflow-y: scroll">
                  <table class="table table-striped">
                  <thead style="background-color:white;position: sticky; top: 0;">
                  <tr>
                    <th scope="col">Sr NO</th>
                    <th scope="col">Subject</th>
                    <th scope="col">Teacher</th>
                    <th scope="col">Semester</th>
                    <th scope="col">Year</th>
                  </tr>
                  </thead>
                  <?php  
                  $q_disp="SELECT * FROM $branch_hod WHERE 1";
                  $result_display = mysqli_query($conn,$q_disp) or die("ERROR".mysqli_error($conn));
                  $no=1;
                  while ( $row_display = mysqli_fetch_array($result_display) )
                    {
                    ?>
                    <tr>
                    <td><?echo $no; ?></td>
                    <td><?echo $row_display['sub_name']; ?></td>
                    <td><?echo $row_display['Teacher-fname'].' '.$row_display['Teacher-sname']; ?></td>
                    <td><?echo $row_display['semester']; ?></td>
                    <td><?echo $row_display['year']; ?></td>
                  </tr>
                  <?php
                  $no = $no +1;
                  }}?>
                    </table>
                  </div>
              
              <div class="row" style="margin-top:3%">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_allo" style="margin-right: 2%">Add Allocation</button>
              <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#update_allo">Edit Allocation Details</button>
              </div>
          </div>
        </div>
        </div>
     </div>

<div class="modal fade" id="add_allo" tabindex="-1">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Add Allocation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="needs-validation" method="post" action="" novalidate >
        <div class="modal-body">
        <div class="form-row">
          <div class="form-group col-md-6">
          <label >Teacher</label>
          <select name="t_id" class="form-control custom-select" required>
                    <option value="" disabled selected>Assign Teacher</option>
                <?php
                        while($row = mysqli_fetch_array($teacher_result)){
                      ?>
                        <option><?echo $row['f_name']." ".$row['s_name']." : ".$row['id']; ?></option>
                <?}?>
                </select>
          </div>
          <div class="form-group col-md-6">
            <label >Subject</label>
            <input type="text" class="form-control" name="sub" placeholder="Subject" required>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-4">
            <label>Subject Code</label>
            <input type="text" class="form-control" name="sub_code" placeholder="Subject Code" required>
          </div>
          <div class="form-group col-md-4">
            <label>Year</label>
            <select name="year" class="form-control custom-select" required>
              <option value="" disabled selected>Choose Year</option>
              <option>2015-16</option>
              <option>2016-17</option>
              <option>2017-18</option>
              <option>2018-19</option>
              <option>2019-20</option>
              <option>2020-21</option>
              <option>2021-22</option>
              <option>2022-23</option>
              <option>2023-24</option>
              <option>2024-25</option>
              <option>2025-26</option>

            </select>
          </div>
          <div class="form-group col-md-4">
            <label>Semester</label>
            <select name="sem" class="form-control custom-select" required>
              <option value="" disabled selected>Choose Semester</option>
              <option>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
              <option>6</option>
              <option>7</option>
              <option>8</option>
            </select>
          </div>
        </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" name="add_alloc" class="btn btn-success">Add Allocation</button>
            </div>
       </form>
    </div>
  </div>
</div>

<div class="modal fade" id="update_allo" tabindex="-1">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Edit Allocation Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="needs-validation" method="post" action="" novalidate >
        <div class="modal-body">
        <div class="form-row">
          <div class="form-group col-md-12">
          <label >Allocation</label>
            <select name="upd_course" class="form-control custom-select" required>
                      <option value="" disabled selected>Select Allocation</option>
                  <?php
                          $q_disp1="SELECT * FROM $branch_hod WHERE 1";
                          $result1 = mysqli_query($conn,$q_disp1) or die("ERROR".mysqli_error($conn));
                          while($row2 = mysqli_fetch_array($result1)){
                        ?>
                          <option><?echo $row2['teacher_id']." || ".$row2['sub_name']." - ".$row2['semester']." : ".$row2['year']; ?></option>
                  <?}?>
            </select>
          </div>
        </div>
        <hr>
        <div class="form-row">
          <div class="form-group col-md-6">
          <label >Teacher</label>
          <select name="t_id" class="form-control custom-select" required>
                    <option value="" disabled selected>Assign Teacher</option>
                <?php
                        while($row = mysqli_fetch_array($teacher_result1)){
                      ?>
                        <option><?echo $row['f_name']." ".$row['s_name']." : ".$row['id']; ?></option>
                <?}?>
                </select>
          </div>
          <div class="form-group col-md-6">
            <label >Subject</label>
            <input type="text" class="form-control" name="sub" placeholder="Subject" required>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-4">
            <label>Subject Code</label>
            <input type="text" class="form-control" name="sub_code" placeholder="Subject Code" required>
          </div>
          <div class="form-group col-md-4">
            <label>Year</label>
            <select name="year" class="form-control custom-select" required>
              <option value="" disabled selected>Choose Year</option>
              <option>2015-16</option>
              <option>2016-17</option>
              <option>2017-18</option>
              <option>2018-19</option>
              <option>2019-20</option>
              <option>2020-21</option>
              <option>2021-22</option>
              <option>2022-23</option>
              <option>2023-24</option>
              <option>2024-25</option>
              <option>2025-26</option>

            </select>
          </div>
          <div class="form-group col-md-4">
            <label>Semester</label>
            <select name="sem" class="form-control custom-select" required>
              <option value="" disabled selected>Choose Semester</option>
              <option>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
              <option>6</option>
              <option>7</option>
              <option>8</option>
            </select>
          </div>
        </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" name="update_alloc" class="btn btn-warning">Update Changes</button>
            </div>
       </form>
    </div>
  </div>
</div>
<?php
  if(isset($_POST['update_alloc']))
  {
    $del_id=explode(" ",$_POST['upd_course'])[0];
    $del_sub=explode(" ",$_POST['upd_course'])[2];
    $del_sem=explode(" ",$_POST['upd_course'])[4];
    $del_year=explode(" ",$_POST['upd_course'])[6];

    $f_name=explode(" ",$_POST['t_id'])[0];
    $s_name=explode(" ",$_POST['t_id'])[1];
    $t_id=explode(" ",$_POST['t_id'])[3];
    $sub=$_POST['sub'];
    $sub_code=$_POST['sub_code'];
    $year=$_POST['year'];
    $sem=$_POST['sem'];

    $upd_query="UPDATE $branch_hod SET `Teacher-fname`='$f_name',`Teacher-sname`='$s_name',
                `sub_name`='$sub',`teacher_id`='$t_id',`year`='$year',`semester`='$sem',`subject-code`='$sub_code'
                WHERE sub_name='$del_sub' AND teacher_id='$del_id' AND semester='$del_sem' AND year='$del_year'";
    
    $upd_result = mysqli_query($conn,$upd_query) or die("ERROR".mysqli_error($conn));
    echo "<script>Allocation Details Updated Successfully</script>";
  }
?>
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