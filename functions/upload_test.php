<?php
include_once('upload_functions.php');
include_once('account_functions.php');

?>

<h1> Upload Functions Test </h1>

<p> Setting up </p>
<?php
create_user("tester", "test@email.com", "password");
$mediaID = add_media("path", "type", "name");
?>

<p><b> Test 1: create_upload </b></p>
<?php
    $testID = create_upload("tester", $mediaID, "0");
    if($testID == 1)
        echo "success";
    else
        echo "failed";
?>
<p><b> Test 2: create_upload </b></p>
<?php
    if(create_upload("test", $mediaID, "0") != 1)
        echo "success";
    else
        echo "failed";
?>

<p><b> Test 3: upload_exists </b></p>
<?php
    if(upload_exists("tester", $mediaID) == True)
        echo "success";
    else
        echo "failed";
?>

<p><b> Test 4: upload_exists </b></p>
<?php
    if(upload_exists("test", $mediaID) == False)
        echo "success";
    else
        echo "failed";
?>

<p><b> Test 5: remove_upload </b></p>
<?php
    if(remove_upload("tester", $mediaID) == 1)
        echo "success";
    else
        echo "failed";


?>

<p> Tear Down </p>
<?php
remove_user("tester");
remove_media($mediaID);
?>
