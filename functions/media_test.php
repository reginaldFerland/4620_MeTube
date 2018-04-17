<?php
include_once("media_functions.php");

?>

<h1> Media Tests </h1>

<p><b> Test 1: add_media </b></p>
<?php
    $id1 = add_media("path1","type","name");
    if($id1 >0)
        echo "success";
    else
        echo "failed";
?>
<p><b> Test 2: add_media </b></p>
<?php 
    $id2 = add_media("path2","type","name", "Its super awesome");
    if($id2 >0)
        echo "success";
    else
        echo "failed";
?>
<p><b> Test 3: add_media </b></p>
<?php
    $id3 = add_media("path3","type","name", "Its my secret", False);
    if($id3 >0)
        echo "success";
    else
        echo "failed";
?>
<p><b> Test 4: remove_media </b></p>
<?php
    if(remove_media($id1) == 1)
        echo "success";
    else
        echo "failed";
?>
<p><b> Test 5: media_exists </b></p>
<?php
    if(media_exists($id2) == 1)
        echo "success";
    else
        echo "failed";
?>
<p><b> Test 6: media_exists </b></p>
<?php
    if(media_exists(0) != 1)
        echo "success";
    else
        echo "failed";
?>
<p><b> Test 7: path_exists </b></p>
<?php
    if(path_exists("path3") == 1)
        echo "success";
    else
        echo "failed";
?>
<p><b> Test 8: path_exists </b></p>
<?php
    if(path_exists("p") != 1)
        echo "success";
    else
        echo "failed";
?>
<p><b> Test 9: change_media_name </b></p>
<?php
    if(change_media_name($id2, "named") == 1)
        echo "success";
    else
        echo "failed";
?>
<p><b> Test 10: change_media_name </b></p>
<?php
    if(change_media_name(0, "named") != 1)
        echo "success";
    else
        echo "failed";
?>
<p><b> Test 11: change_media_name </b></p>
<?php
    if(change_media_name($id2, NULL) != 1)
        echo "success";
    else
        echo "failed";
?>
<p><b> Test 12: change_description </b></p>
<?php
    if(change_description($id2, "coolio") == 1)
        echo "success";
    else
        echo "failed";
?>
<p><b> Test 13: change_description </b></p>
<?php
    if(change_description(0, "named") != 1)
        echo "success";
    else
        echo "failed";
?>
<p><b> Test 14: change_description </b></p>
<?php
    if(change_description($id2, NULL) != 1)
        echo "success";
    else
        echo "failed";
?>
<p><b> Test 15: update_media_timestamp </b></p>
<?php
    if(update_media_timestamp($id2) == 1)
        echo "success";
    else
        echo "failed";
?>
<p><b> Test 16: update_media_timestamp </b></p>
<?php
    if(update_media_timestamp(0) != 1)
        echo "success";
    else
        echo "failed";
?>
<p><b> Test 17: increment_views </b></p>
<?php
    if(increment_views(0) != 1)
        echo "success";
    else
        echo "failed";
?>
<p><b> Test 18: increment_views </b></p>
<?php
    if(increment_views($id2) == 1)
        echo "success";
    else
        echo "failed";
?>
<p><b> Test 19: set_public </b></p>
<?php
    if(set_public($id2, TRUE) == 1)
        echo "success";
    else
        echo "failed";
?>
<p><b> Test 20: set_public </b></p>
<?php
    if(set_public(0, TRUE) != 1)
        echo "success";
    else
        echo "failed";
?>
<p><b> Test 21: add_like </b></p>
<?php
    if(add_like(0) != 1)
        echo "success";
    else
        echo "failed";
?>
<p><b> Test 22: add_like </b></p>
<?php
    if(add_like($id2) == 1)
        echo "success";
    else
        echo "failed";
?>
<p><b> Test 24: remove_like </b></p>
<?php
    if(remove_like(0) != 1)
        echo "success";
    else
        echo "failed";
?>
<p><b> Test 25: remove_like </b></p>
<?php
    if(remove_like($id2) == 1)
        echo "success";
    else
        echo "failed";
?>
<p> Remove test 2 and 3 media </p>
<?php remove_media($id2); remove_media($id3); ?>


