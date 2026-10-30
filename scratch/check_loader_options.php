<?php
$conn = new mysqli('localhost', 'root', '', 'crmsoft');
$res = $conn->query("SELECT name, value FROM tbloptions WHERE name LIKE '%load%' OR name LIKE '%anim%' OR name LIKE '%preloader%'");
while ($row = $res->fetch_assoc()) {
    echo "{$row['name']}: {$row['value']}\n";
}

