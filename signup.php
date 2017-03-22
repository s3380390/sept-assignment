<!DOCTYPE HTML>
<html>
   <head>
     <title>Sign Up</title>
   </head>
   <body>
      <h1> Sign Up </h1>
   
      <form action ='form2.php' method='post' >
         <p> First Name <br><input type='text' name='firstname' placeholder='John' 
             value='' pattern="[A-Za-z\-' ]{2,25}" required/></p>
         <p> Last Name <br><input type='text' name='lastname' placeholder='Smith' 
              pattern="[A-Za-z\-' ]{2,25}" value=''required/></p>
         <p> Username <br><input type='text' name='username' placeholder='johnsmith1'
             value='' required/></p>
         <p> Password <br><input type='password' name='password' required/></p>
         <p> Confirm Password <br><input type = 'password' name='password2' required/></p>
         <p> Contact Number <br><input type='text' name='contact' placeholder='0412345678'
             value='' pattern="[0-9\-\+ ]{10,15}" required/></p>
         <p> Address <br><input type='text' name='address' value='' required/></p>
         <p><input type='submit' name='submit' value='Submit' /></p>
      </form>
  
   </body>
   
</html>

