<?php
     
    
     $firstname = $_POST['first'];
     $lastname = $_POST['last'];
    $username = $_POST['user'];
    $password = $_POST['pass1'];
    $password2 = $_POST['pass2'];
     
     
     if($password == $password2)
     {
          echo "Registration Successful";
          
     } 
     else 
     {
          echo "Passwords do not match";
      }
          
    echo$firstname;
    echo$lastname;
    echo$username;
    echo$password;
    echo$password2;
  
?>
    