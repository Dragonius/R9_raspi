<?php
include ("config.php");
$mysqli = new mysqli($db_server, $db_user, $db_pass, $db_name );

if (mysqli_connect_errno()) { printf("Connect failed: %s\n", mysqli_connect_error()); exit(); }
$result = $mysqli->query("SELECT a01 from table order by id desc limit 1");


foreach($result as $r) {

    if ($result != null)
    {
       $rows = array('a01' => (float) $r['a01']);
       echo $r['a01'];
    }

        if ($result == null)
    {
       $rows = array('0' => (float) '0');
    }

}

?>
