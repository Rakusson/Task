<?php

//utworzenie klasy oraz wykorzystanie w formie rabatu
class discount{
    public $code;
    public $percent;
    public $active;
    public function count()
    {
        return $this->percent * 115;
    }
}
$d1 = new discount();

$discount = $_POST["discount"];
if(!empty($discount))
{
    require('database_connect.php');
    $discountbase = $mysqli->query("SELECT code, percent, active FROM discount ORDER BY id");
    $row = $discountbase->fetch_all(MYSQLI_ASSOC);
    $flag = 0;
    foreach($row as $value)
    {
        if($value["code"] == $discount)
        {
            if($value["active"] == 1)
            {
            $d1->code = $value["code"];
            $d1->percent = $value["percent"];
            $d1->active = $value["active"];
            $flag = 1;
            }
            else
            {
                echo "Kod wygasł";
                $flag = 2;
            }
        }
    }
    if($flag == 0)
    {
        echo "Wpisany kod nie istnieje";
    }
    else
    {
        if ($flag == 1)
        {
            echo ("<script>discountjs = ".$d1->count().";</script>");
        }
        else
        {  
        }
    }

}
else
{
    echo "Wpisz kod";
}

?>