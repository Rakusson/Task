<?php 

//Sprawdzenie danych z formularza oraz przesłanie do bazy
$flag=0;
$is_new_account=0;
$is_different_address=0;
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
$address=$_POST["address"];
$post_code=$_POST["post_code"];
$city=$_POST["city"];
$phone=$_POST["phone"];
$new_country=$_POST["new_country"];
$new_address=$_POST["new_address"];
$new_post_code=$_POST["new_post_code"];
$new_city=$_POST["new_city"];
$new_phone=$_POST["new_phone"];
$delivery=$_POST["delivery"];
$payment=$_POST["payment"];
$comment=$_POST["comment"];
$newsletter=$_POST["newsletter"];
$price=$_POST["price"];
$discount=1;
$recaptcha=$_POST["recaptcha"];

foreach($_POST as $key=>$value)
{  
    if($key=='new_account' && $value==1){
        $is_new_account=1;
    }
    if($key=='different_address' && $value==1){
        $is_different_address=1;
    }

    if(($is_new_account==0 && $key!='new_account' && $key!='login' && $key!='password' && $key!='confirmpassword') || $is_new_account==1){
        if(($is_different_address==0 && $key!='different_address' && $key!='new_address' && $key!='new_country' && $key!='new_post_code'  && $key!='new_city'  && $key!='new_phone') || $is_different_address==1){
            if(empty($value))
            {
                echo("Uzupełnij brakujące pola <br>");
                $flag = 1;
                break;
            }
        }
    }
}

require('database_connect.php');
if($is_new_account==1){
    $user=$mysqli->query("SELECT `login` FROM `client` WHERE `login` = '".$login."'")->fetch_array(MYSQLI_ASSOC);
    if (!empty($user))
    {
        if($login == $user['login'])
        {
            echo("Taki login już istnieje <br>");
            $flag = 1;
        }
    }   
}

$secretKey = "6Ld5QIccAAAAAM_geWvvMwQavzk0IQ9_3j1uTqnT";
$ip = $_SERVER['REMOTE_ADDR'];
//wysyła zapytanie na serwer
$url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($recaptcha);
$response = file_get_contents($url);
$responseKeys = json_decode($response,true);

if($responseKeys["success"]) {
    if($flag == 0)
    {
       
        //Hashowanie hasła
        $password = password_hash($password, PASSWORD_DEFAULT);
        if($newsletter==2){
            $newsletter=0;
        }
        if ($is_new_account==1) {
            $mysqli->query("INSERT INTO `client`(`login`, `password`, `name`, `lastname`, `country`, `adress`, `post_code`, `city`, `phone`, `newsletter`) VALUES ('$login','$password','$name','$lastname','$country','$address','$post_code','$city','$phone','$newsletter')");
        } else {
            $mysqli->query("INSERT INTO `client`(`name`, `lastname`, `country`, `adress`, `post_code`, `city`, `phone`, `newsletter`) VALUES ('$name','$lastname','$country','$address','$post_code','$city','$phone','$newsletter')");
        }
        $result = $mysqli->query("SELECT id FROM client ORDER BY id DESC");
        $row = $result->fetch_array(MYSQLI_ASSOC);
        $id_klienta = $row["id"];

        if($is_different_address==1){
            $mysqli->query("INSERT INTO `different_address`(`country`, `address`, `post_code`, `city`, `phone`) VALUES ('$new_country','$new_address','$new_post_code','$new_city','$new_phone')");
            $result_addr = $mysqli->query("SELECT id FROM different_address ORDER BY id DESC");
            $row_addr = $result_addr->fetch_array(MYSQLI_ASSOC);
            $id_different_address = $row_addr["id"];
        }else{
            $id_different_address='NULL';
        }

        if($id_different_address=='NULL'){
            $mysqli->query("INSERT INTO `order`(`id_client`, `price`, `product`, `quantity`, `id_delivery`, `id_payment` , `comment`, `id_discount`) VALUES ('$id_klienta','$price','przykladowy_produkt','1','$delivery','$payment','$comment','$discount')");
        }else{
            $mysqli->query("INSERT INTO `order`(`id_client`, `price`, `product`, `quantity`, `id_delivery`, `id_payment` , `comment`, `id_discount`, `id_different_address`) VALUES ('$id_klienta','$price','przykladowy_produkt','1','$delivery','$payment','$comment','$discount','$id_different_address')");
        }
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