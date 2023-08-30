<!DOCTYPE html>
<html>
<head>
    <title>Share Chat Room</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        p {
            margin: 20px;
            color: #333;
        }

        form {
            margin: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"] {
            padding: 8px;
            width: 250px;
        }

        button[type="submit"] {
            padding: 8px 15px;
            background-color: #333;
            color: #fff;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <?php
    $room_id = $_GET['id'];
    $username = $_GET['username'];
    $invite_message = "Hey there! You have been invited to a chat room id $room_id by $username. Would you like to join? If so, kindly enter your username below and click 'Join' to proceed.";
    ?>

    <p><?php echo $invite_message; ?></p>
    <form action="join.php" method="post">
        <input type="hidden" name="room_id" value="<?php echo $room_id; ?>">
        <label for="username">Username:</label>
        <input type="text" name="username" placeholder="Enter your username" required>
        <button type="submit">Join</button>
    </form>
</body>
</html>
