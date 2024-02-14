<?php

include 'components/connect.php';

if(isset($_POST['submit'])){

    $id = create_unique_id();
    $first_name = $_POST['firstname'];
    $first_name = filter_var($first_name, FILTER_SANITIZE_STRING);
    $last_name = $_POST['lastname'];
    $last_name = filter_var($last_name, FILTER_SANITIZE_STRING);
    $username = $_POST['username'];
    $username = filter_var($username, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);
    $c_pass = password_verify($_POST['confirm_password'], $pass);
    $c_pass = filter_var($c_pass, FILTER_SANITIZE_STRING);
 
    $verify_email = $conn->prepare("SELECT * FROM `registration` WHERE email = ?");
    $verify_email->execute([$email]);
 
    $verify_username = $conn->prepare("SELECT * FROM `registration` WHERE username = ?");
    $verify_username->execute([$username]);

    if($verify_email->rowCount() > 0){
        $warning_msg[] = 'Email already taken!';
     }else if ($verify_username->rowCount() > 0){
        $warning_msg[] = 'Username already taken!';
    }else{
        if($c_pass == 1){
           $insert_user = $conn->prepare("INSERT INTO `registration`(id, firstName, lastName, username, email, password) VALUES(?,?,?,?,?,?)");
           $insert_user->execute([$id, $first_name, $last_name, $username, $email, $pass]);
           $success_msg[] = 'Registered successfully!';
       }else{
          $warning_msg[] = 'Confirm password not matched!';
       }
    }
    
 }
 
 ?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/header.php'; ?>
<!-- header section ends -->

<section class="account-form">
<form action="" method="post" enctype="multipart/form-data">
      <h3>make your account!</h3>
      <p class="placeholder">your first name <span>*</span></p>
            <input type="text" id="firstname" name="firstname" required class="box"><br>

            <p class="placeholder">your last name <span>*</span></p>
            <input type="text" id="lastname" name="lastname" required class="box"><br>

            <p class="placeholder">your username <span>*</span></p>
            <input type="text" id="username" name="username" required class="box"><br>

            <p class="placeholder">your email <span>*</span></p>
            <input type="email" id="email" name="email" required class="box"><br>

            <p class="placeholder">your password <span>*</span></p>
            <input type="password" id="password" name="password" required class="box"><br>

            <p class="placeholder">confirm password <span>*</span></p>
            <input type="password" id="confirm_password" name="confirm_password" required class="box"><br>

            <p class="link">already have an account? <a href="login.php">login now</a></p>
      <input type="submit" value="register now" name="submit" class="btn">
   </form>

</section>













<!-- sweetalert cdn link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<?php include 'components/alerts.php'; ?>

</body>
</html>