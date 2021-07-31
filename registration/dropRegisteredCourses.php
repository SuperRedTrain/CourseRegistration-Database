
<?php
echo "<body style='background-color:#ADD8E6'></body>";

session_start();
$studentID=$_SESSION["student"];

echo "<h3>Drop Registered Courses"."</h3>";
echo "Student ID: {$studentID}"."</br> ";

?>

<form action=" " method="POST">
<p>
<label>please enter the section identifier:</label>
<input type="text" name="sectionID"/>

<p>
<input type="submit" name="submitbutton" value="submit"> <br>
</form>

<?php


if(isset($_POST['submitbutton'])){

    $secID = $_POST['sectionID'];
    echo "ID: {$secID}"."</br> ";

    // connect to the database
    $db=@new mysqli('127.0.0.1','root','');
    if ($db->connect_error)
        die('Connect error: '. $db->connect_error);
    $db->select_db('course_registration') or die('Can not connect to the database');
    
    
    //  Drop a class
    dropClass($studentID, $secID, $db);

    // Display the registered courses
    displayRegisteredCourses($studentID,$db);


}


function displayRegisteredCourses($studentID,$db)
{
    echo "<h4>Registered Courses"."</h4>";
    
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
    
}

function dropClass($studentID, $secID, $db)
{
    $sql="SELECT * FROM REGISTERED WHERE Student_ID={$studentID} AND Section_identifier={$secID};";
        
    $result=$db->query($sql);
    
    $num_courses=$result->num_rows;
    
    if($num_courses!=0){
        $sqlDrop="DELETE FROM registered WHERE Student_ID={$studentID} AND Section_identifier={$secID};";
                            
        $db->query($sqlDrop);
        
    }else{
        echo "You have not registered for this section!";        
    }
        
    
}

?>


<a href="<?php echo "studentDashboard.php" ?>">Dashboard</a></br>