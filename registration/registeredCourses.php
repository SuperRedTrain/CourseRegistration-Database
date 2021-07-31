<?php
echo "<body style='background-color:#ADD8E6'></body>";

session_start();
$studentID=$_SESSION["student"];


echo "<h3>Registered Courses"."</h3>";
echo "Student ID: {$studentID}"."</br> ";

$db=@new mysqli('127.0.0.1','root','');
if ($db->connect_error)
    die('Connect error: '. $db->connect_error);
$db->select_db('course_registration') or die('Can not connect to the database');
    
    
$sql="SELECT * FROM REGISTERED,SECTION,COURSE 
    WHERE Student_ID={$studentID} AND REGISTERED.Section_identifier=SECTION.Section_identifier AND SECTION.Course_number=COURSE.Course_number;";
    
    
$result=$db->query($sql);
    
echo '<table border="1"><tr><td>Course_name</td><td>Year</td><td>Semester</td><td>Instructor</td><td>Time</td></tr>';
    
while($row = mysqli_fetch_assoc($result)){
        
    echo "<tr><td> {$row['Course_name']}</td> ".
        "<td>{$row['Year']} </td> ".
        "<td>{$row['Semester']} </td> ".
        "<td>{$row['Instructor']} </td> ".
        "<td>{$row['Schedule_time']} </td> ".
        "</tr>";
        
}
    
echo '</table>';
echo " "."</br>";
    

?>

<a href="<?php echo "studentDashboard.php" ?>">Dashboard</a></br>