<?php
session_start();
include '../config.php';
if(!isset ($_SESSION['username'])){
    header("Location:../index.php");
}
?>
<html>
    <body>
        ini super user
        <a href="../logout.php"> logout</a>
    </body>
</html>