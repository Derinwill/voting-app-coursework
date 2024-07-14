<?php
session_start(); 
require_once "conn.php";
$id = $_GET['id'];

$query = "DELETE FROM users WHERE id = '$id'";
mysqli_query($conn, $query);
header('location:voters.php?status=success');