<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 5//EN">
<HTML>
<HEAD>
<META http-equiv="Content-Type" content="text/html; charset=iso-8859-2">
<TITLE>Tűzfalak</TITLE>
</HEAD>

<BODY>
<PRE>
<FORM method="POST" action="">
<?php
header('Content-type: text/html; charset=iso-8859-2');
include_once ($_SERVER["DOCUMENT_ROOT"].DIRECTORY_SEPARATOR.'intalk'.DIRECTORY_SEPARATOR.'db.php');
include_once ($_SERVER["DOCUMENT_ROOT"].DIRECTORY_SEPARATOR.'intalk'.DIRECTORY_SEPARATOR.'menu.php');
include_once ($_SERVER["DOCUMENT_ROOT"].DIRECTORY_SEPARATOR.'intalk'.DIRECTORY_SEPARATOR.'functions.php');

    if(isset($_POST["new_firewall"])){
        new_firewall($db);
    }
    
    if(isset($_POST["delete_firewall"])){
        delete_firewall($db);
    }
    
    if(isset($_POST["empty_firewall"])){
        $emptyfw = empty_firewall($db);
    }
    
    $firewalls = select_all_firewall($db);
    $types = select_firewall_types($db);

?>
    <table border="1" style="border-collapse: collapse">
        <tr>
            <th></th>
            <th>Név</th>
            <th>IP</th>
            <th>Típus</th>
            <th></th>
        </tr>
<?php foreach($firewalls as $firewall ): ?>
        <tr>
            <td><input type="checkbox" name="firewall_id[]" value="<?php echo $firewall["firewall_id"]?>"></td>
            <td><a href="./showfw.php?id=<?php echo $firewall["firewall_id"] ?>"><?php echo $firewall["firewall_name"]?></a></td>
            <td><?php echo $firewall["firewall_ip"]?></td>
            <td><?php echo $firewall["manufacturer"]."_".$firewall["type_name"] ?></td>
            <td><a href="./editfw.php?id=<?php echo $firewall["firewall_id"] ?>">Szerkesztés</a></td>
        </tr>
<?php endforeach ?>
    </table>
    
    <input type="submit" name="delete_firewall" value="Tűzfal(ak) törlése"> <input type="submit" name="empty_firewall" value="Üres tűzfalak">
    
    <?php if(isset($_POST["empty_firewall"])) : ?>
    <table border="1" style="border-collapse: collapse">
    <tr>
        <th>Név</th>
        <th>IP</th>
        <th>Típus</th>
    </tr>
    <?php foreach($emptyfw as $fw): ?>
    <tr>
        <td><?php echo $fw["firewall_name"]?></td>
        <td><?php echo $fw["firewall_ip"]?></td>
        <td><?php echo $fw["manufacturer"]."_".$fw["type_name"]?></td>
    </tr>
    <?php endforeach ?>
    </table>
    <?php endif ?>
    
        <legend><b>Új tűzfal:</b></legend>
        Név:    <input type="text" name="firewall_name" <?php if(isset($_POST["firewall_name"])) echo "value=\"".$_POST["firewall_name"]."\""; ?>> 
        IP:     <input type="text" name="firewall_ip" pattern="(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)_*(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)_*){3}" <?php if(isset($_POST["firewall_ip"])) echo "value=\"".$_POST["firewall_ip"]."\""; ?>> 
        Típus:  <select name="firewall_type">
        <?php foreach($types as $type): ?>
        <option value="<?php echo $type["type_id"] ?>" <?php if(isset($_POST["firewall_type"])&&$_POST["firewall_type"]==$type["type_id"]) echo "selected" ?>><?php echo $type["manufacturer"]."_".$type["type_name"]?></option>
        <?php endforeach ?>
        </select>
        <input type="submit" name="new_firewall" value="Új tűzfal">
</FORM>
</PRE>
</BODY>
</HTML>