<body style="background-color: #ADD8E6"></body>
<form action=" " method="post">

   <!--Year-->
    <select name="Year" >Year
        <option value="2019">2019</option>
        <option value="2020">2020</option>
        <option value="2021">2021</option>
    </select>
    <!--Semester-->
    <select name="Semester" >Semester
        <option value="Fall">Fall</option>
        <option value="Spring">Spring</option>
        <option value="Summer">Summer</option>
    </select>


    <input type="submit" name="submitbutton" value="submit"> <br>
</form>

<?php

if(isset($_POST['submitbutton'])){
    $year = $_POST['Year'];
    $semester = $_POST['Semester'];
 
    
    echo "<h3>Available Sections for {$year} {$semester}"."</h3>";
    
    
    $db=@new mysqli('127.0.0.1','root','');
    if ($db->connect_error)
        die('Connect error: '. $db->connect_error);
    $db->select_db('course_registration') or die('Can not connect to the database');
        
        
    $sql="SELECT * FROM SECTION WHERE Year={$year} AND Semester='{$semester}';";

    
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
?>

<a href="<?php echo "studentDashboard.php" ?>">Dashboard</a></br>