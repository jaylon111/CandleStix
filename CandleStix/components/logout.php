<?php
// components/logout.php

include 'connect.php';

setcookie('user_id', '', time() - 1, '/');

header('location: ../login.php');
exit;
?>
