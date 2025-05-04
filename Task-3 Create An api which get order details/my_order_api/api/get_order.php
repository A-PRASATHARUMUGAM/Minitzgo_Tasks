<?php
$api_key_valid = "f7bfea5227de9c2e1b7eb5e3738bbe07d8b516092636d577494158b407222112";


$headers = getallheaders();
$api_key = isset($headers['x-api-key']) ? $headers['x-api-key'] : '';


if ($api_key !== $api_key_valid) {
    http_response_code(403);
    echo json_encode(["error" => "Invalid API key"]);
    exit();
}


$host = "localhost";
$user = "root";
$password = "";
$dbname = "orders_db";

$conn = new mysqli($host, $user, $password, $dbname);


if ($conn->connect_error) {
    die(json_encode(["error" => "Database connection failed: " . $conn->connect_error]));
}


$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['cid']) || empty($data['cid'])) {
    http_response_code(400);
    echo json_encode(["error" => "Client ID (cid) is required"]);
    exit();
}

$cid = $conn->real_escape_string($data['cid']);

$sql = "SELECT * FROM orders WHERE cid = '$cid'";
$result = $conn->query($sql);

$orders = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }
}


$response = [
    "count" => count($orders),
    "orders" => $orders
];

header("Content-Type: application/json");
echo json_encode($response);

$conn->close();
?>
