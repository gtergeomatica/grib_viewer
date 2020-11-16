# grib_viewer
From a grib to ascii (python) to leafletjs (Leaflet.CanvasLayer.Field) - webGIS for RisQUEAU project





## Dipendenze
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

Per "scaricare" l'aggiornamento ai submodules sul proprio server è possibile fare un *sync*: 

```
git submodule sync
```



Le dipendenze (al 2020-11-16) sono:

* https://github.com/Leaflet/Leaflet.git vendor/Leaflet
* https://github.com/stefanocudini/leaflet-list-markers.git vendor/leaflet-list-markers
* https://github.com/Leaflet/Leaflet.markercluster.git vendor/Leaflet.markercluster
* https://github.com/Eclipse1979/leaflet-slider.git vendor/leaflet_slider
* https://github.com/adlzanchetta/Leaflet.CanvasLayer.Field.git vendor/Leaflet.CanvasLayer.Field



Da ggiugere (potrebbero servire in futuro?)
* https://github.com/stefanocudini/leaflet-search.git
* https://github.com/PHPMailer/PHPMailer.git
* https://github.com/simsalabim/sisyphus.git
* https://github.com/l-lin/font-awesome-animation.git
* https://github.com/gtergeomatica/omirl_data_ingestion.git
* https://github.com/snapappointments/bootstrap-select.git
* https://github.com/wenzhixin/bootstrap-table.git
