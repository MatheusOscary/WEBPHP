<?php
    session_start();
    
    unset($_SESSION['UserId']);
    unset($_SESSION['Token']);

    Header("location: login.php"); 
?>