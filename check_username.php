<?php

require_once 'dbconfig.php'

if(isset($_GET["q"])){
    header("Content-Type: application/json");

}else{
    echo "Errore";
    exit;
}
$conn= mysqli_connect($dbconfig=['host'],$dbconfig['user'],$dbconfig=['password'],$dbconfig['name'] or die(mysqli_error($conn));
$username=mysqli_real_escape_string($_GET['q']);
$query="SELECT username FROM users WHERE username='".$username."'";
$res=msqli_query($conn,$query) or die(mysqli_error($conn))
echo json_econde(array('exists'=>mysqli_num_rows($res)>0 ? true: false))
mysqli_close($conn);
exit;


?>