<?php

/*
    STEPS WE NEED TO TAKE...
    
    1. Build login HTML form
    2. Check if form has been submitted
    3. Validate form data
    4. Add form data to variables
    5. Connect to database
    6. Query the database for username submitted in the form
    6.1     If no entries: show error message
    7. Store basic user data from database in variables
    8. Verify stored hashed password with the one submitted in the form
    8.1     If invalid: show error message
    9. Start a session & create session variables
    10. Redirect to a "Profile Page"
    10.1 Provide link to "logout" page
    10.2 Add cookie clear to logout page
    10.3 Provide link to log back include
    11. Close the mySQL connection
*/

  if(isset($_POST['login'])){
      // build a function that validates data
        function validateFormData($formData){
            $formData = trim(stripslashes(htmlspecialchars($formData)));
            return $formData;
        }

        // create variables
        // wrap the data with our functions

        $formuser = validateFormData($_POST['username']);
        $formpass = validateFormData($_POST['password']);
      
        // connect to database
        include('connection.php');
      
        // creats SQL query
        $query = "SELECT username, email, password FROM users WHERE username = '$formuser'";
      
        // store the result
        $result = mysqli_query($connection,$query);
        
        // verify if result is returned
        if(mysqli_num_rows($result)>0){
            // store basic user data in variables
            while($row = mysqli_fetch_assoc($result)){
                $user   = $row['username'];
                $email   = $row['email'];
                $hashedPass   = $row['password'];
            }
            
            // verify hashed password with the typed password
            if(password_verify($formpass,$hashedPass)){
                // correct login details
                // start the session
                session_start();
                
                // store data in SESSION variables
                $_SESSION['loggedinUser'] = $user;
                $_SESSION['loggedinEmail'] = $email;
                
                header('Location: profile.php');
            }else{ // hashed password didn't verify
                // error message
                $loginError = "<div class='alert alert-danger'>Wrong username/password combination. Try again</div>";
            }
        }
        else{ // there are no results in database
            $loginError = "<div class='alert alert-danger'>No such user in databse. Please Try again<a class='close' data-dismiss='alert'>&times;</a></div>";
        }
      // close the mysql connection
      
      mysqli_close($connection);
  }

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
        
        <title>Login</title>
    </head>
    
    <body>
        
        <main class="container">
            <h1>Login</h1>
         
            <p class="lead">Use this form to log in to your account</p>
            
            <?php echo $loginError; ?>
            <form class="form-inline" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <label for="login-username" class="sr-only">Username</label>
                    <input type="text" placeholder="Username" class="form-control" id="login-username" name="username">
                </div>
                
                <div class="form-group">
                    <label for="login-password" class="sr-only">Password</label>
                    <input type="password" placeholder="Password" class="form-control" id="login-password" name="password">
                </div>
                
                <button name="login" type="submit" class="btn btn-primary ">Login!</button>
            </form>
      
                
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