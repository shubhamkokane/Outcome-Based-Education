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
if(isset($_POST['can_cred'])){
  header("Location:index.php");            
  session_destroy();
  } 
?>

<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CO Attainment Table</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/3857a76116.js" crossorigin="anonymous"></script>
    <script src="https://www.chartjs.org/dist/2.9.3/Chart.min.js"></script>
    <script src="https://www.chartjs.org/samples/latest/utils.js"></script>
    
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light" style="padding: 1%">
  <a class="navbar-brand" href="index.php">OBE Tool</a>
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
      <li class="nav-item">
        
        <?php
                    if ($_SESSION['desgn']==3){
                    echo '<a href="SPEC_CO.php" class="nav-link">Curriculum</a> ';
                    }
                    elseif($_SESSION['desgn']==1 or $_SESSION['desgn']==2 ){
                      echo'<a href="set_curr.php" class="nav-link">Curriculum</a> ';
                    }
                    
                    ?>    
        </li>
      <li class="nav-item active">
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
    echo '<form method="post"><button type="submit" class="btn btn-danger" name="can_cred">LOGOUT</button></form>';
    }
    ?>
  </div>
</nav>
<div class="container-fluid">
<div class="row" style="padding: 1%;">
  <div class='col-2'>
    <nav class="nav flex-column" style="margin: 1%;">
    <a class="nav-link" href="report.php" style="color: black;">Subject Analysis</a>
    <a class="nav-link active" href="#" style="color:green;font-weight: bold;">CO Attainment Table</a>
    <a class="nav-link" href="po_report.php" style="color: black;">PO Attainment Table</a>
    </nav>
  </div>
  <div class='col-10' style="padding-top:1%;" >
    <form class="needs-validation" method="post" action="" enctype="multipart/form-data" style="margin-left: 2.5%" novalidate> 
    <p style="font-size:large;">Please enter the details for Couse Outcome Attainment Table:</p>
      <div class="form-row" style="margin-top: 2%">
        <div class="form-group col-md-3">
        <select name="course" class="form-control custom-select" required>
                          <option value="" disabled selected>Choose Course</option>
                          <?php
                            while($row2 = mysqli_fetch_array($result)){
                          ?>
                          <option><?echo "Subject : ".$row2['sub_name']." ".$row2['subject-code']." Semester : ".$row2['semester']." || Year : ".$row2['year']; ?></option>
                            <?}?>
                        </select>
        </div>
        <div class="form-group col-md-3">
        <select name="format" class="form-control custom-select" required>
                          <option value="" disabled selected>Choose Exam Format</option>
                          <option>All</option>
                          <option>Unit Test-1</option>
                          <option>Unit Test-2</option>
                          <option>Unit Test-1&2</option>
                        </select>
        </div>
        <div class="form-group col-md-3">
          <input type="number" class="form-control" name="thresh_per" placeholder="Threshold % Marks" required>
        </div>
        <div class="form-group col-md-3">
          <input type="number" class="form-control" name="int" placeholder="% Weightage for Internal" value=" ">
        </div>
        </div>
        <div class="form-row">
        <div class="form-group col-md-3">
          <input type="number" class="form-control" name="r1" placeholder="Threshold-1 in %(lower)" required>
        </div>
        <div class="form-group col-md-3">
          <input type="number" class="form-control" name="r2" placeholder="Threshold-2 in %" required>
        </div>
        <div class="form-group col-md-3">
          <input type="number" class="form-control" name="r3" placeholder="Threshold-3 in %" required>
        </div>
        <div class="form-group col-md-3" >
        <button class="btn btn-success" name="import" style="width:100%">Show Analysis</button>
        </div>
        </div>
    </form>
  </div>
</div> 
<?php
if(isset($_POST["import"])){
  $internal=$_POST['int'];
  if(empty($internal)) {$internal=0.3;$external=0.7;  }
  else {$internal=$internal/100;$external=1-$internal;  }
  #echo $external.$internal;
  $range1=(int)$_POST['r1'];
  $range2=(int)$_POST['r2'];
  $range3=(int)$_POST['r3'];
  $th_per=(int)$_POST['thresh_per'];
  $selection=$_POST['format'];
  $sem_data=array();
  $oral_data=array();
  $tw_data=array();
  $student_no_data=array();
  $per_student_no=array();
  $att_level=array();
  $mark_co=array();
  ###############
  $co1=array();
  $co2=array();
  $co3=array();
  $co4=array();
  $co5=array();
  $co6=array();
  ###############
  $data_1a=0;
  $data_1b=0;
  $data_1c=0;
  $data_1d=0;
  $data_1e=0;
  $data_1f=0;
  $data_2a=0;
  $data_2b=0;
  $data_3a=0;
  $data_3b=0;
  ###############
  $sub=explode(" ",$_POST['course'])[2];
  $sub_code=explode(" ",$_POST['course'])[3];
  $sem=explode(" ",$_POST['course'])[6];
  $year=explode(" ",$_POST['course'])[10];
  $sem_count=0;
  $oral_count=0;
  $tw_count=0;
  $student_count=0;

  if($selection=="All")
  {
    $sem_query="SELECT * FROM `sem_data` WHERE  `teacher_id`='$id' AND `sem`='$sem' AND `sub`= '$sub' AND `year`='$year'";
    $sem_result = mysqli_query($conn,$sem_query) or die("ERROR".mysqli_error($conn));
    while($row = mysqli_fetch_array($sem_result)){
      $sum = 0;
      $sum=(int)$row['1a']+(int)$row['1b']+(int)$row['1c']+(int)$row['1d']+
            (int)$row['2a']+(int)$row['2b']+(int)$row['3a']+(int)$row['3b']+
            (int)$row['4a']+(int)$row['4b']+(int)$row['5a']+(int)$row['5b']+
            (int)$row['6a']+(int)$row['6b']+(int)$row['6c']+(int)$row['6d'];
      array_push($sem_data,$sum);
      if($sum>=$th_per*80/100){
        $sem_count=$sem_count+1;
      }
      $student_count=$student_count+1;
    }
    #print_r($sem_data);
    $oral_query="SELECT * FROM `oral_data` WHERE  `teacher_id`='$id' AND `sem`='$sem' AND `sub`= '$sub' AND `year`='$year'";
    $oral_result = mysqli_query($conn,$oral_query) or die("ERROR".mysqli_error($conn));
    while($row = mysqli_fetch_array($oral_result)){
      array_push($oral_data,$row['ques']);
      if((int)$row['ques']>=$th_per*25/100){
        $oral_count=$oral_count+1;
      }
    }
    #print_r($oral_data);
    $tw_query="SELECT * FROM `tw_data` WHERE  `teacher_id`='$id' AND `sem`='$sem' AND `sub`= '$sub' AND `year`='$year'";
    $tw_result = mysqli_query($conn,$tw_query) or die("ERROR".mysqli_error($conn));
    while($row = mysqli_fetch_array($tw_result)){
      array_push($tw_data,$row['ques']);
      if((int)$row['ques']>=$th_per*25/100){
        $tw_count=$tw_count+1;
      }
    }
    #print_r($tw_data);
    if($sem_count>$range3*$student_count/100){$sem_att=3;}
    else if($sem_count<=$range3*$student_count/100 and $sem_count>$range2*$student_count/100){$sem_att=2;}
    else if($sem_count<=$range2*$student_count/100 and $sem_count>$range1*$student_count/100){$sem_att=1;}

    if($tw_count>$range3*$student_count/100){$tw_att=3;}
    else if($tw_count<=$range3*$student_count/100 and $tw_count>$range2*$student_count/100){$tw_att=2;}
    else if($tw_count<=$range2*$student_count/100 and $tw_count>$range1*$student_count/100){$tw_att=1;}

    if($oral_count>$range3*$student_count/100){$oral_att=3;}
    else if($oral_count<=$range3*$student_count/100 and $oral_count>$range2*$student_count/100){$oral_att=2;}
    else if($oral_count<=$range2*$student_count/100 and $oral_count>$range1*$student_count/100){$oral_att=1;}

    #echo $oral_att.$sem_att.$tw_att;
    $ut_query="SELECT * FROM `ut_data` WHERE  `Teacher_ID`='$id' AND `Semester`='$sem' AND `Subject`= '$sub' AND `year`='$year'";
    $ut_result = mysqli_query($conn,$ut_query) or die("ERROR".mysqli_error($conn));
    while($row = mysqli_fetch_array($ut_result)){
      if((int)$row['1a']>2*$th_per/100){         $data_1a=$data_1a+1;      }
      if((int)$row['1b']>2*$th_per/100){         $data_1b=$data_1b+1;      }
      if((int)$row['1c']>2*$th_per/100){         $data_1c=$data_1c+1;      }
      if((int)$row['1d']>2*$th_per/100){         $data_1d=$data_1d+1;      }
      if((int)$row['1e']>2*$th_per/100){         $data_1e=$data_1e+1;      }
      if((int)$row['1f']>2*$th_per/100){         $data_1f=$data_1f+1;      }
      if((int)$row['2a']>5*$th_per/100){         $data_2a=$data_2a+1;      }
      if((int)$row['2b']>5*$th_per/100){         $data_2b=$data_2b+1;      }
      if((int)$row['3a']>5*$th_per/100){         $data_3a=$data_3a+1;      }
      if((int)$row['3b']>5*$th_per/100){         $data_3b=$data_3b+1;      }
    }
    array_push($student_no_data,$data_1a,$data_1b,$data_1c,$data_1d,$data_1e,
              $data_1f,$data_2a,$data_2b,$data_3a,$data_3b);
    #print_r($student_no_data);

    foreach ($student_no_data as $value) {array_push($per_student_no,(int)$value*100/$student_count); }  
    #print_r($per_student_no);
    foreach ($per_student_no as $value){
    if($value>$range3){ array_push($att_level,3);}
    else if($value>$range2 and $value<=$range3){array_push($att_level,2);}
    else if($value>$range1 and $value<=$range2){array_push($att_level,1);}
    else {array_push($att_level,0);}
    }
    #print_r($att_level);
    $co_query="SELECT * FROM `ut_co_marks` WHERE `teacher_id`='$id' AND `sem`='$sem' AND `sub`= '$sub' AND `year`='$year'";
    $co_result = mysqli_query($conn,$co_query) or die("ERROR".mysqli_error($conn));
    $co_row = mysqli_fetch_array($co_result);
    array_push($mark_co,$co_row['1a'],$co_row['1b'],$co_row['1c'],$co_row['1d'],$co_row['1e'],
                        $co_row['1f'],$co_row['2a'],$co_row['2b'],$co_row['3a'],$co_row['3b']);
    #print_r($mark_co);
    $index=0;
    foreach($mark_co as $map){
      if($map==1){
        array_push($co1,$att_level[$index]);
      }
      else if($map==2){
        array_push($co2,$att_level[$index]);
      }
      else if($map==3){
        array_push($co3,$att_level[$index]);
      }
      else if($map==4){
        array_push($co4,$att_level[$index]);
      }
      else if($map==5){
        array_push($co5,$att_level[$index]);
      }
      else if($map==6){
        array_push($co6,$att_level[$index]);
      }
      $index=$index+1;
    }
    if(count($co1)!=0){$var1=array_sum($co1)/count($co1);}else{$var1=0;}
    if(count($co2)!=0){$var2=array_sum($co2)/count($co2);}else{$var2=0;}
    if(count($co3)!=0){$var3=array_sum($co3)/count($co3);}else{$var3=0;}
    if(count($co4)!=0){$var4=array_sum($co4)/count($co4);}else{$var4=0;}
    if(count($co5)!=0){$var5=array_sum($co5)/count($co5);}else{$var5=0;}
    if(count($co6)!=0){$var6=array_sum($co6)/count($co6);}else{$var6=0;}

    $ext_var1=($internal*((float)$var1+(float)$tw_att)/2)+($external*((float)$sem_att+(float)$oral_att)/2);
    $ext_var2=($internal*((float)$var2+(float)$tw_att)/2)+($external*((float)$sem_att+(float)$oral_att)/2);
    $ext_var3=($internal*((float)$var3+(float)$tw_att)/2)+($external*((float)$sem_att+(float)$oral_att)/2);
    $ext_var4=($internal*((float)$var4+(float)$tw_att)/2)+($external*((float)$sem_att+(float)$oral_att)/2);
    $ext_var5=($internal*((float)$var5+(float)$tw_att)/2)+($external*((float)$sem_att+(float)$oral_att)/2);
    $ext_var6=($internal*((float)$var6+(float)$tw_att)/2)+($external*((float)$sem_att+(float)$oral_att)/2);
    $int_array=array($var1,$var2,$var3,$var4,$var5,$var6);
    $ext_array=array($ext_var1,$ext_var2,$ext_var3,$ext_var4,$ext_var5,$ext_var6);
    echo "<script> window.onload = function() {graph()} </script>";  ?>
    <div class="row" style="margin-left: 1%; margin-right:1%">
      <div class="col-6">
      <table class="table table-striped" style="margin-top: 5%">
        <thead>
          <tr>
            <th scope="col">CO Code</th>
            <th scope="col">Internal</th>
            <th scope="col">External</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">CO1</th>
            <td><?echo round($var1,2);?></td>
            <td><?echo round($ext_var1,2);?></td>
          </tr>
          <tr>
            <th scope="row">CO2</th>
            <td><?echo round($var2,2);?></td>
            <td><?echo round($ext_var2,2);?></td>
          </tr>
          <tr>
            <th scope="row">CO3</th>
            <td><?echo round($var3,2);?></td>
            <td><?echo round($ext_var3,2);?></td>
          </tr>
          <tr>
            <th scope="row">CO4</th>
            <td><?echo round($var4,2);?></td>
            <td><?echo round($ext_var4,2);?></td>
          </tr>
          <tr>
            <th scope="row">CO5</th>
            <td><?echo round($var5,2);?></td>
            <td><?echo round($ext_var5,2);?></td>
          </tr>
          <tr>
            <th scope="row">CO6</th>
            <td><?echo round($var6,2);?></td>
            <td><?echo round($ext_var6,2);?></td>
          </tr>
        </tbody>
      </table>
      </div>
      <div class="col-6">
        <canvas id="Chart1" width="100%" height="60vh" style="margin-right: 3%"></canvas>
      </div>
    </div>  

    <? 
  }
  elseif($selection=="Unit Test-1")
  {
    $ut_query="SELECT * FROM `ut_data` WHERE  `Teacher_ID`='$id' AND `Semester`='$sem' AND `Subject`= '$sub' AND `year`='$year'";
    $ut_result = mysqli_query($conn,$ut_query) or die("ERROR".mysqli_error($conn));
    while($row = mysqli_fetch_array($ut_result)){
      if((int)$row['1a']>2*$th_per/100){         $data_1a=$data_1a+1;      }
      if((int)$row['1b']>2*$th_per/100){         $data_1b=$data_1b+1;      }
      if((int)$row['1c']>2*$th_per/100){         $data_1c=$data_1c+1;      }
      if((int)$row['1d']>2*$th_per/100){         $data_1d=$data_1d+1;      }
      if((int)$row['1e']>2*$th_per/100){         $data_1e=$data_1e+1;      }
      if((int)$row['1f']>2*$th_per/100){         $data_1f=$data_1f+1;      }
      if((int)$row['2a']>5*$th_per/100){         $data_2a=$data_2a+1;      }
      if((int)$row['2b']>5*$th_per/100){         $data_2b=$data_2b+1;      }
      if((int)$row['3a']>5*$th_per/100){         $data_3a=$data_3a+1;      }
      if((int)$row['3b']>5*$th_per/100){         $data_3b=$data_3b+1;      }
      $student_count=$student_count+1;
    }
    array_push($student_no_data,$data_1a,$data_1b,$data_1c,$data_1d,$data_1e,
              $data_1f,$data_2a,$data_2b,$data_3a,$data_3b);
    #print_r($student_no_data);

    foreach ($student_no_data as $value) {array_push($per_student_no,(int)$value*100/$student_count); }  
    #print_r($per_student_no);
    foreach ($per_student_no as $value){
    if($value>$range3){ array_push($att_level,3);}
    else if($value>$range2 and $value<=$range3){array_push($att_level,2);}
    else if($value>$range1 and $value<=$range2){array_push($att_level,1);}
    else {array_push($att_level,0);}
    }
    $co_query="SELECT * FROM `ut_co_marks` WHERE `teacher_id`='$id' AND `sem`='$sem' AND `sub`= '$sub' AND `year`='$year'";
    $co_result = mysqli_query($conn,$co_query) or die("ERROR".mysqli_error($conn));
    $co_row = mysqli_fetch_array($co_result);
    array_push($mark_co,$co_row['1a'],$co_row['1b'],$co_row['1c'],$co_row['1d'],$co_row['1e'],
                        $co_row['1f'],$co_row['2a'],$co_row['2b'],$co_row['3a'],$co_row['3b']);
    #print_r($mark_co);
    $index=0;
    foreach($mark_co as $map){
      if($map==1){
        array_push($co1,$att_level[$index]);
      }
      else if($map==2){
        array_push($co2,$att_level[$index]);
      }
      else if($map==3){
        array_push($co3,$att_level[$index]);
      }
      else if($map==4){
        array_push($co4,$att_level[$index]);
      }
      else if($map==5){
        array_push($co5,$att_level[$index]);
      }
      else if($map==6){
        array_push($co6,$att_level[$index]);
      }
      $index=$index+1;
    }
    if(count($co1)!=0){$var1=array_sum($co1)/count($co1);}else{$var1=0;}
    if(count($co2)!=0){$var2=array_sum($co2)/count($co2);}else{$var2=0;}
    if(count($co3)!=0){$var3=array_sum($co3)/count($co3);}else{$var3=0;}
    if(count($co4)!=0){$var4=array_sum($co4)/count($co4);}else{$var4=0;}
    if(count($co5)!=0){$var5=array_sum($co5)/count($co5);}else{$var5=0;}
    if(count($co6)!=0){$var6=array_sum($co6)/count($co6);}else{$var6=0;}
    $int_array=array($var1,$var2,$var3,$var4,$var5,$var6);
    
    ?>
    <div class="row" style="margin-left: 1%; margin-right:1%">
      <div class="col-6">
      <table class="table table-striped" style="margin-top: 5%">
        <thead>
          <tr>
            <th scope="col">CO Code</th>
            <th scope="col">Internal || Unit Test-1 </th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">CO1</th>
            <td><?echo round($var1,2);?></td>
          </tr>
          <tr>
            <th scope="row">CO2</th>
            <td><?echo round($var2,2);?></td>
          </tr>
          <tr>
            <th scope="row">CO3</th>
            <td><?echo round($var3,2);?></td>
          </tr>
          <tr>
            <th scope="row">CO4</th>
            <td><?echo round($var4,2);?></td>
          </tr>
          <tr>
            <th scope="row">CO5</th>
            <td><?echo round($var5,2);?></td>
          </tr>
          <tr>
            <th scope="row">CO6</th>
            <td><?echo round($var6,2);?></td>
          </tr>
        </tbody>
      </table>
      </div>
      <div class="col-6">
        <canvas id="Chart2" width="100%" height="60vh" style="margin-right: 3%"></canvas>
      </div>
    </div> 
    <?php
    echo "<script> window.onload = function() {graph2()} </script>";  
  }
  elseif($selection=="Unit Test-2")
  {
    $ut_query="SELECT * FROM `ut2_data` WHERE  `Teacher_ID`='$id' AND `Semester`='$sem' AND `Subject`= '$sub' AND `year`='$year'";
    $ut_result = mysqli_query($conn,$ut_query) or die("ERROR".mysqli_error($conn));
    while($row = mysqli_fetch_array($ut_result)){
      if((int)$row['1a']>2*$th_per/100){         $data_1a=$data_1a+1;      }
      if((int)$row['1b']>2*$th_per/100){         $data_1b=$data_1b+1;      }
      if((int)$row['1c']>2*$th_per/100){         $data_1c=$data_1c+1;      }
      if((int)$row['1d']>2*$th_per/100){         $data_1d=$data_1d+1;      }
      if((int)$row['1e']>2*$th_per/100){         $data_1e=$data_1e+1;      }
      if((int)$row['1f']>2*$th_per/100){         $data_1f=$data_1f+1;      }
      if((int)$row['2a']>5*$th_per/100){         $data_2a=$data_2a+1;      }
      if((int)$row['2b']>5*$th_per/100){         $data_2b=$data_2b+1;      }
      if((int)$row['3a']>5*$th_per/100){         $data_3a=$data_3a+1;      }
      if((int)$row['3b']>5*$th_per/100){         $data_3b=$data_3b+1;      }
      $student_count=$student_count+1;
    }
    array_push($student_no_data,$data_1a,$data_1b,$data_1c,$data_1d,$data_1e,
              $data_1f,$data_2a,$data_2b,$data_3a,$data_3b);
    #print_r($student_no_data);

    foreach ($student_no_data as $value) {array_push($per_student_no,(int)$value*100/$student_count); }  
    #print_r($per_student_no);
    foreach ($per_student_no as $value){
    if($value>$range3){ array_push($att_level,3);}
    else if($value>$range2 and $value<=$range3){array_push($att_level,2);}
    else if($value>$range1 and $value<=$range2){array_push($att_level,1);}
    else {array_push($att_level,0);}
    }
    $co_query="SELECT * FROM `ut2_co_marks` WHERE `teacher_id`='$id' AND `sem`='$sem' AND `sub`= '$sub' AND `year`='$year'";
    $co_result = mysqli_query($conn,$co_query) or die("ERROR".mysqli_error($conn));
    $co_row = mysqli_fetch_array($co_result);
    array_push($mark_co,$co_row['1a'],$co_row['1b'],$co_row['1c'],$co_row['1d'],$co_row['1e'],
                        $co_row['1f'],$co_row['2a'],$co_row['2b'],$co_row['3a'],$co_row['3b']);
    #print_r($mark_co);
    $index=0;
    foreach($mark_co as $map){
      if($map==1){
        array_push($co1,$att_level[$index]);
      }
      else if($map==2){
        array_push($co2,$att_level[$index]);
      }
      else if($map==3){
        array_push($co3,$att_level[$index]);
      }
      else if($map==4){
        array_push($co4,$att_level[$index]);
      }
      else if($map==5){
        array_push($co5,$att_level[$index]);
      }
      else if($map==6){
        array_push($co6,$att_level[$index]);
      }
      $index=$index+1;
    }
    if(count($co1)!=0){$var1=array_sum($co1)/count($co1);}else{$var1=0;}
    if(count($co2)!=0){$var2=array_sum($co2)/count($co2);}else{$var2=0;}
    if(count($co3)!=0){$var3=array_sum($co3)/count($co3);}else{$var3=0;}
    if(count($co4)!=0){$var4=array_sum($co4)/count($co4);}else{$var4=0;}
    if(count($co5)!=0){$var5=array_sum($co5)/count($co5);}else{$var5=0;}
    if(count($co6)!=0){$var6=array_sum($co6)/count($co6);}else{$var6=0;}
    $int_array=array($var1,$var2,$var3,$var4,$var5,$var6);
    echo array_sum($co1);
    ?>
    <div class="row" style="margin-left: 1%; margin-right:1%">
      <div class="col-6">
      <table class="table table-striped" style="margin-top: 5%">
        <thead>
          <tr>
            <th scope="col">CO Code</th>
            <th scope="col">Internal || Unit Test-2 </th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">CO1</th>
            <td><?echo round($var1,2);?></td>
          </tr>
          <tr>
            <th scope="row">CO2</th>
            <td><?echo round($var2,2);?></td>
          </tr>
          <tr>
            <th scope="row">CO3</th>
            <td><?echo round($var3,2);?></td>
          </tr>
          <tr>
            <th scope="row">CO4</th>
            <td><?echo round($var4,2);?></td>
          </tr>
          <tr>
            <th scope="row">CO5</th>
            <td><?echo round($var5,2);?></td>
          </tr>
          <tr>
            <th scope="row">CO6</th>
            <td><?echo round($var6,2);?></td>
          </tr>
        </tbody>
      </table>
      </div>
      <div class="col-6">
        <canvas id="Chart2" width="100%" height="60vh" style="margin-right: 3%"></canvas>
      </div>
    </div> 
    <?php
    echo "<script> window.onload = function() {graph2()} </script>"; 
  }
  elseif($selection=="Unit Test-1&2")
  {
    $ut_query="SELECT * FROM `ut_data` WHERE  `Teacher_ID`='$id' AND `Semester`='$sem' AND `Subject`= '$sub' AND `year`='$year'";
    $ut_result = mysqli_query($conn,$ut_query) or die("ERROR".mysqli_error($conn));
    while($row = mysqli_fetch_array($ut_result)){
      if((int)$row['1a']>2*$th_per/100){         $data_1a=$data_1a+1;      }
      if((int)$row['1b']>2*$th_per/100){         $data_1b=$data_1b+1;      }
      if((int)$row['1c']>2*$th_per/100){         $data_1c=$data_1c+1;      }
      if((int)$row['1d']>2*$th_per/100){         $data_1d=$data_1d+1;      }
      if((int)$row['1e']>2*$th_per/100){         $data_1e=$data_1e+1;      }
      if((int)$row['1f']>2*$th_per/100){         $data_1f=$data_1f+1;      }
      if((int)$row['2a']>5*$th_per/100){         $data_2a=$data_2a+1;      }
      if((int)$row['2b']>5*$th_per/100){         $data_2b=$data_2b+1;      }
      if((int)$row['3a']>5*$th_per/100){         $data_3a=$data_3a+1;      }
      if((int)$row['3b']>5*$th_per/100){         $data_3b=$data_3b+1;      }
      $student_count=$student_count+1;
    }
    array_push($student_no_data,$data_1a,$data_1b,$data_1c,$data_1d,$data_1e,
              $data_1f,$data_2a,$data_2b,$data_3a,$data_3b);
    #print_r($student_no_data);

    foreach ($student_no_data as $value) {array_push($per_student_no,(int)$value*100/$student_count); }  
    #print_r($per_student_no);
    foreach ($per_student_no as $value){
    if($value>$range3){ array_push($att_level,3);}
    else if($value>$range2 and $value<=$range3){array_push($att_level,2);}
    else if($value>$range1 and $value<=$range2){array_push($att_level,1);}
    else {array_push($att_level,0);}
    }
    $co_query="SELECT * FROM `ut_co_marks` WHERE `teacher_id`='$id' AND `sem`='$sem' AND `sub`= '$sub' AND `year`='$year'";
    $co_result = mysqli_query($conn,$co_query) or die("ERROR".mysqli_error($conn));
    $co_row = mysqli_fetch_array($co_result);
    array_push($mark_co,$co_row['1a'],$co_row['1b'],$co_row['1c'],$co_row['1d'],$co_row['1e'],
                        $co_row['1f'],$co_row['2a'],$co_row['2b'],$co_row['3a'],$co_row['3b']);
    #print_r($mark_co);
    $index=0;
    foreach($mark_co as $map){
      if($map==1){
        array_push($co1,$att_level[$index]);
      }
      else if($map==2){
        array_push($co2,$att_level[$index]);
      }
      else if($map==3){
        array_push($co3,$att_level[$index]);
      }
      else if($map==4){
        array_push($co4,$att_level[$index]);
      }
      else if($map==5){
        array_push($co5,$att_level[$index]);
      }
      else if($map==6){
        array_push($co6,$att_level[$index]);
      }
      $index=$index+1;
    }
    if(count($co1)!=0){$var1_1=array_sum($co1)/count($co1);}else{$var1_1=0;}
    if(count($co2)!=0){$var2_1=array_sum($co2)/count($co2);}else{$var2_1=0;}
    if(count($co3)!=0){$var3_1=array_sum($co3)/count($co3);}else{$var3_1=0;}
    if(count($co4)!=0){$var4_1=array_sum($co4)/count($co4);}else{$var4_1=0;}
    if(count($co5)!=0){$var5_1=array_sum($co5)/count($co5);}else{$var5_1=0;}
    if(count($co6)!=0){$var6_1=array_sum($co6)/count($co6);}else{$var6_1=0;}
    $int_array_1=array($var1_1,$var2_1,$var3_1,$var4_1,$var5_1,$var6_1);
    !!!!!!!!!!!!!!!!!!!!!

    $student_no_data=array();
    $data_1a=0;
    $data_1b=0;
    $data_1c=0;
    $data_1d=0;
    $data_1e=0;
    $data_1f=0;
    $data_2a=0;
    $data_2b=0;
    $data_3a=0;
    $data_3b=0;
    $per_student_no=array();
    $att_level=array();
    $mark_co=array();
    $ut_query="SELECT * FROM `ut2_data` WHERE  `Teacher_ID`='$id' AND `Semester`='$sem' AND `Subject`= '$sub' AND `year`='$year'";
    $ut_result = mysqli_query($conn,$ut_query) or die("ERROR".mysqli_error($conn));
    while($row = mysqli_fetch_array($ut_result)){
      if((int)$row['1a']>2*$th_per/100){         $data_1a=$data_1a+1;      }
      if((int)$row['1b']>2*$th_per/100){         $data_1b=$data_1b+1;      }
      if((int)$row['1c']>2*$th_per/100){         $data_1c=$data_1c+1;      }
      if((int)$row['1d']>2*$th_per/100){         $data_1d=$data_1d+1;      }
      if((int)$row['1e']>2*$th_per/100){         $data_1e=$data_1e+1;      }
      if((int)$row['1f']>2*$th_per/100){         $data_1f=$data_1f+1;      }
      if((int)$row['2a']>5*$th_per/100){         $data_2a=$data_2a+1;      }
      if((int)$row['2b']>5*$th_per/100){         $data_2b=$data_2b+1;      }
      if((int)$row['3a']>5*$th_per/100){         $data_3a=$data_3a+1;      }
      if((int)$row['3b']>5*$th_per/100){         $data_3b=$data_3b+1;      }
    }
    array_push($student_no_data,$data_1a,$data_1b,$data_1c,$data_1d,$data_1e,
              $data_1f,$data_2a,$data_2b,$data_3a,$data_3b);
    #print_r($student_no_data);

    foreach ($student_no_data as $value) {array_push($per_student_no,(int)$value*100/$student_count); }  
    #print_r($per_student_no);
    foreach ($per_student_no as $value){
    if($value>$range3){ array_push($att_level,3);}
    else if($value>$range2 and $value<=$range3){array_push($att_level,2);}
    else if($value>$range1 and $value<=$range2){array_push($att_level,1);}
    else {array_push($att_level,0);}
    }
    $co_query="SELECT * FROM `ut2_co_marks` WHERE `teacher_id`='$id' AND `sem`='$sem' AND `sub`= '$sub' AND `year`='$year'";
    $co_result = mysqli_query($conn,$co_query) or die("ERROR".mysqli_error($conn));
    $co_row = mysqli_fetch_array($co_result);
    array_push($mark_co,$co_row['1a'],$co_row['1b'],$co_row['1c'],$co_row['1d'],$co_row['1e'],
                        $co_row['1f'],$co_row['2a'],$co_row['2b'],$co_row['3a'],$co_row['3b']);
    #print_r($mark_co);
    $index=0;
    foreach($mark_co as $map){
      if($map==1){
        array_push($co1,$att_level[$index]);
      }
      else if($map==2){
        array_push($co2,$att_level[$index]);
      }
      else if($map==3){
        array_push($co3,$att_level[$index]);
      }
      else if($map==4){
        array_push($co4,$att_level[$index]);
      }
      else if($map==5){
        array_push($co5,$att_level[$index]);
      }
      else if($map==6){
        array_push($co6,$att_level[$index]);
      }
      $index=$index+1;
    }
    if(count($co1)!=0){$var1_2=array_sum($co1)/count($co1);}else{$var1_2=0;}
    if(count($co2)!=0){$var2_2=array_sum($co2)/count($co2);}else{$var2_2=0;}
    if(count($co3)!=0){$var3_2=array_sum($co3)/count($co3);}else{$var3_2=0;}
    if(count($co4)!=0){$var4_2=array_sum($co4)/count($co4);}else{$var4_2=0;}
    if(count($co5)!=0){$var5_2=array_sum($co5)/count($co5);}else{$var5_2=0;}
    if(count($co6)!=0){$var6_2=array_sum($co6)/count($co6);}else{$var6_2=0;}
    $int_array_2=array($var1_2,$var2_2,$var3_2,$var4_2,$var5_2,$var6_2);

    $var1=($var1_1+$var1_2)/2;
    $var2=($var2_1+$var2_2)/2;
    $var3=($var3_1+$var3_2)/2;
    $var4=($var4_1+$var4_2)/2;
    $var5=($var5_1+$var5_2)/2;
    $var6=($var6_1+$var6_2)/2;

    $int_array=array($var1,$var2,$var3,$var4,$var5,$var6);
    ?>
    <div class="row" style="margin-left: 1%; margin-right:1%">
      <div class="col-6">
      <table class="table table-striped" style="margin-top: 5%">
        <thead>
          <tr>
            <th scope="col">CO Code</th>
            <th scope="col">Internal || Unit Test-1 & Unit Test-2 </th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">CO1</th>
            <td><?echo round($var1,2);?></td>
          </tr>
          <tr>
            <th scope="row">CO2</th>
            <td><?echo round($var2,2);?></td>
          </tr>
          <tr>
            <th scope="row">CO3</th>
            <td><?echo round($var3,2);?></td>
          </tr>
          <tr>
            <th scope="row">CO4</th>
            <td><?echo round($var4,2);?></td>
          </tr>
          <tr>
            <th scope="row">CO5</th>
            <td><?echo round($var5,2);?></td>
          </tr>
          <tr>
            <th scope="row">CO6</th>
            <td><?echo round($var6,2);?></td>
          </tr>
        </tbody>
      </table>
      </div>
      <div class="col-6">
        <canvas id="Chart2" width="100%" height="60vh" style="margin-right: 3%"></canvas>
      </div>
    </div> 
    <?php
    echo "<script> window.onload = function() {graph2()} </script>"; 
  }

?>
<?} ?>
</div>
</body>
<script type="text/javascript">
function graph(){
    var ctx = document.getElementById('Chart1').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['CO1', 'CO2', 'CO3', 'CO4', 'CO5', 'CO6'],
            datasets: [{
                label: 'Internal',
                data: <?php echo json_encode($int_array, JSON_NUMERIC_CHECK); ?>,
                backgroundColor: 
                    'rgba(54, 162, 235, 0.2)',
                borderColor: 
                  'rgba(54, 162, 235, 1)',
                borderWidth: 1
            },{
                label: 'Average with External',
                data: <?php echo json_encode($ext_array, JSON_NUMERIC_CHECK); ?>,
                type: 'bar',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor:'rgba(75, 192, 192, 1)',
                borderWidth: 1.5,
                // this dataset is drawn on top
                order: 2
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
});}
</script>
<script type="text/javascript">
function graph2(){
  var ctx = document.getElementById('Chart2').getContext('2d');
  var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
          labels: ['CO1', 'CO2', 'CO3', 'CO4', 'CO5', 'CO6'],
          datasets: [{
              label: 'Internal-Unit Tests',
              data: <?php echo json_encode($int_array, JSON_NUMERIC_CHECK); ?>,
              backgroundColor: 
                  'rgba(54, 162, 235, 0.2)',
              borderColor: 
                'rgba(54, 162, 235, 1)',
              borderWidth: 1
          }]
      },
      options: {
          scales: {
              yAxes: [{
                  ticks: {
                      beginAtZero: true
                  }
              }]
          }
      }
});}
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