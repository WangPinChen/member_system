<?php
include_once('dbConnect.php');

$op = '';
if(isset($_GET['op'])){
    $op = $_GET['op'];
} 
if($op === 'register'){
    register();
}
if($op === 'login'){
    login();
}
if($op === 'logout'){
    logout();
}
if($op === 'modify_profile'){
    modifyProfile();
}
if($op === 'change_password'){
    changePassword();
}

function register(){
    global $dbConnection;
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $birthday = $_POST['birthday'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];

    if($password !== $confirmPassword){
        echo '密碼不一致';
        return;
    }

    if(empty($name) || empty($phone) || empty($birthday) || empty($email) || empty($password) || empty($confirmPassword)){
        echo '請輸入完整資料';
        return;
    }

    $sql = "SELECT * FROM `member_system`.`members` WHERE `email` = '$email'";
    $result = mysqli_query($dbConnection, $sql);
    if(mysqli_num_rows($result) > 0){
        echo '此email已註冊';
        return;
    }
    $sql = "SELECT * FROM `member_system`.`members` WHERE `phone` = '$phone'";
    $result = mysqli_query($dbConnection, $sql);
    if(mysqli_num_rows($result) > 0){
        echo '此號碼已註冊';
        return;
    }

    $hashPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO `member_system`.`members` (`name`, `phone`, `birthday`, `email`, `password`) VALUES ('$name', '$phone', '$birthday', '$email', '$hashPassword')";
    $result = mysqli_query($dbConnection, $sql);
    if($result){
        header('Location: login.php');
    }else{
        echo '註冊失敗';
    }
}
function login(){
    global $dbConnection;
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(empty($email) || empty($password)){
        echo '信箱/密碼不可空白';
        return;
    }

    $sql = "SELECT * FROM `member_system`.`members` WHERE `email` = '$email' ";
    $result = mysqli_query($dbConnection, $sql);
    if(mysqli_num_rows($result) > 0){
        $user = mysqli_fetch_assoc($result);
        if(password_verify($password, $user['password'])){
            session_start();
            $_SESSION['email'] = $email;
            header('Location: profile.php');
        }
    }else{
        echo '登入失敗';
    }
}
function logout(){
    session_start();
    session_destroy();
    header('Location: index.php');
}
function modifyProfile(){
  global $dbConnection;
  session_start();
  
  $name = $_POST['name'];
  $phone = $_POST['phone'];
  $birthday = $_POST['birthday'];
  $sql = "UPDATE `member_system`.`members` SET `name` = '$name', `phone` = '$phone', `birthday` = '$birthday' WHERE `email` = '$_SESSION[email]'";
  $result = mysqli_query($dbConnection, $sql);

  if($result){
    header('Location: profile.php');
  }
}
function changePassword(){
  session_start();
  if(empty($_POST['old-password']) || empty($_POST['new-password']) || empty($_POST['confirm-password'])){
    echo '請輸入完整資料';
    return;
  }
  if($_POST['new-password'] !== $_POST['confirm-password']){
    echo '密碼不一致';
    return;
  }

  global $dbConnection;
  $sql = "SELECT * FROM `member_system`.`members` WHERE `email` = '$_SESSION[email]'";
  $result = mysqli_query($dbConnection, $sql);
  $user = mysqli_fetch_assoc($result);

  if($user['password'] !== $_POST['old-password']){
    echo '舊密碼錯誤';
    return;
  }

  $newPassword = $_POST['new-password'];

  $sql = "UPDATE `member_system`.`members` SET `password` = '$newPassword' WHERE `email` = '$_SESSION[email]'";
  $result = mysqli_query($dbConnection, $sql);
  echo "修改成功".'<a style="margin:0 1rem;" href="/profile.php">回個人頁面</a>';
}
?>

