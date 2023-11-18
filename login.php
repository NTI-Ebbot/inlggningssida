<!DOCTYPE html>
<html>
    <head>
        <title>Logga in</title>
    </head>
    <body>
        <form method="post">
            <legend>Logga in</legend>
            <label for="username">Användarnamn</label><br>
            <input type="text" id="username" name="username" required><br>
            <label for="password">Lösenord</label><br>
            <input type="password" id="password" name="password" required><br>
            <input type="submit" value="Logga in"><br>
        </form>
    </body>
    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["username"]) && isset($_POST["password"])){
            $username = strtolower(str_replace(" ", "", htmlspecialchars($_POST["username"])));
            $password = htmlspecialchars($_POST["password"]);
            $logins = file("logins.txt", FILE_IGNORE_NEW_LINES, );
            

            if (in_array($username, $logins)){
            //↑↑Samma som "createAccount.php"↑↑

                //Sparar positionen av kontonamnet eftersom att lösenordet kommer direkt efter i arrayen
                $accountNumber = array_search($username, $logins);
                //Kollar ifall det inskrivna lösenordet mathcer det som finns lagrat för kontot
                if (password_verify($password, $logins[$accountNumber+1])){
                    echo "Inloggning lyckades!";
                }
            } 
            else{
                echo "Användarnamn eller lösenord är fel.";
            }
        }
    ?>
</html>