<?php
  include_once('../dbConnect.php');
  session_start();

  $session_mail = $_SESSION['email'];

  global $dbConnection;
  $sql = "SELECT * FROM `member_system`.`members` WHERE `email` = '$session_mail' ";
  $result = mysqli_query($dbConnection, $sql);
  $row = mysqli_fetch_assoc($result);
  echo var_dump($row);
  $name = $row['name'];
  $phone = $row['phone'];
  echo $phone;
  $birthday = $row['birthday'];
?>
<h1>Modify Profile Page</h1>
<form action="../functions.php?op=modify_profile" method="post">
  <div>
    <label for="name" >Name</label>
    <input type="text" name='name' id='name' value='<?php echo $name; ?>'>
  </div>  
  <div>
    <label for="phone" >Phone</label>
    <input type="tel" name='phone' id='phone' value='<?php echo $phone; ?>'>
  </div>
  <div>
    <label for="birthday" >Birthday</label>
    <input type="date" name='birthday' id='birthday' value='<?php echo $birthday; ?>'>
  </div>      
  <button type='submit' >Save</button>
</form>