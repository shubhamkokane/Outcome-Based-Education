<?php
$sub=$_POST['sub'];
$sem=explode(" ",$_POST['sem'])[2];
$year=explode(" ",$_POST['sem'])[6];
$id=$_POST['t_id'];
$branch=$_POST['branch'];
$mess=$_POST['mess'];
if(empty($mess)){$mess= 'Alert from the HOD for completion of the task !!';}
$host="localhost";
$user="root";
$pass="";
$db="college_project";
$conn=new mysqli($host,$user,$pass,$db);
$query="INSERT INTO `alert_db`(`teacher_id`, `branch`, `sub`, `sem`, `year`, `message`, `status`) 
        VALUES ('$id','$branch','$sub','$sem','$year','$mess',1)";
$insert_query = mysqli_query($conn,$query) or die("ERROR".mysqli_error($conn));
echo "<script>alert('Alert sent successfully !!')</script>"
?>