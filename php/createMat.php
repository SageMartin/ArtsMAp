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
    debug("New Material: " . $new_mat);

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
    $con->close();
?>