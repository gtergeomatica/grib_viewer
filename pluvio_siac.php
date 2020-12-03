<?php
session_start();
include 'conn.php';

$id=pg_escape_string($_GET["id"]);



if(!$conn_siac) {
    die('Connessione fallita !<br />');
} else {
	//$idcivico=$_GET["id"];
	$query="SELECT extract(epoch from (l.data + l.ora) AT TIME ZONE 'UTC' AT TIME ZONE 'CET') as data_ora, l.\"ValoreCalcolato\"*1000 as lettura
	 FROM \"LETTURE_SIAC\" l
	 WHERE stazione ilike '".$id."' AND (l.data + l.ora) >  (now() - interval '14 days') AND (l.data + l.ora) < now()
	 ORDER BY data_ora asc;";
    
    //echo $query."<br>";
	$result = pg_query($conn_siac, $query);
	#echo $query;
	#exit;
	$rows = array();
	$json = '[';
	$check=0;
	while($r = pg_fetch_assoc($result)) {
    		//$rows[] = $r;
			if ($check==0){
				$json= $json . '['.$r['data_ora'].'000,'.max(0,$r['lettura']).']';
    		} else {
				$json= $json . ',['.$r['data_ora'].'000,'.max(0,$r['lettura']).']';
			}
			$check=1;
	}
	$json=$json .']';
	echo $json;
	pg_close($conn);
	#echo $rows ;
	/*if (empty($rows)==FALSE){
		//print $rows;
		print json_encode(array_values(pg_fetch_all($result)));
	} else {
		echo "[{\"NOTE\":'No data'}]";
	}*/
}

?>
