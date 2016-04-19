--
-- PostgreSQL database dump
--

-- Dumped from database version 9.5.2
-- Dumped by pg_dump version 9.5.2

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: film; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE film (
    filmid integer NOT NULL,
    filmtitle character(100) NOT NULL,
    filmrelease date NOT NULL
);


ALTER TABLE film OWNER TO postgres;

--
-- Name: film_filmid_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE film_filmid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE film_filmid_seq OWNER TO postgres;

--
-- Name: film_filmid_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE film_filmid_seq OWNED BY film.filmid;


--
-- Name: role; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE role (
    roleid integer NOT NULL,
    rolename character(50) NOT NULL
);


ALTER TABLE role OWNER TO postgres;

--
-- Name: role_roleid_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE role_roleid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE role_roleid_seq OWNER TO postgres;

--
-- Name: role_roleid_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE role_roleid_seq OWNED BY role.roleid;


--
-- Name: room; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE room (
    roomid integer NOT NULL,
    seats smallint NOT NULL
);


ALTER TABLE room OWNER TO postgres;

--
-- Name: room_roomid_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE room_roomid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE room_roomid_seq OWNER TO postgres;

--
-- Name: room_roomid_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE room_roomid_seq OWNED BY room.roomid;


--
-- Name: session; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE session (
    sessionid integer NOT NULL,
    "timestamp" timestamp without time zone NOT NULL,
    reffilm integer,
    refroom integer
);


ALTER TABLE session OWNER TO postgres;

--
-- Name: session_sessionid_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE session_sessionid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE session_sessionid_seq OWNER TO postgres;

--
-- Name: session_sessionid_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE session_sessionid_seq OWNED BY session.sessionid;


--
-- Name: staff; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE staff (
    staffid integer NOT NULL,
    reffilm integer NOT NULL
);


ALTER TABLE staff OWNER TO postgres;

--
-- Name: staff_staffid_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE staff_staffid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE staff_staffid_seq OWNER TO postgres;

--
-- Name: staff_staffid_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE staff_staffid_seq OWNED BY staff.staffid;


--
-- Name: work; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE work (
    idrefstaff integer NOT NULL,
    idrefworker integer NOT NULL,
    startyear smallint NOT NULL,
    endyear smallint NOT NULL,
    refrole integer NOT NULL
);


ALTER TABLE work OWNER TO postgres;

--
-- Name: worker; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE worker (
    workerid integer NOT NULL,
    workerfirst character(50) NOT NULL,
    workerlast character(50) NOT NULL
);


ALTER TABLE worker OWNER TO postgres;

--
-- Name: worker_workerid_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE worker_workerid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE worker_workerid_seq OWNER TO postgres;

--
-- Name: worker_workerid_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE worker_workerid_seq OWNED BY worker.workerid;


--
-- Name: filmid; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY film ALTER COLUMN filmid SET DEFAULT nextval('film_filmid_seq'::regclass);


--
-- Name: roleid; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY role ALTER COLUMN roleid SET DEFAULT nextval('role_roleid_seq'::regclass);


--
-- Name: roomid; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY room ALTER COLUMN roomid SET DEFAULT nextval('room_roomid_seq'::regclass);


--
-- Name: sessionid; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY session ALTER COLUMN sessionid SET DEFAULT nextval('session_sessionid_seq'::regclass);


--
-- Name: staffid; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY staff ALTER COLUMN staffid SET DEFAULT nextval('staff_staffid_seq'::regclass);


--
-- Name: workerid; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY worker ALTER COLUMN workerid SET DEFAULT nextval('worker_workerid_seq'::regclass);


--
-- Data for Name: film; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY film (filmid, filmtitle, filmrelease) FROM stdin;
\.


--
-- Name: film_filmid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('film_filmid_seq', 1, false);


--
-- Data for Name: role; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY role (roleid, rolename) FROM stdin;
1	director                                          
2	writer                                            
3	actor                                             
\.


--
-- Name: role_roleid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('role_roleid_seq', 3, true);


--
-- Data for Name: room; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY room (roomid, seats) FROM stdin;
\.


--
-- Name: room_roomid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('room_roomid_seq', 1, false);


--
-- Data for Name: session; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY session (sessionid, "timestamp", reffilm, refroom) FROM stdin;
\.


--
-- Name: session_sessionid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('session_sessionid_seq', 1, false);


--
-- Data for Name: staff; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY staff (staffid, reffilm) FROM stdin;
\.


--
-- Name: staff_staffid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('staff_staffid_seq', 1, false);


--
-- Data for Name: work; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY work (idrefstaff, idrefworker, startyear, endyear, refrole) FROM stdin;
\.


--
-- Data for Name: worker; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY worker (workerid, workerfirst, workerlast) FROM stdin;
\.


--
-- Name: worker_workerid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('worker_workerid_seq', 1, false);


--
-- Name: film_filmid; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY film
    ADD CONSTRAINT film_filmid PRIMARY KEY (filmid);


--
-- Name: role_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY role
    ADD CONSTRAINT role_pkey PRIMARY KEY (roleid);


--
-- Name: room_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY room
    ADD CONSTRAINT room_pkey PRIMARY KEY (roomid);


--
-- Name: session_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY session
    ADD CONSTRAINT session_pkey PRIMARY KEY (sessionid);


--
-- Name: staff_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY staff
    ADD CONSTRAINT staff_pkey PRIMARY KEY (staffid);


--
-- Name: work_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY work
    ADD CONSTRAINT work_pkey PRIMARY KEY (idrefstaff, idrefworker);


--
-- Name: worker_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY worker
    ADD CONSTRAINT worker_pkey PRIMARY KEY (workerid);


--
-- Name: session_reffilm_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY session
    ADD CONSTRAINT session_reffilm_fkey FOREIGN KEY (reffilm) REFERENCES film(filmid) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: session_refroom_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY session
    ADD CONSTRAINT session_refroom_fkey FOREIGN KEY (refroom) REFERENCES room(roomid) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: staff_stafffilm_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY staff
    ADD CONSTRAINT staff_stafffilm_fkey FOREIGN KEY (reffilm) REFERENCES film(filmid) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: work_idrefstaff_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY work
    ADD CONSTRAINT work_idrefstaff_fkey FOREIGN KEY (idrefstaff) REFERENCES staff(staffid) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: work_idrefworker_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY work
    ADD CONSTRAINT work_idrefworker_fkey FOREIGN KEY (idrefworker) REFERENCES worker(workerid) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: work_refrole_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY work
    ADD CONSTRAINT work_refrole_fkey FOREIGN KEY (refrole) REFERENCES role(roleid) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--
