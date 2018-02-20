<!DOCTYPE html>
<?php
	session_start();
	include_once "function.php";
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Browse</title>
    <link rel="stylesheet" type="text/css" href="css/default.css" />
    <script type="text/javascript" src="js/jquery-latest.pack.js"></script>
    <script type="text/javascript">
    function saveDownload(id)
    {
        $.post("media_download_process.php",
        {
            id: id,
        },
        function(message) 
        { }
        );
    } 
    </script>
</head>

<body>
<?php
    include('header.php');
?>

<p>Welcome <?php if(isset($_SESSION['username'])){ echo $_SESSION['username'];} else {echo "Guest";}?></p>
<?php if(isset($_SESSION['username'])) { echo('
<a href="media_upload.php"  style="color:#FF9900;">Upload File</a>
'); } ?>
<div id='upload_result'>
    <?php 
        if(isset($_REQUEST['result']) && $_REQUEST['result']!=0)
        {		
            echo upload_error($_REQUEST['result']);
        }
    ?>
</div>
<br/><br/>
<?php

    $query = "SELECT * from media"; 
    $result = mysql_query( $query );
    if (!$result){
       die ("Could not query the media table in the database: <br />". mysql_error());
    }
?>
    
    <div style="background:#339900;color:#FFFFFF; width:150px;">Uploaded Media</div>
        <table width="50%" cellpadding="0" cellspacing="0">
                 <?php
			while ($result_row = mysql_fetch_row($result)) //filename, username, type, mediaid, path
			{ 
				$mediaid = $result_row[3];
				$filename = $result_row[0];
				$filenpath = $result_row[4];
		?>
        	 <tr valign="top">			
			<td>
					<?php 
						echo $mediaid;  //mediaid
					?>
			</td>
                        <td>
            	            <a href="media.php?id=<?php echo $mediaid;?>" target="_blank"><?php echo $filename;?></a> 
                        </td>
                        <td>
            	            <a href="<?php echo $filenpath;?>" target="_blank" onclick="javascript:saveDownload(<?php echo $result_row[4];?>);">Download</a>
                        </td>
		</tr>
        	<?php
			}
		?>
	</table>
   </div>

<?php
    include('footer.php');
?>
</body>
</html>
