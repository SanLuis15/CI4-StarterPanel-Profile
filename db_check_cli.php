<?php
function checkDb($host, $user, $pass, $dbName) {
    echo "\n--- Checking database: $dbName ---\n";
    $m = new mysqli($host, $user, $pass, $dbName);
    if ($m->connect_error) {
        echo "Connection error: " . $m->connect_error . "\n";
        return;
    }
    $tables = [];
    $res = $m->query('SHOW TABLES');
    if ($res) {
        while ($r = $res->fetch_row()) {
            $tables[] = $r[0];
        }
    }
    if (empty($tables)) {
        echo "No tables found.\n";
    } else {
        echo "Tables: \n" . implode("\n", $tables) . "\n";
    }

    if (in_array('students', $tables)) {
        $q = $m->query("SELECT COUNT(*) AS cnt FROM students");
        if ($q) {
            $cnt = $q->fetch_assoc()['cnt'];
            echo "students table exists, rows = $cnt\n";
            $r = $m->query("SELECT id, name, email, course FROM students LIMIT 5");
            if ($r) {
                echo "Sample rows:\n";
                while ($row = $r->fetch_assoc()) {
                    echo json_encode($row) . "\n";
                }
            }
        } else {
            echo "Failed to count students: " . $m->error . "\n";
        }
    } else {
        echo "students table does not exist in $dbName\n";
    }

    $m->close();
}

checkDb('localhost', 'root', '', 'project');
checkDb('localhost', 'root', '', 'adminpanel');

echo "\nDone.\n";
