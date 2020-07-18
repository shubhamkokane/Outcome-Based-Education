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
if(isset($_POST["import"])){
  $data=array();
  $sub=explode(" ",$_POST['course'])[2];
  $sub_code=explode(" ",$_POST['course'])[3];
  $sem=explode(" ",$_POST['course'])[6];
  $year=explode(" ",$_POST['course'])[10];
  $label=array();
  $max=array();
  $min=array();
  $avg=array();
  $pass_arr=array();
  $count=0;
  $pass=(int)$_POST['pass_marks'];
  $r1=0;
  $r2=0;
  $r3=0;
  $r4=0;
  $pie_data=array();
  
  if($_POST['type']=='Semester'){
    $graph_query="SELECT * FROM `sem_data` WHERE  `teacher_id`='$id' AND `sem`='$sem' AND `sub`= '$sub' AND `year`='$year'";
    $graph_result = mysqli_query($conn,$graph_query) or die("ERROR".mysqli_error($conn));
    while($row = mysqli_fetch_array($graph_result)){
      $sum = 0;
      $sum=(int)$row['1a']+(int)$row['1b']+(int)$row['1c']+(int)$row['1d']+
            (int)$row['2a']+(int)$row['2b']+(int)$row['3a']+(int)$row['3b']+
            (int)$row['4a']+(int)$row['4b']+(int)$row['5a']+(int)$row['5b']+
            (int)$row['6a']+(int)$row['6b']+(int)$row['6c']+(int)$row['6d'];
      $count=$count+1;
      array_push($data,$sum);
      array_push($label,$row['PRN']); 
      if($sum>=(80*40/100) and $sum<(80*50/100)){
        $r1=$r1+1;
      }
      else if($sum>=(80*50/100) and $sum<(80*60/100)){
        $r2=$r2+1;
      }
      else if($sum>=(80*60/100)){
        $r3=$r3+1;
      }
      else{
        $r4=$r4+1;
      }     
    }
    $max = array_fill(0, $count, max($data));
    $min = array_fill(0, $count, min($data));
    $avg = array_fill(0,$count,array_sum($data)/$count);
    $pass_arr=array_fill(0,$count,$pass);
    array_push($pie_data,$r4,$r1,$r2,$r3);     
  }
  else if($_POST['type']=='Unit Test'){
    $graph_query="SELECT * FROM `ut_data` WHERE  `Teacher_id`='$id' AND `Semester`='$sem' AND `Subject`= '$sub' AND `year`='$year'";
    $graph_result = mysqli_query($conn,$graph_query) or die("ERROR".mysqli_error($conn));
    while($row = mysqli_fetch_array($graph_result)){
      $sum = 0;
      $sum=(int)$row['1a']+(int)$row['1b']+(int)$row['1c']+(int)$row['1d']+(int)$row['1e']+(int)$row['1f']+
            (int)$row['2a']+(int)$row['2b']+(int)$row['3a']+(int)$row['3b'];
            array_push($data,$sum);
            array_push($label,$row['PRN']); 
            $count=$count+1;
            if($sum>=(20*40/100) and $sum<(20*50/100)){
              $r1=$r1+1;
            }
            else if($sum>=(20*50/100) and $sum<(20*60/100)){
              $r2=$r2+1;
            }
            else if($sum>=(20*60/100)){
              $r3=$r3+1;
            }
            else{
              $r4=$r4+1;
            }     
    }
    $max = array_fill(0, $count, max($data));
    $min = array_fill(0, $count, min($data));
    $avg = array_fill(0,$count,array_sum($data)/$count);
    $pass_arr=array_fill(0,$count,$pass);
    array_push($pie_data,$r4,$r1,$r2,$r3);     

  }
  else if($_POST['type']=='Assignments'){
    $graph_query="SELECT * FROM `assign_data` WHERE  `teacher_id`='$id' AND `sem`='$sem' AND `sub`= '$sub' AND `year`='$year'";
    $graph_result = mysqli_query($conn,$graph_query) or die("ERROR".mysqli_error($conn));
    while($row = mysqli_fetch_array($graph_result)){
      array_push($data,$row['ques']);
      array_push($label,$row['PRN']);
      $count=$count+1;

    }
    $max = array_fill(0, $count, max($data));
    $min = array_fill(0, $count, min($data));
    $avg = array_fill(0,$count,array_sum($data)/$count);
  }
  else if($_POST['type']=='Orals'){
    $graph_query="SELECT * FROM `oral_data` WHERE  `teacher_id`='$id' AND `sem`='$sem' AND `sub`= '$sub' AND `year`='$year'";
    $graph_result = mysqli_query($conn,$graph_query) or die("ERROR".mysqli_error($conn));
    while($row = mysqli_fetch_array($graph_result)){
      array_push($data,$row['ques']);
      array_push($label,$row['PRN']);   
      $count=$count+1;
 
    }
    $max = array_fill(0, $count, max($data));
    $min = array_fill(0, $count, min($data));
    $avg = array_fill(0,$count,array_sum($data)/$count);
  }
  else if($_POST['type']=='Termwork'){
    $graph_query="SELECT * FROM `tw_data` WHERE  `teacher_id`='$id' AND `sem`='$sem' AND `sub`= '$sub' AND `year`='$year'";
    $graph_result = mysqli_query($conn,$graph_query) or die("ERROR".mysqli_error($conn));
    while($row = mysqli_fetch_array($graph_result)){
      array_push($data,$row['ques']);
      array_push($label,$row['PRN']);
      $count=$count+1;

    }
    $max = array_fill(0, $count, max($data));
    $min = array_fill(0, $count, min($data));
    $avg = array_fill(0,$count,array_sum($data)/$count);
  }
  echo "<script> window.onload = function() {graph()} </script>";
}
?>
<script type="text/javascript">
function graph(){
    var ctx = document.getElementById('Chart1').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($label, JSON_NUMERIC_CHECK); ?>,
            datasets: [{
                label: 'Marks:',
                pointStyle:'crossRot',
                radius:5,
                tension:0,
                data: <?php echo json_encode($data, JSON_NUMERIC_CHECK); ?>,
                backgroundColor:  'rgba(54, 162, 235, 0.2)',
                borderColor:'rgba(54, 162, 235, 1)',
                borderWidth: 1
            },{
            label: 'Maximum Marks',
            data: <?php echo json_encode($max, JSON_NUMERIC_CHECK); ?>,
            type: 'line',
            backgroundColor: 'rgba(0,0,255,0)',
            borderColor:'green',
            borderWidth: 1.5,
            // this dataset is drawn on top
            order: 2
        },{
            label: 'Minimum Marks',
            data: <?php echo json_encode($min, JSON_NUMERIC_CHECK); ?>,
            type: 'line',
            backgroundColor: 'rgba(255,0,0,0)',
            borderColor:'red',
            borderWidth: 1.5,
            // this dataset is drawn on top
            order: 1
        },{
            label: 'Average Marks',
            data: <?php echo json_encode($avg, JSON_NUMERIC_CHECK); ?>,
            type: 'line',
            backgroundColor: 'rgba(255,255,0,0)',
            borderColor:'blue',
            borderWidth: 1.5,
            // this dataset is drawn on top
            order: 1
        },{
            label: 'Passing Marks',
            data: <?php echo json_encode($pass_arr, JSON_NUMERIC_CHECK); ?>,
            type: 'line',
            backgroundColor: 'rgba(255,255,0,0)',
            borderColor:'orange',
            borderWidth: 1.5,
            // this dataset is drawn on top
            order: 1
        }
        ]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: false
                    }
                }]
            }
        }
    });

    var ctx = document.getElementById('Chart2').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
          datasets: [{
        data:<?echo json_encode($pie_data, JSON_NUMERIC_CHECK);?>,
        backgroundColor:['rgba(255, 159, 64, 0.5)',
        'rgba(255, 206, 86, 0.5)',
        'rgba(54, 162, 235, 0.5)',
        'rgba(75, 192, 192, 0.5)'
        ],
        borderColor:['rgba(255, 159, 64, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(54, 162, 235,1)',
        'rgba(75, 192, 192, 1)'
        ]
    }],

    // These labels appear in the legend and in the tooltips when hovering different arcs
    labels: [
        'Marks<40% ',
        '40%<=Marks<50% ',
        '50%<=Marks<60% ',
        '60%<Marks '
    ]
        }
    });
}
</script>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sublect Level Analysis</title>
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
          <a class="nav-link active" href="#" style="color:green;font-weight: bold;">Subject Analysis</a>
          <a class="nav-link" href="co_report.php" style="color: black;">CO Attainment Table</a>
          <a class="nav-link" href="po_report.php" style="color: black;">PO Attainment Table</a>
          </nav>
        </div>
      <div class='col-10' style="padding-top:1%;" >
      <form class="needs-validation" method="post" action="" enctype="multipart/form-data" style="margin-left: 2.5%" novalidate> 
      <p style="font-size:large;">Please enter the details for Subject Level Analysis:</p>
        <div class="form-row" style="margin-top: 2%">
          <div class="form-group" style="margin-right: 1%">
          <select name="type" class="form-control custom-select" required>
              <option value="" disabled selected>Choose Format of Examination</option>
              <option>Unit Test</option>
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
                              while($row2 = mysqli_fetch_array($result)){
                            ?>
                            <option><?echo "Subject : ".$row2['sub_name']." ".$row2['subject-code']." Semester : ".$row2['semester']." || Year : ".$row2['year']; ?></option>
                              <?}?>
                          </select>
          </div>
      <div class="form-group" style="margin-right: 1%">
      <input type="number" class="form-control" name="pass_marks" placeholder="Enter Passing marks">
      </div>
      <div class="form-group" style="margin-right: 1%">
      <button class="btn btn-success" name="import">Show Analysis</button>
      </div>
      </div>
      </form>
      </div>
      </div>
      <div class="row" style="margin-top: 1.5%;margin-left: 1%;margin-right:1%"> 
      <div class="col-6">
      <canvas id="Chart1" width="100%" height="60vh" ></canvas>
      </div>
      <div class="col-6">
      <canvas id="Chart2" width="100%" height="60vh" ></canvas>
      </div>
      </div>
      </div> 
      
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