<?php
echo "<body style='background-color:#ADD8E6'></body>";

session_start();
$studentID=$_SESSION["student"];

echo "<h3>Registration"."</h3>";
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
    
    
    //  Register for a class
    registering($studentID, $secID, $db);

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

function registering($studentID, $secID, $db)
{

    $sql="SELECT * FROM REGISTERED WHERE Student_ID={$studentID} AND Section_identifier={$secID};";
        
    $result=$db->query($sql);
    
    $num_courses=$result->num_rows;
    
    if($num_courses==0){
        // Find out PREREQUISITE.Course_number
 //       $sqlpre="SELECT * FROM SECTION,PREREQUISITE WHERE Section_identifier={$secID} AND SECTION.Course_number=PREREQUISITE.Course_number;";        
 //       $preresult=$db->query($sqlpre);       
        
        // Find out Course_numbers that the student got grades
//        $sqlpreGrade="SELECT * FROM GRADE,SECTION
//                    WHERE Student_ID={$studentID} AND Grade.Section_identifier=SECTION.Section_identifier;";        
//       $preresultGrade=$db->query($sqlpreGrade);        

        
 //       $sqlpre="SELECT * FROM GRADE,SECTION
 //                   WHERE Student_ID={$studentID} AND Grade.Section_identifier=SECTION.Section_identifier
 //                   AND SECTION.Course_number={ SELECT PREREQUISITE.Prerequisite_number
 //                                               FROM PREREQUISITE,SECTION
 //                                               WHERE Section_identifier={$secID} AND SECTION.Course_number=PREREQUISITE.Course_number};";

       
        
        
        $sqlpre="SELECT *
                    FROM (SELECT Prerequisite_number as CourseNum  FROM SECTION,PREREQUISITE WHERE Section_identifier={$secID} AND SECTION.Course_number=PREREQUISITE.Course_number) A
                    LEFT JOIN (SELECT Course_number as CourseNum FROM GRADE,SECTION WHERE Student_ID={$studentID} AND Grade.Section_identifier=SECTION.Section_identifier) B 
                    ON A.CourseNum=B.CourseNum
                    WHERE B.CourseNum IS NULL;";
        $preresult=$db->query($sqlpre); 
        
        $precourses=$preresult->num_rows;
        
        if($precourses== 0){
            
            $sqlInsert="INSERT INTO registered
                    VALUES ({$studentID}, {$secID});";
            
            $db->query($sqlInsert);
            
        }else{            
            echo "Prerequisites have not been met!";        
        }
                
    }else{
        echo "You have registered for this section!";        
    }
        
    
}

?>


<a href="<?php echo "studentDashboard.php" ?>">Dashboard</a></br>