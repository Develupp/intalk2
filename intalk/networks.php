<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 5//EN">
<HTML>
<HEAD>
<META http-equiv="Content-Type" content="text/html; charset=iso-8859-2">
<TITLE>Hálózatok</TITLE>
</HEAD>

<BODY>
<PRE>
<FORM method="POST" action="">
<?php
header('Content-type: text/html; charset=iso-8859-2');
include_once ($_SERVER["DOCUMENT_ROOT"].DIRECTORY_SEPARATOR.'intalk'.DIRECTORY_SEPARATOR.'db.php');
include_once ($_SERVER["DOCUMENT_ROOT"].DIRECTORY_SEPARATOR.'intalk'.DIRECTORY_SEPARATOR.'menu.php');
include_once ($_SERVER["DOCUMENT_ROOT"].DIRECTORY_SEPARATOR.'intalk'.DIRECTORY_SEPARATOR.'functions.php');

    if(isset($_POST["set_network"])){
        set_network_fw($db);
    }
    
    if(isset($_POST["new_network"])){
        new_network($db);
    }

    $firewalls = select_all_firewall($db);
    $networks = select_all_network($db);
    
?>
    <table border="1" style="border-collapse: collapse">
        <tr>
            <th>IP</th>
            <th>Netmask</th>
            <th>Firewall</th>
        </tr>
<?php foreach($networks as $network ): ?>
        <tr>
            <td><?php echo $network["ip"] ?></td>
            <td><?php echo $network["netmask"]?></td>
            <td><select name="firewall_id[]">
                <option value="0" <?php if(get_fw($network["network_id"], $db)==0) echo "selected" ?>>intranet</option>
                <?php foreach($firewalls as $firewall): ?>
                <option value="<?php echo $firewall["firewall_id"]?>" <?php if(get_fw($network["network_id"], $db)==$firewall["firewall_id"]) echo "selected" ?> ><?php echo $firewall["firewall_name"]?></option>
                <?php endforeach ?>
                </select></td>
            <input type="hidden" name="network_id[]" value="<?php echo $network["network_id"] ?>"/>
        </tr>
<?php endforeach ?>
    </table>
    <input type="submit" name="set_network" value="Mentés">
    
        <legend><b>Új hálózat:</b></legend>
        IP:         <input type="text" name="network_ip" pattern="(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)_*(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)_*){3}"> 
        Netmask:    <select name="netmask">
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                        <option value="24" selected >24</option>
                        <option value="25">25</option>
                        <option value="26">26</option>
                        <option value="27">27</option>
                        <option value="28">28</option>
                        <option value="29">29</option>
                        <option value="30">30</option>
                        <option value="31">31</option>
                        <option value="32">32</option>
                    </select>
        <input type="submit" name="new_network" value="Új hálózat">
</FORM>
</PRE>
</BODY>
</HTML>

