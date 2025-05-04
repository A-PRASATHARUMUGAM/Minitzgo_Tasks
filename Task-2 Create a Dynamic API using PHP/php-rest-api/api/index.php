<?php

error_log("Request URI: " . $_SERVER['REQUEST_URI']);
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


include __DIR__ . DIRECTORY_SEPARATOR . 'db.php';

$request_method = $_SERVER['REQUEST_METHOD'];
$request_uri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));

$api_index = array_search('api', $request_uri);
if ($api_index !== false) {
    $request_uri = array_slice($request_uri, $api_index + 1);
}

if ($request_uri[0] == 'users') {
    if ($request_method == 'GET') {
        if (isset($request_uri[1]) && is_numeric($request_uri[1])) {
            getUser($request_uri[1]);
        } else {
            getUsers();
        }
    } elseif ($request_method == 'POST') {
        addUser();
    } elseif ($request_method == 'PUT' && isset($request_uri[1])) {
        updateUser($request_uri[1]);
    } elseif ($request_method == 'DELETE' && isset($request_uri[1])) {
        deleteUser($request_uri[1]);
    } else {
        http_response_code(405);
        echo json_encode(["message" => "Method not allowed."]);
    }
} else {
    http_response_code(404);
    echo json_encode(["message" => "Invalid API endpoint."]);
}
?>
