<!-- join.php -->
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $room_id = $_POST['room_id'];

    // Redirect to the chat room
    header("Location: chatroom.php?username=$username&room_id=$room_id");
    exit;
}
?>
