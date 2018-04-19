<!-- Display media -->
<div class="album py-5 bg-light">
<div class="container">
<div class="row">
    <!-- Loops through all results -->
    <?php 
        $i = 0;
        while ($result_row = mysql_fetch_assoc($result) and $i < $LIMIT) //filename, username, type, mediaid, path
        { 
            $mediaid = $result_row['mediaID'];
            $type = $result_row['type'];
            $filename = $result_row['name'];
            $filenpath = $result_row['path'];
            $time_access= $result_row['last_access'];
            $viewcount = $result_row['viewcount'];
            $description = $result_row['description'];
            if($description == NULL) {
                $description = "No description";
            }
            $description = substr($description, 0, 21);
            if(strpos($type, "video") !== False){
                // Video thumbnail
                $filenpath = "site/thumbnail.png";
            }
            $i += 1;
    ?>

<div class="col-3"> 
    <div class="card mb-4 box-shadow">
        <a href="media.php?id=<?php echo $mediaid;?>">
        <img class="card-img-top" style="height:200px" src="<?php echo $filenpath;?>" alt="Card image">
        </a>
        <div class="card-body">
           <h5 class="card-title text-center"><?php echo substr($filename,0, 10); ?></h5>
           <p class="card-text"> <?php echo $description;?> </p>
            <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                    <a type="button" class="btn btn-sm btn-outline-secondary" href="like.php?id=<?php echo $mediaid;?>">Like</a>
                </div> 
            </div>
        </div>
    </div>
</div>

    <!-- End loop -->
    <?php
        }
    ?>

</div>
</div>
</div>

