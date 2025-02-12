<?php
session_start();
require_once '../database.php'; 
?>


<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>FastPark - Login&Registrazione</title>
    <meta name="generator" content="Visual Studio Code">
    <meta name="keywords" content="parcheggio, auto, fastpark, sosta, sicurezza, prenotazione online, centro città,registrazione,login">
    <meta name="author" content="Giovanni Caldarelli, Raffaele Esposito, Federico Cervo">
    <meta name="description" content="FastPark - Effettua la registrazione oppure accedi per prenotare un parcheggio in pochi click">
    <link rel="stylesheet" href="../risorse/css/styleLogin.css"> 
    <script src="../risorse/js/validazioneRegistrazione.js" defer></script> 
    <script src="../risorse/js/validazioneLogin.js" defer></script> 
</head>
<body>
    <header>
        <div class="logo">
            <a href="../homePage/homePage.php"> 
                <img src="../risorse/immagini/logo.png" alt="FastPark Logo">
            </a>
            <h1>FastPark</h1>
        </div>
        <nav>
            <ul>
                <li><a href="../homePage/homePage.php">Home</a></li>
                <li><a href="../homePage/homePage.php#contatti">Contatti</a></li>
                <li><a href="../homePage/homePage.php#tariffe">Tariffe</a></li>
                <li><a href="../homePage/homePage.php#come-funziona">Guida Rapida</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section id="benvenuto">
            <h2>Benvenuto su FastPark!</h2>
             <p>Accedi o registrati per prenotare il tuo parcheggio in pochi click.</p>
        </section>

        <div class="contenitore-form">
            <!-- Form di Login -->
            <section id="login" <?php if (isset($_SESSION["errore_registrazione"])) echo 'style="display:none"'; ?>>
                <h2>Accedi</h2>
                <form action="processa_login.php" method="POST" onsubmit="return validaLogin(this);">
                    <label for="email_login">Email:</label>
                    <input type="email" id="email_login" name="email" value="<?php echo isset($_SESSION['sticky_email_login']) ? $_SESSION['sticky_email_login'] : ''; ?>" required>
                    
                    <label for="password_login">Password:</label>
                    <input type="password" id="password_login" name="password" required>
                    
                    <button type="submit">Accedi</button>
                    <?php
                    if (isset($_SESSION["errore_login"])) {
                        echo "<p class='errore-messaggio'>" . $_SESSION["errore_login"] . "</p>";
                        unset($_SESSION["errore_login"]); // Rimuove il messaggio dopo averlo mostrato
                    }
                    if (isset($_SESSION["successo_registrazione"])) {
                        echo "<p class='successo-messaggio'>" . $_SESSION["successo_registrazione"] . "</p>";
                        unset($_SESSION["successo_registrazione"]); // Rimuove il messaggio dopo averlo mostrato
                    }
                    ?>
                </form>
                <p>Non hai un account? <button onclick="mostraRegistrazione()">Registrati</button></p>

            </section>

            <!-- Form di Registrazione -->
            <section id="registrazione" <?php if (!isset($_SESSION["errore_registrazione"])) echo 'style="display:none"'; ?>>
                <h2>Registrati</h2>
                <form action="processa_registrazione.php" method="post" onsubmit="return validaRegistrazione(this);">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" value="<?php echo isset($_SESSION['sticky_nome']) ? $_SESSION['sticky_nome'] : ''; ?>" required>

                    <label for="cognome">Cognome:</label>
                    <input type="text" id="cognome" name="cognome" value="<?php echo isset($_SESSION['sticky_cognome']) ? $_SESSION['sticky_cognome'] : ''; ?>" required>

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo isset($_SESSION['sticky_email']) ? $_SESSION['sticky_email'] : ''; ?>" required>

                    <label for="password1">Password:</label>
                    <input type="password" id="password1" name="password1" required>

                    <label for="password2">Conferma Password:</label>
                    <input type="password" id="password2" name="password2" required>

                    <button type="submit">Registrati</button>
                </form>
                <p>Hai già un account? <button onclick="mostraLogin()">Accedi</button></p>
                <?php
                if (isset($_SESSION["errore_registrazione"])) {
                    echo "<p class='errore-messaggio'>" . $_SESSION["errore_registrazione"] . "</p>";
                    unset($_SESSION["errore_registrazione"]); // Elimina il messaggio dopo averlo mostrato
                }
                ?> 
            </section>
        </div>
    </main>

</body>
</html>