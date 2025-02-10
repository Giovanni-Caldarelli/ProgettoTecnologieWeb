<?php 
session_start(); 
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
    <script defer src="../risorse/js/validazione.js"></script> 
</head>
<body>
    <header>
        <h1>FastPark - Accedi o Registrati</h1>
    </header>

    <main>
        <div class="contenitore-form">
            <!-- Form di Login -->
            <section id="login">
                <h2>Accedi</h2>
                <form action="processa_login.php" method="POST" onsubmit="return validaLogin(this);">
                    <label for="email_login">Email:</label>
                    <input type="email" id="email_login" name="email" required>
                    
                    <label for="password_login">Password:</label>
                    <input type="password" id="password_login" name="password" required>
                    
                    <button type="submit">Accedi</button>
                </form>
            </section>

            <!-- Form di Registrazione -->
            <section id="registrazione">
                <h2>Registrati</h2>
                <form action="processa_registrazione.php" method="POST" onsubmit="return validaRegistrazione(this);">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" required>

                    <label for="cognome">Cognome:</label>
                    <input type="text" id="cognome" name="cognome" required>

                    <label for="email_reg">Email:</label>
                    <input type="email" id="email_reg" name="email" required>

                    <label for="password1">Password:</label>
                    <input type="password" id="password1" name="password1" required>

                    <label for="password2">Conferma Password:</label>
                    <input type="password" id="password2" name="password2" required>

                    <button type="submit">Registrati</button>
                </form>
            </section>
        </div>
    </main>

</body>
</html>