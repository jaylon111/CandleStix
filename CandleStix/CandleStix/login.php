<?php

include 'components/connect.php';

if(isset($_POST['submit'])){

   $username = $_POST['username'];
   $username = filter_var($username, FILTER_SANITIZE_STRING);
   $pass = $_POST['password'];
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $verify_username = $conn->prepare("SELECT * FROM `registration` WHERE username = ? LIMIT 1");
   $verify_username->execute([$username]);

   if($verify_username->rowCount() > 0){
      $fetch = $verify_username->fetch(PDO::FETCH_ASSOC);
      $verify_pass = password_verify($pass, $fetch['password']);
      if($verify_pass == 1){
         setcookie('user_id', $fetch['id'], time() + 60*60*24*30, '/');
         header('location:all_posts.php');
      }else{
         $warning_msg[] = 'Incorrect password!';
      }
   }else{
      $warning_msg[] = 'Incorrect username!';
   }
   
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/header.php'; ?>
<!-- header section ends -->

<!-- login section starts  -->

<section class="account-form">
   <form action="" method="post" enctype="multipart/form-data">
      <h3>Welcome back!</h3>
      <p class="placeholder">Your username<span>*</span></p>
      <input type="text" id="username" name="username" required class= "box"><br>

      <p class="placeholder">Your password<span>*</span></p>
      <input type="password" id="password" name="password" required class="box"><br>

      <p class="link">Don't have an account? <a href="register.php">Register now</a></p>

      <input type="submit" value="Login now" name="submit" class="btn">
   </form>
</section>



<!-- sweetalert cdn link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<?php include 'components/alerts.php'; ?>

</body>
</html>
