<?php 
      require_once "conn.php";
      session_start();
      $nameErr = "";  
      $emailErr = "";  
      $passwordErr = "";  
      $exceptionErr = NULL;
      $message = NULL;
      $firstName = "";  
      $lastName = "";  
      $userType= "";
      $email = "";  
      $passwordErr = "";  

      
     function test_input($data) {  
        $data = trim($data);  
        $data = stripslashes($data);  
        $data = htmlspecialchars($data);  
        return $data;  
      }
      if(isset($_POST['login_user'])){
        if (empty($_POST["name"])) {  
          $nameErr = "Name Field is required";  
        } else {  
          $name = test_input($_POST["name"]);  
          if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {  
            $nameErr = "Only letters and white space allowed";
          }   
        }  
      
    
        if (empty($_POST["email"])) {  
          $emailErr = "Email field is required";  
        } else {  
          $email = test_input($_POST["email"]);  
          if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {  
            $emailErr = "Invalid email format";  
          }  
        } 
      
        if (empty($_POST["password"])) {  
          $password = "";  
        } else {  
          $password = test_input($_POST["password"]);  
        }  
    
    
        if(!empty($email) && !empty($password)){
          $query1 =  "SELECT * FROM users WHERE email='$email' AND password='$password'";
          $results1 = mysqli_query($conn, $query1);
          if (mysqli_num_rows($results1) == 1) {
            $user = mysqli_fetch_assoc($results1);
            $_SESSION['name'] =  $user['name'];
            $_SESSION['id'] = $user['id'];
            $_SESSION['email'] = $email;
            $_SESSION['loggedIn'] = true;
            $message = 'You are now logged in';
            header('location: dashboard.php');
          } else {
            $exceptionErr =  "An Error occured while loggingIn user";
            
           
          }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in</title>
    <link rel="stylesheet" href="css/signup.css">
</head>

<body>
    <div class="container">
        <div class="sign_up_content">
            <div class="image">
                <img src="images/signin-image.jpg" alt="signin-image">
            </div>

            <div class="sign_up">
                <div class="sign_up_1">
                    <p>Sign in</p>
                </div>

                <?php if(isset($exceptionErr)): ?>
                <div class="error"><?php echo $exceptionErr; ?></div>
                <?php endif; ?>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <input type="text" name="email" placeholder="Your Email">
                    <br><br>
                    <input type="text" name="password" placeholder="Password">
                    <br><br>
                    <div class="remember">
                        <p>Remember me</p>
                    </div>

                    <button type="submit" name="login_user" class="btn"
                        style="background-color: #6dabe4; color: white; padding: 16px 30px; border-radius: 5px; cursor: pointer; outline:none; border: none;">Log
                        in</button>

                </form>

            </div>
        </div>
        <div class="info">
            <div class="c_account">
                <a href="./signup.php">Create an account</a>
            </div>
            <div class="log_in_2">
                <p>Or login with....</p>
            </div>
        </div>
    </div>

</body>

</html>