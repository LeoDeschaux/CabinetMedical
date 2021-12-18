<?php
	header('Cache-Control: no cache'); //no cache
	session_cache_limiter('private_no_expire'); 
	session_start();
?>