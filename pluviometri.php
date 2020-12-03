<?php 

// pluviometri SIAC e ACRONET + ARPA Liguria Provincia di Imperia
$query_g="SELECT replace(replace(cod_stazioni,' ','-'),'’','')::text as id, ST_AsGeoJson(geom) as geo, name, concat(d.descrizione, ' - ', descr) as descr, note, s.id_ditta 
FROM monitoraggio.stazioni_risqueau s
JOIN monitoraggio.ditta d on d.id=s.id_ditta
WHERE pluviometro='t'
UNION 
SELECT shortcode as id, ST_AsGeoJson(geom) as geo, name, concat('ARPAL - Comune di ', municipality) as descr, '' as note , 0 as id_ditta
FROM arpal.pluvio
;";

// GeoJson Postgis: {"type":"Point","coordinates":[8.90092674245687,44.4828501691802]}

$i=0;
$result_g = pg_query($conn, $query_g);
while($r_g = pg_fetch_assoc($result_g)) {
	if ($i==0){ 
		echo '{"type": "Feature","properties": {"id":"'.$r_g["id"].'", "name": "';
		echo str_replace('"',' ',$r_g["name"]).'", ';
		echo '"descr": "'.str_replace('"',' ',$r_g["descr"]).'",';
		echo '"note": "'.str_replace('"',' ',$r_g["note"]).'"},"geometry":';
		echo $r_g["geo"].'}';
	} else {
		//echo ",". $r_g["geo"];
		echo ',{"type": "Feature","properties": {"id":"'.$r_g["id"].'", "name": "';
		echo str_replace('"',' ',$r_g["name"]).'", ';
		echo '"descr": "'.str_replace('"',' ',$r_g["descr"]).'",';
		echo '"note": "'.str_replace('"',' ',$r_g["note"]).'"},"geometry":';
		echo $r_g["geo"].'}';
		
	}
	$i=$i+1;
}
?>
