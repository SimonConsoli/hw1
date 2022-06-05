<?php
    require_once 'dbconfig.php';
    session_start();
    if(!isset($_SESSION['username'])){
        header("Location: login_page.php");
        exit;
    }
    
    //invio opinions
    if(isset($_POST['titolo']) && isset($_POST['opinion'])){
      
        $conn = mysqli_connect($dbconfig['host'],$dbconfig['username'],$dbconfig['password'],$dbconfig['database']);
        $titolo = mysqli_real_escape_string($conn,$_POST['titolo']);
        $opinion = mysqli_real_escape_string($conn,$_POST['opinion']);     
        $ID = null;
        $query1 = "SELECT personID from users where username = '".$_SESSION['username']."'";
        $res = mysqli_query($conn, $query1) or die("Errore: ".mysqli_error($conn));
        while($row = mysqli_fetch_assoc($res)){
            $ID = $row['personID'];
        }
       
        $query = "INSERT into posts(IDutente,titolo,opinion) values ('$ID',\"$titolo\",\"$opinion\")";
        if(mysqli_query($conn,$query)){
            $postato = true;
        }
        else $postato=false;
        mysqli_close($conn);

    }
    
  
    ?>

    <!DOCTYPE html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>LebonBlog</title>
    <script src="script/navbar.js" defer></script>
    <script src="script/home_page.js "defer></script>
	<link rel="stylesheet" href="style/home_page.css">
    

</head>
<body >
<section id="bo">
<div id="mySidebar" class="sidebar">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="home_page.php">Home</a>
  <a href="login_page.php">Login</a>
  <a href="registration.php">Signup</a>
  <a href="logout.php">Logout</a>
</div>

<div id="main">
  <button class="openbtn" onclick="openNav()">&#9776; Open Sidebar</button>
</div>
</section>
<?php
 if(isset($postato)){
                    echo"Il post è stato pubblicato!";
                } else if($posted = false){
                    echo "Non è stato possibile pubblicare il post";
                }
        ?>
    

    <header id="home" class="header">
        <div class="overlay"></div>

        <div id="header-c" class="c slide" data-ride="c">  
            <div class="container">
                <div class="c-inner">
                    <div class="c-item active">
                        <div class="c-caption ">
                            <h1 class="c-title">Passato, presente e futuro<br> Qui e ora</h1>
                            <button id="showpost" class=" btn btn-primary btn-rounded" href="ricerca.php">Leggi i post</button>
                        </div>
                    </div>            
                </div>
            </div>        
        </div>
        <div class="hidden show"></div>

        <div class="infos container ">
            <div class="title">
              
                <h5>Il blog di domani</h5>
                <p class="font-small">Un solo owner, una community di publisher</p>
            </div>
            <div class="socials ">
                <div >
                    <div>
                        <a > @Simon_Consoli</a>
                       
                    </div>
                    <div >
                        <h6 class="subtitle ">Social Media</h6>
                       
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="section" id="testmonial">
        <div class="container">
            <div id="titoletto">
            <h3 class="section-title" id="gfds">Testimonials</h3>
</div>

            <div id="owl-testmonial" class="owl-carousel owl-theme mt-4">
                <div class="item">
                    <div class="textmonial-item">
                        <img src="assets/imgs/avatar1.jpeg" class="avatar" >
                        <div >
                            <p>In questo sito ho notato la differenza con altri blog, la possibilità di esprimere la propria e di renderla pubblica è una rivoluzione.<br><br>Un nuovo punto di riferimento per i millenials. Viva la generazione Z!</p>
                            <div class="line"></div>
                            <h6 class="name">Lucy Hawkings</h6>
                            <h6 class="name">Economista</h6>
                        </div>
                    </div>
                </div>
             
             
    </section>
     <article id="background">
            <article id="sezionepost">
               
             <h9 >Sezione post </h9><h10> Qui puoi sfruttare la tua immaginazione e scrivere la tua sugli eventi che accadono in tutto il mondo.</h10>
             <div class="possibilities">
                  <div class="withdiv">
                      <button class="variety" data-button="writeit">Scrivi il tuo post</button>
                     <form  id="spotify" name="spotify" method="GET">
                     
                       <input type="text"  id="takeasong" name="takeasong" placeholder="Cerca la canzone che esprime meglio il tuo pensiero">
                       <input type="submit" class="variety"id="inline" value="Aggiungi una canzone"> </form>
                <div id="canzone">
</div>  
                </div>
              </div>
            


         


            <div class="withpost hidden">
                <form name="mypost" id="mypost" method="post">
                   
                    <label name="titolo"><br>Titolo</label><input type="text" id="titolo" name="titolo" placeholder="Inserisci il titolo">
                    
                    <label name="opinion">La tua opinione</label><textarea id="opinion" name="opinion" placeholder="Scrivi la tua opinione in merito!" rows="20" cols="200" wrap="soft"></textarea>
                    
                    <input type="submit" id="submit" value="Posta!">
                </form>
            </div>


            </article>  
            </article>
    
   
            <footer class="footer mt-5 border-top">
                        <p class="mb-0">Simone Consoli 1000004441 </p>
                    </div>
                    
            </footer>
        </div>
    </section>
	

    
    
  
    


   

</body>
</html>
