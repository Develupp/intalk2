<?php
function tostring($s){
	return '"'.$s.'"';
}

function check_sql($query, $db){
    if (!$query){
        echo 'hiba:',mysqli_errno($db)," ok:",mysqli_error($db);
        return false;
    }
    return true;
}

function new_firewall($db){
    $firewall_name = tostring($_POST["firewall_name"]);
    $firewall_ip = tostring($_POST["firewall_ip"]);
    $firewall_type = $_POST["firewall_type"];
    if(test_firewall_name($firewall_name, $db) && test_firewall_ip($firewall_ip, $db)){
        $new_firewall = "insert into firewall (firewall_name,firewall_ip,firewall_type_id) values ($firewall_name,$firewall_ip,$firewall_type)";
        $nf = mysqli_query($db,$new_firewall);
        check_sql($nf, $db);
    }
}

function edit_firewall($id, $db){
    $firewall_name = tostring($_POST["firewall_name"]);
    $firewall_ip = tostring($_POST["firewall_ip"]);
    $firewall_type = $_POST["firewall_type"];
    $edit_firewall = "update firewall SET firewall_name=$firewall_name, firewall_ip=$firewall_ip, firewall_type_id=$firewall_type WHERE firewall_id = $id";
    $ef = mysqli_query($db,$edit_firewall);
    check_sql($ef, $db);
}

function delete_firewall($db){
    foreach($_POST["firewall_id"] as $firewall_id){
        $delete_firewall = "delete from firewall where firewall_id = $firewall_id";
        $df = mysqli_query($db,$delete_firewall);
        check_sql($df, $db);
    }
}

function select_all_firewall($db){
    $select_all="select * from firewall, type WHERE firewall_type_id = type_id";
    $firewalls=mysqli_query($db,$select_all);
    check_sql($firewalls, $db);
    return $firewalls;
}

function select_firewall_by_id($id, $db){
    $select="select * from firewall WHERE firewall_id = $id";
    $firewall = mysqli_query($db,$select);
    check_sql($firewall, $db);
    return $firewall;
}

function test_firewall($firewall_name, $firewall_ip, $db){
    $q = "select * from firewall where firewall_name = $firewall_name OR firewall_ip = $firewall_ip";
    $df = mysqli_query($db,$q);
    check_sql($df, $db);
    if($df->num_rows>0){
        echo "Létezik már ilyen tûzfalnév vagy IP";
        return false;
    }
    return true;
}

function test_firewall_name($firewall_name, $db){
    $q = "select firewall_id from firewall where firewall_name = $firewall_name";
    $df = mysqli_query($db,$q);
    check_sql($df, $db);
    if($df->num_rows>0){
        echo "Létezik már ilyen tûzfalnév";
        return false;
    }
    return true;
}
function test_firewall_ip($firewall_ip, $db){
    $q = "select firewall_id from firewall where firewall_ip = $firewall_ip";
    $df = mysqli_query($db,$q);
    check_sql($df, $db);
    if($df->num_rows>0){
        echo "Létezik már ilyen tûzfal IP";
        return false;
    }
    return true;
}

function select_firewall_types($db){
    $q = "select * from type";
    $types = mysqli_query($db,$q);
    check_sql($types, $db);
    return $types;
}

function select_all_network($db){
    $select_all="select * from network";
    $networks=mysqli_query($db,$select_all);
    check_sql($networks, $db);
    return $networks;
}

function get_fw($nw_id, $db){
    $select = "select firewall_id from firewall_network, firewall WHERE firewall = firewall_id AND network = $nw_id";
    $result = mysqli_query($db,$select);
    check_sql($select, $db);
    if($result->num_rows==0){
        return "0";
    }
    return $result->fetch_assoc()["firewall_id"];
}

function set_network_fw($db){
    $truncate = "truncate table firewall_network";
    $empty = mysqli_query($db,$truncate);
    check_sql($empty, $db);
    for($i=0; $i<count($_POST["network_id"]);$i++){
        $fw_id = $_POST['firewall_id'][$i];
        $nw_id = $_POST['network_id'][$i];
        if($_POST["firewall_id"][$i]!=0){
            $insert = "insert into firewall_network (firewall, network) values ($fw_id, $nw_id)";
            $data = mysqli_query($db,$insert);
            check_sql($data, $db);
        }
    }
}

function new_network($db){
    $ip = tostring($_POST["network_ip"]);
    $netmask = tostring($_POST["netmask"]);
    if(test_network($ip, $netmask, $db)){
        //var_dump($_POST);
        $insert = "insert into network (ip, netmask) values ($ip, $netmask)";
        $new_nw = mysqli_query($db,$insert);
        check_sql($new_nw, $db);
    }
}

function test_network($ip, $netmask, $db){
    $q = "select network_id from network where ip = $ip and netmask = $netmask";
    $df = mysqli_query($db,$q);
    check_sql($df, $db);
    if($df->num_rows>0){
        echo "Létezik már ilyen hálózat";
        return false;
    }
    return true;
}

function show_firewall($id, $db){
    $sql1 = "select firewall_name, firewall_ip, CONCAT(manufacturer,\"_\",type_name) as type from firewall, type where firewall_type_id = type_id and firewall_id = $id";
    $firewall=mysqli_query($db,$sql1);
    check_sql($firewall, $db);
    $sql2 = "select ip, netmask from network, firewall_network where network_id = network and firewall = $id";
    $network=mysqli_query($db,$sql2);
    check_sql($network, $db);
    if(check_sql($firewall, $db) && check_sql($network, $db)){
        $result["firewall"]= $firewall->fetch_assoc();
        $result["network"]= $network;
        return $result;
    }
}

function empty_firewall($db){
    $sql = "select * from firewall, type where firewall_id not in(SELECT firewall from firewall_network) and firewall_type_id = type_id";
    $firewall=mysqli_query($db,$sql);
    if(check_sql($firewall, $db)){
        return $firewall;
    }
    
}

?>