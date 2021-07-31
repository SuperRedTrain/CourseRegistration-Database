<?php
echo "<body style='background-color:#ADD8E6'></body>";

session_start();
$studentID=$_SESSION["student"];



$db=@new mysqli('127.0.0.1','root','');
if ($db->connect_error)
    die('Connect error: '. $db->connect_error);
$db->select_db('course_registration') or die('Can not connect to the database');
        

$sql="SELECT * FROM GRADE,SECTION,COURSE
WHERE Student_ID={$studentID} AND GRADE.Section_identifier=SECTION.Section_identifier AND SECTION.Course_number=COURSE.Course_number;";
    
$result=$db->query($sql);

echo "<h3>TRANSCRIPT"."</h3>";
echo "Student ID: {$studentID}"."</br> ";

echo '<table border="1"><tr><td>Course_number</td><td>Section_identifier</td><td>Course_name</td><td>Year</td><td>Semester</td><td>Grade</td></tr>';

while($row = mysqli_fetch_assoc($result)){
   
//    echo "Course_number: {$row['Course_number']}";
//    echo "Section_identifier: {$row['Section_identifier']}";
//    echo "Course_name: {$row['Course_name']}";
//    echo "Grade: {$row['Grade']}"."</br> ";
    
    
    echo "<tr><td> {$row['Course_number']}</td> ".
        "<td>{$row['Section_identifier']} </td> ".
        "<td>{$row['Course_name']} </td> ".
        "<td>{$row['Year']} </td> ".
        "<td>{$row['Semester']} </td> ".
        "<td>{$row['Grade']} </td> ".
        "</tr>";

}

echo '</table>';
echo ""."</br>";

?>

<a href="<?php echo "studentDashboard.php" ?>">Dashboard</a></br>
