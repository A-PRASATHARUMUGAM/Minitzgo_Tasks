<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "orders_db";

// Create a connection
$conn = new mysqli($host, $user, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create Database
$sql = "CREATE DATABASE IF NOT EXISTS orders_db";

if ($conn->query($sql) === TRUE) {
    echo "Database created successfully!<br>";
} else {
    echo "Error creating database: " . $conn->error . "<br>";
}

// Connect to the database
$conn = new mysqli($host, $user, $password, $dbname);

// Create Table
$tableSQL = "
CREATE TABLE IF NOT EXISTS orders (
    oid INT(11) AUTO_INCREMENT PRIMARY KEY,
    product_id VARCHAR(100) NULL,
    order_id VARCHAR(50) NULL,
    product_name VARCHAR(255) NULL,
    product_size VARCHAR(100) NULL,
    quantity INT(11) NULL,
    payment_mode VARCHAR(50) NULL,
    transition_id VARCHAR(50) NULL,
    payment_status VARCHAR(50) NULL,
    cid VARCHAR(100) NULL,
    client_name VARCHAR(255) NULL,
    client_coordinates VARCHAR(255) NULL,
    client_amount VARCHAR(100) NOT NULL,
    user_name VARCHAR(255) NULL,
    user_id VARCHAR(50) NULL,
    user_coordinates VARCHAR(255) NULL,
    user_address VARCHAR(255) NULL,
    product_color VARCHAR(50) NULL,
    product_price DECIMAL(10,2) NULL,
    delivery_boy_name VARCHAR(255) NULL,
    delivery_boy_id VARCHAR(50) NULL,
    delivery_boy_coordinates_from VARCHAR(255) NULL,
    delivery_boy_coordinates_client VARCHAR(255) NULL,
    delivery_boy_coordinates_user VARCHAR(255) NULL,
    status_product_client VARCHAR(50) NULL,
    delivery_boy_timestamp VARCHAR(100) NULL,
    product_title VARCHAR(255) NULL,
    status_delivery_user VARCHAR(50) NULL,
    product_status VARCHAR(100) NULL,
    status_after_delivery VARCHAR(50) NULL,
    returns TINYINT(1) NULL,
    reason VARCHAR(255) NULL,
    product_image VARCHAR(255) NULL,
    delivery_boy_phonenumber VARCHAR(20) NULL,
    date DATE NOT NULL DEFAULT CURRENT_DATE,
    time VARCHAR(100) NOT NULL DEFAULT CURRENT_TIMESTAMP,
    user_phonenumber VARCHAR(20) NULL,
    product_description TEXT NULL
)";

if ($conn->query($tableSQL) === TRUE) {
    echo "Table 'orders' created successfully!<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

// Close connection
$conn->close();
?>
