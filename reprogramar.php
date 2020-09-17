<?php
 include('session.php');
 header( "refresh:0.1; url=cita.php" );
 $sql4 = 'update cita set fecha = "'.$_POST['fecha'].'", hora ="'.$_POST['hora'].'" where idcita="'.$_POST['idcita'].'" ';
 // echo $sql4;
 $sth4 = FETCH_SQL($sql4);