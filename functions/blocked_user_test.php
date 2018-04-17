<?php
include_once("account_functions.php");
include_once("blocked_user_functions.php");
?>

<h1> Blocked_user Tests </h1>
<p> Setting up accounts </h1>
<?php
create_user("tester1", "1@test.com", "password");
create_user("tester2", "2@test.com", "password");
?>

<p><b> Test 1: block_user </b></p>
<?php
    if(block_user("tester1", "test") != 1)
        echo "success";
    else
        echo "failed";
?>
<p><b> Test 2: block_user </b></p>
<?php
    if(block_user("test", "tester2") != 1)
        echo "success";
    else
        echo "failed";
?>
<p><b> Test 3: block_user </b></p>
<?php
    if(block_user("tester1", "tester2") == 1)
        echo "success";
    else
        echo "failed";
?>
<p><b> Test 4: is_blocked </b></p>
<?php
    if(is_blocked("test","tester2") == False)
        echo "success";
    else
        echo "failed";
?>
<p><b> Test 5: is_blocked </b></p>
<?php
    if(is_blocked("tester1","tester2") == True)
        echo "success";
    else
        echo "failed";
?>
<p><b> Test 6: unblock_user </b></p>
<?php
    if(unblock_user("tester1","tester") != 1)
        echo "success";
    else
        echo "failed";
?>
<p><b> Test 7: unblock_user </b></p>
<?php
    if(unblock_user("tester1","tester2") == 1)
        echo "success";
    else
        echo "failed";
?>











<p> Tear Down </p>
<?php
remove_user("tester1");
remove_user("tester2");
?>
