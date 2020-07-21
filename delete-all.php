<?php

    if(isset($_POST['delete_multiple'])){
        include("config/db_connect.php");

        print_r($_POST['deletes']);


        function escape($id){
          global $conn;
          return mysqli_real_escape_string($conn,$id);
        }

        $ids = array_map("escape",$_POST['deletes']);

        foreach($ids as $id){
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