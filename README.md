# grib_viewer
From a grib to ascii (python) to leafletjs (Leaflet.CanvasLayer.Field) - webGIS for RisQUEAU project

This is a demo based on https://github.com/adlzanchetta/Leaflet.CanvasLayer.Field.git


## Procedure to install 

# 1. Clone repository 
git clone repository_address


# 2. DB PostGIS connection

create a conn.php file with the connection to DB

```
<?php 
$conn = pg_connect("host=<HOST> port=<XXXX> dbname=<DBNAME> user=<USER> password=<PASSWORD>");
if (!$conn) {
	die('Could not connect to DB, please contact the administrator.');
}
?>
```

It is used for instruments view: 

* pluviometri.php
* etc



TO TRANSLATE:

# 3. Dependencies
Ci sono alcune librerie che sono state aggiunte come dipendenze. Si tratta di altri repository github che sono direttamente caricati dentro il repo:

Un esempio è la libreria leaflet alla base del webGIS:

Con il comando ```git submodule```  si aggiunge il repository: 

```
git submodule add https://github.com/Leaflet/Leaflet.git vendor/Leaflet
```


Quindi si può aggiornare ad una specifica versione il submodule per aggiornare il repository (analogo del comando push).

```
git submodule update --remote vendor/Leaflet
cd vendor/Leaflet
git checkout 1.4.0
```

Per "scaricare" l'aggiornamento ai submodules sul proprio server è possibile fare un *sync* (DA USARE CON CAUTELA): 

```
git submodule sync
```



Le dipendenze (al 2020-11-16) sono:

* https://github.com/Leaflet/Leaflet.git vendor/Leaflet
* https://github.com/stefanocudini/leaflet-list-markers.git vendor/leaflet-list-markers
* https://github.com/Eclipse1979/leaflet-slider.git vendor/leaflet_slider
* https://github.com/adlzanchetta/Leaflet.CanvasLayer.Field.git vendor/Leaflet.CanvasLayer.Field


Alla prima installazione è necessario fare:

* git submodule update --init --remote vendor/Leaflet
* git submodule update --init --remote vendor/leaflet-list-markers/
* git submodule update --init --remote vendor/leaflet-slider/
* git submodule update --init --remote vendor/Leaflet.CanvasLayer.Field/


Quindi almeno per leaflet ripetere il checkout come sopra
```
git submodule update --remote vendor/Leaflet
cd vendor/Leaflet
git checkout 1.4.0
```

Da testare se funziona anche per nuove versioni di leaflet e modificare il presente README.md




Invece i seguenti file sono scaricati: 

* https://github.com/Leaflet/Leaflet.markercluster.git vendor/Leaflet.markercluster



--
Forse da aggiugere (potrebbero servire in futuro?)

* https://github.com/stefanocudini/leaflet-search.git
* https://github.com/PHPMailer/PHPMailer.git
* https://github.com/simsalabim/sisyphus.git
* https://github.com/l-lin/font-awesome-animation.git
* https://github.com/gtergeomatica/omirl_data_ingestion.git
* https://github.com/snapappointments/bootstrap-select.git
* https://github.com/wenzhixin/bootstrap-table.git


# 4. Add line to crontab

```
###################################################################################
# Risqueau 8every day at 12:00 PM)
05 12 * * * gter /usr/bin/python3 /home/gter/REPOSITORY/grib_viewer/python/grib2ascii.py /home/risqueau/dati/ 2>&1
```
