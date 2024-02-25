<?php


// Include the configuration file
include 'db_config.php';

// Enable CORS

header("Access-Control-Allow-Origin: http://localhost:4200");
header("Access-Control-Allow-Methods: OPTIONS, GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
//header("Access-Control-Allow-Origin: *");
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
        // Create (Insert) Operation
        $postData = json_decode(file_get_contents("php://input"), true);
        $description = $postData['description'];
        $appointmentDate = $postData['date'];
        $sql = "INSERT INTO demo_appointment (description, date) VALUES ('$description', '$appointmentDate')";
        //echo $sql;
        if ($conn->query($sql) === TRUE) {
            echo json_encode(['message' => 'Task added successfully']);
        } else {
            echo json_encode(['message' => 'Task added failed']);
        }
        break;

    case 'PUT':
        // Update Operation
        parse_str(file_get_contents("php://input"), $_PUT);
        $id = $_PUT['id'];
        $description = $_PUT['description'];
        $appointmentDate = $_PUT['date'];
        $sql = "UPDATE demo_appointment SET description='$description', date='$appointmentDate' WHERE Id=$id";
        if ($conn->query($sql) === TRUE) {
            echo json_encode(['message' => 'Task added successfully']);
        } else {
            echo json_encode(['message' => 'Task added failed']);
        }
        break;

    case 'DELETE':
        // Delete Operation
        $requestUri = $_SERVER['REQUEST_URI'];
        $parts = explode('/', $requestUri);
        $id = end($parts);

        $sql = "DELETE FROM demo_appointment WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            echo json_encode(['message' => 'Task added successfully']);
        } else {
            echo json_encode(['message' => 'Task added failed']);
        }
        break;

    // add the options validation below this line
    case 'OPTIONS':
        // just exit and CORS request will be okay
        exit( 0 );
        break;

    default:
        echo json_encode(['message' => 'Task added failed']);
}

// Close connection
$conn->close();
?>
