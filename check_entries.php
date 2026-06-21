<?php
require_once 'config.php';
$result = $conn->query("SELECT * FROM dukungan ORDER BY created_at DESC LIMIT 5");
if ($result) {
    echo "Last 5 entries:\n";
    while ($row = $result->fetch_assoc()) {
        print_r($row);
    }
} else {
    echo "Query failed: " . $conn->error;
}
