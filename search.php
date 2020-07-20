 <?php

    $todos = null;

   if(isset($_POST['search']) and isset($_POST['name'])){
      include("config/db_connect.php");

      $name_to_search = mysqli_real_escape_string($conn, $_POST['name']);

      $sql = "SELECT * FROM todos WHERE name LIKE '%$name_to_search%' ORDER BY id DESC";

      $result = mysqli_query($conn, $sql);

      $resultCount = mysqli_num_rows($result);

      $todos = mysqli_fetch_all($result, MYSQLI_ASSOC);


      mysqli_free_result($result);
      mysqli_close($conn);
   }

 ?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>search</title>
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

       
        
        <!-- SEARCH FORM -->
        <div id="search-form-container">
          <form action="search.php" method="POST" id="search-form" autocomplete="off">
            <input type="text" name="name" placeholder="search">
            <input type="submit" value="search" name="search">
          </form>
        </div>


        <!-- RESULTS -->
        <div class="todos">
            <?php if($todos): ?>
                <?php echo $resultCount." result(s) matched" ?>
                <?php foreach ($todos as $todo): ?>
                    <div class="todo">
                        <?php echo htmlspecialchars($todo['name']) ?>
                        <a href="index.php?id=<?php echo htmlspecialchars($todo['id']) ?>">delete</a>
                        <a href="view.php?id=<?php echo htmlspecialchars($todo['id']) ?>">view</a>
                    </div>
                <?php endforeach ?>
            <?php else: ?>
                <span style="color: #aaa">no results found</span>
            <?php endif ?>
        </div>

    </main>
    
    <!-- <script src="js/index.js"></script> -->

</body>
</html>