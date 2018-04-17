<?php
include_once("comments_functions.php");
?>
<h1> Comments Function Test </h1>

<p> Setup </p>
<?php
create_user("tester","email@email.com", "password");
$mediaID = add_media("path","type","name");
?>
<p><b> Test 1: create_comment </b></p>
<?php
    if(create_comment("tester", $mediaID, "Commenting") == 1)
        echo "success";
    else
        echo "failed";
?>
<p><b> test 2: create_comment </b></p>
<?php
    if(create_comment("t", $mediaID, "commenting") != 1)
        echo "success";
    else
        echo "failed";
?>
<p><b> test 3: comment_exists </b></p>
<p> Fails without knowing id</p>
<?php
    if(comment_exists(6) == True)
        echo "success";
    else
        echo "failed";
?>
<p><b> test 4: comment_exists</b></p>
<?php
    if(comment_exists(4) == False)
        echo "success";
    else
        echo "failed";
?>
<p><b> test 5: edit_comment</b></p>
<?php
    if(edit_comment(6, "new comment") == 1)
        echo "success";
    else
        echo "failed";
?>
<p><b> test 6: edit_comment</b></p>
<?php
    if(edit_comment(4, "new comment") != 1)
        echo "success";
    else
        echo "failed";
?>
<p><b> test 7: delete_comment</b></p>
<?php
    if(delete_comment(6) == 1)
        echo "success";
    else
        echo "failed";
?>
<p><b> test 8: delete_comment</b></p>
<?php
    if(delete_comment(6) != 1)
        echo "success";
    else
        echo "failed";
?>



<p> Tear Down </p>
<?php
remove_user("tester");
remove_media($mediaID);
?>
