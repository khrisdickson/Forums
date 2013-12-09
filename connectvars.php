<?php
$server = 'webdesign4.georgianc.on.ca';
$username = 'db100083097';
$password = '871124';
$database = 'db100083097';

if(!mysql_connect($server, $username, $password, $database))
{
	exit('Error trying to establish connection');
}
if(!mysql_select_db($database))
{
	exit('Could not find the database');
}

?>