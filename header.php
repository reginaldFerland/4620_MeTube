<header>

<!-- Nav bar -->
<nav class="navbar navbar-expand navbar-inverse bg-dark">
  <!-- Logo -->
  <a class="navbar-brand" href="./">METUBE</a>

  <!-- Search Bar -->
  <form class="form-inline" action="">
    <input class="form-control mr-sm-2" type="text" placeholder="Search">
    <button class="btn btn-success" type="submit">Search</button>
  </form>

  <!-- Determine if logged in -->
  <?php
  if(isset($_SESSION['username'])) {
  echo('
    <!-- Profile and Log out -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="./profile.php">Profile</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./logout.php">Log Out</a>
      </li>
    </ul>
    
  ');}
  else {
  echo(' 
    <!-- Log in or Register -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="./login.php">Login</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./register.php">Register</a>
      </li>
    </ul>
  ');} ?>

</nav>
</header>
