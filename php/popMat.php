<?php 
    function debug($msg) {
        $msg = str_replace('"', '\\"', $msg);
        echo "<script>console.log('Debug: ' + \"$msg\")</script>";
    }
    $con = new mysqli("localhost", "root", "", "test");

    if ($con->connect_errno) {
        debug("Failed to connect to MySQL (" . $con->connect_errno . ") " . $con->connect_error);
    }
    if (!($sql_material_type = $con->prepare("SELECT DISTINCT type FROM MaterialType"))) {
        debug(sprintf("Material Type prepare failed: ( %s ) %s", $con->errno, $con->error));
    } else {
        $sql_material_type->execute();
        $sql_material_type->bind_result($types);
        $sql_material_type->store_result();
        debug(sprintf("%d matching rows.", $sql_material_type->affected_rows));
        while ($sql_material_type->fetch()) {
            printf("<option value=%s>%s</option>", $types, $types);
        }
        $sql_material_type->free_result();
        $sql_material_type->close();
    }
    $con->close();
?>