<?php
require 'config.php';

$conn = getDBConnection();
$result = $conn->query("DESCRIBE comments");

echo "<h2>Comments Table Structure</h2>";
echo "<table border='1'>";
echo "<tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th><th>Extra</th></tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    foreach ($row as $value) {
        echo "<td>$value</td>";
    }
    echo "</tr>";
}

echo "</table>";
$conn->close();