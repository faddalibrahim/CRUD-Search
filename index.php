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


      <div class="crud">
         <button id="select-multiple-button">select multiple</button>
      <!--   <h2 class="header">
          <center>CRUD</center>
        </h2> -->

        <div class="form-body">
            <!-- success and error messages -->
            <center style="color: #5cb85c" class="success-error">
              <?php echo $_GET['add'] ?? $_GET['delete'] ?? $_GET['update'] ?? $_GET['deletes'] ?? '' ?>
            </center>
            <br>

            <!-- ADD FORM -->
            <form id="form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off" id="addForm">
                <input type="text" placeholder="enter item" required name="item">
                <input type="submit" value="add" name="add" id="submit-button">
               <!--  <label for="submit-button">
                  <i class="fas fa-plus"></i>
                </label> -->
            </form>
          
          <!-- ACTION BUTTONS -->
          <center>
           
          </center>
        </div>
          

          <!-- TODOS -->
          <div class="todos">
              <?php if($todos): ?>
                  <?php foreach ($todos as $todo): ?>
                      <div class="todo">
                        <div class="item">
                          <input type="checkbox" name="" data-id="<?php echo htmlspecialchars($todo['id'])?>" hidden>
                          <?php echo htmlspecialchars($todo['name']) ?>
                        </div>
                        <div class="action">
                          <a href="index.php?id=<?php echo htmlspecialchars($todo['id']) ?>" style="color: violet">delete</a>
                          <a href="view.php?id=<?php echo htmlspecialchars($todo['id']) ?>" style="color: violet">view</a>
                         
                          <span data-id="<?php echo htmlspecialchars($todo['id']) ?>" data-data="<?php echo htmlspecialchars($todo['name'])?>" class="update-btn" style="color: violet">update</span>
                        </div>
                      </div>
                  <?php endforeach ?>
              <?php else: ?>
                  <span style="color: #ccc">
                    <center>
                      no items added yet
                    </center>
                    <br>
                  </span>
              <?php endif ?>
          <button id="delete-selected-button" hidden>deleted selected items</button>
          </div>
      </div>

        
        <!-- UPDATE FORM -->
        <div id="update-form-container">
          <form action="update.php" method="POST" id="update-form" autocomplete="off">
            <span id="close"><i class="fas fa-times"></i></span>
            <input type="text" name="new_update" value="">
            <input type="hidden" name="id" value="" class="id-field">
            <input type="hidden" required name="origin" value="index_page">
            <input type="submit" value="update" name="update">
          </form>
        </div>


        <!-- DELETE ALL PROMPT -->
        <div id="delete-selected-prompt">
          <h2 style="font-family: roboto">Are you sure you wanna delete the selected items?</h2>
          <a href="" id="yes-delete-selected">Yes</a>
          <a href="delete-all.php?">No</a>
        </div>
    </main>
    
    <script src="js/index.js"></script>

</body>
</html>