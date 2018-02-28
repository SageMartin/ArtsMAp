<?php
    function debug($msg) {
        $msg = str_replace('"', '\\"', $msg);
        echo "<script>console.log('Debug: ' + \"$msg\")</script>";
    }
    $con = new mysqli("localhost", "root", "", "test");

    if ($con->connect_errno) {
        debug("Failed to connect to MySQL (" . $con->connect_errno . ") " . $con->connect_error);
    }

    $new_mat = $_POST["input"];
    debug("Attempting to create material " . $new_mat . '.');
    if (!($check_material = $con->prepare("SELECT materialID FROM MaterialType WHERE type = ?"))) {
        debug(sprintf("Material Check prepare failed: ( %s ) %s", $con->errno, $con->error));
    } else {
        $check_material->bind_param("s", $new_mat);
        $check_material->execute();
        $check_material->bind_result($material_id);
        $check_material->store_result();
        debug(sprintf("%d matching rows.", $check_material->affected_rows));
        if ($check_material->affected_rows > 0) {
            $check_material->fetch();
            if (!$material_id) {
                debug("No material found.");
            } else {
                debug(sprintf("Material " . $new_mat . " exists materialID found is %d.", $material_id));
            }
        }
        $check_material->free_result();
        $check_material->close();
    }
    if (!$material_id) {
        debug("Creating material " . $new_mat . ".");
        if (!($sql_material_ins = $con->prepare("INSERT INTO MaterialType (type) VALUES (?)"))) {
            debug(sprintf("Material Insert prepare failed: ( %s ) %s", $con->errno, $con->error));
        } else {
            $sql_material_ins->bind_param("s", $new_mat);
            $sql_material_ins->execute();
            debug(sprintf("%d rows inserted.", $sql_material_ins->affected_rows));
            $sql_material_ins->close();
            $material_id = $con->insert_id;
            debug(sprintf("New materialID: %d", $material_id));
        }
        echo "Created new material called: " . $new_mat . "!";
    } else {
        echo "Material " . $new_mat . " already exists!";
    }
    $con->close();
?>