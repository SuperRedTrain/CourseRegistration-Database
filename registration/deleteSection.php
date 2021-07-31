<?php
echo "<body style='background-color:#FFB6C1'></body>";

session_start();
$adminID=$_SESSION["admin"];


echo "<h3>Delete Sections"."</h3>";

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
    
    // connect to the database
    $db=@new mysqli('127.0.0.1','root','');
    if ($db->connect_error)
        die('Connect error: '. $db->connect_error);
    $db->select_db('course_registration') or die('Can not connect to the database');
        
        
    // Delete a section
    deleteSection($secID, $db, $adminID);
        
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

function deleteSection($secID, $db, $adminID)
{
    if ($adminID == 111111){
        $sql="SELECT * FROM SECTION WHERE Section_identifier={$secID};";
        $result=$db->query($sql);
        
        $num_courses=$result->num_rows;
        if($num_courses!=0){
            
            $sqlDel="DELETE FROM section WHERE Section_identifier={$secID};";
                        
            
            $db->query($sqlDel);
                       
        }else{
            echo "This section does not exist!";
        }
        
        
    }else{
        echo "Please log in first.";
    }
}

?>


<a href="<?php echo "adminDashboard.php" ?>">Dashboard</a></br>