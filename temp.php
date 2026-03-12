<?php
require 'app/Config/Boot/development.php';
$db = \Config\Database::connect();
$result = $db->table('students')->get()->getResultArray();
print_r($result);
