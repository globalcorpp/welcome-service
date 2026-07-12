<?php
header('Content-Type: application/json');
require_once 'config.php'; 

// Function for clean JSON response and exit
function respond_json($data, $status = 200) {
    http_response_code($status);
    echo json_encode($data, JSON_PRETTY_PRINT);
    exit;
}

// --- Database Connection ---
$conn_string = "host=" . DB_HOST . " port=" . DB_PORT . 
               " dbname=" . DB_NAME . " user=" . DB_USER . 
               " password=" . DB_PASSWORD;
$db_connection = pg_connect($conn_string);

if (!$db_connection) {
    // 500 Internal Server Error
    respond_json(["error" => "Database connection failed: " . pg_last_error()], 500); 
}

// --- Determine Query Type ---
$data = [];

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    // --- QUERY BY ID ---
    $target_id = (int)$_GET['id'];
    
    // Use pg_query_params for security (prevents SQL injection)
    $query = "SELECT id, description FROM gameduell_data WHERE id = $1";
    $result = pg_query_params($db_connection, $query, array($target_id));
    
    if ($result && pg_num_rows($result) > 0) {
        $data = pg_fetch_all($result);
    } else {
        respond_json(["message" => "Row with ID {$target_id} not found."], 404); // 404 Not Found
    }

} else {
    // --- GET ALL QUERY (No ID parameter found) ---
    $query = "SELECT id, description FROM gameduell_data ORDER BY id ASC";
    $result = pg_query($db_connection, $query);

    if ($result) {
        $data = pg_fetch_all($result);
    }
}

// --- Output ---
if ($data) {
    respond_json($data); // 200 OK
} else {
    // Only happens if "get all" query runs but returns 0 rows.gameduell_data
    respond_json(["message" => "No data found in the table."], 200); 
}

pg_close($db_connection);
?>