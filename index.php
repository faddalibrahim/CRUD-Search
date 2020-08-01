<?php 
	include("config/db_connect.php");

	$sql = "SELECT id,name,created_at FROM todos ORDER BY id DESC";

	$result = mysqli_query($conn, $sql);

	$todos = mysqli_fetch_all($result, MYSQLI_ASSOC);

	mysqli_free_result($result);
	mysqli_close($conn);

 ?>

 <?php 
    // adding an item
    if(isset($_POST['add']) and !empty($_POST['add'])){
        include('includes/add.inc.php');
    }

    //deleting an item
    if(isset($_GET['id']) and !empty($_GET['id'])){
        include('includes/delete.inc.php');
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
 <!-- boostrap -->
 <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Your custom styles (optional) -->
  <link href="css/index.css" rel="stylesheet">
  <!--Favicon-->
  <!-- <link rel="shortcut icon" type="image/png" href="img/favicon.png"/> -->
  <link rel="icon" type="image/ico" href="img/favicon.ico"/>
</head>

<body class="d-flex flex-column justify-content-center align-items-center">
    <main class="container d-flex flex-column">
        <!-- success and error messages -->
        <span class="alert alert-success" style="height: 0;">
          <?php echo $_GET['add'] ?? $_GET['delete'] ?? $_GET['update'] ?? $_GET['deletes'] ?? '' ?>
        </span>

        <!-- ADD FORM -->
        <form id="form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off" id="addForm">
          <div class="d-flex">
            <input type="text" placeholder="enter item" required name="item" class="form-control" style="box-shadow: none; border-top-right-radius: 0; border-bottom-right-radius: 0">
            <!-- <input type="submit" value="" name="add" class="btn btn-success" style="border-top-left-radius: 0; border-bottom-left-radius: 0"> -->
            <button type="submit" value="" name="add" class="btn btn-success" style="border-top-left-radius: 0; border-bottom-left-radius: 0"><i class="fas fa-plus"></i></button>
          </div>
        </form>
        
        <!-- ACTION BUTTONS -->
        <br>
        <button id="delete-multiple-button" class="btn btn-danger">delete multiple items</button>
        <br>
        <br>

        <!-- TODOS -->
        <div class="todos">
            <?php if($todos): ?>
                <?php foreach ($todos as $todo): ?>
                    <div class="todo d-flex justify-content-between align-items-center">
                        <input type="checkbox" name="" data-id="<?php echo htmlspecialchars($todo['id'])?>" hidden>
                        <span style="padding: 0 1rem">
                          <?php echo htmlspecialchars($todo['name']) ?>
                        </span>
                        <div>
                          <a href="index.php?id=<?php echo htmlspecialchars($todo['id']) ?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                          <a href="view.php?id=<?php echo htmlspecialchars($todo['id']) ?>" class="btn btn-info"><i class="fas fa-eye"></i></a>
                          <button class="btn btn-primary" value="<?php echo htmlspecialchars($todo['id']) ?>" data-data="<?php echo htmlspecialchars($todo['name'])?>"><i class="fas fa-pen-alt"></i></button>
                        </div>
                    </div>
                <?php endforeach ?>
            <?php else: ?>
                <span style="color: #aaa">no items added yet</span>
            <?php endif ?>
        </div>
        
        <!-- UPDATE FORM -->
        <div id="update-form-container">
          <form action="update.php" method="POST" id="update-form" autocomplete="off">
            <span id="close">close</span>
            <input type="text" name="new_update" value="" >
            <input type="hidden" name="id" value="">
            <input type="hidden" required name="origin" value="index_page">
            <input type="submit" value="update" name="update">
          </form>
        </div>

        <button id="delete-selected-button" hidden>deleted selected</button>

        <!-- DELETE ALL PROMPT -->
        <div id="delete-selected-prompt">
          <span>Are you sure you wanna delete the selected items</span>
          <a href="" id="yes-delete-selected">Yes</a>
          <a href="delete-all.php?">No</a>
        </div>
    </main>


    <!--- Script Source Files -->
    <script src="bootstrap/js/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/index.js"></script>
    

</body>
</html>