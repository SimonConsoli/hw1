<?php
include 'dbconfig.php';
session_start();
if(isset($_SESSION["username"])){
    header("Location:home_page.php");
    exit;
}
if(isset($_POST["username"])&& isset($_POST["password"])&& !empty($_POST["username"])&&!empty($_POST["password"])){
     $conn= mysqli_connect($dbconfig['host'],$dbconfig['username'],$dbconfig['password'],$dbconfig['database']) or die(mysqli_error($conn));
    $username=mysqli_real_escape_string($conn,$_POST["username"]);
    $password=mysqli_real_escape_string($conn,$_POST["password"]);
    $query="SELECT username, password FROM users WHERE username='".$username."' AND password ='".$password."'";
    $res=mysqli_query($conn,$query);
    if(mysqli_num_rows($res)>0){
        $_SESSION["username"]=$_POST["username"];
        header("Location:home_page.php");
    } else{
        $error=true;
    }
}
?>

<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" href="style/login.css">
        <script src="script/login.js" defer></script>
</head>
<body>
    <article id="main">
    <section id="form">
            
        <form name="login_form" method="post">
            <h3 id="title_site">LebonBlog</h3>
               
                <p>
                    <label class="username">Nome Utente<input type='text' name='username'></label>
                </p>
             
                
                <p> 
                    <label class="password">Password <input type='password' name='password'></label>
                </p>
                 <div class="login_err hidden">I due campi non possono essere vuoti.</div>
               <p id="subm">
                    <a href="registration.php">Non sei registrato? Clicca qui<a>
                        <input type='submit' value="Login"></label>



            </form>
        </section>
        </article>
    </body>
</html>
