<?php 
      session_start(); 
      require_once "conn.php";
      if (!isset($_SESSION['email'])) {
        header('location: signup.php');
      }

      $status = isset($_GET['status']) ? $_GET['status'] : NULL;
      if(isset($status) && $status === 'success'){
         echo '<script>alert("Recipe Created")</script>';
      }
 
 
      if(isset($status) && $status === 'error'){
         echo '<script>alert("An error occured while trying to save recipe")</script>';
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
    <link rel="stylesheet" href="./css/voter.css">
    <script src="https://kit.fontawesome.com/5b1f941fd6.js" crossorigin="anonymous"></script>
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
                    <p><a href="./voters.php" class="active">Voters</a></p>
                    <p><a href="./account.php">Profile</a></p>
                    <p><a href="./logout.php">Logout</a></p>
                </div>
                <div class="main">
                    <?php 
                            $query = "SELECT * FROM users";
                            if ($result = $conn ->query($query)) {
                                while($row = $result -> fetch_assoc()){
                                            
                                    $firstName=$row['first_name'];
                                    $email= $row['email'];
                                    $lastName= $row['last_name'];
                                    $address= $row['address'];
                                    $phoneNumber= $row['phoneNumber'];
                                    $userType = $row['userType'];
                                    $profilePicture = $row['picture'];
                                    $id= $row['id'];
                             
                    
                    
                    ?>
                    <div class="card">
                        <div
                            style="position: absolute; display: flex; flex-direction: column; gap: 40px; top: 20px; right: 20px; z-index: 20;">
                            <a style="font-size: 17px;" href="editVoter.php"><i
                                    class="fa-solid fa-pen-to-square"></i></a>
                            <a style="font-size: 17px;" href="delete.php"> <i class="fa-solid fa-trash"></i></a>
                        </div>
                        <?php if($profilePicture): ?>
                        <img src="./saved/<?php echo $profilePicture ?>" alt="John"
                            style="width:100%; height: 360px; object-fit:fill;  filter: brightness(85%);">
                        <?php else: ?>
                        <img src="./images/profile.jpg" alt="John"
                            style="width:100%; height: 360px; object-fit: contain;">
                        <?php endif; ?>
                        <h2><?php echo $firstName; ?> <?php echo $lastName; ?></h2>
                        <p class="title"><?php echo $userType ?></p>
                        <p><?php echo $phoneNumber; ?></p>

                        <a href="?id=<?php echo $id; ?>#demo-modal" class="btn"><button>View Profile</button></a>
                    </div>

                    <?php    } } ?>
                </div>
            </div>
        </div>
    </div>
    <div id="demo-modal" class="modal">

        <?php 
            $userId = $_GET['id'];
            $query = "SELECT * FROM users WHERE users.id =  $userId";

            $results1 = mysqli_query($conn, $query);
            $user = mysqli_fetch_assoc($results1);
            
            $name = $user['first_name']. " ". $user['last_name'];
            $email = $user['email'];
            $phoneNumber = $user['phoneNumber'];
            $address = $user['address'];
            $userType = $user['userType'];
            
        ?>
        <div class="modal__content">
            <h1>Profile Info</h1>

            <p>
                Name: <?php echo $name; ?>
            </p>
            <p>
                email: <?php echo $email; ?>
            </p>

            <p>
                phoneNumber: <?php echo $phoneNumber; ?>
            </p>

            <p>
                address: <?php echo $address; ?>
            </p>

            <div class="modal__footer">

            </div>

            <a href="#" class="modal__close">&times;</a>
        </div>
    </div>
</body>

</html>