<?php
include 'chat.html';

// Check if 'text' is set in POST request
if (!isset($_POST['text'])) {
    echo "No input received.";
    exit;
}

$conn = mysqli_connect("localhost", "root", "", "chat");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Sanitize input
$getMesg = mysqli_real_escape_string($conn, $_POST['text']);

// Query the database
$check_data = "SELECT replies FROM chatbot WHERE queries LIKE '%$getMesg%'";
$run_query = mysqli_query($conn, $check_data);

if (!$run_query) {
    die("Error in query: " . mysqli_error($conn));
}

// Check if the query returned results
if (mysqli_num_rows($run_query) > 0) {
    $fetch_data = mysqli_fetch_assoc($run_query);
    $replay = $fetch_data['replies'];
    echo $replay;
} else {
    echo "Sorry, I can't understand you!";
}

mysqli_close($conn);
?>
