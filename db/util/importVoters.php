<?php

$array = array("GENERAL-11/04/2003","PRIMARY-03/02/2004","GENERAL-11/02/2004","SPECIAL-02/08/2005","PRIMARY-05/03/2005","PRIMARY-09/13/2005","GENERAL-11/08/2005","SPECIAL-02/07/2006","PRIMARY-05/02/2006","GENERAL-11/07/2006","PRIMARY-05/08/2007","PRIMARY-09/11/2007","GENERAL-11/06/2007","PRIMARY-11/06/2007","GENERAL-12/11/2007","PRIMARY-03/04/2008","PRIMARY-10/14/2008","GENERAL-11/04/2008","GENERAL-11/18/2008","PRIMARY-05/05/2009","PRIMARY-09/08/2009","PRIMARY-09/15/2009","PRIMARY-09/29/2009","GENERAL-11/03/2009","PRIMARY-05/04/2010","PRIMARY-07/13/2010","PRIMARY-09/07/2010","GENERAL-11/02/2010","PRIMARY-05/03/2011","PRIMARY-09/13/2011","GENERAL-11/08/2011","PRIMARY-03/06/2012","GENERAL-11/06/2012","PRIMARY-05/07/2013","PRIMARY-09/10/2013","PRIMARY-10/01/2013","GENERAL-11/05/2013","PRIMARY-05/06/2014","GENERAL-11/04/2014","PRIMARY-05/05/2015","PRIMARY-09/15/2015","GENERAL-11/03/2015","PRIMARY-03/15/2016","GENERAL-06/07/2016","PRIMARY-09/13/2016","GENERAL-11/08/2016");

$user = "root";
$pass = "10068366";
$dbname = "grapevine";
$host = "localhost";

try {

    $source = "mysql:host=$host;dbname=$dbname";
    $db = new PDO($source, $user, $pass, array("charset" => "utf8"));
    $db->query("SET CHARACTER SET utf8");
} catch (PDOException $e) {
    echo "Connection Error Message: " . $e->getMessage() . "<br/>";
    die();
}

$newarray = str_replace("-", "", $array);
$newarray = str_replace("/", "", $newarray);
$newarray = array_map('strtolower', $newarray);

foreach($newarray as $col) {
    $query = ("
        ALTER TABLE voters
        add $col varchar(255)
        ");
    echo $query;

    $prep = $db->prepare("$query");
    $prep->bindParam(1, $col);
    $prep->execute();
}

/** Enter file below */
$populateQuery = ("
    load data local infile './SWVF_45_88.TXT'
    into table voters fields terminated by ',' enclosed by"
    + '"' + "lines terminated by '\n' ignore 1 rows
");

$prep = $db->prepare("$populateQuery");
$prep->execute();

?>
