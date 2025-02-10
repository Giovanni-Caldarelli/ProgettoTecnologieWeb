<?php
session_start();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <title>FastPark - Homepage</title>
    <meta charset="UTF-8">
    <meta name="generator" content="Visual Studio Code">
    <meta name="keywords" content="parcheggio, auto, fastpark, sosta, sicurezza, prenotazione online, centro città">
    <meta name="author" content="Giovanni Caldarelli, Raffaele Esposito, Federico Cervo">
    <meta name="description" content="FastPark - Prenota e gestisci il tuo parcheggio online in modo semplice e sicuro.">
    <link rel="stylesheet" href="../risorse/css/styleHomePage.css">
    <link rel="icon" href="../risorse/immagini/logoP.png" type="image/png">
</head>








<body>
    <header>
        <div class="logo">
            <a href="homePage.php"> 
                <img src="../risorse/immagini/logo.png" alt="FastPark Logo">
            </a>
            <h1>FastPark</h1>
        </div>
        <nav>
            <ul>
                <li><a href="homePage.php">Home</a></li>
                <?php
                if (isset($_SESSION['user_email'])) {
                    echo '<li><a href="../logout.php">Logout</a></li>';
                } else {
                    echo '<li><a href="../login/login.php">Login</a></li>';
                }
                ?>
                <li><a href="#contatti">Contatti</a></li>
                <li><a href="#tariffe">Tariffe</a></li>
                <li><a href="#come-funziona">Guida Rapida</a></li>
            </ul>
        </nav>
        
    </header>
    

    <main>
    <div class="layout-container">
    <section id="chi-siamo">
        <div class="box">
            <h2>Chi siamo</h2>
            <p>
                Con oltre 20 anni di esperienza, siamo leader nel settore dei <br>
                parcheggi, garantendo soluzioni affidabili, sicure e <br>
                all'avanguardia. I nostri parcheggi, situati in tre punti strategici di <br>
                Napoli, offrono comodità e facilità di accesso per ogni esigenza.
            </p>
            <h3>Posti disponibili in tempo reale</h3>
            <ul>
            <?php
            require_once '../database.php';
            $query = "SELECT nome, posti_disponibili FROM parcheggi";
            $result = pg_query($conn, $query);

            if ($result) {
                while ($row = pg_fetch_assoc($result)) {
                    echo '<li>🚗 ' . htmlspecialchars($row['nome']) . ': ' . htmlspecialchars($row['posti_disponibili']) . ' posti disponibili</li>';
                }
            }
            ?>
            </ul>
        </div>
    </section>

    <section id="prenotazione-compatta">
        <h2>Prenota il tuo parcheggio</h2>
        <div class="prenotazione-box">
            <form id="prenotazione-form">
                <label for="sede">Sede</label>
                <select name="sede" id="sede" <?php if (!isset($_SESSION['user_email'])) echo 'disabled'; ?>>
                    <option value="" disabled selected>-- Scegli una sede --</option>
                    <option value="centro-storico">Centro Storico</option>
                    <option value="mergellina">Mergellina</option>
                    <option value="vomero">Vomero</option>
                </select>

                <div class="date-time">
                    <div>
                        <label for="check-in">Check-in</label>
                        <input type="date" id="check-in" name="check-in" <?php if (!isset($_SESSION['user_email'])) echo 'disabled'; ?>>
                        <input type="time" id="check-in-time" name="check-in-time" value="12:00" <?php if (!isset($_SESSION['user_email'])) echo 'disabled'; ?>>
                    </div>
                    <div>
                        <label for="check-out">Check-out</label>
                        <input type="date" id="check-out" name="check-out" <?php if (!isset($_SESSION['user_email'])) echo 'disabled'; ?>>
                        <input type="time" id="check-out-time" name="check-out-time" value="12:00" <?php if (!isset($_SESSION['user_email'])) echo 'disabled'; ?>>
                    </div>
                </div>

                <?php
                if (isset($_SESSION['user_email'])) {
                    echo '<button type="submit" class="btn-prenota">Cerca</button>';
                } else {
                    echo '<a href="../login/login.php" class="btn-login">Accedi per prenotare</a>';
                }
                ?>
             </form>
        </div>
    </section>
    </div>
        

        <section id="disponibilita">
            <h2>I nostri parcheggi</h2>
            <div class="parcheggi-container">
                <div class="parcheggio">
                    <a href="https://www.google.com/maps?q=Via+Toledo,+123,+80134+Napoli" target="_blank">
                        <img src="../risorse/immagini/centrostorico.png" alt="Centro Storico">
                    </a>
                    <h3>Centro Storico</h3>
                    <p>Indirizzo: Via Toledo, 123, 80134 Napoli</p>
                </div>
                <div class="parcheggio">
                    <a href="https://www.google.com/maps?q=Via+Caracciolo,+45,+80122+Napoli" target="_blank">
                        <img src="../risorse/immagini/mergellina.png" alt="Mergellina">
                    </a>
                    <h3>Mergellina</h3>
                    <p>Indirizzo: Via Caracciolo, 45, 80122 Napoli</p>
                </div>
                <div class="parcheggio">
                    <a href="https://www.google.com/maps?q=Via+Scarlatti,+67,+80127+Napoli" target="_blank">
                        <img src="../risorse/immagini/vomero.png" alt="Vomero">
                    </a>
                    <h3>Vomero</h3>
                    <p>Indirizzo: Via Scarlatti, 67, 80127 Napoli</p>
                </div>
            </div>
        </section>


        <section id="tariffe">
            <h2>Tariffe</h2>
            <div class="tariffe-container">
                <table>
                    <thead>
                     <tr>
                        <th>Parcheggio</th>
                        <th>Tariffa Oraria</th>
                        <th>Tariffa Giornaliera</th>
                     </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Centro Storico</td>
                        <td>€ 2,00</td>
                        <td>€ 20,00</td>
                      </tr>
                      <tr>
                        <td>Mergellina</td>
                        <td>€ 2,50</td>
                        <td>€ 22,00</td>
                     </tr>
                     <tr>
                        <td>Vomero</td>
                        <td>€ 3,00</td>
                        <td>€ 25,00</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </section>



        <section id="recensioni">
            <h2>Recensioni dei nostri clienti</h2>
            <div class="recensioni-container">
                <div class="recensione">
                    <p>"Servizio impeccabile! Il parcheggio era comodo e sicuro." - <strong>Mario Rossi</strong></p>
                    <div class="stars">⭐ ⭐ ⭐ ⭐ ⭐</div>
                </div>
                <div class="recensione">
                    <p>"Personale gentile e prezzi competitivi. Assolutamente consigliato!" - <strong>Lucia Verdi</strong></p>
                    <div class="stars">⭐ ⭐ ⭐ ⭐ ⭐</div>
                </div>
                <div class="recensione">
                    <p>"Ottima esperienza! Ho trovato sempre parcheggio senza problemi." - <strong>Alessandro Bianchi</strong></p>
                    <div class="stars">⭐ ⭐ ⭐ ⭐ ⭐</div>
                </div>
           </div>
        </section>



        <section id="come-funziona">
            <h2>Come Funziona?</h2>
            <div class="steps">
                <div class="step">
                    <img src="../risorse/immagini/step1.png" alt="Step 1">
                    <p>Registrati o accedi al tuo account.</p>
                </div>
                <div class="step">
                    <img src="../risorse/immagini/step2.png" alt="Step 2">
                    <p>Scegli il parcheggio più vicino e prenota.</p>
                </div>
                <div class="step">
                    <img src="../risorse/immagini/step3.png" alt="Step 3">
                    <p>Effettua il pagamento in modo sicuro.</p>
                </div>
                <div class="step">
                    <img src="../risorse/immagini/step4.png" alt="Step 4">
                    <p>Goditi il tuo parcheggio</p>
                </div>
            </div>
        </section>
    </main>
    

    <footer>
            <div class="footer-container">
                <div class="footer-item">
                    <img src="../risorse/immagini/telecamera.png" alt="Sicurezza">
                    <h3>Sicurezza</h3>
                    <p>
                        Sicurezza garantita 24 ore su 24, 7 giorni su 7. Tecnologia avanzata con monitoraggio FullHD continuo.
                    </p>
                </div>
                <div class="footer-item">
                    <img src="../risorse/immagini/punto.png" alt="Dove siamo">
                    <h3>Dove siamo</h3>
                    <p>
                        Presenti in 3 zone strategiche di Napoli in centro storico, Mergellina e Vomero. Oltre 25 anni di esperienza e affidabilità.
                    </p>
                </div>
            </div>
        
            <div class="footer-contacts" id="contatti">
                <div class="contact">
                    <p><strong>Centro Storico</strong></p>
                    <p>Email: <a href="mailto:g.caldarelli16@studenti.unisa.it">g.caldarelli16@studenti.unisa.it</a></p>
                    <p>Telefono: +39 3385782927</p>
                    <p>Indirizzo: <a href="https://www.google.com/maps?q=Via+Toledo,+123,+80134+Napoli" target="_blank">Via Toledo, 123, 80134 Napoli</a></p>
                </div>
                <div class="contact">
                    <p><strong>Mergellina</strong></p>
                    <p>Email: <a href="mailto:r.esposito163@studenti.unisa.it">r.esposito163@studenti.unisa.it</a></p>
                    <p>Telefono: +39 3339197364</p>
                    <p>Indirizzo: <a href="https://www.google.com/maps?q=Via+Caracciolo,+45,+80122+Napoli" target="_blank">Via Caracciolo, 45, 80122 Napoli</a></p>
                </div>
                <div class="contact">
                    <p><strong>Vomero</strong></p>
                    <p>Email: <a href="mailto:f.cervo@studenti.unisa.it">f.cervo@studenti.unisa.it</a></p>
                    <p>Telefono: +39 3914783091</p>
                    <p>Indirizzo: <a href="https://www.google.com/maps?q=Via+Scarlatti,+67,+80127+Napoli" target="_blank">Via Scarlatti, 67, 80127 Napoli</a></p>
                </div>
            </div>
        </footer>

</body>
</html>
