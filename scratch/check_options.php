<?php
$conn = new mysqli('localhost', 'root', '', 'crmsoft');
$res = $conn->query("SELECT name, value FROM tbloptions WHERE name IN ('company_logo', 'company_logo_dark', 'favicon', 'companyname')");
while ($row = $res->fetch_assoc()) {
    echo "{$row['name']}: {$row['value']}\n";
}

