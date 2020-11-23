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
    filename='{}/omirl_run.log'.format(tmpdir),
    filemode='a',
    level=logging.INFO) 

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
    query = "SELECT shortcode from arpal.pluvio; --where valido='t';"
    curr.execute(query)
    lista_idrometri = curr.fetchall()
    # print("Print each row and it's columns values")
    for row in lista_idrometri:
        logging.info('Leggo pluviometro {}'.format(row[0]))
        try:
            os.system('/usr/bin/python3 {}/xml2json.py Pluvio {}'.format(path_omirl, row[0]))
            logging.info('Download dati per Idrometro {} avvenuto correttamente'.format(row[0]))
        except Exception as e:
            logging.error('TIMEOUT? PROBLEM', e) 
        try: 
            path_file = os.path.abspath(os.path.join(os.path.dirname( __file__ ), '..', 'data/{}_Pluvio.json'.format(row[0])))
            logging.debug(path_file)
            os.system('mv {}/{}_Pluvio.json {}'.format(path_omirl, row[0],path_file))
        except Exception as ee:
            logging.error('move problem', ee)     
            
            
        
if __name__ == "__main__":
    main()
