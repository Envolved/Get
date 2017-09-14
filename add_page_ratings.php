<?php


require('bootstrap.php');

global $db;

$userid = $_REQUEST['userid'];
$page_id = $_REQUEST['page_id'];
$rating = $_REQUEST['rating'];


if( isset($page_id) && !empty($page_id) && isset($userid) && !empty($userid) && isset($rating) && !empty($rating) )
{
	$check_sql = sprintf("select * from pages_rating where user_id = %s and page_id = %s", secure($userid, 'int'), secure($page_id, 'int') );

	$get_rating = $db->query($check_sql) or _error(SQL_ERROR_THROWEN);

	if($get_rating->num_rows > 0) 
	{
		$ratings_sql = sprintf("UPDATE pages_rating SET rating = %s WHERE user_id = %s and page_id = %s ", secure($rating), secure($userid, 'int'), secure($page_id, 'int') );
	}
	else
	{
		$ratings_sql = sprintf("INSERT INTO pages_rating (user_id, page_id, rating) VALUES (%s, %s, %s)", secure($userid, 'int'),  secure($page_id, 'int'), secure($rating) );
	}

	// execute query
	$db->query($ratings_sql) or _error(SQL_ERROR_THROWEN);

	echo 'success';
}

?>