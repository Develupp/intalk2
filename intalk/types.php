<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 5//EN">
<HTML>
<HEAD>
<META http-equiv="Content-Type" content="text/html; charset=iso-8859-2">
<TITLE>Típusok</TITLE>
</HEAD>

<BODY>
<PRE>
<FORM method="POST" action="">
<?php
header('Content-type: text/html; charset=iso-8859-2');
include_once ($_SERVER["DOCUMENT_ROOT"].DIRECTORY_SEPARATOR.'intalk'.DIRECTORY_SEPARATOR.'db.php');
include_once ($_SERVER["DOCUMENT_ROOT"].DIRECTORY_SEPARATOR.'intalk'.DIRECTORY_SEPARATOR.'menu.php');
include_once ($_SERVER["DOCUMENT_ROOT"].DIRECTORY_SEPARATOR.'intalk'.DIRECTORY_SEPARATOR.'functions.php');
    $types = select_firewall_types($db);
?>
    <table border="1" style="border-collapse: collapse">
        <tr>
            <th>Név</th>
            <th>Gyártó</th>
            <th>Support vége</th>
            <th>Termék vége</th>
        </tr>
        <?php foreach($types as $type ): ?>
        <tr>
            <td><?php echo $type["type_name"]?></td>
            <td><?php echo $type["manufacturer"]?></td>
            <td><?php echo $type["end_of_support"] ?></td>
            <td><?php echo $type["end_of_life"] ?></td>
        </tr>
<?php endforeach ?>
    </table>
</FORM>
</PRE>
</BODY>
</HTML>

