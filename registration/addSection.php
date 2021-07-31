<?php
echo "<body style='background-color:#FFB6C1'></body>";

session_start();
$adminID=$_SESSION["admin"];


echo "<h3>Add Sections"."</h3>";

?>

<form action=" " method="POST">
<p>
<label>Section Identifier:</label>
<input type="text" name="sectionID"/>
<p>
<label>Section Number:</label>
<input type="text" name="sectionNum"/>
<p>
<label>Year:</label>
<input type="text" name="year"/>
<p>
<label>Semester:</label>
<input type="text" name="semester"/>
<p>
<label>Instructor:</label>
<input type="text" name="instructor"/>
<p>
<label>Schedule Time:</label>
<input type="text" name="time"/>
<p>
<input type="submit" name="submitbutton" value="submit"> <br>
</form>

<?php

if(isset($_POST['submitbutton'])){
    
    $secID = $_POST['sectionID'];
    $secNum = $_POST['sectionNum'];
    $secYear = $_POST['year'];
    $secSem = $_POST['semester'];
    $secInst = $_POST['instructor'];
    $secTime = $_POST['time'];
    
    
    // connect to the database
    $db=@new mysqli('127.0.0.1','root','');
    if ($db->connect_error)
        die('Connect error: '. $db->connect_error);
    $db->select_db('course_registration') or die('Can not connect to the database');
        
        
    //  Add a section
    insertSection($secID, $secNum, $secYear, $secSem, $secInst, $secTime, $db, $adminID);
        
    // Display all the sections
    displaySections($db);
        
        
}



// Display all the sections
function displaySections($db)
{
    $sql="SELECT * FROM SECTION;";
    
    $result=$db->query($sql);

    echo '<table border="1"><tr><td>Section_identifier</td><td>Course_number</td><td>Year</td><td>Semester</td><td>Instructor</td><td>Time</td></tr>';
    
    while($row = mysqli_fetch_assoc($result)){
        
        echo "<tr><td> {$row['Section_identifier']}</td> ".
            "<td>{$row['Course_number']} </td> ".
            "<td>{$row['Year']} </td> ".
            "<td>{$row['Semester']} </td> ".
            "<td>{$row['Instructor']} </td> ".
            "<td>{$row['Schedule_time']} </td> ".
            "</tr>";        
    }
    
    echo '</table>';
    echo " "."</br>";
}

function insertSection($secID, $secNum, $secYear, $secSem, $secInst, $secTime, $db, $adminID)
{
    if ($adminID == 111111){
        $sql="SELECT * FROM SECTION WHERE Section_identifier={$secID};";
        $result=$db->query($sql);
        
        $num_courses=$result->num_rows;
        if($num_courses==0){
            
            $sqlInsert="INSERT INTO section
                        VALUES ({$secID},{$secNum},{$secYear},'{$secSem}','{$secInst}','{$secTime}');";
            
            $db->query($sqlInsert);
            

            
        }else{
            echo "This section was added already!";
        }
        
        
    }else{
        echo "Please log in first.";
    }
}

?>


<a href="<?php echo "adminDashboard.php" ?>">Dashboard</a></br>