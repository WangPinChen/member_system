<?php
  include_once('dbConnect.php');
  include('nav.php');
  //session_start();
  if(!isset($_SESSION['email']) || !$_SESSION['email']){
    header('Location: login.php');
  }

  $session_email = $_SESSION['email'];
  echo '<h1>Profile Page</h1>';

  global $dbConnection; 
  $sql = "SELECT * FROM `member_system`.`members` WHERE `email` = '$session_email' ";
  $result = mysqli_query($dbConnection, $sql);

  while($user = mysqli_fetch_assoc($result)){
    echo 'Name : '.$user['name'].'<br>';
    echo 'Phone : '.$user['phone'].'<br>';
    echo 'Birthday : '.$user['birthday'].'<br>';
    echo 'Email : '.$user['email'].'<br>';
  }
?>
<div style='margin:0.5rem 0;'>
  <a href="user/modify.php">Modify Profile</a>
  <a href="user/change_password.php">Change Password</a>
</div>