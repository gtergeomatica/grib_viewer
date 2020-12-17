## Script python to manage grib file of today

- **grib2ascii**: download of data from a network folder, extract the band for u, v, temperature (2 m above ground), rain cumulate. For rain cumulate calculate also the 3h cumulate
- **json_grafici.py**: export json file from SIAC DB 
- **omirl_run.py**: run the file of this repository https://github.com/gtergeomatica/omirl_data_ingestion.git
- **credenziali.py** file omitted from github with the following format 

```
#credenziali DB valide per DB risqueau
ip='XXXXXXXXX'
db='XXXXXXXXX'
user='XXXXXXXXX'
pwd='XXXXXXXXX'
port='XXXX'

#credenziali DB valide per DB risqueau siac
ip_s='XXXXXXXXX'
port_s='XXXX' 
db_s='XXXXXXXXX' 
user_s='XXXXXXXXX' 
pwd_s='XXXXXXXXX'


# path to omirl_data_ingestion repository
path_omirl= '/XXXXXXXXX/REPOSITORY/omirl_data_ingestion/'


smtp_server = "smtp.gmail.com"
smtp_port = 587  # For starttls
sender_email = "XXXXXXXXX@gmail.com"
smtp_password = "XXXXXXXXX"
receiver_email = "assistenzagis@gter.it"
```

The python script sono gestiti tramite crontab


