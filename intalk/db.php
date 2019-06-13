<?php

$db=mysqli_connect( 'localhost','root','','firewalls');
if (!$db) {
    exit("sikertelen kapcsolat:". mysqli_connect_error());
}

?>