<?php 
include('connection.php');


if(isset($_POST["add"])){
    
    // build a function that validates data
    function validateFormData($formData){
        $formData = trim(stripslashes(htmlspecialchars($formData)));
        return $formData;
    }
    $userError = $emailError = $passwordError = "";
    $username = $email = $password = "";
    
    
    // check to see if inputs are empty
    // create variables with form data
    // wrap the data with our function

    if(!$_POST["username"]){
        $userError = "Please Enter your username <br>";
    }else{
        $username = validateFormData($_POST["username"]);
    }

    if(!$_POST["email"]){
        $emailError = "Please Enter your email <br>";
    }else{
        $email = validateFormData($_POST["email"]);
    }
    
    if(!$_POST["password"]){
        $passwordError = "Please Enter your password <br>";
    }else{
        $password = validateFormData($_POST["password"]);
    }
    
    if($username && $email && $password){
        
        $hashedPass = password_hash( $password , PASSWORD_DEFAULT );
        $query = "INSERT INTO users(id, username, password, email, signup_date, biography)
        VALUES (NULL, '$username', '$hashedPass', '$email', CURRENT_TIMESTAMP, NULL)";
        
        if(mysqli_query($connection,$query)){
            echo "New record in database";
        }else{
            echo "Error:". $query()."<br>".mysqli_error($connection);
        }
        
    }
}


mysqli_close($connection);


/*
MYSQL INSERT QUERY

INSERT INTO users(id, username, password, email, signup_date, biography)
VALUES (NULL, 'jacksonsmith', 'abc1230', 'jacl@son.com', CURRENT_TIMESTAMP, 'Hello!, I m Jackson. This is my bio')
*/

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
        
        <title>mySQL Insert</title>
    </head>
    
    <body>
        
       
         
        <div class="container">
            
           <h1>mySQL Insert</h1>
            <p class="text-danger">* Required Field</p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
             
                <small class="text-danger">* <?php echo $userError; ?></small>
                <input type="text" placeholder="Username" name="username"><br><br>
    
                <small class="text-danger">* <?php echo $emailError; ?></small>
                <input type="text" placeholder="Email" name="email"><br><br>
             
                <small class="text-danger">* <?php echo $passwordError; ?></small>
                <input type="password" placeholder="Password" name="password"><br><br>
                
                <input type="submit" name="add" value="Add Entry">
            </form>
       </div>
            
        
        
        
        
        <!-- Bootstrap js -->
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script src="bootstrap-4.4.1-dist/bootstrap-4.4.1-dist/js/bootstrap.min.js"></script>
    </body>
    
    
    
</html>