<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $room_id = $_POST['room_id'];
    $message = $_POST['message'];
    $username = $_POST['username'];
    $time =$_POST['time'];

    // Process image path, if present
    $imagePath = "";
    if (preg_match('/^.*\.(jpg|jpeg|png|gif)$/i', $message)) {
        $imagePath = $message;
        $message = "[Image]";
    }

    $chat_log = "[$time] $username: $message\n";
    $chat_file = "room/$room_id.txt";

    file_put_contents($chat_file, $chat_log, FILE_APPEND);

    // Update the chat log with image path
    if ($imagePath) {
        file_put_contents($chat_file, $imagePath . "\n", FILE_APPEND);
    }
}
?>
