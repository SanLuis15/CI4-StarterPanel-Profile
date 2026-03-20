<?php
$db = new mysqli('localhost', 'root', '', 'project');
$hash = password_hash('Password1', PASSWORD_DEFAULT);
$db->query("UPDATE users SET password = '$hash'");
echo "All passwords updated to Password1";
