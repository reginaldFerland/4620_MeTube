<form action="profile.php" method="post" style="max-width:200px; margin: 20px" class="mx-auto">
  <div class="form-group">
    <input type="text" name="fname" placeholder="<?php echo $fname;?>">
  </div>
  <div class="form-group">
    <input type="text" name="lname" placeholder="<?php echo $lname;?>">
  </div>
  <div class="form-group">
    <input type="text" name="email" placeholder="<?php echo $email;?>">
  </div>
  <div class="form-group">
    <input  type="password" name="passowrd1" placeholder="New Password">
  </div>
  <div class="form-group">
    <input  type="password" name="passowrd2" placeholder="Repeat New Password">
  </div>
  <div class="form-group">
    <input  type="password" name="password" placeholder="Current Password">
  </div>
  <div class="form-group">
    <input name="submit" type="submit" value="Submit">
  </div>
</form>


