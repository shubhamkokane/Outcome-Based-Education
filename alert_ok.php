<?php
$sub = $_POST['sub'];
$sem = $_POST['sem'];
$id = $_POST['t_id'];
$branch = $_POST['branch'];
$year = $_POST['year'];
$host="localhost";
$user="root";
$pass="";
$db="college_project";
$conn=new mysqli($host,$user,$pass,$db);
$query="UPDATE `alert_db` SET `status`= 0 WHERE `teacher_id`='$id' AND `branch`='$branch'AND 
                `sub`='$sub' AND `sem`='$sem' AND `year`='$year'";
$update_query = mysqli_query($conn,$query) or die("ERROR".mysqli_error($conn));
echo "<script>alert('Updated Successfully')</script>"?>