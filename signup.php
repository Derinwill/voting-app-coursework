<?php 
     require_once "conn.php";
     session_start();
     
     $nameErr = "";  
     $userTypeErr= "";
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
   if (isset($_POST['reg_user'])) {  
       if (empty($_POST["first_name"])) {  
         $nameErr = "Firstname Field is required";  
       } else {  
         $firstName = test_input($_POST["first_name"]);  
         if (!preg_match("/^[a-zA-Z-' ]*$/",$firstName)) {  
           $nameErr = "Only letters and white space allowed"; 
         }   
       }  

       if (empty($_POST["last_name"])) {  
        $nameErr = "Lastname Field is required";  
      } else {  
        $lastName = test_input($_POST["last_name"]);  
        if (!preg_match("/^[a-zA-Z-' ]*$/", $lastName)) {  
          $nameErr = "Only letters and white space allowed"; 
        }   
      }  
  
   
       if (empty($_POST["userType"])) {  
         $userTypeErr = "User Type Field is required";  
       } else {  
         $userType = test_input($_POST["userType"]);  
         if (!preg_match("/^[a-zA-Z-' ]*$/",$userType )) {  
           $userTypeErr = "Only letters and white space allowed"; 
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
         $passwordErr = "Password field is required";   
       } else {  
         $password = test_input($_POST["password"]);  
       }  
    
   
     if(!empty($firstName) && !empty($lastName) && !empty($email) && !empty($password) && !empty($userType)){
       $query1 =  "SELECT * FROM users WHERE email='$email'";
       $results1 = mysqli_query($conn, $query1);
       if (mysqli_num_rows($results1) == 1) {
         $exceptionErr =  "This email already exist, Please register with a new email";
       }else{
           $query = "INSERT INTO users (first_name, last_name, email, password, userType)
           VALUES('$firstName', '$lastName', '$email', '$password', '$userType')";
         try{
         mysqli_query($conn, $query);
         $id = mysqli_insert_id($conn);
         $_SESSION["id"] = $id;
         $_SESSION['name'] = $firstName;
         $_SESSION['email'] = $email;
         $_SESSION['loggedIn'] = true;  
         header('location: dashboard.php');
         
         }catch(Exception $e){
           $exceptionErr =  "An Error occured while saving user";
         }
       }
      
     }
   }
   

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sign up</title>

    <link rel="stylesheet" href="css/signin.css">
</head>

<body>
    <div class="container">
        <header>
            <h1>Sign up</h1>
        </header>
        <?php if(isset($exceptionErr)): ?>
        <div class="error"><?php echo $exceptionErr; ?></div>
        <?php endif; ?>
        <section>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <input type=" text" name="first_name" placeholder="First Name" required>
                <br><br>
                <input type="text" name="last_name" placeholder="Last Name" required>
                <br><br>
                <input type="text" name="email" placeholder="Your Email" required>
                <br><br>
                <select name="userType" required>
                    <option value="">Select Category</option>
                    <option value="voter">Voter</option>
                    <option value="election_officer">Election Officer</option>
                    <option value="admin">admin</option>
                </select>
                <br><br>
                <input type="text" name="password" placeholder="Password" required>
                <br><br>
                <input type="text" name="r_password" placeholder="Repeat your password" required>
                <div style="margin-top: 20px;">
                    <button class="Register_1" type="submit" name="reg_user">
                        <p>Register</p>
                    </button>
                </div>


            </form>

            <div class="image_1">
                <img src="images/signup-image.jpg" alt="signup-image">
            </div>
        </section>
        <div style="margin-top: 14px;" class="Terms">
            <p>I agree all statements in <span>Terms of service</span></p>
        </div>

    </div>

</body>

</html>