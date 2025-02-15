INSERT INTO utenti (nome, cognome, email, password, tipo_utente) VALUES
('Admin', 'Super', 'admin@email.com', crypt('adminpassword', gen_salt('bf')), 'admin'),


INSERT INTO parcheggi (nome, posizione, posti_totali, posti_disponibili) VALUES
('Centro Storico', 'Via Toledo 123, Napoli', 50, 46),
('Mergellina', 'Via Caracciolo 45, Napoli', 60, 57),
('Vomero', 'Via Scarlattii 67, Napoli', 48, 45);


INSERT INTO prenotazioni (nome_utente, nome_parcheggio, data_prenotazione, ora_prenotazione) VALUES
('Mario', 'Centro Storico', '2025-05-10', '10:00:00'),
('Luca', 'Centro Storico', '2025-06-12', '14:30:00'),
('Anna', 'Centro Storico', '2025-07-01', '18:15:00'),
('Giuseppe', 'Centro Storico', '2025-07-01', '18:30:00'),

('Giovanna', 'Mergellina', '2025-05-15', '11:45:00'),
('Francesco', 'Mergellina', '2025-06-20', '16:00:00'),
('Paola', 'Mergellina', '2025-07-05', '18:30:00'),

('Raffaella', 'Vomero', '2025-05-08', '08:30:00'),
('Chiara', 'Vomero', '2025-06-18', '17:15:00'),
('Andrea', 'Vomero', '2025-07-10', '20:00:00');