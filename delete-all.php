<?php

    if(isset($_GET['ids'])){
        include("config/db_connect.php");

        $ids = mysqli_real_escape_string($conn, $_GET['ids']);

        $ids_array = json_decode($ids);

        foreach($ids_array as $id){
             $sql = "DELETE from todos WHERE id = $id";
             mysqli_query($conn,$sql);
       }

        mysqli_free_result($result);
        mysqli_close($conn);

        header("location: index.php?deletes=selected items were successfully deleted");
            

    }
    else{
        header("location: index.php");
    }



?>