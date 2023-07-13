<?php
// api.php

// Establish connection with the MySQL database
$servername = 'localhost';
$username = 'your_mysql_username';
$password = 'your_mysql_password';
$dbname = 'your_database_name';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// API endpoints for CRUD operations
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Get all todos
    $sql = 'SELECT * FROM todos';
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $todos = [];
        while ($row = $result->fetch_assoc()) {
            $todos[] = $row;
        }
        echo json_encode($todos);
    } else {
        echo 'No todos found.';
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Create a new todo
    $todoText = $_POST['todoText'];

    $sql = "INSERT INTO todos (text) VALUES ('$todoText')";
    if ($conn->query($sql) === true) {
        echo 'Todo created successfully.';
    } else {
        echo 'Error creating todo: ' . $conn->error;
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Delete a todo
    parse_str(file_get_contents('php://input'), $data);
    $todoId = $data['id'];

    $sql = "DELETE FROM todos WHERE id = $todoId";
    if ($conn->query($sql) === true) {
        echo 'Todo deleted successfully.';
    } else {
        echo 'Error deleting todo: ' . $conn->error;
    }
}

$conn->close();
?>
