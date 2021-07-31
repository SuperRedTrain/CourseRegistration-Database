<?php
echo "<body style='background-color:#F08080'></body>";

session_start();
$adminID=$_SESSION["admin"];

// echo "Admin ID: {$adminID}"."</br> ";
echo "<h3>Login success!!   Welcome  Administrator!"."</h3>";

?>

<a href="<?php echo "addSection.php" ?>">Add New Sections</a></br>

<a href="<?php echo "deleteSection.php" ?>">Delete Sections</a></br>