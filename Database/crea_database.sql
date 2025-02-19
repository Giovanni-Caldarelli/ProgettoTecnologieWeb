
DROP TABLE IF EXISTS prenotazioni CASCADE;
DROP TABLE IF EXISTS parcheggi CASCADE;
DROP TABLE IF EXISTS utenti CASCADE;

CREATE TABLE utenti (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(50) UNIQUE NOT NULL,
    cognome VARCHAR(50) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    tipo_utente VARCHAR(20) DEFAULT 'registrato',
    data_registrazione TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE parcheggi (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    posizione VARCHAR(255) NOT NULL,
    posti_totali INT NOT NULL,
    posti_disponibili INT NOT NULL
);

CREATE TABLE prenotazioni (
    id SERIAL PRIMARY KEY,
    nome_utente VARCHAR(100) NOT NULL,
    nome_parcheggio VARCHAR(100) NOT NULL,
    data_prenotazione DATE NOT NULL,
    ora_prenotazione TIME NOT NULL
);

GRANT ALL PRIVILEGES ON ALL TABLES IN SCHEMA public TO www;
GRANT ALL PRIVILEGES ON ALL SEQUENCES IN SCHEMA public TO www;
