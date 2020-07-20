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
        <?php echo $_GET['add'] ?? $_GET['delete'] ?? $_GET['update'] ?? '' ?>

        <!-- ADD FORM -->
        <form id="form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off" id="addForm">
            <input type="text" placeholder="enter item" required name="item">
            <input type="submit" value="add" name="add">
        </form>

        <!-- TODOS -->
        <div class="todos">
            <?php if($todos): ?>
                <?php foreach ($todos as $todo): ?>
                    <div class="todo">
                        <?php echo htmlspecialchars($todo['name']) ?>
                        
                        <a href="index.php?id=<?php echo htmlspecialchars($todo['id']) ?>">delete</a>
                        <a href="view.php?id=<?php echo htmlspecialchars($todo['id']) ?>">view</a>
                        <button value="<?php echo htmlspecialchars($todo['id']) ?>" data-data="<?php echo htmlspecialchars($todo['name'])?>">update</button>
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
    </main>
    
    <script src="js/index.js"></script>

</body>
</html>