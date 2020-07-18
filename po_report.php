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
    <title>PO Attainment Table</title>
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
          echo '<a href="profile.php" class="btn btn-light"  style="margin-right: 1%;">
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
          <a class="nav-link active" href="co_report.php" style="color:black;">CO Attainment Table</a>
          <a class="nav-link" href="#" style="color:green;font-weight:bold">PO Attainment Table</a>
          </nav>
        </div>
      <div class='col-10' style="padding-top:1%;" >
      <form class="needs-validation" method="post" action="" enctype="multipart/form-data" style="margin-left: 2.5%" novalidate> 
      <p style="font-size:large;">Please enter the details for Program Outcome Attainment Table:</p>
        <div class="form-row" style="margin-top: 2%">
          <div class="form-group col-md-3" style="margin-right: 1%">
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
            <input type="number" class="form-control" name="thresh_per" placeholder="Threshold % Marks" required>
          </div>
          <div class="form-group col-md-3" style="margin-right: 1%">
            <input type="number" class="form-control" name="r1" placeholder="Threshold-1 in %(lower)" required>
          </div>
          </div>
          <div class="form-row">
          <div class="form-group col-md-3" style="margin-right: 1%">
            <input type="number" class="form-control" name="r2" placeholder="Threshold-2 in %" required>
          </div>
          <div class="form-group col-md-3" style="margin-right: 1%">
            <input type="number" class="form-control" name="r3" placeholder="Threshold-3 in %" required>
          </div>
          
          <div class="form-group col-md-2" style="margin-right: 1%">
          <button class="btn btn-success" name="import" style="width: 100%">Show Analysis</button>
          </div>
          </div>
      </form>
      </div>
      </div> 
      <?php
      if(isset($_POST["import"])){
        $range1=(int)$_POST['r1'];
        $range2=(int)$_POST['r2'];
        $range3=(int)$_POST['r3'];
        $th_per=(int)$_POST['thresh_per'];
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
        $po1map=array();
        $po2map=array();
        $po3map=array();
        $po4map=array();
        $po5map=array();
        $po6map=array();
        $po7map=array();
        $po8map=array();
        $po9map=array();
        $po10map=array();
        $po11map=array();
        $po12map=array();
        $pso1map=array();
        $pso2map=array();
        ###############
        $po1_val=array();
        $po2_val=array();
        $po3_val=array();
        $po4_val=array();
        $po5_val=array();
        $po6_val=array();
        $po7_val=array();
        $po8_val=array();
        $po9_val=array();
        $po10_val=array();
        $po11_val=array();
        $po12_val=array();
        $pso1_val=array();
        $pso2_val=array();
        ###############
        $po1_val_base=array();
        $po2_val_base=array();
        $po3_val_base=array();
        $po4_val_base=array();
        $po5_val_base=array();
        $po6_val_base=array();
        $po7_val_base=array();
        $po8_val_base=array();
        $po9_val_base=array();
        $po10_val_base=array();
        $po11_val_base=array();
        $po12_val_base=array();
        $pso1_val_base=array();
        $pso2_val_base=array();
        ###############
        $sub=explode(" ",$_POST['course'])[2];
        $sub_code=explode(" ",$_POST['course'])[3];
        $sem=explode(" ",$_POST['course'])[6];
        $year=explode(" ",$_POST['course'])[10];
        $sem_count=0;
        $oral_count=0;
        $tw_count=0;
        $student_count=0;
        $tb_name=$sub.'|'.$sub_code;
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
      $ext_var1=(0.3*((float)$var1+(float)$tw_att)/2)+(0.7*((float)$sem_att+(float)$oral_att)/2);
      $ext_var2=(0.3*((float)$var2+(float)$tw_att)/2)+(0.7*((float)$sem_att+(float)$oral_att)/2);
      $ext_var3=(0.3*((float)$var3+(float)$tw_att)/2)+(0.7*((float)$sem_att+(float)$oral_att)/2);
      $ext_var4=(0.3*((float)$var4+(float)$tw_att)/2)+(0.7*((float)$sem_att+(float)$oral_att)/2);
      $ext_var5=(0.3*((float)$var5+(float)$tw_att)/2)+(0.7*((float)$sem_att+(float)$oral_att)/2);
      $ext_var6=(0.3*((float)$var6+(float)$tw_att)/2)+(0.7*((float)$sem_att+(float)$oral_att)/2);
      $int_array=array($var1,$var2,$var3,$var4,$var5,$var6);

      $ext_array=array($ext_var1,$ext_var2,$ext_var3,$ext_var4,$ext_var5,$ext_var6);
 #########################-----------------------------#############################
        $po_db="co_po_map";
        $new_conn=new mysqli($host,$user,$pass,$po_db);
      $po_query="SELECT * FROM `$tb_name` WHERE 1";
      $po_result = mysqli_query($new_conn,$po_query) or die("ERROR".mysqli_error($new_conn));
      while($row = mysqli_fetch_array($po_result)){
        array_push($po1map,$row['po1']);
        array_push($po2map,$row['po2']);
        array_push($po3map,$row['po3']);
        array_push($po4map,$row['po4']);
        array_push($po5map,$row['po5']);
        array_push($po6map,$row['po6']);
        array_push($po7map,$row['po7']);
        array_push($po8map,$row['po8']);
        array_push($po9map,$row['po9']);
        array_push($po10map,$row['po10']);
        array_push($po11map,$row['po11']);
        array_push($po12map,$row['po12']);
        array_push($pso1map,$row['pso1']);
        array_push($pso2map,$row['pso2']);
      }
      for($i = 0; $i <= 5; $i++){
        if($po1map[$i]==3){array_push($po1_val,(float)$ext_array[$i]);array_push($po1_val_base,(float)$ext_array[$i]);}
        elseif($po1map[$i]==2){array_push($po1_val,(float)$ext_array[$i]*2/3);array_push($po1_val_base,(float)$ext_array[$i]);}
        elseif($po1map[$i]==1){array_push($po1_val,(float)$ext_array[$i]*1/3);array_push($po1_val_base,(float)$ext_array[$i]);}
        elseif($po1map[$i]==0){array_push($po1_val,(float)$ext_array[$i]*0/3);}
      }
      for($i = 0; $i <= 5; $i++){
        if($po2map[$i]==3){array_push($po2_val,(float)$ext_array[$i]);array_push($po2_val_base,(float)$ext_array[$i]);}
        elseif($po2map[$i]==2){array_push($po2_val,(float)$ext_array[$i]*2/3);array_push($po2_val_base,(float)$ext_array[$i]);}
        elseif($po2map[$i]==1){array_push($po2_val,(float)$ext_array[$i]*1/3);array_push($po2_val_base,(float)$ext_array[$i]);}
        elseif($po2map[$i]==0){array_push($po2_val,(float)$ext_array[$i]*0/3);}
      }
      for($i = 0; $i <= 5; $i++){
        if($po3map[$i]==3){array_push($po3_val,(float)$ext_array[$i]);array_push($po3_val_base,(float)$ext_array[$i]);}
        elseif($po3map[$i]==2){array_push($po3_val,(float)$ext_array[$i]*2/3);array_push($po3_val_base,(float)$ext_array[$i]);}
        elseif($po3map[$i]==1){array_push($po3_val,(float)$ext_array[$i]*1/3);array_push($po3_val_base,(float)$ext_array[$i]);}
        elseif($po3map[$i]==0){array_push($po3_val,(float)$ext_array[$i]*0/3);}
      }
      for($i = 0; $i <= 5; $i++){
        if($po4map[$i]==3){array_push($po4_val,(float)$ext_array[$i]);array_push($po4_val_base,(float)$ext_array[$i]);}
        elseif($po4map[$i]==2){array_push($po4_val,(float)$ext_array[$i]*2/3);array_push($po4_val_base,(float)$ext_array[$i]);}
        elseif($po4map[$i]==1){array_push($po4_val,(float)$ext_array[$i]*1/3);array_push($po4_val_base,(float)$ext_array[$i]);}
        elseif($po4map[$i]==0){array_push($po4_val,(float)$ext_array[$i]*0/3);}
      }
      for($i = 0; $i <= 5; $i++){
        if($po5map[$i]==3){array_push($po5_val,(float)$ext_array[$i]);array_push($po5_val_base,(float)$ext_array[$i]);}
        elseif($po5map[$i]==2){array_push($po5_val,(float)$ext_array[$i]*2/3);array_push($po5_val_base,(float)$ext_array[$i]);}
        elseif($po5map[$i]==1){array_push($po5_val,(float)$ext_array[$i]*1/3);array_push($po5_val_base,(float)$ext_array[$i]);}
        elseif($po5map[$i]==0){array_push($po5_val,(float)$ext_array[$i]*0/3);}
      }
      for($i = 0; $i <= 5; $i++){
        if($po6map[$i]==3){array_push($po6_val,(float)$ext_array[$i]);array_push($po6_val_base,(float)$ext_array[$i]);}
        elseif($po6map[$i]==2){array_push($po6_val,(float)$ext_array[$i]*2/3);array_push($po6_val_base,(float)$ext_array[$i]);}
        elseif($po6map[$i]==1){array_push($po6_val,(float)$ext_array[$i]*1/3);array_push($po6_val_base,(float)$ext_array[$i]);}
        elseif($po6map[$i]==0){array_push($po6_val,(float)$ext_array[$i]*0/3);}
      }
      for($i = 0; $i <= 5; $i++){
        if($po7map[$i]==3){array_push($po7_val,(float)$ext_array[$i]);array_push($po7_val_base,(float)$ext_array[$i]);}
        elseif($po7map[$i]==2){array_push($po7_val,(float)$ext_array[$i]*2/3);array_push($po7_val_base,(float)$ext_array[$i]);}
        elseif($po7map[$i]==1){array_push($po7_val,(float)$ext_array[$i]*1/3);array_push($po7_val_base,(float)$ext_array[$i]);}
        elseif($po7map[$i]==0){array_push($po7_val,(float)$ext_array[$i]*0/3);}
      }
      for($i = 0; $i <= 5; $i++){
        if($po8map[$i]==3){array_push($po8_val,(float)$ext_array[$i]);array_push($po8_val_base,(float)$ext_array[$i]);}
        elseif($po8map[$i]==2){array_push($po8_val,(float)$ext_array[$i]*2/3);array_push($po8_val_base,(float)$ext_array[$i]);}
        elseif($po8map[$i]==1){array_push($po8_val,(float)$ext_array[$i]*1/3);array_push($po8_val_base,(float)$ext_array[$i]);}
        elseif($po8map[$i]==0){array_push($po8_val,(float)$ext_array[$i]*0/3);}
      }
      for($i = 0; $i <= 5; $i++){
        if($po9map[$i]==3){array_push($po9_val,(float)$ext_array[$i]);array_push($po9_val_base,(float)$ext_array[$i]);}
        elseif($po9map[$i]==2){array_push($po9_val,(float)$ext_array[$i]*2/3);array_push($po9_val_base,(float)$ext_array[$i]);}
        elseif($po9map[$i]==1){array_push($po9_val,(float)$ext_array[$i]*1/3);array_push($po9_val_base,(float)$ext_array[$i]);}
        elseif($po9map[$i]==0){array_push($po9_val,(float)$ext_array[$i]*0/3);}
      }
      for($i = 0; $i <= 5; $i++){
        if($po10map[$i]==3){array_push($po10_val,(float)$ext_array[$i]);array_push($po10_val_base,(float)$ext_array[$i]);}
        elseif($po10map[$i]==2){array_push($po10_val,(float)$ext_array[$i]*2/3);array_push($po10_val_base,(float)$ext_array[$i]);}
        elseif($po10map[$i]==1){array_push($po10_val,(float)$ext_array[$i]*1/3);array_push($po10_val_base,(float)$ext_array[$i]);}
        elseif($po10map[$i]==0){array_push($po10_val,(float)$ext_array[$i]*0/3);}
      }
      for($i = 0; $i <= 5; $i++){
        if($po11map[$i]==3){array_push($po11_val,(float)$ext_array[$i]);array_push($po11_val_base,(float)$ext_array[$i]);}
        elseif($po11map[$i]==2){array_push($po11_val,(float)$ext_array[$i]*2/3);array_push($po11_val_base,(float)$ext_array[$i]);}
        elseif($po11map[$i]==1){array_push($po11_val,(float)$ext_array[$i]*1/3);array_push($po11_val_base,(float)$ext_array[$i]);}
        elseif($po11map[$i]==0){array_push($po11_val,(float)$ext_array[$i]*0/3);}
      }
      for($i = 0; $i <= 5; $i++){
        if($po12map[$i]==3){array_push($po12_val,(float)$ext_array[$i]);array_push($po12_val_base,(float)$ext_array[$i]);}
        elseif($po12map[$i]==2){array_push($po12_val,(float)$ext_array[$i]*2/3);array_push($po12_val_base,(float)$ext_array[$i]);}
        elseif($po12map[$i]==1){array_push($po12_val,(float)$ext_array[$i]*1/3);array_push($po12_val_base,(float)$ext_array[$i]);}
        elseif($po12map[$i]==0){array_push($po12_val,(float)$ext_array[$i]*0/3);}
      }
      for($i = 0; $i <= 5; $i++){
        if($pso1map[$i]==3){array_push($pso1_val,(float)$ext_array[$i]);array_push($pso1_val_base,(float)$ext_array[$i]);}
        elseif($pso1map[$i]==2){array_push($pso1_val,(float)$ext_array[$i]*2/3);array_push($pso1_val_base,(float)$ext_array[$i]);}
        elseif($pso1map[$i]==1){array_push($pso1_val,(float)$ext_array[$i]*1/3);array_push($pso1_val_base,(float)$ext_array[$i]);}
        elseif($pso1map[$i]==0){array_push($pso1_val,(float)$ext_array[$i]*0/3);}
      }
      for($i = 0; $i <= 5; $i++){
        if($pso2map[$i]==3){array_push($pso2_val,(float)$ext_array[$i]);array_push($pso2_val_base,(float)$ext_array[$i]);}
        elseif($pso2map[$i]==2){array_push($pso2_val,(float)$ext_array[$i]*2/3);array_push($pso2_val_base,(float)$ext_array[$i]);}
        elseif($pso2map[$i]==1){array_push($pso2_val,(float)$ext_array[$i]*1/3);array_push($pso2_val_base,(float)$ext_array[$i]);}
        elseif($pso2map[$i]==0){array_push($pso2_val,(float)$ext_array[$i]*0/3);}
      }
     $po_avg=array();
     array_push($po_avg,array_sum($po1_val)/count($po1_val));
     array_push($po_avg,array_sum($po2_val)/count($po2_val));
     array_push($po_avg,array_sum($po3_val)/count($po3_val));
     array_push($po_avg,array_sum($po4_val)/count($po4_val));
     array_push($po_avg,array_sum($po5_val)/count($po5_val));
     array_push($po_avg,array_sum($po6_val)/count($po6_val));
     array_push($po_avg,array_sum($po7_val)/count($po7_val));
     array_push($po_avg,array_sum($po8_val)/count($po8_val));
     array_push($po_avg,array_sum($po9_val)/count($po9_val));
     array_push($po_avg,array_sum($po10_val)/count($po10_val));
     array_push($po_avg,array_sum($po11_val)/count($po11_val));
     array_push($po_avg,array_sum($po12_val)/count($po12_val));
     array_push($po_avg,array_sum($pso1_val)/count($pso1_val));
     array_push($po_avg,array_sum($pso2_val)/count($pso2_val));

     $po_base_avg=array();
     array_push($po_base_avg,array_sum($po1_val_base)/count($po1_val_base));
     array_push($po_base_avg,array_sum($po2_val_base)/count($po2_val_base));
     array_push($po_base_avg,array_sum($po3_val_base)/count($po3_val_base));
     array_push($po_base_avg,array_sum($po4_val_base)/count($po4_val_base));
     array_push($po_base_avg,array_sum($po5_val_base)/count($po5_val_base));
     array_push($po_base_avg,array_sum($po6_val_base)/count($po6_val_base));
     array_push($po_base_avg,array_sum($po7_val_base)/count($po7_val_base));
     array_push($po_base_avg,array_sum($po8_val_base)/count($po8_val_base));
     array_push($po_base_avg,array_sum($po9_val_base)/count($po9_val_base));
     array_push($po_base_avg,array_sum($po10_val_base)/count($po10_val_base));
     array_push($po_base_avg,array_sum($po11_val_base)/count($po11_val_base));
     array_push($po_base_avg,array_sum($po12_val_base)/count($po12_val_base));
     array_push($po_base_avg,array_sum($pso1_val_base)/count($pso1_val_base));
     array_push($po_base_avg,array_sum($pso2_val_base)/count($pso2_val_base));
      ?>
      <div class="row" style="margin-left: 1%; margin-right:1%">
      <div class="col-6" style="height:55vh; overflow-y: scroll;">
      <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">PO/PSO Code</th>
      <th scope="col">PO Weighted Average</th>
      <th scope="col">PO Threshold Base </th>

    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">PO1</th>
      <td><?echo round($po_avg[0],2);?></td>
      <td><?echo round($po_base_avg[0],2);?></td>
    </tr>
    <tr>
      <th scope="row">PO2</th>
      <td><?echo round($po_avg[1],2);?></td>
      <td><?echo round($po_base_avg[1],2);?></td>

    </tr>
    <tr>
      <th scope="row">PO3</th>
      <td><?echo round($po_avg[2],2);?></td>
      <td><?echo round($po_base_avg[2],2);?></td>

    </tr>
    <tr>
      <th scope="row">PO4</th>
      <td><?echo round($po_avg[3],2);?></td>
      <td><?echo round($po_base_avg[3],2);?></td>

    </tr>
    <tr>
      <th scope="row">PO5</th>
      <td><?echo round($po_avg[4],2);?></td>
      <td><?echo round($po_base_avg[4],2);?></td>

    </tr>
    <tr>
      <th scope="row">PO6</th>
      <td><?echo round($po_avg[5],2);?></td>
      <td><?echo round($po_base_avg[5],2);?></td>

    </tr>
    <tr>
      <th scope="row">PO7</th>
      <td><?echo round($po_avg[6],2);?></td>
      <td><?echo round($po_base_avg[6],2);?></td>

    </tr>
    <tr>
      <th scope="row">PO8</th>
      <td><?echo round($po_avg[7],2);?></td>
      <td><?echo round($po_base_avg[7],2);?></td>

    </tr>
    <tr>
      <th scope="row">PO9</th>
      <td><?echo round($po_avg[8],2);?></td>
      <td><?echo round($po_base_avg[8],2);?></td>

    </tr>
    <tr>
      <th scope="row">PO10</th>
      <td><?echo round($po_avg[9],2);?></td>
      <td><?echo round($po_base_avg[9],2);?></td>

    </tr>
    <tr>
      <th scope="row">PO11</th>
      <td><?echo round($po_avg[10],2);?></td>
      <td><?echo round($po_base_avg[10],2);?></td>

    </tr>
    <tr>
      <th scope="row">PO12</th>
      <td><?echo round($po_avg[11],2);?></td>
      <td><?echo round($po_base_avg[11],2);?></td>

    </tr>
    <tr>
      <th scope="row">PSO1</th>
      <td><?echo round($po_avg[12],2);?></td>
      <td><?echo round($po_base_avg[12],2);?></td>

    </tr>
    <tr>
      <th scope="row">PSO2</th>
      <td><?echo round($po_avg[13],2);?></td>
      <td><?echo round($po_base_avg[13],2);?></td>

    </tr>
    
  </tbody>
</table>
      </div>
      <div class="col-6">
      <canvas id="Chart1" width="100%" height="70vh" style="margin-right: 3%"></canvas>
      </div>
      </div>  
  <? echo "<script> window.onload = function() {graph()} </script>";  } ?>

  </div>
  <script type="text/javascript">
function graph(){
    var ctx = document.getElementById('Chart1').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['PO1', 'PO2', 'PO3', 'PO4', 'PO5', 'PO6', 'PO7',
                     'PO8', 'PO9', 'PO10', 'PO11', 'PO12', 'PSO1', 'PSO2'],
            datasets: [{
                label: 'PO Weighted Average',
                data: <?php echo json_encode($po_avg, JSON_NUMERIC_CHECK); ?>,
                backgroundColor: 
                'rgba(75, 192, 192, 0.2)',
                borderColor: 
                'rgba(75, 192, 192, 1)',
                borderWidth: 1
            },{
                label: 'PO Threshold Base',
                data: <?php echo json_encode($po_base_avg, JSON_NUMERIC_CHECK); ?>,
                type: 'bar',
                backgroundColor: 'rgba(255, 206, 86, 0.2)',
                borderColor:'rgba(255, 206, 86, 1)',
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
</body>
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