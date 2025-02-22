--
-- PostgreSQL database dump
--

-- Dumped from database version 17.0
-- Dumped by pg_dump version 17.0

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: pgcrypto; Type: EXTENSION; Schema: -; Owner: -
--

CREATE EXTENSION IF NOT EXISTS pgcrypto WITH SCHEMA public;


--
-- Name: EXTENSION pgcrypto; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION pgcrypto IS 'cryptographic functions';


SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: parcheggi; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.parcheggi (
    id integer NOT NULL,
    nome character varying(100) NOT NULL,
    posizione character varying(255) NOT NULL,
    posti_totali integer NOT NULL,
    posti_disponibili integer NOT NULL
);


ALTER TABLE public.parcheggi OWNER TO postgres;

--
-- Name: parcheggi_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.parcheggi_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.parcheggi_id_seq OWNER TO postgres;

--
-- Name: parcheggi_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.parcheggi_id_seq OWNED BY public.parcheggi.id;


--
-- Name: prenotazioni; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.prenotazioni (
    id integer NOT NULL,
    nome_utente character varying(100) NOT NULL,
    nome_parcheggio character varying(100) NOT NULL,
    data_prenotazione date NOT NULL,
    ora_prenotazione time without time zone NOT NULL
);


ALTER TABLE public.prenotazioni OWNER TO postgres;

--
-- Name: prenotazioni_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.prenotazioni_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.prenotazioni_id_seq OWNER TO postgres;

--
-- Name: prenotazioni_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.prenotazioni_id_seq OWNED BY public.prenotazioni.id;


--
-- Name: utenti; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.utenti (
    id integer NOT NULL,
    nome character varying(50) NOT NULL,
    cognome character varying(50) NOT NULL,
    email character varying(150) NOT NULL,
    password character varying(255) NOT NULL,
    tipo_utente character varying(20) DEFAULT 'registrato'::character varying,
    data_registrazione timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.utenti OWNER TO postgres;

--
-- Name: utenti_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.utenti_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.utenti_id_seq OWNER TO postgres;

--
-- Name: utenti_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.utenti_id_seq OWNED BY public.utenti.id;


--
-- Name: parcheggi id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.parcheggi ALTER COLUMN id SET DEFAULT nextval('public.parcheggi_id_seq'::regclass);


--
-- Name: prenotazioni id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.prenotazioni ALTER COLUMN id SET DEFAULT nextval('public.prenotazioni_id_seq'::regclass);


--
-- Name: utenti id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.utenti ALTER COLUMN id SET DEFAULT nextval('public.utenti_id_seq'::regclass);


--
-- Data for Name: parcheggi; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.parcheggi (id, nome, posizione, posti_totali, posti_disponibili) FROM stdin;
1	Centro Storico	Via Toledo 123, Napoli	50	46
2	Mergellina	Via Caracciolo 45, Napoli	60	57
3	Vomero	Via Scarlattii 67, Napoli	48	45
\.


--
-- Data for Name: prenotazioni; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.prenotazioni (id, nome_utente, nome_parcheggio, data_prenotazione, ora_prenotazione) FROM stdin;
1	Mario	Centro Storico	2025-05-10	10:00:00
2	Luca	Centro Storico	2025-06-12	14:30:00
3	Anna	Centro Storico	2025-07-01	18:15:00
4	Giuseppe	Centro Storico	2025-07-01	18:30:00
5	Giovanna	Mergellina	2025-05-15	11:45:00
6	Francesco	Mergellina	2025-06-20	16:00:00
7	Paola	Mergellina	2025-07-05	18:30:00
8	Raffaella	Vomero	2025-05-08	08:30:00
9	Chiara	Vomero	2025-06-18	17:15:00
10	Andrea	Vomero	2025-07-10	20:00:00
\.


--
-- Data for Name: utenti; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.utenti (id, nome, cognome, email, password, tipo_utente, data_registrazione) FROM stdin;
1	Admin	Super	admin@email.com	$2a$06$BCeMZGBupo6D2UIIE10FIOxDTT714rQm5tVMH7BndsBUwofrpgZVe	admin	2025-02-22 11:28:47.886499
2	Mario	Rossi	mario.rossi@email.com	$2a$06$Y/qTv8D8D/veJYaJZfrVseBiYZMfjG.3.VXnTdFDaX3Q9mVXA53hS	registrato	2025-02-22 11:28:47.886499
3	Luca	Bianchi	luca.bianchi@email.com	$2a$06$VQwAOaKBDXx9/6bCMI0IseEaxkLMXxWSEZb9te3BgKr7uZkBtNK1K	registrato	2025-02-22 11:28:47.886499
4	Anna	Verdi	anna.verdi@email.com	$2a$06$niBm/tpsfdiqmcey3OaYZem4HjGwhZPKs.oY5ca4dbGqV.UazIaK6	registrato	2025-02-22 11:28:47.886499
5	Giuseppe	Esposito	giuseppe.esposito@email.com	$2a$06$1SdiRX8n2lO7RmLH1Xd2VuxPg3WI3v5cqjAwTNeSxet3Vg5Gio/vO	registrato	2025-02-22 11:28:47.886499
6	Giovanna	Ferrari	giovanna.ferrari@email.com	$2a$06$DTJ/83Y9ZY5T7Bh1QluXiOJXKft9rH0.nQS.De9yp.SticVDSnvT.	registrato	2025-02-22 11:28:47.886499
7	Francesco	Russo	francesco.russo@email.com	$2a$06$2zY0FXmf3GgnApsaCrtT6u52urek10YMpX/LGBBVTNt9b8MtLvLF2	registrato	2025-02-22 11:28:47.886499
8	Paola	De Luca	paola.deluca@email.com	$2a$06$aqJnoqzf3B3enYHxTA9sTu6UT0Z2AqV0xhJNBqsc6ydx9mmffNbcS	registrato	2025-02-22 11:28:47.886499
9	Raffaella	Mancini	raffaella.mancini@email.com	$2a$06$2VQBRXA5CS.Fjv7PUQYrFewkf8Hw2bkc6oFoojNipeQ5dwitU5KiS	registrato	2025-02-22 11:28:47.886499
10	Chiara	Moretti	chiara.moretti@email.com	$2a$06$qtkNUOvWy3E53w6tz7dC.eVdVvOIAyF1Vyd1WSQhpGTQQl9beDPT.	registrato	2025-02-22 11:28:47.886499
11	Andrea	Gallo	andrea.gallo@email.com	$2a$06$sXjlwLWZEcIL7e2MKJECouRqALmRfOCXzxhBi9dsOvT9boIiuC3Oq	registrato	2025-02-22 11:28:47.886499
\.


--
-- Name: parcheggi_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.parcheggi_id_seq', 3, true);


--
-- Name: prenotazioni_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.prenotazioni_id_seq', 10, true);


--
-- Name: utenti_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.utenti_id_seq', 12, true);


--
-- Name: parcheggi parcheggi_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.parcheggi
    ADD CONSTRAINT parcheggi_pkey PRIMARY KEY (id);


--
-- Name: prenotazioni prenotazioni_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.prenotazioni
    ADD CONSTRAINT prenotazioni_pkey PRIMARY KEY (id);


--
-- Name: utenti utenti_email_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.utenti
    ADD CONSTRAINT utenti_email_key UNIQUE (email);


--
-- Name: utenti utenti_nome_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.utenti
    ADD CONSTRAINT utenti_nome_key UNIQUE (nome);


--
-- Name: utenti utenti_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.utenti
    ADD CONSTRAINT utenti_pkey PRIMARY KEY (id);


--
-- Name: TABLE parcheggi; Type: ACL; Schema: public; Owner: postgres
--

GRANT ALL ON TABLE public.parcheggi TO www;


--
-- Name: SEQUENCE parcheggi_id_seq; Type: ACL; Schema: public; Owner: postgres
--

GRANT ALL ON SEQUENCE public.parcheggi_id_seq TO www;


--
-- Name: TABLE prenotazioni; Type: ACL; Schema: public; Owner: postgres
--

GRANT ALL ON TABLE public.prenotazioni TO www;


--
-- Name: SEQUENCE prenotazioni_id_seq; Type: ACL; Schema: public; Owner: postgres
--

GRANT ALL ON SEQUENCE public.prenotazioni_id_seq TO www;


--
-- Name: TABLE utenti; Type: ACL; Schema: public; Owner: postgres
--

GRANT ALL ON TABLE public.utenti TO www;


--
-- Name: SEQUENCE utenti_id_seq; Type: ACL; Schema: public; Owner: postgres
--

GRANT ALL ON SEQUENCE public.utenti_id_seq TO www;


--
-- PostgreSQL database dump complete
--

