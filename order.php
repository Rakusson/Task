<?php 

//Sprawdzenie danych z formularza oraz przesłanie do bazy
$flag=0;
$login=$_POST["login"];
$password=$_POST["password"];
$confirmpassword=$_POST["confirmpassword"];
if($confirmpassword != $password)
{
    echo("Hasła nie są takie same <br>");
    $flag = 1;
}
$name=$_POST["firstname"];
$lastname=$_POST["lastname"];
$country=$_POST["country"];
$adress=$_POST["adress"];
$post_code=$_POST["post_code"];
$city=$_POST["city"];
$phone=$_POST["phone"];
$delivery=$_POST["delivery"];
$payment=$_POST["payment"];
$comment=$_POST["comment"];
$newsletter=$_POST["newsletter"];
$price=$_POST["price"];
$discount=1;
$recaptcha=$_POST["recaptcha"];

foreach($_POST as $value)
{  
    if(empty($value))
    {
        echo("Uzupełnij brakujące pola <br>");
        $flag = 1;
        break;
    }
}

$secretKey = "6Ld5QIccAAAAAM_geWvvMwQavzk0IQ9_3j1uTqnT";
$ip = $_SERVER['REMOTE_ADDR'];
// post request to server
$url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($recaptcha);
$response = file_get_contents($url);
$responseKeys = json_decode($response,true);
// should return JSON with success as true
if($responseKeys["success"]) {
    if($flag == 0)
    {
        require('database_connect.php');
        if ($mysqli->query("INSERT INTO `client`(`login`, `password`, `name`, `lastname`, `country`, `adress`, `post_code`, `city`, `phone`, `newsletter`) VALUES ('$login','$password','$name','$lastname','$country','$adress','$post_code','$city','$phone','$newsletter')") === TRUE) {
            
        } else {
            
        }
        $result = $mysqli->query("SELECT id FROM client ORDER BY id DESC");
        $row = $result->fetch_array(MYSQLI_ASSOC);
        $id_klienta = $row["id"];

        $mysqli->query("INSERT INTO `order`(`id_client`, `price`, `product`, `quantity`, `id_delivery`, `id_payment` , `comment`, `id_discount`) VALUES ('$id_klienta','$price','przykladowy_produkt','1','$delivery','$payment','$comment','$discount')");
        $orders = $mysqli->query("SELECT id FROM `order` ORDER BY id DESC");
        $row2 = $orders->fetch_array(MYSQLI_ASSOC);
        $id_order = $row2["id"];

        echo("Złożono zamówienie nr $id_order");
    }
}
else
{
    echo("Zweryfikuj, że nie jesteś robotem");
}


?>