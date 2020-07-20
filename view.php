<?php 

     //fetching single item to display
     if(isset($_GET['id'])){
        include("config/db_connect.php");
        $id = $_GET['id'];


        //if id is not numeric, redirect to index page
        if(!is_numeric($id)){
            header("location: index.php");
        }

        //sanitizing id
        $id_to_view = mysqli_real_escape_string($conn, $id);


        //making query
        $sql= "SELECT * FROM todos WHERE id = $id_to_view";
        $result = mysqli_query($conn, $sql);
        $todo = mysqli_fetch_assoc($result);
    }
    else{
        header("location: index.php");
    }
 ?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Todo</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="fontawesome/css/all.min.css" type="text/css">
  <!-- Bootstrap core CSS -->
  <link href="mdb/css/bootstrap.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/index.css" rel="stylesheet">
  <!--Favicon-->
  <!-- <link rel="shortcut icon" type="image/png" href="img/favicon.png"/> -->
  <link rel="icon" type="image/ico" href="img/favicon.ico"/>
</head>

<body>
    <main>
        <!-- success and error messages -->
        <?php

            if(isset($_GET['update']) and $_GET['update'] === 'success'){
                echo "update successful";
            }else if(isset($_GET['update']) and $_GET['update'] === 'fail'){
                echo "update failed";
            }
        ?>

        <?php if($todo): ?>
            <p>
                <?php echo htmlspecialchars($todo['name'])  ?>
            </p>
            <p>
                <?php echo htmlspecialchars($todo['created_at'])  ?>
            </p>
        <?php else: ?>
            <?php die("<p>no such item exists</p>") ?>
        <?php endif ?>

        <!-- update form -->
        <form id="form" action="update.php" method="POST" autocomplete="off">
            <input type="text" placeholder="new update" required name="new_update">
            <input type="hidden" required name="id" value="<?php echo htmlspecialchars($todo['id']) ?>">
            <input type="hidden" required name="origin" value="view-page">
            <input type="submit" value="update" name="update">
        </form>

       <a href="index.php">home page</a>
    </main>



</body>
</html>