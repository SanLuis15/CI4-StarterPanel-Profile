<?php
// simple script to inspect the database tables for this CI4 app
require __DIR__ . '/vendor/autoload.php';

// Use framework to bootstrap environment
// code from public/index.php simplified
// Load our paths config
$appPaths = require APPPATH . 'Config/Paths.php';
require rtrim($appPaths->systemDirectory, '\/') . '/bootstrap.php';

// now we should have services available
$db = \Config\Database::connect();

echo "Using database: " . $db->getDatabase() . "\n";

$tables = $db->listTables();
echo "Tables: \n";
print_r($tables);

if ($db->tableExists('students')) {
    echo "\nstudents table exists\n";
    $rows = $db->table('students')->get()->getResultArray();
    print_r($rows);
} else {
    echo "\nstudents table does not exist\n";
}
