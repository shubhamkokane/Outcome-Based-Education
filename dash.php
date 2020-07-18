<!DOCTYPE html>
<?php
// Start the session
session_start();
$desgn=$_SESSION["desgn"];
$branch=$_SESSION["branch"];
$id = $_SESSION['user_id'];
$host="localhost";
$user="root";
$pass="";
$db="college_project";
$conn=new mysqli($host,$user,$pass,$db);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/3857a76116.js" crossorigin="anonymous"></script>
    <style>
        .fa-times-circle {
  color: red;
}
.fa-check-circle
{
    color: green;
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
            <li class="nav-item active">
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

      <div class="container-fluid">
        <form class="needs-validation" method="post" action="" novalidate>
            <div class="form-row" style="margin-top: 2%">
            <div class="form-group" style="margin-left: 0.5%;margin-right:1%">
                <select name="course" class="form-control custom-select" required>
                  <option value="" disabled selected>Choose Course</option>
                  <?php
                  if($desgn==3)
                  {
                    $q_sub="SELECT * FROM $branch WHERE teacher_id='$id'";
                  }
                  else if($desgn==2){
                    $q_sub="SELECT * FROM $branch WHERE 1";
                  }
                  $sub_display = mysqli_query($conn,$q_sub) or die("ERROR".mysqli_error($conn));
                    while($row1 = mysqli_fetch_array($sub_display)){
                  ?>
                <option><?echo "Subject : ".$row1['sub_name']." ".$row1['subject-code']." Semester : ".$row1['semester']." || Year : ".$row1['year']; ?></option>
                    <?}?>
                </select>
              </div>
              <div class="form-group" style="margin-right: 1%">
              <button class="btn btn-success" name="search">Search</button>
              </div>
              <div class="form-group">
              <button class="btn btn-danger" name="remove">Remove from Dashboard</button>
              </div>
              </div>
         </form>
        <div class="row" >
          <div class='col-12' style="height:60vh; overflow-y: scroll;">
          <table class="table table-striped">
            <thead style="background-color:white;position: sticky; top: 0;">
              <tr>
                <th scope="col">Sr.No.</th>
                <th scope="col">Subject</th>
                <th scope="col"<?if($desgn==3){echo'style="display: none"';}?>>Teacher</th>
                <th scope="col">Semester-Year</th>
                <th scope="col">CO Specification</th>
                <th scope="col">PO Specification</th>
                <th scope="col">CO-PO Mapping</th>
                <th scope="col">Marks Mapping</th>
                <?php
                if($desgn==2){
                  echo '<th scope="col">Send Alert</th>';
                }
                ?>
              </tr>
            </thead>
            <?php  
            
            if($desgn==3){
              $q_disp="SELECT * FROM `dash_data` WHERE t_id='$id'";
            }
            else if($desgn==2){
              $q_disp="SELECT * FROM `dash_data` WHERE branch='$branch'";
            }
            if(isset($_POST['search'])){
              $sub=explode(" ",$_POST['course'])[2];
              $sub_code=explode(" ",$_POST['course'])[3];
              $sem=explode(" ",$_POST['course'])[6];
              $year=explode(" ",$_POST['course'])[10];
              $q_disp="SELECT * FROM `dash_data` WHERE sub='$sub' AND sem='$sem' AND year='$year' AND branch='$branch'";
            }
                  $result_display = mysqli_query($conn,$q_disp) or die("ERROR".mysqli_error($conn));
                  $no=1;
                  while ( $row_display = mysqli_fetch_array($result_display) )
                    {
                    ?>
                    <tr>
                    <td><?echo $no; ?></td>
                    <td><?echo $row_display['sub']; ?></td>
                    <td <?if($desgn==3){echo'style="display: none"';}?>><?echo $row_display['f_name']." ".$row_display['s_name']; ?></td>
                    <td><?echo "Semester : ".$row_display['sem']." || Year : ".$row_display['year']; ?></td>
                    <td><?php
                    if($row_display['co_spec']==1){echo '<i class="fas fa-check-circle"></i>';}
                    else{echo '<i class="fas fa-times-circle"></i>';}
                      ?>
                    </td>
                    <td><?php
                    if($row_display['po_spec']==1){echo '<i class="fas fa-check-circle"></i>';}
                    else{echo '<i class="fas fa-times-circle"></i>';}
                      ?>
                    </td>
                    <td><?php
                    if($row_display['co_po_map']==1){echo '<i class="fas fa-check-circle"></i>';}
                    else{echo '<i class="fas fa-times-circle"></i>';}
                      ?>
                    </td>
                    <td><?php
                    if($row_display['marks_map']==1){echo '<i class="fas fa-check-circle"></i>';}
                    else{echo '<i class="fas fa-times-circle"></i>';}
                      ?>
                    </td>
                    <?php
                if($desgn==2){?>
                  <td scope="col">
                  <button type="button" class="btn btn-primary" onclick="setEventId('<?php echo $row_display['t_id'] ?>',
                                                                                    '<?php echo $row_display['sub'] ?>',
                                                                                    '<?php echo 'Semester : '.$row_display['sem'].' || Year : '.$row_display['year']; ?>',
                                                                                    '<?echo $row_display['f_name'].' '.$row_display['s_name']; ?>',
                                                                                    '<?echo $branch; ?>')"
                  data-toggle="modal" data-target="#alert_modal" name="alert">Send</button>
                  </td>
                <?}?>
                  </tr>
                  <?php
                  $no = $no +1;
                  }?>
          </table>
        </div>
    </div> 
  </div>
  <div class="modal fade" id="alert_modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Alerts</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
       <h6><strong>Teacher-Id</strong> : <span id='t_id'></span></h6>
       <h6><strong>Teacher</strong> : <span id='t_name'></span></h6>
       <h6><strong>Course</strong> : <span id='sub'></span>  <span id='sem'></span></h6>
       <div class="form-group">
          <textarea class="form-control" id="msg" name="msg" rows="3" placeholder="You can enter any personalized alert for the teacher over here !!!"></textarea>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary"  onclick="passVal()" data-dismiss="modal">Send Alert</button>
      </div>
    </div>
  </div>
</div>

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
<script type="text/javascript">
var teacher_id;
var subject;
var semester;
var name;
var dept;
    function setEventId(t_id,sub,sem,t_name,branch){
      document.querySelector("#t_id").innerHTML = t_id;
      document.querySelector("#sub").innerHTML = sub;
      document.querySelector("#sem").innerHTML = sem;
      document.querySelector("#t_name").innerHTML = t_name; 
      teacher_id=t_id;
      subject=sub;
      semester=sem;
      dept=branch;
    }
    function current(){
      alert("Under Development !!")
    }
    
    function passVal(){
       var msg = document.getElementById("msg").value;
       var data = {sub:subject,sem:semester,t_id:teacher_id,branch:dept,mess:msg};
        $.post("alert_insert.php",data,
        function(data){
            $('#result').html(data)
        });
    }
   </script>
   <div id='result'></div>
</body>
</html>