<?php

    $website = str_split($_POST['website'])??'';

    $password = str_split($_POST['codeword'])??'';

    $webInt = [];

    $pasInt = [];

    for ($i = 0; $i < sizeof($website); $i++){

        $webInt[$i] = ord($website[$i])-96;

    }



    for ($i = 0; $i < sizeof($password); $i++){

        $pasInt[$i] = ord($password[$i])-96;

    }



    $tempPas = [];

    $j = 0;



    for ($i = 0; $i < sizeof($website); $i++){

        if ($j == sizeof($pasInt)){

            $j = 0;

        }

        $tempPas[$i] = $webInt[$i] + $pasInt[$j];

        if ($tempPas[$i] > 26){

            $tempPas[$i] = $tempPas[$i] - 26;

        }

        $j++;

    }



    $tempPasChar = [];

    for ($i = 0; $i < sizeof($tempPas); $i++){

        if ($i%2 == 0){

            $tempPas[$i] = $tempPas[$i] + 64;

            $tempPasChar[$i] = chr($tempPas[$i]);

        }

        else{

            $tempPas[$i] = $tempPas[$i] + 96;

            $tempPasChar[$i] = chr($tempPas[$i]);

        }

    }



    $new_password = implode($tempPasChar);

    for ($i = 0; $i < sizeof($tempPas); $i++){

        if (strlen($new_password) < 15){

            $new_password .= $tempPas[$i];

        }

        else if (strlen($new_password) > 15){

            $new_password = substr($new_password,0, 14);

            break;

        } 

    }

    if ($new_password != ""){

        $new_password .= '!';

    }



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

            <input type="text" id="new_pwd" autofocus value=<?=$new_password?>><br>

            <button type="button" id="reset" onclick='location="https://technowitch.dev/SkyePass"'>Reset</button>

            <button type="button" id="copy" onclick="copyText()">Copy</button>

        </div>

    </body>

</html>