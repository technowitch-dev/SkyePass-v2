<?php
require_once 'hash_function.php';

$hash = hash_function($_POST['website'], $_POST['codeword']);

?>

<html>

    <head>

        <link rel="stylesheet" href="style.css">

        <link rel="icon" href="images/xxhdpi.png">

    </head>

    <body>

        <script>

            function copyText() {

            // Get the text field

            var copyText = document.getElementById("new_pwd");



            // Select the text field

            copyText.select();

            copyText.setSelectionRange(0, 99999); // For mobile devices



            // Copy the text inside the text field

            navigator.clipboard.writeText(copyText.value);

            }

        </script> 

        <title>SkyePassword Generated!</title>

        <img src="images/login-background.png" alt="SkyePass Logo">

        <div id="login-box">

            <p id="label2">Generated Password:</p><br>

            <input type="text" id="new_pwd" autofocus value=<?=$hash?>><br>

            <button type="button" id="reset" onclick='location="https://technowitch.dev/pass"'>Reset</button>

            <button type="button" id="copy" onclick="copyText()">Copy</button>

        </div>

    </body>

</html>