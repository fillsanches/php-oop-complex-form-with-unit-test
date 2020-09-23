<?php 

/**
 * Definition of MySQL database configurations
 *
 * @author Fellipe Sanches <fellipes@yahoo.com.br>
 */

// Database configuration 
$db_host     = "127.0.0.1"; 
$db_username = "your-db-user"; 
$db_password = "your-db-password"; 
$db_name     = "your-db-name"; 
 
// Create database connection 
$db = new mysqli($db_host, $db_username, $db_password, $db_name); 
 
// Check connection 
if ($db->connect_error) { 
    die("Connection failed: " . $db->connect_error); 
}
