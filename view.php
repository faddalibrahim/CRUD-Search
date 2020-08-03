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

<style type="text/css">
  #parent{
    /*box-shadow: 0 0 1rem 0rem rgba(13,12,14,0.5);*/
    /*box-shadow: 0 0 1rem 0rem #333;*/
    box-shadow: 0 0 0.5rem 0.1rem #aaa;
    /*border: 0.05rem solid #aaa;*/
    border-radius: 0.5rem;
    padding: 3rem;
  }

  .form-body{
    padding-left: 0;
    background-color: transparent;
  }

  input[type=submit]{
    padding: 0.5rem;
    background-color: navy;
    color: white;
    outline: none;
    border: none;
  }
</style>

<body>
    <main>
      <div id="parent"> 
          <!-- success and error messages -->
          <center style="color: #5cb85c">  
            <?php

                if(isset($_GET['update']) and $_GET['update'] === 'success'){
                    echo "update successful";
                }else if(isset($_GET['update']) and $_GET['update'] === 'fail'){
                    echo "update failed";
                }
            ?>
          </center>

          <?php if($todo): ?>
              <h1 style="text-transform: capitalize; color: #aaa">
                  <?php echo htmlspecialchars($todo['name'])  ?>
              </h1>
              <small style="color: #bbb">
                  <?php echo htmlspecialchars($todo['created_at'])  ?>
              </small>
          <?php else: ?>
              <?php die("<p style='color:#aaa'>no such item exists</p>") ?>
          <?php endif ?>

          <br>

          <!-- update form -->
          <form id="form" action="update.php" method="POST" class="form-body" autocomplete="off">
              <input type="text" placeholder="new update" required name="new_update">
              <input type="hidden" required name="id" value="<?php echo htmlspecialchars($todo['id']) ?>">
              <input type="hidden" required name="origin" value="view-page">
              <input type="submit" value="update" name="update">
          </form>

         <a href="index.php" style="text-decoration: none; color: purple">Back to home page</a>
      </div>
    </main>



</body>
</html>