<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $room_id = $_GET['room_id'];
    $imageDir = "room/images-of-$room_id/";
    
    if (!file_exists($imageDir)) {
        mkdir($imageDir, 0777, true);
    }
    
    $imageFile = $imageDir . basename($_FILES['image']['name']);
    move_uploaded_file($_FILES['image']['tmp_name'], $imageFile);
    
    echo $imageFile; // Return the image path for the chat message
}
?>
