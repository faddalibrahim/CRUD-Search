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

<style type="text/css">
  input[type=submit]{
    padding: 0.5rem;
    background-color: navy;
    color: white;
    outline: none;
    border: none;
    font-family: roboto;
    font-size: 1rem;
  }

    .todo{
      background-color: #eee;
      margin-bottom: 0;
      margin-top: 0.1rem;
    }

    .todo:hover a{
        opacity: 1;
    }

  .form-body{
    display: flex;
    /*width: 100%;*/
    padding-left: 0;
    padding-right: 0;
    font-family: roboto;
  }

  .search-results{
    /*box-shadow: 0 0 0.5rem 0.1rem rgba(13,12,14,0.2);*/
    border: 0.05rem solid #ccc;
    border-radius: 0.3rem;
    padding: 1rem 0 0;
  }

  a{
    text-decoration: none;
    opacity: 0;
  }

</style>

<body>
    <main>

      <div> 
          <!-- SEARCH FORM -->
          <div id="search-form-container">
            <form action="search.php" method="POST" id="search-form" autocomplete="off" class="form-body">
              <input type="text" name="name" placeholder="search">
              <input type="submit" value="search" name="search">
            </form>
          </div>


          <!-- RESULTS -->
          <div class="search-results">
              <?php if($todos): ?>
                <center style="color: #aaa">  
                  <?php echo $resultCount." result(s) matched" ?>
                </center>
                <br>
                  <?php foreach ($todos as $todo): ?>
                      <div class="todo">
                          <?php echo htmlspecialchars($todo['name']) ?>
                          <div> 
                          <a href="index.php?id=<?php echo htmlspecialchars($todo['id']) ?>" style="color: red">delete</a>
                          <a href="view.php?id=<?php echo htmlspecialchars($todo['id']) ?>">view</a>

                          </div>
                      </div>
                  <?php endforeach ?>
              <?php else: ?>
                  <center style="color: #aaa">no results found</center><br>
              <?php endif ?>
          </div>

      </div>
        

    </main>
    
    <!-- <script src="js/index.js"></script> -->

</body>
</html>