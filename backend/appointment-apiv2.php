<?php

// Include the configuration file
include 'db_config.php';

// Enable CORS
header("Access-Control-Allow-Origin: http://localhost:4200");
header("Access-Control-Allow-Methods: OPTIONS, GET, POST");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Content-Type: application/json");

// Check request method
$requestMethod = $_SERVER['REQUEST_METHOD'];

// Handle CRUD operations
switch ($requestMethod) {
    case 'GET':
        // Read (Select) Operation
        $sql = "SELECT * FROM demo_appointment";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $data = array();
            while($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            echo json_encode($data);
        } else {
            echo json_encode(array());
        }
        break;

    case 'POST':
        // Parse the POST data
        $postData = json_decode(file_get_contents("php://input"), true);

        // Check if the 'type' parameter is set in the POST data
        if (isset($postData['type'])) {
            $type = $postData['type'];

            switch ($type) {
                case 'create':
                    // Create (Insert) Operation
                    $description = $postData['description'];
                    $appointmentDate = $postData['date'];
                    $sql = "INSERT INTO demo_appointment (description, date) VALUES ('$description', '$appointmentDate')";

                    if ($conn->query($sql) === TRUE) {
                        echo json_encode(['message' => 'Task added successfully']);
                    } else {
                        echo json_encode(['message' => 'Task added failed']);
                    }
                    break;

                case 'update':
                    // Update Operation
                    $id = $postData['id'];
                    $description = $postData['description'];
                    $appointmentDate = $postData['date'];
                    $sql = "UPDATE demo_appointment SET description='$description', date='$appointmentDate' WHERE id=$id";

                    if ($conn->query($sql) === TRUE) {
                        echo json_encode(['message' => 'Task updated successfully']);
                    } else {
                        echo json_encode(['message' => 'Task update failed']);
                    }
                    break;

                case 'delete':
                    // Delete Operation
                    $id = $postData['id'];
                    $sql = "DELETE FROM demo_appointment WHERE id=$id";

                    if ($conn->query($sql) === TRUE) {
                        echo json_encode(['message' => 'Task deleted successfully']);
                    } else {
                        echo json_encode(['message' => 'Task delete failed']);
                    }
                    break;

                default:
                    echo json_encode(['message' => 'Invalid operation type']);
            }
        } else {
            echo json_encode(['message' => 'Operation type not specified']);
        }
        break;

    // Add the OPTIONS validation below this line
    case 'OPTIONS':
        // Allow preflight requests
        header("HTTP/1.1 200 OK");
        break;

    default:
        echo json_encode(['message' => 'Invalid request method']);
}

// Close connection
$conn->close();

?>
