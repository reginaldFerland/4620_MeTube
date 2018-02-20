<header>
<style>
#outer {
    width:100%;
    text-align:center;
}
.inner {
    display:inline-block;
}
</style>


<div id="outer">
<div class="inner">
<a href='index.php' >Home</a>
</div>
<div class="inner">
<h1> Metube </h1>
</div>

<?php
if(!isset($_SESSION['username'])) {
echo('
<div class="inner">
<form action="login.php" method="post">
	
	<input type="submit" class="button"  VALUE = "Log in" >
</form>
</div>

<div class="inner">
<form action="register.php" method="post">
	
	<input type="submit" class="button"  VALUE = "Register" >
</form>
</div>
');
}

else {
echo('
<div class="inner">
<form action="logout.php" method="post">
	
	<input type="submit" class="button"  VALUE = "Log out" >
</form>
</div>

');
}

?>
</div>

<hr>

</header>
