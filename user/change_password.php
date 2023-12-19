<h1>Change Password Page</h1>
<form action="../functions.php?op=change_password" method="post">
  <div>
    <label for="old-password">Old Password : </label>
    <input type="password" name="old-password" id="old-password" required>
  </div>
  <div>
    <label for="new-password">New Password : </label>
    <input type="password" name="new-password" id="new-password" required>
  </div>
  <div>
    <label for="confirm-password">Confirm Password : </label>
    <input type="password" name="confirm-password" id="confirm-password" required>
  </div>
  <button type="submit">Change</button>
</form>