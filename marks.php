
<!DOCTYPE html>  
<html>
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
$result1 = mysqli_query($conn,$query) or die("ERROR".mysqli_error($conn));

?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Marks Entry</title>
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
        <?php
      if($_SESSION['desgn']==3){
        echo '<a class="nav-link" href="# " onclick="login_error()" style="color: black;display: none">Set Curriculum</a>
        <a class="nav-link" href="#" onclick="login_error()" style="color: black;display: none">Specify PO</a>
        <a class="nav-link" href="SPEC_CO.php" style="color: black;">Specify CO</a>';
        
        }
        else{
          echo '<a class="nav-link" href="set_curr.php" style="color: black;">Set Curriculum</a>
          <a class="nav-link" href="spec_po.php" style="color: black;">Specify PO</a>
        <a class="nav-link" href="SPEC_CO.php" style="color: black;">Specify CO</a>';
        }
        ?>
          <a class="nav-link" href="CO_PO.php" style="color: black;">CO-PO Mapping</a>
          <a class="nav-link" href="marks_co.php" style="color: black;">Marks-CO Mapping</a>
          <a class="nav-link active" href="marks.php" style="color: green;font-weight: bold;">Marks Data</a>

        </nav>
      </div>
    <div class='col-10' style="padding:1%;">
      <p style="font-size:large;">Select the marks file with csv extension:<a class="btn" data-toggle="modal" data-target=".bd-example-modal-xl"><i class="fas fa-info-circle"></i></a></p> 
      <form class="needs-validation" method="post" action="" enctype="multipart/form-data" style="margin-left:0.5%" novalidate> 
        <div class="form-row" style="margin-top: 1%">
          <div class="form-group" style="margin-right: 1%">
          <select name="type" class="form-control custom-select" required>
              <option value="" disabled selected>Choose Format of Examination</option>
              <option>Unit Test-1</option>
              <option>Unit Test-2</option>
              <option>Semester</option>
            <option>Assignments</option>
            <option>Orals</option>
            <option>Termwork</option>	  
          </select>
          </div>
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
			<div class="form-group" style="margin-right: 1%">
			<div class="custom-file">
            <input type="file" class="custom-file-input" id="customFile" name="file" required>
            <label class="custom-file-label" for="customFile">Choose file</label>
			</div>
      </div>
      <div class="form-group" style="margin-right: 1%">
      <button class="btn btn-success" name="import">Import </button>
      </div>
      </div>
      </form>
      <button class="btn btn-info" data-toggle="modal"  data-target="#disp_modal">Show Data</button>

<!-- Modal -->
<div class="modal fade" id="disp_modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Display Marks Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="needs-validation" method="post" action="" novalidate>
      <div class="modal-body">
      <div class="form-row">
          <div class="form-group" style="width: 100%">
          <select name="type" class="form-control custom-select" required>
            <option value="" disabled selected>Choose Format of Examination</option>
            <option>Unit Test-1</option>
            <option>Unit Test-2</option>
            <option>Semester</option>
            <option>Assignments</option>
            <option>Orals</option>
            <option>Termwork</option>	  
          </select>
          </div>
      </div>
      <div class="form-row" >
      <div class="form-group" style="width: 100%">
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
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-info" name="show">Show Data</button>
      </div>
      </form>
    </div>
  </div>
</div>

<br>
<!-- File Import -->
<?php  
$connect = mysqli_connect($host,$user,$pass,$db);
if ($connect->connect_error) {
  die("Connection failed: " . $connect->connect_error);
}
if(isset($_POST["import"]))
{
  $sub=explode(" ",$_POST['course'])[2];
  $sub_code=explode(" ",$_POST['course'])[3];
  $sem=explode(" ",$_POST['course'])[6];
  $year=explode(" ",$_POST['course'])[10];

 if($_FILES['file']['name'])
 {
  $filename = explode(".", $_FILES['file']['name']);
  if($filename[1] == 'csv')
  {
  $handle = fopen($_FILES['file']['tmp_name'], "r");
  if($_POST['type']=='Unit Test-1')
  {
   while($data = fgetcsv($handle))
   {
    $prn = mysqli_real_escape_string($connect, $data[0]);
    $q1a = mysqli_real_escape_string($connect, $data[1]);
    $q1b = mysqli_real_escape_string($connect, $data[2]);
    $q1c = mysqli_real_escape_string($connect, $data[3]);
    $q1d = mysqli_real_escape_string($connect, $data[4]);
    $q1e = mysqli_real_escape_string($connect, $data[5]);
    $q1f = mysqli_real_escape_string($connect, $data[6]);
    $q2a = mysqli_real_escape_string($connect, $data[7]);
    $q2b = mysqli_real_escape_string($connect, $data[8]);
    $q3a = mysqli_real_escape_string($connect, $data[9]);
    $q3b = mysqli_real_escape_string($connect, $data[10]);
    $query = "INSERT INTO `ut_data`(`PRN`, `Teacher_ID`, `Subject`, `Semester`,`year`, `1a`, `1b`, `1c`, `1d`, `1e`, `1f`, `2a`, `2b`, `3a`, `3b`)
      VALUES ('$prn','$id','$sub','$sem','$year','$q1a','$q1b','$q1c','$q1d','$q1e','$q1f','$q2a','$q2b','$q3a','$q3b')";
    $check=mysqli_query($connect, $query);
    if ($check == false){
      echo "error" .$connect-> error;
    }
   }
   echo "<script>alert('Unit-Test:1 data updated successfully');</script>";
  }
  elseif($_POST['type']=='Unit Test-2')
  {
    while($data = fgetcsv($handle))
   {
    $prn = mysqli_real_escape_string($connect, $data[0]);
    $q1a = mysqli_real_escape_string($connect, $data[1]);
    $q1b = mysqli_real_escape_string($connect, $data[2]);
    $q1c = mysqli_real_escape_string($connect, $data[3]);
    $q1d = mysqli_real_escape_string($connect, $data[4]);
    $q1e = mysqli_real_escape_string($connect, $data[5]);
    $q1f = mysqli_real_escape_string($connect, $data[6]);
    $q2a = mysqli_real_escape_string($connect, $data[7]);
    $q2b = mysqli_real_escape_string($connect, $data[8]);
    $q3a = mysqli_real_escape_string($connect, $data[9]);
    $q3b = mysqli_real_escape_string($connect, $data[10]);
    $query = "INSERT INTO `ut2_data`(`PRN`, `Teacher_ID`, `Subject`, `Semester`,`year`, `1a`, `1b`, `1c`, `1d`, `1e`, `1f`, `2a`, `2b`, `3a`, `3b`)
      VALUES ('$prn','$id','$sub','$sem','$year','$q1a','$q1b','$q1c','$q1d','$q1e','$q1f','$q2a','$q2b','$q3a','$q3b')";
    $check=mysqli_query($connect, $query);
    if ($check == false){
      echo "error" .$connect-> error;
    }
   }
   echo "<script>alert('Unit-Test:2 data updated successfully');</script>";
  }
  elseif($_POST['type']=='Semester')
  {
    while($data = fgetcsv($handle))
    {
     $prn = mysqli_real_escape_string($connect, $data[0]);
     $q1a = mysqli_real_escape_string($connect, $data[1]);
     $q1b = mysqli_real_escape_string($connect, $data[2]);
     $q1c = mysqli_real_escape_string($connect, $data[3]);
     $q1d = mysqli_real_escape_string($connect, $data[4]);
     $q2a = mysqli_real_escape_string($connect, $data[5]);
     $q2b = mysqli_real_escape_string($connect, $data[6]);
     $q3a = mysqli_real_escape_string($connect, $data[7]);
     $q3b = mysqli_real_escape_string($connect, $data[8]);
     $q4a = mysqli_real_escape_string($connect, $data[9]);
     $q4b = mysqli_real_escape_string($connect, $data[10]);
     $q5a = mysqli_real_escape_string($connect, $data[11]);
     $q5b = mysqli_real_escape_string($connect, $data[12]);
     $q6a = mysqli_real_escape_string($connect, $data[13]);
     $q6b = mysqli_real_escape_string($connect, $data[14]);
     $q6c = mysqli_real_escape_string($connect, $data[15]);
     $q6d = mysqli_real_escape_string($connect, $data[16]);
     $query = "INSERT INTO `sem_data`(`PRN`, `teacher_id`, `sub`, `sub_code`,
     `sem`, `year`, `1a`, `1b`, `1c`, `1d`, `2a`, `2b`, `3a`, `3b`, `4a`, `4b`, 
     `5a`, `5b`, `6a`, `6b`, `6c`, `6d`) VALUES ('$prn','$id','$sub','$sub_code','$sem','$year','$q1a','$q1b','$q1c',
      '$q1d','$q2a','$q2b','$q3a','$q3b','$q4a','$q4b',
      '$q5a','$q5b','$q6a','$q6b','$q6c','$q6d')";
     $check=mysqli_query($connect, $query);
     if ($check == false){
       echo "||ERROR->" .$connect-> error;
     }
    }
    echo "<script>alert('Semester data updated successfully');</script>";
  }
  elseif($_POST['type']=='Assignments')
  {
    while($data = fgetcsv($handle))
   {
    $prn = mysqli_real_escape_string($connect, $data[0]);
    $ques = mysqli_real_escape_string($connect, $data[1]);
    $query = "INSERT INTO `assign_data` (`PRN`, `teacher_id`, `sub`, `sub_code`, `sem`, `year`, `ques`) VALUES 
    ('$prn','$id','$sub','$sub_code','$sem','$year','$ques')";
    $check=mysqli_query($connect, $query);
    if ($check == false){
      echo "error" .$connect-> error;
    }
   }
   echo "<script>alert('Assignments data updated successfully');</script>";
  }
  elseif($_POST['type']=='Orals')
  {
    while($data = fgetcsv($handle))
   {
    $prn = mysqli_real_escape_string($connect, $data[0]);
    $ques = mysqli_real_escape_string($connect, $data[1]);
    $query = "INSERT INTO `oral_data` (`PRN`, `teacher_id`, `sub`, `sub_code`, `sem`, `year`, `ques`) VALUES 
    ('$prn','$id','$sub','$sub_code','$sem','$year','$ques')";
    $check=mysqli_query($connect, $query);
    if ($check == false){
      echo "error" .$connect-> error;
    }
   }
   echo "<script>alert('Orals data updated successfully');</script>";
  }
  elseif($_POST['type']=='Termwork')
  {
    while($data = fgetcsv($handle))
   {
    $prn = mysqli_real_escape_string($connect, $data[0]);
    $ques = mysqli_real_escape_string($connect, $data[1]);
    $query = "INSERT INTO `tw_data` (`PRN`, `teacher_id`, `sub`, `sub_code`, `sem`, `year`, `ques`) VALUES 
    ('$prn','$id','$sub','$sub_code','$sem','$year','$ques')";    
    $check=mysqli_query($connect, $query);
    if ($check == false){
      echo "error" .$connect-> error;
    }
   }
   echo "<script>alert('Termwork data updated successfully');</script>";
  }
   fclose($handle);  
  }
 }
}
elseif (isset($_POST["show"])) {
  $sub=explode(" ",$_POST['course'])[2];
  $sub_code=explode(" ",$_POST['course'])[3];
  $sem=explode(" ",$_POST['course'])[6];
  $year=explode(" ",$_POST['course'])[10];


if($_POST['type']=='Unit Test-1')
 {
  $query = "SELECT * FROM `ut_data` WHERE `Teacher_ID`='$id' AND `Semester`='$sem' AND `Subject`= '$sub' AND `year`='$year'";
  $result = mysqli_query($connect,$query) or die("ERROR".mysqli_error($connect));

  ?>
  <div style="height:400px; overflow-y: scroll; margin-top:2%" >
  
  <table class="table" >
  <thead style="background-color:white;position: sticky; top: 0; border-top: 1px solid gray;">
    <tr>
      <th scope="col">PRN</th>
      <th scope="col">Subject</th>
      <th scope="col">Semester</th>
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
    </tr>
  </thead>
  <tbody>
    <?php
  while($rows=mysqli_fetch_array($result)){
    ?>
    <tr>
    <td><?php echo $rows['PRN']?></td>
    <td><?php echo $rows['Subject']?></td>
    <td><?php echo $rows['Semester']?></td>
    <td><?php echo $rows['1a']?></td>
    <td><?php echo $rows['1b']?></td>
    <td><?php echo $rows['1c']?></td>
    <td><?php echo $rows['1d']?></td>
    <td><?php echo $rows['1e']?></td>
    <td><?php echo $rows['1f']?></td>
    <td><?php echo $rows['2a']?></td>
    <td><?php echo $rows['2b']?></td>
    <td><?php echo $rows['3a']?></td>
    <td><?php echo $rows['3b']?></td>
    </tr>
    <?php
  	}
}
elseif($_POST['type']=='Unit Test-2')
{
  $query = "SELECT * FROM `ut2_data` WHERE `Teacher_ID`='$id' AND `Semester`='$sem' AND `Subject`= '$sub' AND `year`='$year'";
  $result = mysqli_query($connect,$query) or die("ERROR".mysqli_error($connect));

  ?>
  <div style="height:400px; overflow-y: scroll; margin-top:2%" >
  
  <table class="table" >
  <thead style="background-color:white;position: sticky; top: 0; border-top: 1px solid gray;">
    <tr>
      <th scope="col">PRN</th>
      <th scope="col">Subject</th>
      <th scope="col">Semester</th>
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
    </tr>
  </thead>
  <tbody>
    <?php
  while($rows=mysqli_fetch_array($result)){
    ?>
    <tr>
    <td><?php echo $rows['PRN']?></td>
    <td><?php echo $rows['Subject']?></td>
    <td><?php echo $rows['Semester']?></td>
    <td><?php echo $rows['1a']?></td>
    <td><?php echo $rows['1b']?></td>
    <td><?php echo $rows['1c']?></td>
    <td><?php echo $rows['1d']?></td>
    <td><?php echo $rows['1e']?></td>
    <td><?php echo $rows['1f']?></td>
    <td><?php echo $rows['2a']?></td>
    <td><?php echo $rows['2b']?></td>
    <td><?php echo $rows['3a']?></td>
    <td><?php echo $rows['3b']?></td>
    </tr>
    <?php
  	}
}
elseif($_POST['type']=='Semester'){
    $query = "SELECT * FROM `sem_data` WHERE `teacher_id`='$id' AND `sem`='$sem' AND `sub`= '$sub' AND `year`='$year'";
    $result = mysqli_query($connect,$query) or die("ERROR".mysqli_error($connect));
  
    ?>
    <div style="height:400px; overflow-y: scroll; margin-top:2%" >
    
    <table class="table" >
    <thead style="background-color:white;position: sticky; top: 0; border-top: 1px solid gray;">
      <tr>
        <th scope="col">PRN</th>
        <th scope="col">Subject</th>
        <th scope="col">Semester</th>
        <th scope="col">1a</th>
        <th scope="col">1b</th>
        <th scope="col">1c</th>
        <th scope="col">1d</th>
        <th scope="col">2a</th>
        <th scope="col">2b</th>
        <th scope="col">3a</th>
        <th scope="col">3b</th>
        <th scope="col">4a</th>
        <th scope="col">4b</th>
        <th scope="col">5a</th>
        <th scope="col">5b</th>
        <th scope="col">6a</th>
        <th scope="col">6b</th>
        <th scope="col">6c</th>
        <th scope="col">6d</th>
      </tr>
    </thead>
    <tbody>
      <?php
    while($rows=mysqli_fetch_array($result)){
      ?>
      <tr>
      <td><?php echo $rows['PRN']?></td>
      <td><?php echo $rows['sub']?></td>
      <td><?php echo $rows['sem']?></td>
      <td><?php echo $rows['1a']?></td>
      <td><?php echo $rows['1b']?></td>
      <td><?php echo $rows['1c']?></td>
      <td><?php echo $rows['1d']?></td>
      <td><?php echo $rows['2a']?></td>
      <td><?php echo $rows['2b']?></td>
      <td><?php echo $rows['3a']?></td>
      <td><?php echo $rows['3b']?></td>
      <td><?php echo $rows['4a']?></td>
      <td><?php echo $rows['4b']?></td>
      <td><?php echo $rows['5a']?></td>
      <td><?php echo $rows['5b']?></td>
      <td><?php echo $rows['6a']?></td>
      <td><?php echo $rows['6b']?></td>
      <td><?php echo $rows['6c']?></td>
      <td><?php echo $rows['6d']?></td>
      </tr>
      <?php
      }
}
elseif($_POST['type']=='Assignments'){
  $query = "SELECT * FROM `assign_data` WHERE `teacher_id`='$id' AND `sem`='$sem' AND `sub`= '$sub' AND `year`='$year'";
  $result = mysqli_query($connect,$query) or die("ERROR".mysqli_error($connect));
  ?>
  <div style="height:400px; overflow-y: scroll; margin-top:2%" >
  <table class="table" >
  <thead style="background-color:white;position: sticky; top: 0; border-top: 1px solid gray;">
    <tr>
      <th scope="col">PRN</th>
      <th scope="col">Subject</th>
      <th scope="col">Semester</th>
      <th scope="col">Assignments Marks</th>
    </tr>
  </thead>
  <tbody>
    <?php
  while($rows=mysqli_fetch_array($result)){
    ?>
    <tr>
    <td><?php echo $rows['PRN']?></td>
    <td><?php echo $rows['sub']?></td>
    <td><?php echo $rows['sem']?></td>
    <td><?php echo $rows['ques']?></td>
    </tr>
    <?php
    }
}
elseif($_POST['type']=='Orals'){
  $query = "SELECT * FROM `oral_data` WHERE `teacher_id`='$id' AND `sem`='$sem' AND `sub`= '$sub' AND `year`='$year'";
  $result = mysqli_query($connect,$query) or die("ERROR".mysqli_error($connect));
  ?>
  <div style="height:400px; overflow-y: scroll; margin-top:2%" >
  <table class="table" >
  <thead style="background-color:white;position: sticky; top: 0; border-top: 1px solid gray;">
    <tr>
      <th scope="col">PRN</th>
      <th scope="col">Subject</th>
      <th scope="col">Semester</th>
      <th scope="col">Orals Marks</th>
    </tr>
  </thead>
  <tbody>
    <?php
  while($rows=mysqli_fetch_array($result)){
    ?>
    <tr>
    <td><?php echo $rows['PRN']?></td>
    <td><?php echo $rows['sub']?></td>
    <td><?php echo $rows['sem']?></td>
    <td><?php echo $rows['ques']?></td>
    </tr>
    <?php
    }
}
elseif($_POST['type']=='Termwork'){
  $query = "SELECT * FROM `tw_data` WHERE `teacher_id`='$id' AND `sem`='$sem' AND `sub`= '$sub' AND `year`='$year'";
  $result = mysqli_query($connect,$query) or die("ERROR".mysqli_error($connect));
  ?>
  <div style="height:400px; overflow-y: scroll; margin-top:2%" >
  <table class="table" >
  <thead style="background-color:white;position: sticky; top: 0; border-top: 1px solid gray;">
    <tr>
      <th scope="col">PRN</th>
      <th scope="col">Subject</th>
      <th scope="col">Semester</th>
      <th scope="col">Termwork Marks</th>
    </tr>
  </thead>
  <tbody>
    <?php
  while($rows=mysqli_fetch_array($result)){
    ?>
    <tr>
    <td><?php echo $rows['PRN']?></td>
    <td><?php echo $rows['sub']?></td>
    <td><?php echo $rows['sem']?></td>
    <td><?php echo $rows['ques']?></td>
    </tr>
    <?php
    }
}
}
	?>
</tbody>
</table>

</div>
</div>
</div>
</div>

<!-- Sample modal -->

<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title" >Sample CSV</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <h5>Unit Test Format:</h5>
        <div class="alert alert-info" role="alert">
          <h6>Do not add the headers in the CSV file !!!</h6>
        </div>
        <table class="table table-bordered">
          <thead>
            <tr>
            <th scope="col">PRN</th>
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
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td>/2</td>
              <td>/2</td>
              <td>/2</td>
              <td>/2</td>
              <td>/2</td>
              <td>/2</td>
              <td>/5</td>
              <td>/5</td>
              <td>/5</td>
              <td>/5</td>
            </tr>
            <tr>
              <th scope="row">2</th>
              <td>/2</td>
              <td>/2</td>
              <td>/2</td>
              <td>/2</td>
              <td>/2</td>
              <td>/2</td>
              <td>/5</td>
              <td>/5</td>
              <td>/5</td>
              <td>/5</td>
            </tr>
          </tbody>
        </table>
        <hr>
        <h5>Semester Format:</h5>
        <div class="alert alert-info" role="alert">
          <h6>Do not add the headers in the CSV file !!!</h6>
        </div>        <table class="table table-bordered">
          <thead>
            <tr>
            <th scope="col">PRN</th>
            <th scope="col">1a</th>
            <th scope="col">1b</th>
            <th scope="col">1c</th>
            <th scope="col">1d</th>
            <th scope="col">2a</th>
            <th scope="col">2b</th>
            <th scope="col">3a</th>
            <th scope="col">3b</th>
            <th scope="col">4a</th>
            <th scope="col">4b</th>
            <th scope="col">5a</th>
            <th scope="col">5b</th>
            <th scope="col">6a</th>
            <th scope="col">6b</th>
            <th scope="col">6c</th>
            <th scope="col">6d</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td>/5</td>
              <td>/5</td>
              <td>/5</td>
              <td>/5</td>
              <td>/10</td>
              <td>/10</td>
              <td>/10</td>
              <td>/10</td>
              <td>/10</td>
              <td>/10</td>
              <td>/10</td>
              <td>/10</td>
              <td>/5</td>
              <td>/5</td>
              <td>/5</td>
              <td>/5</td>
            </tr>
            <tr>
              <th scope="row">2</th>
              <td>/5</td>
              <td>/5</td>
              <td>/5</td>
              <td>/5</td>
              <td>/10</td>
              <td>/10</td>
              <td>/10</td>
              <td>/10</td>
              <td>/10</td>
              <td>/10</td>
              <td>/10</td>
              <td>/10</td>
              <td>/5</td>
              <td>/5</td>
              <td>/5</td>
              <td>/5</td>
            </tr>
          </tbody>
        </table>
        <hr>
        <h5>Orals Format:</h5>
        <div class="alert alert-info" role="alert">
          <h6>Do not add the headers in the CSV file !!!</h6>
        </div>        <table class="table table-bordered">
          <thead>
            <tr>
            <th scope="col">PRN</th>
            <th scope="col">Orals Marks</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td>-</td>
            </tr>
            <tr>
              <th scope="row">2</th>
              <td>-</td>
            </tr>
          </tbody>
        </table>
        <hr>
        <h5>Assignments Format:</h5>
        <div class="alert alert-info" role="alert">
          <h6>Do not add the headers in the CSV file !!!</h6>
        </div>        <table class="table table-bordered">
          <thead>
            <tr>
            <th scope="col">PRN</th>
            <th scope="col">Assignments Marks</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td>-</td>
            </tr>
            <tr>
              <th scope="row">2</th>
              <td>-</td>
            </tr>
          </tbody>
        </table>
        <hr>
        <h5>Termwork Format:</h5>
        <div class="alert alert-info" role="alert">
          <h6>Do not add the headers in the CSV file !!!</h6>
        </div>        <table class="table table-bordered">
          <thead>
            <tr>
            <th scope="col">PRN</th>
            <th scope="col">Termwork Marks</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td>-</td>
            </tr>
            <tr>
              <th scope="row">2</th>
              <td>-</td>
            </tr>
          </tbody>
        </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
        </div>
    </div>
  </div>
</div>

</body>  
<script>
	function login_error() {
	alert("Function not available");
	}
</script>
<script>
  $('#customFile').on('change',function(){
      //get the file name
      var fileName = $(this).val();
      //replace the "Choose a file" label
      $(this).next('.custom-file-label').html(fileName);
  })
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