<?php

    if(isset($_POST['new_update']) and isset($_POST['id'])){
        include("config/db_connect.php");

        $id = $_POST['id'];

        //if id is not numeric, redirect to index page
         if(!is_numeric($id)){
            header("location: index.php");
        }

        $new_update = mysqli_real_escape_string($conn, $_POST['new_update']);
        $id_to_update = mysqli_real_escape_string($conn, $_POST['id']);

        $sql = "UPDATE todos SET name = '$new_update' WHERE id = $id_to_update";

        if(mysqli_query($conn, $sql)){
            mysqli_free_result($result);
            mysqli_close($conn);

            if($_POST['origin'] === 'view-page'){
                header("location: view.php?id=$id_to_update&update=success");
            }else{
                header("location: index.php?update=item was updated");
            }
            
        }else{
            if($_POST['origin'] === 'view-page'){
                header("location: view.php?id=$id_to_update&update=fail");
            }else{
                header("location: index.php?update=update failed");
            }
        }

    }else{
        header("location: index.php");
    }



?>