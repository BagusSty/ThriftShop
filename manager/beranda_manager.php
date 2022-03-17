<?php
session_start();
if(!isset ($_SESSION['username'])){
    header("Location:../index.php");
}
?>
<html>
    <body>
        ini admin
        <a href="../logout.php"> logout</a>
    </body>
</html>