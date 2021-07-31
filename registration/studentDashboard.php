<?php
echo "<body style='background-color:#87CEFA'></body>";

session_start();
$studentID=$_SESSION["student"];

$db=@new mysqli('127.0.0.1','root','');
if ($db->connect_error)
    die('Connect error: '. $db->connect_error);
$db->select_db('course_registration') or die('Can not connect to the database');


$sql='SELECT * FROM STUDENT WHERE Student_ID='."'{$studentID}';";
$result=$db->query($sql);

while($row = mysqli_fetch_assoc($result)){
    $name = $row['Name'];
    echo "<h3>Login success!!   Welcome  {$name}!"."</h3>";

    echo "Student ID: {$row['Student_ID']}"."</br> ";
    echo "Major: {$row['Major']}"."</br> ";
    echo "Email: {$row['Email']}"."</br> ";
    echo "Address: {$row['Address']}"."</br> ";
    echo "Phone: {$row['Phone_number']}"."</br>";
    echo "College: {$row['College']}"."</br>";
    echo "Admit term: {$row['Admit_term']}"."</br>";
    echo "Current program: {$row['Current_program']}"."</br>";
    echo ""."</br>";
}


?>

<a href="<?php echo "transcript.php" ?>">View Transcript</a></br>

<a href="<?php echo "courseRegistration.php" ?>">Course Registration</a></br>

<a href="<?php echo "courses.php" ?>">Available Courses</a></br>

<a href="<?php echo "registeredCourses.php" ?>">Registered Courses</a></br>

<a href="<?php echo "dropRegisteredCourses.php" ?>">Drop Registered Courses</a></br>
