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
    <meta name="author" content="Giovanni Caldarelli,Raffaele Esposito, Federico Cervo">
    <meta name="description" content="FastPark - Prenota e gestisci il tuo parcheggio online in modo semplice e sicuro.">
    <link rel="stylesheet" href="../risorse/css/styleHomePage.css">
    <link rel="icon" href="../risorse/immagini/logoP.png" type="image/png">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"/>
    <script src="../risorse/js/validazionePrenotazione.js" defer></script>
    <script src="../risorse/js/aggiornaParcheggi.js" defer></script>
    <script src="../risorse/js/geolocalizzazione.js" defer></script>
    <script src="../risorse/js/sliderRecensioni.js" defer></script>
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" defer></script>
    <script src="../risorse/js/gestioneMappa.js" defer></script>
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
               
               <li><a href="#contatti">Contatti</a></li>
               <li><a href="#tariffe">Tariffe</a></li>
               <li><a href="#come-funziona">Come Funziona</a></li>
               <?php
                if (isset($_SESSION['user_email'])) {
                    echo '<li><a href="../logout.php">Logout</a></li>';
                } else {
                    echo '<li><a href="../login/login.php">Login</a></li>';
                }
                ?>
            </ul>
        </nav>
        <?php
        if (isset($_SESSION["user_nome"])) {
            echo '<div class="benvenuto-utente">
            Benvenuto, ' . htmlspecialchars($_SESSION["user_nome"]) . '!<br>
            <a href="' . ($_SESSION["user_tipo"] === "admin" ? "../gestione/admin.php" : "../profilo/area_riservata.php") . '" class="btn-area">Area Riservata</a>
         </div>';
        }
        ?>
    </header>
    

    <main>
        <div class="layout-container">
            <section id="prenotazione-compatta">
                <h2>Prenota il tuo parcheggio</h2>
                <div class="prenotazione-box">
                    <form id="prenotazione-form" action="../prenotazione/prenotazione.php" method="POST" target="_blank">
                        <label for="sede">Sede</label>
                        <select name="sede" id="sede" <?php if (!isset($_SESSION['user_email'])) echo 'disabled'; ?>>
                            <option value="" disabled selected> -- Scegli una sede -- </option>
                            <option value="Centro Storico">Centro Storico</option>
                            <option value="Mergellina">Mergellina</option>
                            <option value="Vomero">Vomero</option>
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

            <section id="chi-siamo">
                <div class="box">
                    <h2>Chi siamo</h2>
                    <p>
                    Fastpark è la soluzione ideale per chi cerca un parcheggio sicuro, veloce ed economico a Napoli. 
                    Con tre sedi strategiche – <b> Vomero, Mergellina e Centro Storico </b> – offriamo un servizio 
                    pratico e affidabile per chi vuole muoversi in città senza lo stress del parcheggio. 
                    Il nostro obiettivo è garantire  comodità e sicurezza , permettendoti di risparmiare tempo e denaro. 
                    Scegli Fastpark e parcheggia senza pensieri!
                    </p>
                    <h3>Posti disponibili in tempo reale</h3>
                    <ul id="lista-parcheggi">
                        <!-- Parcheggi caricati tramite AJAX -->
                    </ul>
                </div>
            </section>
        </div>


        <section id="Parcheggi">
            <h2>I nostri parcheggi</h2>
            <div class="parcheggi-container">
                <div class="parcheggio">
                    <a href="#" target="_blank">
                        <img src="../risorse/immagini/centrostorico.png" alt="Centro Storico">
                    </a>
                    <h3>Centro Storico</h3>
                    <p>Indirizzo: Via Toledo, 123, Napoli</p>
                </div>
                <div class="parcheggio">
                    <a href="#" target="_blank">
                        <img src="../risorse/immagini/mergellina.png" alt="Mergellina">
                    </a>
                    <h3>Mergellina</h3>
                    <p>Indirizzo: Via Caracciolo, 45, Napoli</p>
                </div>
                <div class="parcheggio">
                    <a href="#" target="_blank">
                        <img src="../risorse/immagini/vomero.png" alt="Vomero">
                    </a>
                    <h3>Vomero</h3>
                    <p>Indirizzo: Via Scarlatti, 67, Napoli</p>
                </div>
            </div>
        </section>


        <section id="parcheggi-napoli">
            <div class="content-container">
                <img src="..\risorse\immagini\Centro Storico.png" alt="Parcheggio Centro Storico">
                <div class="text-content">
                    <h3>Centro Storico</h3>
                    <p>
                        Il nostro parcheggio situato nel <strong>Centro Storico</strong> di Napoli è perfetto per chi vuole 
                        visitare i monumenti e le vie storiche della città. A pochi passi da Via Toledo e Spaccanapoli, 
                        offre sicurezza e comodità per la tua auto. Potrai lasciare il veicolo in una posizione strategica 
                        e muoverti comodamente a piedi per esplorare le meraviglie del centro storico, dai vicoli caratteristici 
                        ai ristoranti tipici, fino alle innumerevoli attrazioni culturali come il Duomo di Napoli e il Cristo Velato.
                    </p>
                </div>
            </div>
            <div class="content-container">
                <div class="text-content">
                    <h3>Mergellina</h3>
                    <p>
                        Se desideri goderti una passeggiata sul lungomare di Napoli, il nostro parcheggio a <strong>Mergellina</strong> 
                        è la scelta ideale. A pochi metri dal mare e dalle famose spiagge cittadine, permette di lasciare l'auto in un luogo sicuro 
                        e raggiungere le migliori attrazioni della zona. Potrai visitare la storica Fontana del Sebeto, il porto turistico, 
                        oppure goderti una cena in uno dei rinomati ristoranti di pesce della zona, ammirando il tramonto sul Golfo di Napoli.
                    </p>
                </div>
                 <img src="..\risorse\immagini\Lungomaremergellina.png" alt="Parcheggio Mergellina">
            </div>
            <div class="content-container">
                <img src="..\risorse\immagini\CentroVomero.png" alt="Parcheggio Vomero">
                <div class="text-content">
                    <h3>Vomero</h3>
                    <p>
                        Situato in una delle zone più eleganti di Napoli, il parcheggio <strong>Vomero</strong> è perfetto per chi vuole 
                        passeggiare tra negozi, locali esclusivi e luoghi di interesse come Castel Sant’Elmo e la Certosa di San Martino. 
                        Il quartiere è noto per la sua vivace vita culturale e commerciale, con boutique, cinema, teatri e locali alla moda.
                    </p>
                </div>
            </div>
        </section>

        
        <section id="mappa">
            <div id="map-all" class="map">
            </div>
        </section>

        
        <section id="tariffe">
            <h2>Tariffe</h2>
            <div class="tariffe-container">
                <table>
                    <thead>
                        <tr> <th>Parcheggio</th> <th>Tariffa Oraria</th> <th>Tariffa Giornaliera</th> </tr>
                    </thead>
                    <tbody>
                        <tr> <td>Centro Storico</td> <td>€ 2,00</td> <td>€ 20,00</td> </tr>
                        <tr> <td>Mergellina</td> <td>€ 2,50</td> <td>€ 22,00</td> </tr>
                        <tr> <td>Vomero</td> <td>€ 3,00</td> <td>€ 25,00</td> </tr>
                    </tbody>
                </table>
            </div>
        </section>


        <section id="recensioni">
            <h2 class="title">Recensioni dei nostri clienti</h2>
            <div class="slider-container">
                <button class="nav-btn" id="prevBtn">←</button>
                <div class="slider">
                    <div class="slider-wrapper">
                        <?php
                        $recensioni = [
                            "Facilissimo prenotare online, in pochi click ho trovato posto!",
                            "Ottimo servizio, ho prenotato e parcheggiato senza problemi.",
                            "La prenotazione è veloce e il parcheggio è ben organizzato.",
                            "Sistema di prenotazione chiaro e prezzi trasparenti, consigliato!",
                            "Finalmente un parcheggio che si può prenotare senza stress!",
                            "Personale disponibile e parcheggio sempre in ordine.",
                            "Ottima esperienza, parcheggio sicuro e facile da trovare.",
                            "Prenotare online mi ha fatto risparmiare tempo, comodissimo!",
                            "Servizio affidabile, mai più stress per trovare parcheggio.",
                            "Il sito è intuitivo e la prenotazione è andata liscia, perfetto!"
                        ];
                        foreach ($recensioni as $index => $recensione) {
                            echo '<div class="slide">
                                <div class="stars">⭐️⭐️⭐️⭐️⭐️</div>
                                    <p class="date">' . (2 + 2*$index) . ' Giorni Fa</p>
                                    <p>"' . $recensione . '"</p>
                                    <p class="verified">✔ Acquirente verificato</p>
                                </div>';
                        }
                        ?>
                    </div>
                </div>
                <button class="nav-btn" id="nextBtn">→</button>
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
            <br>
            <div class="contact">
                <p><strong>Mergellina</strong></p>
                <p>Email: <a href="mailto:r.esposito163@studenti.unisa.it">r.esposito163@studenti.unisa.it</a></p>
                <p>Telefono: +39 3339197364</p>
                <p>Indirizzo: <a href="https://www.google.com/maps?q=Via+Caracciolo,+45,+80122+Napoli" target="_blank">Via Caracciolo, 45, 80122 Napoli</a></p>
            </div>
            <br>
            <div class="contact">
                <p><strong>Vomero</strong></p>
                <p>Email: <a href="mailto:f.cervo1@studenti.unisa.it">f.cervo1@studenti.unisa.it</a></p>
                <p>Telefono: +39 3914783091</p>
                    
                <p>Indirizzo: <a href="https://www.google.com/maps?q=Via+Scarlatti,+67,+80127+Napoli" target="_blank">Via Scarlatti, 67, 80127 Napoli</a></p>
                
            </div>
            
        </div>
    </footer>
</body>
</html>





