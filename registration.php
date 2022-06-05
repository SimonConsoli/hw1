<?php
include 'dbconfig.php';
session_start();
if(isset($_SESSION['username'])){
    header("Location:home_page.php");
    exit;
}


if(!empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["email"])&& !empty($_POST["name"])&& !empty($_POST["surname"])&& !empty($_POST["confirm_password"]))
{
    $conn= mysqli_connect($dbconfig['host'],$dbconfig['username'],$dbconfig['password'],$dbconfig['database']) or die(mysqli_error($conn));
    



if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){ 
    $error[]="E-mail non valida";

}
else{
    $email=mysqli_real_escape_string($conn,$_POST["email"]);
    $res=mysqli_query($conn,"SELECT email FROM users WHERE email='".$email."'");
   // if(mysqli_num_ros($res)>0) $error[]="E-mail già presente nel database";
}


if(!preg_match("/^[a-z](?=(?:[a-z]*\d){0,4}(?![a-z]*\d))(?=[a-z\d]{3,11}$)[a-z\d]+$/i", $_POST['username'])){ //
    $error[]="Username non valido ";
}
else{
    $query = "SELECT username FROM users WHERE username='".$username."'";
    $res=mysqli_query($conn,$query);
    if(mysqli_num_rows($res)>0){
        $error[]="Username già utilizzato";
    }
}


if(strlen($_POST["password"])>8||strlen($_POST["password"]<16)){
    $error[]="La password deve contenere almeno 8 caratteri e non deve superarne i 16";
}



if(strcmp($_POST["password"], $_POST["confirm_password"]) !=0){
    $error[]="Password non coincidenti. Riprova";
}


if(count($error)==0){
    $name=mysqli_real_escape_string($conn,$_POST["name"]);
    $username=mysqli_real_escape_string($conn,$_POST["username"]);
    $email=mysqli_real_escape_string($conn,$_POST["email"]);
    $password=mysqli_real_escape_string($conn,$_POST["password"]);
    $surname=mysqli_real_escape_string($conn,$_POST["surname"]);
    $query= "INSERT INTO users(username,name,surname,email,password)VALUES('$username','$name','$surname','$email','$password')";
    if(mysqli_query($conn,$query)){
        $_SESSION['username']=$_POST['username'];
        $_SESSION['User_id']=mysqli_insert_id($conn);
        header('Location:home_page.php');
        mysqli_close($conn);
        exit;
    }

}
}

?>

<html>
    <head>
        <title>Registrati ->LebonBlog<-</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style/registration.css">
        <script src="script/registrazione.js" defer></script>



</head>
<body>
    <article id="main">
    <section id="form">
          
           
        <form name="registration_form" id="reg_form" method="post">
            <h3 id="site_name">LebonBlog</h3>
                <div id="register">Registrati</div>
                <div class="error_A hidden">Compila i campi in modo corretto.</div>



                <p class="nome"> 
                    <label>Nome<input type='text' name='nome'></label>
                </p>
                 <div id="error_n"class="registration_err hidden">Nome non valido</div>

                <p class="cognome"> 
                    <label>Cognome<input type='text' name='cognome'></label>
                </p>
                <div id="error_s" class="registration_err hidden">Cognome non valido</div>

                <p class="username">
                    <label>Nome Utente<input type='text' name='username'></label>
                </p>
                <div id="error_us" class="registration_err hidden">Username non valido</div>

                <p class="email"> 
                    <label>E-Mail<input type='text' name='email'></label>    
                </p>
                <div id="error_em" class="registration_err hidden">E-mail non valida</div>

                <p class="password"> 
                    <label>Password <input type='password' name='password'></label>
                </p>
                <div id="error_pass" class="registration_err hidden">La password deve essere compresa tra 8 e 16 caratteri</div>
                
                <p class="confirm_password"> 
                    <label>Conferma Password<input type='password' name='confirm_password'></label>
                </p>
                <div id="error_cp" class="registration_err hidden">Le password non corrispondono</div>

                <p id="logandsubmit">
                    <a href="login_page.php" id="loginredirect">Già registrato? Effettua il login.</a><input type='submit' id="submit" value="Registrati">
                </p>



            </form>
           
        </section>
        </article>
    </body>
</html>
  