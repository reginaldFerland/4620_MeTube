<?php
include_once('account_functions.php');
?>
<p><b> Test 1: create_user </b> </p>
<?php
    if(create_user("badEmail", "bad", "password") != 1)
        echo "success";
    else
        echo "failed";
?>
<p><b> Test 2: create_user</b></p>
<?php
    if(create_user("tester", "test@test.com", "password") == 1)
        echo "success";
    else
        echo "failed";
?>
<p><b> Test 3: user_exists  </b></p>
<?php
    if(user_exists("badEmail") == False)
        echo "sucess";
    else
        echo "failed";
?>
<p><b> Test 4: user_exists </b> </p>
<?php 
    if(user_exists("tester") == True)
        echo "sucess";
    else
        echo "failed";
?>
<p><b> Test 5: email_exists </b></p>
<?php
    if(email_exists("bad") == False)
        echo "sucess";
    else
        echo "failed";
?>
<p><b> Test 6: email_exists </b> </p>
<?php
    if(email_exists("test@test.com") == True)
        echo "success";
    else
        echo "failed";
?>
<p><b> Test 7: password_check </b> </p>
<?php
    if(password_check("tester", "pass") != 1)
        echo "success";
    else
        echo "failed";
?>
<p><b> Test 8: password_check </b> </p>
<?php
    if(password_check("tester","password") == 1)
        echo "success";
    else
        echo "failed";
?>
<p><b> Test 9: remove_user </b> </p>
<?php
    if(remove_user("tester") == 1 and user_exists("tester") == False)
        echo "success";
    else
        echo "failed";
?>
<p> Recreated user </p>
<?php
create_user("tester", "email@email.com", "password");
?>
<p><b> Test 10: validate_email </b></p>
<?php
    if(validate_email("fail") != 1)
        echo "success";
    else
        echo "failed";
?>

<p><b> Test 11: validate_email </b></p>
<?php
    if(validate_email("email@email") != 1)
        echo "success";
    else
        echo "failed";
?>
<p><b> Test 12: validate_email </b></p>
<?php
    if(validate_email("email@email.com") == 1)
        echo "success";
    else
        echo "failed";
?>
<p><b> Test 13: change_email </b></p>
<?php
    if(change_email("tester", "newEmail") != 1)
        echo "success";
    else
        echo "failed";    
?>
<p><b> Test 14: change_email </b></p>
<?php
    if(change_email("test", "newEmail@email.com") != 1)
        echo "success";
    else
        echo "failed";    
?>
<p><b> Test 15: change_email </b></p>
<?php
    if(change_email("tester", "newEmail@email.com") == 1)
        echo "success";
    else
        echo "failed";    
?>
<p><b> Test 16: change_name </b></p>
<?php
    if(change_name("mrT", "MR T") != 1)
        echo "success";
    else
        echo "failed";
?>
<p><b> Test 17: change_name </b></p>
<?php
    if(change_name("tester", "MR T") == 1)
        echo "success";
    else
        echo "failed";
?>
<p><b> Test 18: change_about </b></p>
<?php
    if(change_about("test", "MR T") != 1)
        echo "success";
    else
        echo "failed";
?>
<p><b> Test 19: change_about </b></p>
<?php
    if(change_about("tester", "MR T") == 1)
        echo "success";
    else
        echo "failed";
?>
<p><b> Test 20: increment_upload </b></p>
<?php
    if(increment_upload("test") != 1)
        echo "success";
    else
        echo "failed";
?>
<p><b> Test 21: increment_upload </b></p>
<?php
    if(change_about("tester", "MR T") == 1)
        echo "success";
    else
        echo "failed";
?>
<p><b> Test 22: change_pic </b></p>
<?php
    if(change_pic("test", "2") != 1)
        echo "success";
    else
        echo "failed";
?>
<p><b> Test 23: change_pic </b></p>
<?php
    if(change_pic("tester", 29) != 1)
        echo "success";
    else
        echo "failed";
?>
<p><b> Test 24: change_pic </b></p>
<p> requires a picture uploaded </p>
<?php
    if(change_pic("tester", 2) == 1)
        echo "success";
    else
        echo "failed";
?>

<p> Remove account </p>
<?php remove_user("tester");?>
