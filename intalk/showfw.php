<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 5//EN">
<HTML>
<HEAD>
<META http-equiv="Content-Type" content="text/html; charset=iso-8859-2">
<TITLE>T�zfal</TITLE>
</HEAD>
<BODY>
<PRE>
<FORM method="POST" action="">
<?php
header('Content-type: text/html; charset=iso-8859-2');
include_once ($_SERVER["DOCUMENT_ROOT"].DIRECTORY_SEPARATOR.'intalk'.DIRECTORY_SEPARATOR.'db.php');
include_once ($_SERVER["DOCUMENT_ROOT"].DIRECTORY_SEPARATOR.'intalk'.DIRECTORY_SEPARATOR.'menu.php');
include_once ($_SERVER["DOCUMENT_ROOT"].DIRECTORY_SEPARATOR.'intalk'.DIRECTORY_SEPARATOR.'functions.php');
    
    $firewall = show_firewall($_GET["id"],$db);
?>

<h1><?php echo $firewall["firewall"]["firewall_name"].PHP_EOL ?></h1>
<b>T�zfal IP:</b>       <?php echo $firewall["firewall"]["firewall_ip"].PHP_EOL ?>
<b>T�zfal t�pus:</b>    <?php echo $firewall["firewall"]["type"].PHP_EOL ?>
<b>H�l�zatok sz�ma:</b> <?php echo $firewall["network"]->num_rows.PHP_EOL ?>


<b>H�l�zatok:</b>
<?php foreach($firewall["network"] as $network): ?>
<?php echo $network["ip"].'/'.$network["netmask"].PHP_EOL ?>
<?php endforeach ?>
</FORM>
</PRE>
</BODY>
</HTML>

