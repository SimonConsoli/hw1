<?php

    require_once 'dbconfig.php';
    session_start();
    if(!isset($_SESSION['username'])){
        header("Location: login_page.php");
        exit;
    }
    else if(!isset($_GET["q"])){
        header("Location: home_page.php");
        exit;
    }
    
    header('Content-Type: application/json');

    $conn = mysqli_connect($dbconfig['host'], $dbconfig['username'], $dbconfig['password'], $dbconfig['database']);
    $number = mysqli_real_escape_string($conn,$_GET['q']);
    //per fare la fetch ai post
    $queryPOST = "SELECT * FROM posts ORDER BY IDpost DESC LIMIT ".$number;
    $resPOST = mysqli_query($conn,$queryPOST);
    if(mysqli_num_rows($resPOST)>0){
        while($row = mysqli_fetch_assoc($resPOST)){
        $queryID = "SELECT personID,username from users where personID = '".$row['IDutente']."'";
        $resID = mysqli_query($conn,$queryID);
        $comparazioneid = 0;
        
        while($row2 = mysqli_fetch_assoc($resID)){
            $username = $row2['username'];
        }

        
        

        $time = getTime($row['time']);
        $array[]=array(
            'IDpost' => $row['IDpost'],
            'username' => $username,
            'titolo' => $row['titolo'],
            'opinion' => $row['opinion'],
            'time' => $time,
            'numeropost' => mysqli_num_rows($resPOST)
        );
    }
    }
    else {
        $array[] = array('found' => false);
        echo json_encode($array);
        mysqli_close($conn);
        exit;}


    function getTime($timestamp) {          
        $old = strtotime($timestamp); 
        $diff = time() - $old;           
        $old = date('d/m/y', $old);

        if ($diff /60 <1) {
            return intval($diff%60)." secondi fa";
        } else if (intval($diff/60) == 1)  {
            return "un minuto fa";  
        } else if ($diff / 60 < 60) {
            return intval($diff/60)." minuti fa";
        } else if (intval($diff / 3600) == 1) {
            return "un'ora fa";
        } else if ($diff / 3600 <24) {
            return intval($diff/3600) . " ore fa";
        } else if (intval($diff/86400) == 1) {
            return "ieri";
        } else if ($diff/86400 < 30) {
            return intval($diff/86400) . " giorni fa";
        } else {
            return $old; 
        }
    }

?>

