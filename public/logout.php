<?php
	require('../src/config.php');
	$_SESSION = [];
	session_destroy();
	redirect('../../productlist.php?logout');