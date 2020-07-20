<?php

	include("config/db_connect.php");

	$id = $_GET['id'];

	//if id is not numeric, redirect to index page
	if(!is_numeric($id) and !isset($_GET['id'])){
	    header("location: index.php");
	}

	$id_to_delete = mysqli_real_escape_string($conn, $id);


	$sql_delete_query = "DELETE FROM todos WHERE id = $id_to_delete";


	if(mysqli_query($conn, $sql_delete_query)){
	    mysqli_free_result($result);
	    mysqli_close($conn);
	    
	    header("location: index.php?delete=item was deleted");
	}else{
	    header("location: index.php?delete=item failed to delete");
	}

?>