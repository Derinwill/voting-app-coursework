<?php 
       session_start(); 
       require_once "conn.php";
       if (!isset($_SESSION['email'])) {
         header('location: signin.php');
       }
       header('location: dashboard.php');
?>