<?php
// User data stored in JSON
$users_file = dirname(__DIR__) . '/users.json';

// Load users from JSON
function loadUsers() 
{
    global $users_file;
    if (file_exists($users_file)) {
        $data = file_get_contents($users_file);
        return json_decode($data, true);
    }
    return [];
}

// Save users to JSON
function saveUsers($users)
{
    global $users_file;
    file_put_contents($users_file, json_encode($users, JSON_PRETTY_PRINT));
}

// Get all users
function getUsers()
{
    $users = loadUsers();
    echo json_encode($users);
}

// Get a specific user by ID
function getUser($id)
{
    $users = loadUsers();
    foreach ($users as $user) {
        if ($user['id'] == $id) {
            echo json_encode($user);
            return;
        }
    }
    http_response_code(404);
    echo json_encode(["message" => "User not found."]);
}

// Add a new user
function addUser()
{
    $data = json_decode(file_get_contents("php://input"), true);
    if (!empty($data['name']) && !empty($data['email'])) {
        $users = loadUsers();
        $new_user = [
            "id" => count($users) + 1,
            "name" => $data['name'],
            "email" => $data['email']
        ];
        $users[] = $new_user;
        saveUsers($users);
        echo json_encode(["message" => "User added successfully.", "user" => $new_user]);
    } else {
        http_response_code(400);
        echo json_encode(["message" => "Invalid data. Name and email required."]);
    }
}

// Update a user by ID
function updateUser($id)
{
    $users = loadUsers();
    $data = json_decode(file_get_contents("php://input"), true);
    foreach ($users as &$user) {
        if ($user['id'] == $id) {
            if (!empty($data['name'])) {
                $user['name'] = $data['name'];
            }
            if (!empty($data['email'])) {
                $user['email'] = $data['email'];
            }
            saveUsers($users);
            echo json_encode(["message" => "User updated successfully.", "user" => $user]);
            return;
        }
    }
    http_response_code(404);
    echo json_encode(["message" => "User not found."]);
}

// Delete a user by ID
function deleteUser($id)
{
    $users = loadUsers();
    foreach ($users as $key => $user) {
        if ($user['id'] == $id) {
            unset($users[$key]);
            saveUsers(array_values($users));
            echo json_encode(["message" => "User deleted successfully."]);
            return;
        }
    }
    http_response_code(404);
    echo json_encode(["message" => "User not found."]);
}
?>
