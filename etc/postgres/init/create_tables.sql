SELECT 'CREATE DATABASE jarvis'
WHERE NOT EXISTS (SELECT FROM pg_database WHERE datname = 'jarvis')\gexec

CREATE TABLE IF NOT EXISTS auth_clients (
	id serial PRIMARY KEY,
	name VARCHAR (50) UNIQUE NOT NULL,
	password VARCHAR (50) NOT NULL,
	active BOOLEAN NOT NULL,
	created_on TIMESTAMP NOT NULL,
	last_login TIMESTAMP 
);

INSERT INTO auth_clients (name, password, active, created_on)
VALUES('admin_client', 'qwertyworks', '1', now());

CREATE TABLE IF NOT EXISTS auth_users (
	id serial PRIMARY KEY,
	email VARCHAR(50) UNIQUE NOT NULL,
	password VARCHAR(50) NOT NULL,
	active BOOLEAN NOT NULL,
	created TIMESTAMP NOT NULL,
	created_by INT NOT NULL,
	updated TIMESTAMP,
	updated_by INT
);

CREATE TABLE IF NOT EXISTS spacecraft_characters (
	id serial PRIMARY KEY,
	name VARCHAR(50),
	current_room VARCHAR(50) NOT NULL,
	pos_x INT NOT NULL,
	pos_y INT NOT NULL,
	pos_z INT NOT NULL,
	active BOOLEAN NOT NULL,
	updated TIMESTAMP,
	updated_by INT,
	created TIMESTAMP NOT NULL,
	created_by INT NOT NULL
);