<?php

    include 'config/db_connect.php';

    $item = mysqli_real_escape_string($conn, $_POST['item']);
    $sql_insert = "INSERT INTO todos(name) VALUE('$item')";
    $result = mysqli_query($conn, $sql_insert);

    /*freeing results from memory*/
	mysqli_free_result($result);
	/*close connection to database*/
	mysqli_close($conn);

   

    if($result){
        header('location: index.php?add=success');
    }else{
        // echo "Error: ".mysqli_error($conn);
        header('location: index.php?add=failed');
    }



?>