<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "capital_agro_wp";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected to database: " . $dbname . "<br><br>";

// Get all tables
$result = $conn->query("SHOW TABLES");
if ($result->num_rows > 0) {
    echo "<h3>Existing tables:</h3>";
    $tables = [];
    while($row = $result->fetch_array()) {
        $tables[] = $row[0];
        echo "- " . $row[0] . "<br>";
    }
    
    echo "<br><h3>Dropping all tables...</h3>";
    
    // Disable foreign key checks
    $conn->query("SET FOREIGN_KEY_CHECKS = 0");
    
    // Drop all tables
    foreach($tables as $table) {
        if ($conn->query("DROP TABLE IF EXISTS `$table`")) {
            echo "✓ Dropped table: $table<br>";
        } else {
            echo "✗ Error dropping table $table: " . $conn->error . "<br>";
        }
    }
    
    // Re-enable foreign key checks
    $conn->query("SET FOREIGN_KEY_CHECKS = 1");
    
    echo "<br><strong>Database cleaned successfully! You can now run WordPress installation.</strong>";
} else {
    echo "No tables found in the database.";
}

$conn->close();
?>