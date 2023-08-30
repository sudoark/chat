<!DOCTYPE html>
<html>
<head>
    <title>Chat Room</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        h1 {
            margin-top: 50px;
            color: #333;
        }

        form {
            margin-top: 20px;
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
    <h1>Chat Room</h1>
    <form action="join.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="room_id">Room ID:</label>
        <input type="text" id="room_id" name="room_id" required>
        <br>
        <button type="submit">Join Chat Room</button>
    </form>
    <form action="create.php" method="post">
        <label for="username_create">Username:</label>
        <input type="text" id="username_create" name="username_create" required>
        <button type="submit">Create Chat Room</button>
    </form>
</body>
</html>
