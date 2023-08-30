<!DOCTYPE html>
<html>
<head>
    <title>Chat Room - <?php echo $_GET['room_id']; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        h1 {
            margin: 20px;
            color: #333;
        }

        #chat-container {
            border: 1px solid #ccc;
            padding: 10px;
            height: 300px;
            overflow-y: scroll;
            white-space: pre-line;
            background-color: #fff;
        }

        .chat-message {
            display: flex;
            align-items: flex-start;
            margin-bottom: 10px;
        }

        .chat-message img {
            max-width: 100px;
            max-height: 100px;
            margin-right: 10px;
        }

        #shareButton {
            padding: 8px 15px;
            background-color: #333;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        /* Styles for the share modal */
        #shareModal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
            align-items: center;
            justify-content: center;
        }

        #shareModalContent {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        var isAtBottom = true;

        function scrollToBottom() {
            var chatDiv = document.getElementById("chat-container");
            chatDiv.scrollTop = chatDiv.scrollHeight;
            isAtBottom = true;
        }

        $(document).ready(function() {
            scrollToBottom();

            var username = "<?php echo $_GET['username']; ?>";
            var room_id = "<?php echo $_GET['room_id']; ?>";

            function updateChat() {
                if (isAtBottom) {
                    $.get("room/" + room_id + ".txt", function(data) {
                        $("#chat-container").html(data);
                        scrollToBottom();
                    });
                }
            }

            updateChat();
            setInterval(updateChat, 1000);

            $("#chat-container").on("scroll", function() {
                var element = $(this)[0];
                isAtBottom = Math.abs(element.scrollHeight - element.scrollTop - element.clientHeight) < 1;
            });

            $("#message_form").submit(function(e) {
                e.preventDefault();

                var message = $("#message").val();
                var imageInput = $("#image")[0];
                var image = imageInput.files[0];

                if (image) {
                    var formData = new FormData();
                    formData.append("image", image);

                    $.ajax({
                        url: "upload-image.php?room_id=" + room_id,
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(imagePath) {
                            message = "<img src='" + imagePath + "' class='shared-image'>" + message;
                            sendMessage(message);
                            $("#message_form")[0].reset(); // Reset the form after sending
                        }
                    });
                } else {
                    sendMessage(message);
                    $("#message_form")[0].reset(); // Reset the form after sending
                }
            });

           // function sendMessage(message) {
           //     $.post("chat-backup.php", { room_id: room_id, message: message, username: username }, function() {
           //         if (isAtBottom) {
            //            updateChat();
            //        }
            //    });
           // }
           function sendMessage(message) {

    var now = new Date();

    

    var day = now.getDate().toString().padStart(2, '0');

    var month = (now.getMonth() + 1).toString().padStart(2, '0'); // Months are 0-based

    var year = now.getFullYear();



    var timestamp = day + '/' + month + '/' + year + ',' + ' ' + now.toLocaleTimeString();

    

  //  message = message + " " + '"' + timestamp + '"' + "";
  time = timestamp;



    $.post("chat-backup.php", { room_id: room_id, message: message, username: username, time: timestamp }, function() {

        if (isAtBottom) {

            updateChat();

        }

    });

}
                    $("#shareButton").click(function() {
                var room_id = "<?php echo $_GET['room_id']; ?>";
                var username = "<?php echo $_GET['username']; ?>";
                var shareUrl = "https://<?php echo $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']) . '/share.php'; ?>";
                var inviteUrl = shareUrl + "?id=" + room_id + "&username=" + encodeURIComponent(username);

                // Open the share modal
                $("#shareModal").fadeIn();
                $("#shareLink").val(inviteUrl);
            });

            $("#copyButton").click(function() {
                var copyText = document.getElementById("shareLink");
                copyText.select();
                document.execCommand("copy");
                alert("Copied the link: " + copyText.value);
            });

            $("#closeModal").click(function() {
                // Close the share modal
                $("#shareModal").fadeOut();
            });
        });

</script>
</head>
<body>
    <h1>Welcome to Chat Room <?php echo $_GET['room_id']; ?></h1>
    <div id="chat-container"></div>
    <form id="message_form" enctype="multipart/form-data">
        <input type="file" id="image" name="image" accept="image/*">
        <input type="text" id="message" placeholder="Enter your message...">
        <button type="submit">Send</button>
    </form>
    <button id="shareButton">Share Room</button>
    <div id="shareModal">
        <div id="shareModalContent">
            <p>Share this link with others:</p>
            <input type="text" id="shareLink" readonly>
            <button id="copyButton">Copy</button>
            <button id="closeModal">Close</button>
        </div>
    </div>
</body>
</html>
