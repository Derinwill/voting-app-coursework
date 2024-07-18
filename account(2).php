<?php 
      session_start(); 
      require_once "conn.php";
      if (!isset($_SESSION['email'])) {
        header('location: signup.php');
      }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>account(2)</title>
    <link rel="stylesheet" href="css/account(2).css">
</head>

<body>
    <header>
        <div class="top_bar">
            <div class="search_now">
                <input placeholder="Search now" class="draft" />
            </div>
            <div class="images">
                <img src="images/profile.jpg" alt="face28">
            </div>
        </div>
    </header>
    <div class="container">
        <div class="display_flex">
            <div class="sidebar">
                <a href="./dashboard.html">Dashboard</a>
                <p>Profile</p>
            </div>
            <div class="account">
                <div class="acc">
                    <p>Account</p>
                </div>
                <div class="details">
                    <a href="./account.html">Personal Details</a>
                    <p class="change_password">Change password</p>
                    <p>Withdrawal setting</p>
                </div>
                <div class="c_password">
                    <p class="change_p">Change password</p>
                    <p>Please enter your current password to change your password.</p>
                </div>
                <div class="password_info">
                    <label for="password">Current password</label>
                    <input type="password" id="Currentpassword">
                    <br><br>
                    <label for="password">New password</label>
                    <input type="password" id="Newpassword">
                    <br><br>
                    <label for="password">Confirm new password</label>
                    <input type="password" id="Confirmnewpassword">
                </div>
                <div class="cancel_save">
                    <div class="cancel">
                        <button>Cancel</button>
                    </div>
                    <div class="save">
                        <button>Save</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>

</html>