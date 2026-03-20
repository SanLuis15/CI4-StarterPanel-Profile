<?php
require 'vendor/autoload.php';
$db = \Config\Database::connect();
$query = $db->query("DESCRIBE users");
print_r($query->getResultArray());
