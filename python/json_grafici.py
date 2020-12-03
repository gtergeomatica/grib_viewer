#! /usr/bin/env python
# -*- coding: utf-8 -*-
#   Gter Copyleft 2020 
# author:Roberto Marzocchi 
# co-author: Roberta Fagandini, Rossella Ambrosino
##################################################################################


import os
#import urllib2 #problema con python3
import urllib.request 
import xml.etree.ElementTree as et 
import psycopg2 
from credenziali import *
 
#import time 
#import datetime 
#import telepot 

import logging 
import tempfile 
tmpdir=tempfile.gettempdir() 

logging.basicConfig(
    format='%(asctime)s\t%(levelname)s\t%(message)s',
    filename='{}/json_grafici.log'.format(tmpdir),
    filemode='w',
    level=logging.DEBUG) 

#import config
# Il token è contenuto nel file config.py e non è aggiornato su GitHub per evitare utilizzi impropri
#TOKEN=config.TOKEN 
#bot = telepot.Bot(TOKEN)
#per ora solo un test su Roberto chat_id= config.chat_id


#file= os.path.abspath(os.path.join(os.path.dirname( __file__ ), '..', 'data.php'))

path=os.path.dirname( __file__ ) 


        
def main():
    
    
    
    conn = psycopg2.connect(host=ip, dbname=db, user=user, password=pwd, port=port)
    curr = conn.cursor()
    conn.autocommit = True
    
    query='''SELECT s.cod_stazioni::text 
    FROM monitoraggio.stazioni_risqueau s
    WHERE pluviometro='t' and id_ditta=1 '''
    curr.execute(query)
    #Pluviometri
    lista_idrometri = curr.fetchall()
    # print("Print each row and it's columns values")
    for row in lista_idrometri:
        logging.info('Leggo pluviometro {}'.format(row[0]))
        conn_s = psycopg2.connect(host=ip_s, dbname=db_s, user=user_s, password=pwd_s, port=port_s)
        curr_s = conn_s.cursor()
        conn_s.autocommit = True
        try:
            # precipitazione calcolo della cumulata ogni 5' e uso 1000*epoca perchè così vuole highchart
            # os.system('/usr/bin/python3 {}/xml2json.py Pluvio {}'.format(path_omirl, row[0]))
            query_s = '''SELECT date_trunc('hour', (data+ora) AT TIME ZONE 'UTC' AT TIME ZONE 'CET') AS hour_stump
            ,(extract(minute FROM (data+ora) AT TIME ZONE 'UTC' AT TIME ZONE 'CET')::int / 5) AS min5_slot
            ,1000*extract(epoch from (date_trunc('hour', (data+ora) AT TIME ZONE 'UTC' AT TIME ZONE 'CET')+ interval '5 minutes'*(extract(minute FROM (data+ora))::int / 5))) as ora
            ,sum(greatest(0.0,"ValoreCalcolato"))
            FROM "LETTURE_SIAC" l 
            WHERE stazione ilike '{}' 
            AND (l.data + l.ora) >  (now() - interval '12 hours') 
            AND (l.data + l.ora) < now()
            GROUP  BY 1, 2, 3
            order by 1,2'''.format(row[0])
            curr_s.execute(query_s)
            lista_dati = curr_s.fetchall()
            i=0
            for row1 in lista_dati:
                if i==0:
                    json='[[{},{}]'.format(row1[2], max(0,row1[3]))
                else:
                    json='{},[{},{}]'.format(json,row1[2], max(0,row1[3]))
                i+=1
            #print(json)
            json = '{}]'.format(json)
            f = open("{}_PluvioNative.json".format(row[0].replace(' ','-').translate(str.maketrans({"’":None}))), "w")
            f.write(json)
            f.close() 
            logging.info('Download dati per Pluviometro {} avvenuto correttamente'.format(row[0]))
        except Exception as e:
            logging.error(e) 
        try: 
            path_file = os.path.abspath(os.path.join(os.path.dirname( __file__ ), '..', 'data/{}_PluvioNative.json'.format(row[0].replace(' ','-').translate(str.maketrans({"’":None})))))
            logging.debug(path_file)
            os.system('mv {}{}_PluvioNative.json {}'.format(path, row[0].replace(' ','-').translate(str.maketrans({"’":None})), path_file))
        except Exception as ee:
            logging.error('move problem', ee)
        curr_s.close()
        conn_s.close()
   
    curr.close()
    conn.close()
    
    #Pluviometri ACRONET id_ditta=2
    conn = psycopg2.connect(host=ip, dbname=db, user=user, password=pwd, port=port)
    curr = conn.cursor()
    conn.autocommit = True
    
    query='''SELECT s.cod_stazioni::text 
    FROM monitoraggio.stazioni_risqueau s
    WHERE pluviometro='t' and id_ditta=2 '''
    curr.execute(query)
    #Pluviometri
    lista_idrometri = curr.fetchall()
    # print("Print each row and it's columns values")
    for row in lista_idrometri:
        logging.info('Leggo pluviometro {}'.format(row[0]))
        conn_s = psycopg2.connect(host=ip_s, dbname=db_s, user=user_s, password=pwd_s, port=port_s)
        curr_s = conn_s.cursor()
        conn_s.autocommit = True
        try:
            # precipitazione calcolo della cumulata ogni 5' e uso 1000*epoca perchè così vuole highchart
            query_s = '''SELECT date_trunc('hour', (data+ora) AT TIME ZONE 'UTC' AT TIME ZONE 'CET') AS hour_stump
            ,(extract(minute FROM (data+ora) AT TIME ZONE 'UTC' AT TIME ZONE 'CET')::int / 5) AS min5_slot
            ,1000*extract(epoch from (date_trunc('hour', (data+ora) AT TIME ZONE 'UTC' AT TIME ZONE 'CET')+ interval '5 minutes'*(extract(minute FROM (data+ora))::int / 5))) as ora
            ,sum(greatest(0.0,valore))
            FROM "LETTURE_ACRONET" l 
            WHERE stazione ilike '{}' 
            AND (l.data + l.ora) >  (now() - interval '12 hours') 
            AND (l.data + l.ora) < now()
            GROUP  BY 1, 2, 3
            order by 1,2'''.format(row[0])
            curr_s.execute(query_s)
            lista_dati = curr_s.fetchall()
            i=0
            for row1 in lista_dati:
                if i==0:
                    json='[[{},{}]'.format(row1[2], max(0,row1[3]))
                else:
                    json='{},[{},{}]'.format(json,row1[2], max(0,row1[3]))
                i+=1
            #print(json)
            json = '{}]'.format(json)
            f = open("{}_PluvioNative.json".format(row[0].replace(' ','-').translate(str.maketrans({"’":None}))), "w")
            f.write(json)
            f.close() 
            logging.info('Download dati per Pluviometro {} avvenuto correttamente'.format(row[0]))
        except Exception as e:
            logging.error(e) 
        try: 
            path_file = os.path.abspath(os.path.join(os.path.dirname( __file__ ), '..', 'data/{}_PluvioNative.json'.format(row[0].replace(' ','-').translate(str.maketrans({"’":None})))))
            logging.debug(path_file)
            os.system('mv {}{}_PluvioNative.json {}'.format(path, row[0].replace(' ','-').translate(str.maketrans({"’":None})), path_file))
        except Exception as ee:
            logging.error('move problem', ee)
        curr_s.close()
        conn_s.close()

   
         
if __name__ == "__main__":
    main()   