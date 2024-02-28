<!-- header.php -->

<header class="header">
   <section class="flex">
      <a href="" class="logo">CandleStix</a>
      <nav class="navbar">
         <a href="login.php" class="fas fa-alt">L</a>
         <a href="register.php" class="far fa-registered">R</a>
         <a href='/http://127.0.0.1:5000' class="fas fa-alt">P</a>
         <a href="components/logout.php" class="fas fa-alt">EXIT</a>
      </nav>
   </section>
</header>

<!-- Rest of your HTML code goes here -->

<!-- sweetalert cdn link -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!-- custom js file link -->
<script src="js/script.js"></script>

<script>
   function logout() {
      // Perform the logout action here
      // You can redirect the user to the logout page or perform an AJAX request to log them out
      // For example, you can redirect the user to "components/logout.php" using the following line:
      window.location.href = "components/logout.php";
   }
</script>

<?php include 'components/alerts.php'; ?>

</body>
</html>
