#!/usr/bin/env python
# -*- coding: utf-8 -*-
#
# Gter copyleft 2020
# author:Roberto Marzocchi 
# co-author: Roberta Fagandini, Rossella Ambrosino
##################################################################################

import os,sys

from sys import argv

import datetime

import logging
import tempfile
import smtplib, ssl
from credenziali import *

#il file di log lo salviamo nella cartella temporanea di sistema
tmpfolder=tempfile.gettempdir() # get the current temporary directory
logfile='{}/grib2ascii.log'.format(tmpfolder)

 
logging.basicConfig(
    format='%(asctime)s\t%(levelname)s\t%(message)s',
    filename=logfile,
    filemode='w',
    level=logging.DEBUG)

# assegno l'input dello script e.g wd (wind direction)
script, input1 = argv

try:
    path_grib=input1
    logging.info(path_grib)
except: 
    logging.error('Please, define the path to grib file. If the file is contained in this directory use ./')
    exit()


# funzione non usata
def gdal_execute(comando):
    '''
    
    Funzione per lanciare comando gdal
    '''
    try:
        ret = os.system(comando)
        logging.debug(ret)
    except Exception as e:
        logging.error(e)
    return ret



def main():
    now = datetime.datetime.now()
    now_file  =now.strftime("%Y%m%d")
    giorno = now.strftime("%Y/%m/%d")
    today = datetime.datetime.now().date()
    logging.debug(today)
    fine_giorno = today + datetime.timedelta(hours=47)
    logging.debug(fine_giorno)
    logging.info("Current date and time : {}".format(now_file))
    file_prefix='WRF_NEP'
    file_name='{}_{}00'.format(file_prefix, now_file)



    #verifico che il file esista
    if os.path.isfile('{}{}.grb2'.format(path_grib,file_name)):
        logging.info("{}{}.grb2 exist".format(path_grib,file_name))
    else:
        logging.error("{}{}.grb2 not exist".format(path_grib,file_name))
        try:
            '''server = smtplib.SMTP(smtp_server,smtp_port)
            server.ehlo() # Can be omitted
            server.starttls(context=context) # Secure the connection
            server.ehlo() # Can be omitted
            server.login(sender_email, smtp_password)
            '''
            #port = 465  # For SSL
            #smtp_server = "smtp.gmail.com"
            #sender_email = "my@gmail.com"  # Enter your address
            #receiver_email = "your@gmail.com"  # Enter receiver address
            #password = input("Type your password and press enter: ")
            # TODO: Send email here
            message = """\
Subject: Risqueau ALERT 

{}.grb2 not exist on the GisHosting server. 
            
This message is automaticaly sent from Python.""".format(file_name)
            
            context = ssl.create_default_context()
            with smtplib.SMTP(smtp_server, smtp_port) as server:
                server.ehlo()  # Can be omitted
                server.starttls(context=context)
                server.ehlo()  # Can be omitted
                server.login(sender_email, smtp_password)
                server.sendmail(sender_email, receiver_email, message)
            
            
            # Create a secure SSL context
            '''context = ssl.create_default_context()
            with smtplib.SMTP_SSL(smtp_server, smtp_port, context=context) as server:
                server.login(sender_email, smtp_password)
                server.sendmail(sender_email, receiver_email, message)  '''    
        except Exception as ee:
            # Print any error messages to stdout
            logging.error(ee)
        exit()
    
    
    #exit()
    file= os.path.abspath(os.path.join(os.path.dirname( __file__ ), '..', 'data.php'))
    data_path=os.path.abspath(os.path.join(os.path.dirname( __file__ ), '..', 'data'))
     
    
    f = open(file, "w")
    f.write("<?php \n$data='{}'; \n$start_date='{}'; \n$end_date='{}'; \n?>".format(giorno, today, fine_giorno))
    f.close()
    exit;
    # prima di tutto converto il grib in GeoTiff
    geotiff='/usr/bin/gdalwarp -t_srs EPSG:4326 -of Gtiff -dstnodata -9999 {0}{1}.grb2 {0}{1}.tiff'.format(path_grib,file_name)

    logging.info(geotiff)
    #exit()

    try:
        ret = os.system(geotiff)
        logging.debug(ret)
    except Exception as e:
        logging.error(e)
        

    k=0
    while k<48:
        # wind speed - banda 12 + k * 292
        ws='/usr/bin/gdal_translate -b {0} -of AAigrid {4}{1}.tiff {5}/{2}_{3}.asc'.format((12+k*292),file_name,'ws',(k+1),path_grib,data_path)
        try:
            ret = os.system(ws)
            logging.debug(ret)
        except Exception as e:
            logging.error(e)
        #*********************************************************************************
        # # u-component of velocity at 1000 hPA 
        ws_u='/usr/bin/gdal_translate -b {0} -of AAigrid {4}{1}.tiff {5}/{2}_{3}.asc'.format((196+k*292),file_name,'ws_u',(k+1),path_grib,data_path)
        try:
            ret = os.system(ws_u)
            logging.debug(ret)
        except Exception as e:
            logging.error(e)
        #*********************************************************************************   
        # # u-component of velocity at 1000 hPA 
        ws_v='/usr/bin/gdal_translate -b {0} -of AAigrid {4}{1}.tiff {5}/{2}_{3}.asc'.format((197+k*292),file_name,'ws_v',(k+1),path_grib,data_path)
        try:
            ret = os.system(ws_v)
            logging.debug(ret)
            logging.info('Hour {} converted'.format(k+1))
        except Exception as e:
            logging.error(e)   
        # vado avanti con il contatore
        k+=1
        


    remove_geotiff= 'rm {0}{1}.tiff*'.format(path_grib,file_name)
    try:
        ret = os.system(remove_geotiff)
        logging.debug(ret)
    except Exception as e:
        logging.error(e)


    
if __name__ == "__main__":
    	main()

logging.info('*'*20 + ' ESCO NORMALMENTE' + '*'*20)     