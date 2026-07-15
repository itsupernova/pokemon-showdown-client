<?php

mb_internal_encoding('UTF-8');

$routes = json_decode(file_get_contents(__DIR__ . '/routes.json'), true);

// Load database configuration from environment variables for PostgreSQL
// This supports both local development and production (Render/Supabase)
$psconfig = [

	'sysops' => explode(',', getenv('PS_SYSOPS') ?: 'zarel'),
	'autolock_ip' => [],

// password and SID hashing settings

	'password_cost' => (int)getenv('PS_PASSWORD_COST') ?: 12,
	'sid_length' => (int)getenv('PS_SID_LENGTH') ?: 15,
	'sid_cost' => (int)getenv('PS_SID_COST') ?: 4,

// database - PostgreSQL configuration
// Environment variables should be set on Render or in local .env file

	'driver' => getenv('DB_DRIVER') ?: 'pgsql',
	'server' => getenv('DB_HOST') ?: 'localhost',
	'port' => (int)getenv('DB_PORT') ?: 5432,
	'username' => getenv('DB_USER') ?: getenv('DB_USERNAME') ?: '',
	'password' => getenv('DB_PASSWORD') ?: '',
	'database' => getenv('DB_NAME') ?: getenv('DB_DATABASE') ?: '',
	'prefix' => getenv('DB_PREFIX') ?: 'ps_',
	'charset' => 'utf8',
	'sslmode' => getenv('DB_SSLMODE') ?: null,

// alternative: use connection string if provided
// Format: postgresql://user:password@host:5432/database
	'connection_string' => getenv('DATABASE_URL') ?: null,

// routes
	'routes' => $routes,

// CORS requests

	'cors' => [
		'/^http:\/\/smogon\.com$/' => 'smogon.com_',
		'/^http:\/\/www\.smogon\.com$/' => 'www.smogon.com_',
		'/^http:\/\/logs\.psim\.us$/' => 'logs.psim.us_',
		'/^http:\/\/logs\.psim\.us:8080$/' => 'logs.psim.us_',
		'/^http:\/\/[a-z0-9]+\.psim\.us$/' => '',
		'/^http:\/\/play\.pokemonshowdown\.com$/' => '',
	],

// key signing for SSO

	'privatekeys' => [

1 => getenv('PS_PRIVATE_KEY') ?: '',

	]

];
