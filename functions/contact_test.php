<?php
include_once('account_functions.php');
include_once('blocked_user_functions.php');
include_once('contact_functions.php');
?>

<h1> Contact Tests </h1>
<p> Setting up accounts </p>
<?php
create_user("tester1", "test1@test.com","password");
create_user("tester2", "test2@test.com","password");
?>

<p><b> Test 1: add_friend </b></p>
<?php
    if(add_friend("test", "tester2") != 1)
        echo "success";
    else
        echo "failed";
?>
<p><b> Test 2: add_friend </b></p>
<?php
    if(add_friend("tester1", "tester2") == 1)
        echo "success";
    else
        echo "failed";
?>
<p><b> Test 3: is_friends </b></p>
<?php
    if(is_friends("test", "tester2") == FALSE)
        echo "success";
    else
        echo "failed";
?>
<p><b> Test 4: is_friends </b></p>
<?php
    if(is_friends("tester1", "tester2") == TRUE)
        echo "success";
    else
        echo "failed";
?>
<p><b> Test 5: remove_friend </b></p>
<?php
    if(remove_friend("test", "tester2") != 1)
        echo "success";
    else
        echo "failed";
?>
<p><b> Test 6: remove_friend </b></p>
<?php
    if(remove_friend("tester1", "tester2") == 1)
        echo "success";
    else
        echo "failed";
?>

<p> Tear Down </p>
<?php
remove_user("tester1");
remove_user("tester2");
?>
