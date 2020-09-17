<?php
 include('session.php');
 header( "refresh:0.1; url=cita.php" );
	$sql4 = 'DELETE FROM citas WHERE id = "'.$_POST['idcita'].'"';
 // echo $sql4;
	$sth4 = FETCH_SQL($sql4);