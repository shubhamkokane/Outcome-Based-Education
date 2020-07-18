<!DOCTYPE html>
<html lang="en">
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
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CO-PO Mapping</title>
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
        echo '<a class="nav-link" href="#" onclick="login_error()" style="color: black; display: none">Set Curriculum</a>
        <a class="nav-link" href="#" onclick="login_error()" style="color: black; display: none">Specify PO</a>
        <a class="nav-link" href="SPEC_CO.php"  style="color: black;">Specify CO</a>';
        
        }
        else{
          echo '<a class="nav-link" href="set_curr.php" style="color: black;">Set Curriculum</a>
          <a class="nav-link" href="spec_po.php" style="color: black;">Specify PO</a>
        <a class="nav-link" href="SPEC_CO.php" style="color: black;">Specify CO</a>';
        }
        ?>
        <a class="nav-link active" href="CO_PO.php" style="color: green;font-weight: bold;">CO-PO Mapping</a>
        <a class="nav-link" href="marks_co.php" style="color: black;">Marks-CO Mapping</a>
        <a class="nav-link" href="marks.php" style="color: black;">Marks Data</a>

      </nav>
    </div>
    <div class='col-10'>
    <form class="needs-validation" method="post" action="" novalidate>
      <div class="container-fluid">
          <div class="form-row" style="margin-top: 2%">
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
          </div>
    </div>
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">CO\PO</th>
                  <th scope="col">PO1</th>
                  <th scope="col">PO2</th>
                  <th scope="col">PO3</th>
                  <th scope="col">PO4</th>
                  <th scope="col">PO5</th>
                  <th scope="col">PO6</th>
                  <th scope="col">PO7</th>
                  <th scope="col">PO8</th>
                  <th scope="col">PO9</th>
                  <th scope="col">PO10</th>
                  <th scope="col">PO11</th>
                  <th scope="col">PO12</th>
                  <th scope="col">PSO1</th>
                  <th scope="col">PSO2</th>
                </tr>               
              </thead>
              <tbody>
                <tr>
                  <th scope="row">CO1</th>
                  <td>
                  <select class="form-control custom-select" name="co1-1">
                    <option selected>0</option>
                    <option >1</option>
                    <option>2</option>
                    <option>3</option>	  
                    </select>                                            
                  </td>
                  <td>
                  <select class="form-control custom-select" name="co1-2">
                  <option selected>0</option>
                    <option >1</option>
                    <option>2</option>
                    <option>3</option>	  
                    </select>                                             
                  </td>
                  <td>
                  <select class="form-control custom-select" name="co1-3"><option selected>0</option>
                    <option >1</option>
                    <option>2</option>
                    <option>3</option>	  
                    </select>                                             
                  </td>
                  <td>
                  <select class="form-control custom-select" name="co1-4"><option selected>0</option>
                    <option >1</option>
                    <option>2</option>
                    <option>3</option>	  
                    </select>                                             
                  </td>
                  <td>
                  <select class="form-control custom-select" name="co1-5"><option selected>0</option>
                    <option >1</option>
                    <option>2</option>
                    <option>3</option>	  
                    </select>                                             
                  </td>
                  <td>
                  <select class="form-control custom-select" name="co1-6"><option selected>0</option>
                    <option >1</option>
                    <option>2</option>
                    <option>3</option>	  
                    </select>                                             
                  </td>
                  <td>
                  <select class="form-control custom-select" name="co1-7"><option selected>0</option>
                    <option >1</option>
                    <option>2</option>
                    <option>3</option>	  
                    </select>                                             
                  </td>
                  <td>
                  <select class="form-control custom-select" name="co1-8"><option selected>0</option>
                    <option >1</option>
                    <option>2</option>
                    <option>3</option>	  
                    </select>                                             
                  </td>
                  <td>
                  <select class="form-control custom-select" name="co1-9"><option selected>0</option>
                    <option >1</option>
                    <option>2</option>
                    <option>3</option>	  
                    </select>                                             
                  </td>
                  <td>
                  <select class="form-control custom-select" name="co1-10"><option selected>0</option>
                    <option >1</option>
                    <option>2</option>
                    <option>3</option>	  
                    </select>                                             
                  </td>
                  <td>
                  <select class="form-control custom-select" name="co1-11"><option selected>0</option>
                    <option >1</option>
                    <option>2</option>
                    <option>3</option>	  
                    </select>                                             
                  </td>
                  <td>
                  <select class="form-control custom-select" name="co1-12"><option selected>0</option>
                    <option >1</option>
                    <option>2</option>
                    <option>3</option>	  
                    </select>                                             
                  </td>
                  <td>
                  <select class="form-control custom-select" name="co1-13"><option selected>0</option>
                    <option >1</option>
                    <option>2</option>
                    <option>3</option>	  
                    </select>                                             
                  </td>
                  <td>
                  <select class="form-control custom-select" name="co1-14"><option selected>0</option>
                    <option >1</option>
                    <option>2</option>
                    <option>3</option>	  
                    </select>                                             
                  </td>
                </tr>
                <tr>
                  <th scope="row">CO2</th>
                  <td>
                  <select class="form-control custom-select" name="co2-1"><option selected>0</option>
                    <option >1</option>
                    <option>2</option>
                    <option>3</option>	  
                    </select>                                            
                  </td>
                  <td>
                  <select class="form-control custom-select" name="co2-2"><option selected>0</option>
                    <option >1</option>
                    <option>2</option>
                    <option>3</option>	  
                    </select>                                             
                  </td>
                  <td>
                  <select class="form-control custom-select" name="co2-3"><option selected>0</option>
                    <option >1</option>
                    <option>2</option>
                    <option>3</option>	  
                    </select>                                             
                  </td>
                  <td>
                  <select class="form-control custom-select" name="co2-4"><option selected>0</option>
                    <option >1</option>
                    <option>2</option>
                    <option>3</option>	  
                    </select>                                             
                  </td>
                  <td>
                  <select class="form-control custom-select" name="co2-5"><option selected>0</option>
                    <option >1</option>
                    <option>2</option>
                    <option>3</option>	  
                    </select>                                             
                  </td>
                  <td>
                  <select class="form-control custom-select" name="co2-6"><option selected>0</option>
                    <option >1</option>
                    <option>2</option>
                    <option>3</option>	  
                    </select>                                             
                  </td>
                  <td>
                  <select class="form-control custom-select" name="co2-7"><option selected>0</option>
                    <option >1</option>
                    <option>2</option>
                    <option>3</option>	  
                    </select>                                             
                  </td>
                  <td>
                  <select class="form-control custom-select" name="co2-8"><option selected>0</option>
                    <option >1</option>
                    <option>2</option>
                    <option>3</option>	  
                    </select>                                            
                  </td>
                  <td>
                  <select class="form-control custom-select" name="co2-9"><option selected>0</option>
                    <option >1</option>
                    <option>2</option>
                    <option>3</option>	  
                    </select>                                             
                  </td>
                  <td>
                  <select class="form-control custom-select" name="co2-10"><option selected>0</option>
                    <option >1</option>
                    <option>2</option>
                    <option>3</option>	  
                    </select>                                             
                  </td>
                  <td>
                  <select class="form-control custom-select" name="co2-11"><option selected>0</option>
                    <option >1</option>
                    <option>2</option>
                    <option>3</option>	  
                    </select>                                             
                  </td>
                  <td>
                  <select class="form-control custom-select" name="co2-12"><option selected>0</option>
                    <option >1</option>
                    <option>2</option>
                    <option>3</option>	  
                    </select>                                             
                  </td>
                  <td>
                  <select class="form-control custom-select" name="co2-13"><option selected>0</option>
                    <option >1</option>
                    <option>2</option>
                    <option>3</option>	  
                    </select>                                             
                  </td>
                  <td>
                  <select class="form-control custom-select" name="co2-14"><option selected>0</option>
                    <option >1</option>
                    <option>2</option>
                    <option>3</option>	  
                    </select>                                             
                  </td>
                </tr>
                <tr>
                  <th scope="row">CO3</th>
                  <td>
                  <select class="form-control custom-select" name="co3-1"><option selected>0</option>
                    <option >1</option>
                    <option>2</option>
                    <option>3</option>	  
                    </select>                                            
                  </td>
                  <td>
                  <select class="form-control custom-select" name="co3-2"><option selected>0</option>
                    <option >1</option>
                    <option>2</option>
                    <option>3</option>	  
                    </select>                                             
                  </td>
                  <td>
                  <select class="form-control custom-select" name="co3-3"><option selected>0</option>
                    <option >1</option>
                    <option>2</option>
                    <option>3</option>	  
                    </select>                                             
                  </td>
                  <td>
                  <select class="form-control custom-select" name="co3-4"><option selected>0</option>
                    <option >1</option>
                    <option>2</option>
                    <option>3</option>	  
                    </select>                                             
                  </td>
                  <td>
                  <select class="form-control custom-select" name="co3-5"><option selected>0</option>
                    <option >1</option>
                    <option>2</option>
                    <option>3</option>	  
                    </select>                                             
                  </td>
                  <td>
                  <select class="form-control custom-select" name="co3-6"><option selected>0</option>
                    <option >1</option>
                    <option>2</option>
                    <option>3</option>	  
                    </select>                                             
                  </td>
                  <td>
                  <select class="form-control custom-select" name="co3-7"><option selected>0</option>
                    <option >1</option>
                    <option>2</option>
                    <option>3</option>	  
                    </select>                                             
                  </td>
                  <td>
                  <select class="form-control custom-select" name="co3-8"><option selected>0</option>
                    <option >1</option>
                    <option>2</option>
                    <option>3</option>	  
                    </select>                                             
                  </td>
                  <td>
                  <select class="form-control custom-select" name="co3-9"><option selected>0</option>
                    <option >1</option>
                    <option>2</option>
                    <option>3</option>	  
                    </select>                                             
                  </td>
                  <td>
                  <select class="form-control custom-select" name="co3-10"><option selected>0</option>
                    <option >1</option>
                    <option>2</option>
                    <option>3</option>	  
                    </select>                                             
                  </td>
                  <td>
                  <select class="form-control custom-select" name="co3-11"><option selected>0</option>
                    <option >1</option>
                    <option>2</option>
                    <option>3</option>	  
                    </select>                                             
                  </td>
                  <td>
                  <select class="form-control custom-select" name="co3-12"><option selected>0</option>
                    <option >1</option>
                    <option>2</option>
                    <option>3</option>	  
                    </select>                                             
                  </td>
                  <td>
                  <select class="form-control custom-select" name="co3-13"><option selected>0</option>
                    <option >1</option>
                    <option>2</option>
                    <option>3</option>	  
                    </select>                                             
                  </td>
                  <td>
                  <select class="form-control custom-select" name="co3-14"><option selected>0</option>
                    <option >1</option>
                    <option>2</option>
                    <option>3</option>	  
                    </select>                                             
                  </td>
                </tr>
                <tr>
                      <th scope="row">CO4</th>
                      <td>
                  <select class="form-control custom-select" name="co4-1"><option selected>0</option>
                    <option >1</option>
                    <option>2</option>
                    <option>3</option>	  
                    </select>                                            
                  </td>
                  <td>
                  <select class="form-control custom-select" name="co4-2"><option selected>0</option>
                    <option >1</option>
                    <option>2</option>
                    <option>3</option>	  
                    </select>                                             </td>
                  <td>
                  <select class="form-control custom-select" name="co4-3"><option selected>0</option>
                    <option >1</option>
                    <option>2</option>
                    <option>3</option>	  
                    </select>                                             </td>
                  <td>
                  <select class="form-control custom-select" name="co4-4"><option selected>0</option>
                    <option >1</option>
                    <option>2</option>
                    <option>3</option>	  
                    </select>                                             </td>
                  <td>
                  <select class="form-control custom-select" name="co4-5"><option selected>0</option>
                    <option >1</option>
                    <option>2</option>
                    <option>3</option>	  
                    </select>                                             </td>
                  <td>
                  <select class="form-control custom-select" name="co4-6"><option selected>0</option>
                    <option >1</option>
                    <option>2</option>
                    <option>3</option>	  
                    </select>                                             </td>
                  <td>
                  <select class="form-control custom-select" name="co4-7"><option selected>0</option>
                    <option >1</option>
                    <option>2</option>
                    <option>3</option>	  
                    </select>                                             </td>
                  <td>
                  <select class="form-control custom-select" name="co4-8"><option selected>0</option>
                    <option >1</option>
                    <option>2</option>
                    <option>3</option>	  
                    </select>                                             </td>
                  <td>
                  <select class="form-control custom-select" name="co4-9"><option selected>0</option>
                    <option >1</option>
                    <option>2</option>
                    <option>3</option>	  
                    </select>                                             </td>
                  <td>
                  <select class="form-control custom-select" name="co4-10"><option selected>0</option>
                    <option >1</option>
                    <option>2</option>
                    <option>3</option>	  
                    </select>                                             </td>
                  <td>
                  <select class="form-control custom-select" name="co4-11"><option selected>0</option>
                    <option >1</option>
                    <option>2</option>
                    <option>3</option>	  
                    </select>                                             </td>
                  <td>
                  <select class="form-control custom-select" name="co4-12"><option selected>0</option>
                    <option >1</option>
                    <option>2</option>
                    <option>3</option>	  
                    </select>                                             </td>
                  <td>
                  <select class="form-control custom-select" name="co4-13"><option selected>0</option>
                    <option >1</option>
                    <option>2</option>
                    <option>3</option>	  
                    </select>                                             </td>
                  <td>
                  <select class="form-control custom-select" name="co4-14"><option selected>0</option>
                    <option >1</option>
                    <option>2</option>
                    <option>3</option>	  
                    </select>                                             </td>
                </tr>
                <tr>
                  <th scope="row">CO5</th>
                  <td>
                    <select class="form-control custom-select" name="co5-1"><option selected>0</option>
                      <option >1</option>
                      <option>2</option>
                      <option>3</option>	  
                      </select>                                            
                    </td>
                    <td>
                    <select class="form-control custom-select" name="co5-2"><option selected>0</option>
                      <option >1</option>
                      <option>2</option>
                      <option>3</option>	  
                      </select>                                             </td>
                    <td>
                    <select class="form-control custom-select" name="co5-3"><option selected>0</option>
                      <option >1</option>
                      <option>2</option>
                      <option>3</option>	  
                      </select>                                             </td>
                    <td>
                    <select class="form-control custom-select" name="co5-4"><option selected>0</option>
                      <option >1</option>
                      <option>2</option>
                      <option>3</option>	  
                      </select>                                             </td>
                    <td>
                    <select class="form-control custom-select" name="co5-5"><option selected>0</option>
                      <option >1</option>
                      <option>2</option>
                      <option>3</option>	  
                      </select>                                             </td>
                    <td>
                    <select class="form-control custom-select" name="co5-6"><option selected>0</option>
                      <option >1</option>
                      <option>2</option>
                      <option>3</option>	  
                      </select>                                             </td>
                    <td>
                    <select class="form-control custom-select" name="co5-7"><option selected>0</option>
                      <option >1</option>
                      <option>2</option>
                      <option>3</option>	  
                      </select>                                             </td>
                    <td>
                    <select class="form-control custom-select" name="co5-8"><option selected>0</option>
                      <option >1</option>
                      <option>2</option>
                      <option>3</option>	  
                      </select>                                             </td>
                    <td>
                    <select class="form-control custom-select" name="co5-9"><option selected>0</option>
                      <option >1</option>
                      <option>2</option>
                      <option>3</option>	  
                      </select>                                             </td>
                    <td>
                    <select class="form-control custom-select" name="co5-10"><option selected>0</option>
                      <option >1</option>
                      <option>2</option>
                      <option>3</option>	  
                      </select>                                             </td>
                    <td>
                    <select class="form-control custom-select" name="co5-11"><option selected>0</option>
                      <option >1</option>
                      <option>2</option>
                      <option>3</option>	  
                      </select>                                             </td>
                    <td>
                    <select class="form-control custom-select" name="co5-12"><option selected>0</option>
                      <option >1</option>
                      <option>2</option>
                      <option>3</option>	  
                      </select>                                             </td>
                    <td>
                    <select class="form-control custom-select" name="co5-13"><option selected>0</option>
                      <option >1</option>
                      <option>2</option>
                      <option>3</option>	  
                      </select>                                             </td>
                    <td>
                    <select class="form-control custom-select" name="co5-14"><option selected>0</option>
                      <option >1</option>
                      <option>2</option>
                      <option>3</option>	  
                      </select>                                             </td>
                </tr>
                <tr>
                      <th scope="row">CO6</th>
                      <td>
                    <select class="form-control custom-select" name="co6-1"><option selected>0</option>
                      <option >1</option>
                      <option>2</option>
                      <option>3</option>	  
                      </select>                                            
                    </td>
                    <td>
                    <select class="form-control custom-select" name="co6-2"><option selected>0</option>
                      <option >1</option>
                      <option>2</option>
                      <option>3</option>	  
                      </select>                                             </td>
                    <td>
                    <select class="form-control custom-select" name="co6-3"><option selected>0</option>
                      <option >1</option>
                      <option>2</option>
                      <option>3</option>	  
                      </select>                                             </td>
                    <td>
                    <select class="form-control custom-select" name="co6-4"><option selected>0</option>
                      <option >1</option>
                      <option>2</option>
                      <option>3</option>	  
                      </select>                                             </td>
                    <td>
                    <select class="form-control custom-select" name="co6-5"><option selected>0</option>
                      <option >1</option>
                      <option>2</option>
                      <option>3</option>	  
                      </select>                                             </td>
                    <td>
                    <select class="form-control custom-select" name="co6-6"><option selected>0</option>
                      <option >1</option>
                      <option>2</option>
                      <option>3</option>	  
                      </select>                                             </td>
                    <td>
                    <select class="form-control custom-select" name="co6-7"><option selected>0</option>
                      <option >1</option>
                      <option>2</option>
                      <option>3</option>	  
                      </select>                                             </td>
                    <td>
                    <select class="form-control custom-select" name="co6-8"><option selected>0</option>
                      <option >1</option>
                      <option>2</option>
                      <option>3</option>	  
                      </select>                                             </td>
                    <td>
                    <select class="form-control custom-select" name="co6-9"><option selected>0</option>
                      <option >1</option>
                      <option>2</option>
                      <option>3</option>	  
                      </select>                                             </td>
                    <td>
                    <select class="form-control custom-select" name="co6-10"><option selected>0</option>
                      <option >1</option>
                      <option>2</option>
                      <option>3</option>	  
                      </select>                                             </td>
                    <td>
                    <select class="form-control custom-select" name="co6-11"><option selected>0</option>
                      <option >1</option>
                      <option>2</option>
                      <option>3</option>	  
                      </select>                                             </td>
                    <td>
                    <select class="form-control custom-select" name="co6-12"><option selected>0</option>
                      <option >1</option>
                      <option>2</option>
                      <option>3</option>	  
                      </select>                                             </td>
                    <td>
                    <select class="form-control custom-select" name="co6-13"><option selected>0</option>
                      <option >1</option>
                      <option>2</option>
                      <option>3</option>	  
                      </select>                                             </td>
                    <td>
                    <select class="form-control custom-select" name="co6-14"><option selected>0</option>
                      <option >1</option>
                      <option>2</option>
                      <option>3</option>	  
                      </select>                                             </td>
                </tr>                   
              </tbody>
            </table>
        <button type="submit" class="btn btn-success" name='save_changes' style="margin: 1%;">Add Mappings</button>
        </form>
    </div>
    </div>
    </div>   
<?php
if(isset($_POST['save_changes']))
{
  $host="localhost";
  $user="root";
  $pass="";
  $db="co_po_map";
  $conn=new mysqli($host,$user,$pass,$db);
  $sub=explode(" ",$_POST['course'])[2];
  $sub_code=explode(" ",$_POST['course'])[3];
  $sem=explode(" ",$_POST['course'])[6];
  $year=explode(" ",$_POST['course'])[10];
  $tb_name=$sub.'|'.$sub_code;
  $name=mysqli_real_escape_string($conn,$tb_name);
  $create_query="CREATE TABLE `".$name."` ( co_code VARCHAR(30), po1 INT, po2 INT,po3 INT,
   po4 INT, po5 INT,po6 INT, po7 INT, po8 INT,po9 INT,
   po10 INT, po11 INT,po12 INT, pso1 INT, pso2 INT)";
  $result = mysqli_query($conn,$create_query) or die("ERROR".mysqli_error($conn));
  for ($x = 1; $x <= 6; $x++) {
    $num=strval($x);
    $course="co".$num;
    $co=$course."-";
    $data= array();
    for ($i=1; $i<=14;$i++){
      $map = $co.$i;
      array_push($data,$_POST[$map]);
    }
    $insert_query="INSERT INTO `".$name."` (`co_code`, `po1`, `po2`, `po3`, `po4`, `po5`, `po6`, 
    `po7`, `po8`, `po9`, `po10`, `po11`, `po12`, `pso1`, `pso2`) 
    VALUES ('$course','$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]',
    '$data[7]','$data[8]','$data[9]','$data[10]','$data[11]','$data[12]','$data[13]')";
    $insert_result = mysqli_query($conn,$insert_query) or die("ERROR".mysqli_error($conn));
  }
  echo '<script>alert("Mapping added Successfully");</script>';
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