<?php

// Replace this with a DEBUG var
error_reporting(E_ALL);

// Global Definitions
define('DEBUG', true);


require_once 'src/data/dbConnect.php';
require_once 'src/config/paths.php';

// Initailise app with configuration

// Initialize connection to DB
$dbo = DataConnection::getDBConnection();


// TODO: Router goes here




