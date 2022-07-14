<?php

require_once 'connect.php';

echo "Creating users table...\n";
$db->exec("CREATE TABLE IF NOT EXISTS users(id SERIAL,email VARCHAR(255) UNIQUE,name VARCHAR(255), password VARCHAR(255),role VARCHAR(255) DEFAULT 'shopper',last_updated TIMESTAMP)");
echo "Users table created.\n";

echo "Creating products table...\n";
$db->exec("CREATE TABLE IF NOT EXISTS products(id SERIAL,name VARCHAR(255),price INTEGER,description VARCHAR(255),category VARCHAR(255),image VARCHAR(255),last_updated TIMESTAMP)");
echo "Products table created.\n";