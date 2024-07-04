<?php
session_start();
unset($_SESSION['id']);
unset($_SESSION['email']);
unset($_SESSION['name']);
unset($_SESSION['loggedIn']);
header("location: signin.php");