<?php
$userID = $_POST['UserID'];//
$password = $_POST['Password'];//

$db=@new mysqli('127.0.0.1','root','');
if ($db->connect_error)
    die('Connect error: '. $db->connect_error);
$db->select_db('course_registration') or die('Can not connect to the database');
    

$sql='SELECT * FROM STUDENT WHERE Student_ID='."'{$userID}'AND Password="."'$password';";
$result=$db->query($sql);
$num_users=$result->num_rows;


if($num_users!=0){
    
    
    if($userID == 111111){
        
        session_start();
        $_SESSION["admin"]=$userID;
        
        header("location:adminDashboard.php");
        
    }else{
        
        session_start();
        $_SESSION["student"]=$userID;
        
        header("location:studentDashboard.php");
        
    }
    
            

}else{
    echo "Failed to login!";
}

?>
