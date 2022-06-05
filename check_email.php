<?php
require_once 'dbconfig.php';

if(isset($_GET["q"])){
    header("Content-Type:application/json");

}else{
    echo "Errore";
    exit;
}
$conn = mysqli_connect($dbconfig['host'], $dbconfig['username'], $dbconfig['password'], $dbconfig['database']);
    $email = mysqli_real_escape_string($conn,$_GET['q']);
    $query="SELECT * FROM users WHERE email='".$email."'";
    $res=mysqli_query($conn,$query);
    echo json_encode(array("exists"=>mysqli_num_rows($res)>0?true:false));
    mysqli_clos($conn);
    ?>