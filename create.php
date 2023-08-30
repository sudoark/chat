<!-- create.php -->
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username_create'];
    $room_id = uniqid(); // Generate a unique room ID

    // Redirect to the chat room
    header("Location: chatroom.php?username=$username&room_id=$room_id");
    exit;
}
?>
