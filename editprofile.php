<?php 
      session_start(); 
      require_once "conn.php";
      if (!isset($_SESSION['email'])) {
        header('location: signup.php');
      }
      
      $status = isset($_GET['status']) ? $_GET['status'] : NULL;
      if(isset($status) && $status === 'success'){
         echo '<script>alert("Account Updated")</script>';
      
      }
 
 
      if(isset($status) && $status === 'error'){
         echo '<script>alert("An error occured while trying to save recipe")</script>';
      }


     
      $userId =  isset($_GET['user_id']) ? $_GET['user_id'] : null;

      $firstName="";
      $email="";
      $lastName="";
      $address="";
      $phoneNumber="";
      $profilePicture = "";



      if($userId){
        $query = "SELECT * FROM users WHERE id = $userId";
        try{
          $results1 =  mysqli_query($conn, $query);
          $user = mysqli_fetch_assoc($results1);
          $firstName =$user['first_name'];
          $lastName =$user['last_name'];
          $email =$user['email'];
          $phoneNumber = $user['phoneNumber'];
          $address= $user['address'];
          $profilePicture = $user['picture'];
          $location = $user['location'];
        }catch(Exception $e){
            echo $e;
            echo '<script>alert("An Error occured while getting using profile")</script>';
            
            return;
        }

    }


    if(isset($_POST['update_user'])){
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $phoneNumber = $_POST['phoneNumber'];
        $address = $_POST['address'];
        $email = $_POST['emailAddress'];
        $imgContent = null;
        $filename = null;
        $tempname = null;
        $folder = null;
        $location = $_POST['location'];


        if (isset($_FILES["uploadfile"]) && $_FILES["uploadfile"]["error"] == 0) {
            $filename = $_FILES["uploadfile"]["name"];
            $tempname = $_FILES['uploadfile']['tmp_name'];
            $imgContent = file_get_contents($tempname);
            $folder = "./saved/" . $filename;
        }
        $query = null;
        if ( $filename !== null) {
            $query = "UPDATE users SET first_name = ?, last_name = ?, phoneNumber = ?, email = ?, address = ?, picture = ?, location = ? WHERE id = ?";
            $idUser = $_GET['user_id'];
            try{
                $stmt = $conn->prepare($query);
                $stmt->bind_param('sssssssi', $firstName, $lastName, $phoneNumber, $email, $address, $filename, $location,  $idUser);
                $stmt->execute();
                move_uploaded_file($tempname, $folder);
              
                header("location: voters.php");
              }catch(Exception $e){
                  echo $e;
                  echo '<script>alert("Image upload failed, Please try again")</script>';
                 
                  return;
              }
           
        } else {
            $idUser = $_GET['user_id'];
            $query = "UPDATE users SET first_name = ?, last_name = ?, phoneNumber = ?, email = ?, address = ?, location = ? WHERE id = ?";
            
            try{
                $stmt = $conn->prepare($query);
                $stmt->bind_param('ssssssi', $firstName, $lastName, $phoneNumber, $email, $address, $location, $idUser);
                $stmt->execute();
              
                header("location: voters.php");
              }catch(Exception $e){
                  echo $e;
                  echo '<script>alert("Image upload failed, Please try again")</script>';
                  return;
              }
         
        }
 
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
                    <?php if($user['picture']): ?>

                    <img src="./saved/<?php echo $user['picture'];?>" alt="profile_image" width="50" height="50"
                        style="border-radius: 50%;">
                    <?php else: ?>
                        <img src="images/profile.jpg" alt="face28" width="20" height="20">

                    <?php endif; ?>

                    <p> <?php echo $user['last_name'];?> <?php echo $user['first_name']; ?></p>
                </div>
            </div>
        </header>
        <div class="container">
            <div class="display_flex">
                <div class="sidebar">
                    <p><a href="./dashboard.php">Dashboard</a></p>
                    <?php if($user['userType'] === 'admin' || $user['userType'] === 'election_officer' ): ?>
                    <p><a href="./voters.php">Voters</a></p>
                    <?php endif ?>
                    <p><a href="./account.php" class="active">Profile</a></p>
                    <p><a href="./logout.php">Logout</a></p>
                </div>
                <form class="account" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"
                    enctype="multipart/form-data">
                    <div class="acc">
                        <p>Update User</p>
                    </div>
                    <div class="details">
                        <!-- <p class="p_details">Personal Details</p> -->
                        <!-- <a href="./account(2).html">Change password</a> -->

                    </div>

                    <div class="info">
                        <label for="fname">Upload an Image</label>
                        <div style="display: flex; flex-direction: column; align-items: flex-start;">
                            <?php if($profilePicture): ?>
                            <img src="./saved/<?php echo $profilePicture; ?>" alt="profile_image"
                                style="width: 200px; height: 200px; border-radius: 50%; margin-top: 10px;" />
                            <?php else: ?>

                            <img src="./images/profile.jpg" alt="profile_image"
                                style="width: 200px; height: 200px; border-radius: 50%; margin-top: 10px;" />
                            <?php endif ?>
                            <input style="padding-left: 2px; padding-top: 10px;" type="file" name="uploadfile"
                                class="form-control" id="image">

                        </div>

                        <label for="name">First Name</label>
                        <input type="text" id="firstName" name="firstName" value="<?php echo $firstName; ?>"><br><br>
                        <label for="name">Last Name</label>
                        <input type="text" id="lastName" name="lastName" value="<?php echo $lastName; ?>"><br><br>

                        <label for="email">Email address</label>
                        <input type="email" id="Emailaddress" name="emailAddress" value="<?php echo $email; ?>"><br><br>
                        <label for="number">Phone number</label>
                        <input type="text" id="Phonenumber" name="phoneNumber"
                            value="<?php echo $phoneNumber; ?>"><br><br>
                        <label for="">Select Location</label>
                        <select name="location" required>
                            <option value="">Select Location</option>
                            <option value="bristol" <?php echo $location === 'bristol' ? 'selected' : '' ?>>Bristol
                            </option>
                            <option value="blackpool" <?php echo $location === 'blackpool' ? 'selected' : '' ?>>
                                Blackpool</option>
                            <option value="cornwall" <?php echo $location === 'cornwall' ? 'selected' : '' ?>>Cornwall
                            </option>
                            <option value="cumbria" <?php echo $location === 'cumbria' ? 'selected' : '' ?>>Cumbria
                            </option>
                            <option value="derby" <?php echo $location === 'derby' ? 'selected' : '' ?>>Derby</option>
                            <option value="derbyshire" <?php echo $location === 'derbyshire' ? 'selected' : '' ?>>
                                Derbyshire</option>
                        </select>
                        <br><br>
                        <label for="address">Address</label>
                        <input type="address" id="Address" name="address" value="<?php echo $address; ?>"><br><br>
                    </div>
                    <div class="cancel_save">
                        <div class="cancel">
                            <button>Cancel</button>
                        </div>
                        <div class="save">
                            <button type="submit" name="update_user">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>