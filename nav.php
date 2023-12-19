<?php
session_start();
?>

<nav>
    <ul>
        
        <?php
          if ($_SESSION) {
            echo '<li><a href="/functions.php?op=logout">登出</a></li>';
          } else {
            echo '<li><a href="/login.php">登入</a></li>';
            echo '<li><a href="/register.php">註冊</a></li>';
          }
        ?>
    </ul>
</nav>
