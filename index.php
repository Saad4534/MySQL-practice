<?php 
include('connection.php');


$query = "SELECT * FROM users";
$result = mysqli_query( $connection, $query );

$password = password_hash("mypassword", PASSWORD_DEFAULT);
echo $password;

?>







<?php
    DEFINE("TITLE","LOOPS");    
?>



<!DOCTYPE html>


<html>
    <head>
         <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link href="bootstrap-4.4.1-dist/bootstrap-4.4.1-dist/css/bootstrap-grid.min.css" rel="stylesheet">
        
        <title><?php mySQLi; ?></title>
    </head>
    
    <body>
        
     <main class="container">
        <h1>mySQL Select</h1>
         
    
         <?php 
                 if(mysqli_num_rows($result) > 0){

            // we have data
            // output the data

            echo "<table class='table table-bordered'><tr><th>ID</th><th>Username</th><th>Email</th>";

            while( $row = mysqli_fetch_assoc($result) ){
                echo "<tr><td>".$row["id"]."</td><td>".$row["username"]."</td><td>".$row["email"]."</td><tr>";
            }
            echo "</table>";

        }else{
            echo "Whoops! No results.";
        }

        mysqli_close($connection);

         ?>
       
                
    </main>
        
        
        
        
        <!-- Bootstrap js -->
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script src="bootstrap-4.4.1-dist/bootstrap-4.4.1-dist/js/bootstrap.min.js"></script>
    </body>
    
    
    
</html>