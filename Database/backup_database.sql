INSERT INTO utenti (nome, cognome, email, password, tipo_utente) VALUES
('Admin', 'Super', 'admin@email.com', 'adminpassword', 'admin'),
('Mario', 'Rossi', 'mario.rossi@email.com', 'password123', 'registrato'),
('Lucia', 'Verdi', 'lucia.verdi@email.com', 'password456', 'registrato');

INSERT INTO parcheggi (nome, posizione, posti_totali, posti_disponibili) VALUES
('Parcheggio Centro Storico', 'Via Toledo 123, Napoli', 100, 90),
('Parcheggio Mergellina', 'Via Caracciolo 45, Napoli', 200, 180),
('Parcheggio Vomero', 'Via Scarlattii 67, Napoli', 150, 140);

INSERT INTO prenotazioni (id_utente, id_parcheggio, data_prenotazione, ora_prenotazione) VALUES
(2, 1, '2025-02-10', '08:30:00'),
(3, 2, '2025-02-11', '15:00:00'),
(2, 3, '2025-02-12', '10:00:00');
