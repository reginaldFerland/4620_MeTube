<header>

<!-- Nav bar -->
<nav class="navbar navbar-expand navbar-inverse bg-dark">
    <!-- Logo -->
    <a class="navbar-brand" href="./">METUBE</a>

    <!-- Search Bar -->
    <form class="form-inline" action="./search.php" method="POST">
        <input class="form-control mr-sm-2" name="search" type="text" placeholder="Search">
        <button class="btn btn-success" type="submit">Search</button>
    </form>
    
    <!-- Test Dropdown -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="./categories.php">Categories</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="./channels.php">Channels</a>
        </li>
    </ul>
    

    <!-- Determine if logged in -->
    <?php
    if(isset($_SESSION['username'])) { ?>
        <!-- Profile and Log out -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="friends.php">Friends</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="my_playlists.php">Playlists</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="media_upload.php">Upload File</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./profile.php?username=<?php echo $_SESSION["username"];?>">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./logout.php">Log Out</a>
            </li>
        </ul>
    <?php } else { ?>
        <!-- Log in or Register -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="./login.php">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./register.php">Register</a>
            </li>
        </ul>
   <?php  } ?>

</nav>
</header>
