<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 5//EN">
<HTML>
<HEAD>
<META http-equiv="Content-Type" content="text/html; charset=iso-8859-2">
<TITLE>Tűzfal szerkesztés</TITLE>
</HEAD>
<BODY>
<PRE>
<FORM method="POST" action="">
<?php
header('Content-type: text/html; charset=iso-8859-2');
include_once ($_SERVER["DOCUMENT_ROOT"].DIRECTORY_SEPARATOR.'intalk'.DIRECTORY_SEPARATOR.'db.php');
include_once ($_SERVER["DOCUMENT_ROOT"].DIRECTORY_SEPARATOR.'intalk'.DIRECTORY_SEPARATOR.'menu.php');
include_once ($_SERVER["DOCUMENT_ROOT"].DIRECTORY_SEPARATOR.'intalk'.DIRECTORY_SEPARATOR.'functions.php');
    
    if(isset($_POST["edit_firewall"])){
        edit_firewall($_GET["id"], $db);
    }
    
    $types = select_firewall_types($db);
    $types = select_firewall_types($db);
    $firewall = select_firewall_by_id($_GET["id"], $db)->fetch_assoc();
?>
        <legend><b>Tűzfal szerkesztés</b></legend>
        Név:    <input type="text" name="firewall_name" <?php if(isset($firewall["firewall_name"])) echo "value=\"".$firewall["firewall_name"]."\""; ?>> 
        IP:     <input type="text" name="firewall_ip" pattern="(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)_*(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)_*){3}" <?php if(isset($firewall["firewall_ip"])) echo "value=\"".$firewall["firewall_ip"]."\""; ?>> 
        Típus:  <select name="firewall_type">
        <?php foreach($types as $type): ?>
        <option value="<?php echo $type["type_id"] ?>" <?php if(isset($firewall["firewall_type_id"]) && $firewall["firewall_type_id"]===$type["type_id"]) echo "selected" ?>><?php echo $type["manufacturer"]."_".$type["type_name"]?></option>
        <?php endforeach ?>
        </select>
        <input type="submit" name="edit_firewall" value="Tűzfal szerkesztés">
</FORM>
</PRE>
</BODY>
</HTML>

