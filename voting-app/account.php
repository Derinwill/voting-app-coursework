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
    <title>Account</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="./css/account.css">
</head>

<body>
    <div class="wrapper">
        <header>
            <p class="logo">Voting Brook</p>
            <div class="top_bar">
                <div class="search_now">
                    <input placeholder="Search now" class="draft" />
                </div>
                <div class="profile_info">
                    <?php 
                    $userId = $_SESSION['id'];
                    $query = "SELECT * FROM users WHERE users.id =  $userId";
                    $results1 = mysqli_query($conn, $query);
                    $user = mysqli_fetch_assoc($results1);
                
                ?>
                    <p>status: <span class="status"><?php echo $user['userType'] ?></span> </p>
                    <img src="images/face28.jpg" alt="face28">
                    <p> <?php echo $user['last_name'];?> <?php echo $user['first_name']; ?></p>
                </div>
            </div>
        </header>
        <div class="container">
            <div class="display_flex">
                <div class="sidebar">
                    <p><a href="./dashboard.php">Dashboard</a></p>
                    <p><a href="./account.php" class="active">Profile</a></p>
                    <p><a href="./logout.php">Logout</a></p>
                </div>
                <div class="account">
                    <div class="acc">
                        <p>Account</p>
                    </div>
                    <div class="details">
                        <p class="p_details">Personal Details</p>
                        <a href="./account(2).html">Change password</a>
                        <p>Withdrawal setting</p>
                    </div>
                    <div class="personal_details">
                        <p class="personal_d">Personal details</p>
                        <p>Manage your personal information on your HOME-MED account.</p>
                    </div>
                    <div class="info">
                        <label for="name">Pharmacy Name</label>
                        <input type="text" id="Pharmacy"><br><br>
                        <label for="email">Email address</label>
                        <input type="email" id="Emailaddress"><br><br>
                        <label for="number">Phone number</label>
                        <input type="number" id="Phonenumber"><br><br>
                        <label for="address">Address</label>
                        <input type="address" id="Address"><br><br>
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
    </div>
</body>

</html>