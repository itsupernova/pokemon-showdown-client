<?php

// Load replay database configuration from environment variables for PostgreSQL
// This supports both local development and production (Render/Supabase)

$config_replay_database = [
	'driver' => getenv('REPLAY_DB_DRIVER') ?: 'pgsql',
	'server' => getenv('REPLAY_DB_HOST') ?: getenv('DB_HOST') ?: 'localhost',
	'port' => (int)getenv('REPLAY_DB_PORT') ?: (int)getenv('DB_PORT') ?: 5432,
	'username' => getenv('REPLAY_DB_USER') ?: getenv('REPLAY_DB_USERNAME') ?: getenv('DB_USER') ?: getenv('DB_USERNAME') ?: '',
	'password' => getenv('REPLAY_DB_PASSWORD') ?: getenv('DB_PASSWORD') ?: '',
	'database' => getenv('REPLAY_DB_NAME') ?: getenv('REPLAY_DB_DATABASE') ?: getenv('DB_NAME') ?: getenv('DB_DATABASE') ?: 'replays',
	'prefix' => getenv('REPLAY_DB_PREFIX') ?: 'ps_',
	'charset' => 'utf8',
	'sslmode' => getenv('REPLAY_DB_SSLMODE') ?: getenv('DB_SSLMODE') ?: null,

	// alternative: use connection string if provided
	// Format: postgresql://user:password@host:5432/database
	'connection_string' => getenv('REPLAY_DATABASE_URL') ?: getenv('DATABASE_URL') ?: null,
];
