<!DOCTYPE html>
<html>
    <head>
        <title>Skapa konto</title>
    </head>
    <body>
        <form method="post">
            <legend>Skapa konto</legend>
            <label for="username">Användarnamn</label><br>
            <input type="text" id="username" name="username" required><br>
            <label for="password">Lösenord</label><br>
            <input type="password" id="password" name="password" required><br>
            <input type="submit" value="Skapa konto"><br>
        </form>
    </body>
    <?php
        //Kollar ifall det är en post request och ifall användaren har skrivit in ett användarnamn och lösenord.
        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["username"]) && isset($_POST["password"])){
            //Sparar och konverterar användarnamnet till bara små bokstävver, tar bort mellanslag och förhindrar XSS atacker med hjälp av 'htmlspecialchars()'.
            $username = strtolower(str_replace(" ", "", htmlspecialchars($_POST["username"])));
            //Sparar en hash av lösenordet och förhindrar XSS atacker med hjälp av 'htmlspecialchars()'.
            $password = password_hash(htmlspecialchars($_POST["password"]), PASSWORD_DEFAULT);
            //Öppnar "logins.txt" filen som en array. Ignorerar newlines så att man enklare kan kolla efter likhet.
            $logins = file("logins.txt", FILE_IGNORE_NEW_LINES, );
            
            //Kollar ifall det redan finns ett konto med det anvöndarnamnet.
            if (in_array($username, $logins)){
                echo "<p>Det finns redan ett konto med det användarnamnet. Vill du <a href=\"login.php\">logga in</a> istället?</p>";
            } 
            else{
                //Lagrar inloggningsuppgifterna i "logins.txt" filen med hashat lösenord.
                file_put_contents("logins.txt", "\n$username", FILE_APPEND);
                file_put_contents("logins.txt", "\n$password", FILE_APPEND);
                echo "Konto skapat";
            }
        }
    ?>
</html>