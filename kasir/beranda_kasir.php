<?php
session_start();
if(!isset ($_SESSION['username'])){
    header("Location:../index.php");
}
?>
<html>
    <body>
        ini kasir
        <a href="../logout.php"> logout</a>
    </body>
</html>