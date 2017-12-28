<?php
   session_start();
    if(isset($_SESSION['userName'])){
       
        header("location:index.php");
        
    }
if(isset($_POST["submit"])){
    if($_POST['name']){
        
   
    $_SESSION['userName']=$_POST['name'];
     header("location:index.php");
         }else{
        echo "<script>alert('Name cannot be blank.!');</script>";
    }
}

?>

<html>
    <head>
        <title>Login to ChatRoom</title>
          <link href="css/styleIndex.css" type="text/css" rel="stylesheet">
    </head>
    
    <body>
           <style>
            #login p{
                font-family:calibri;
                font-size:40px;
                font-weight: 400;
                padding:0;
               color:white;
                margin: auto;
                margin-top: 50px;
            }
            #login{
                width:40%;
                border-radius: 10px;
                border:1px solid gray;
                background: #006699;
                margin:auto;
            }
            #login input[type="text"]{
                width:90%;
                height:35px;
                font-family:calibri;
                font-size:18px;
                font-weight: 200;
                padding: 5px 5px 5px 3;
                 border-radius: 5px;
                 border:1px solid #4d4d4d;
                outline:none;
                  margin-bottom: 10px;
            }
            #login input[type="text"]:focus{
                 border:3px solid black;
             
                
            }
             #login input[type="submit"]{
                  background-color:#4d4d4d;
                width:90%;
                font-family:calibri;
                font-size:20px;
                font-weight: 200;
                padding: 5px 5px 5px 3;
                 border-radius: 5px;
                 border:1px solid #4d4d4d;
                outline:none;
                 color:white;
                
               
            }
            #login input[type="submit"]:hover{
                background: #196619;
            }
        </style>
        <div id="login">
            <center>
            <p>Enter Your Name Please... </p>
            
            <form method="post" action="login.php">
                <input type="text" placeholder="Your Name" name="name">
                <input type="submit" name="submit" value="OK!">
            </form>
                </center>
        </div>


    </body>

</html>