<!-- Display media -->
<div class="row m-5">
    <!-- Loops through all results -->
    <?php 
        while ($result_row = mysql_fetch_assoc($result)) //filename, username, type, mediaid, path
        { 
            $mediaid = $result_row['mediaID'];
            $username = $result_row['username'];
            $type = $result_row['type'];
            $filename = $result_row['name'];
            $filenpath = $result_row['path'];
            $time_access= $result_row['last_access'];
            $time_created = $result_row['upload_time'];
            $viewcount = $result_row['viewcount'];
    ?>

<div class="col mx-0"> 
    <div class="card text-center" style="width: 18rem;">
        <a href="media.php?id=<?php echo $mediaid;?>" target="_blank"><img class="card-img-top" style="height:250px" src="<?php echo $filenpath; ?>" alt="Card image cap"></a>
        <div class="card-body">
            <h5 class="card-title"><?php echo substr($filename,0, 22); ?></h5>
            <p class="card-text">From: <a href="./profile.php?username=<?php echo $username; ?>"><?php echo $username;?></a></p>
            <p class="card-text">Views: <?php echo $viewcount; ?> </p>
        </div>
    </div>
</div>

    <!-- End loop -->
    <?php
        }
    ?>

</div>

