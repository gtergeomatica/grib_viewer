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
logging.basicConfig(
    format='%(asctime)s\t%(levelname)s\t%(message)s',
    filename='log/grib2ascii.log',
    filemode='w',
    level=logging.DEBUG)


# assegno l'input dello script e.g wd (wind direction)
script, input1 = argv

try:
    path_grib=input1
except: 
    logging.error('Please, define the path to grib file. If the file is contained in this directory use ./')


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
    
    
    #exit()

    f = open("../data.php", "w")
    f.write("<?php \n$data='{}'; \n$start_date='{}'; \n$end_date='{}'; \n?>".format(giorno, today, fine_giorno))
    f.close()
    exit;
    # prima di tutto converto il grib in GeoTiff
    geotiff='gdalwarp -t_srs EPSG:4326 -of Gtiff -dstnodata -9999 {0}.grb2 {0}.tiff'.format(file_name)

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
        ws='gdal_translate -b {0} -of AAigrid {1}.tiff ../data/{2}_{3}.asc'.format((12+k*292),file_name,'ws',(k+1))
        try:
            ret = os.system(ws)
            logging.debug(ret)
        except Exception as e:
            logging.error(e)
        #*********************************************************************************
        # # u-component of velocity at 1000 hPA 
        ws_u='gdal_translate -b {0} -of AAigrid {1}.tiff ../data/{2}_{3}.asc'.format((196+k*292),file_name,'ws_u',(k+1))
        try:
            ret = os.system(ws_u)
            logging.debug(ret)
        except Exception as e:
            logging.error(e)
        #*********************************************************************************   
        # # u-component of velocity at 1000 hPA 
        ws_v='gdal_translate -b {0} -of AAigrid {1}.tiff ../data/{2}_{3}.asc'.format((197+k*292),file_name,'ws_v',(k+1))
        try:
            ret = os.system(ws_v)
            logging.debug(ret)
        except Exception as e:
            logging.error(e)   
        # vado avanti con il contatore
        k+=1
        logging.info('Hour {} converted'.format(k))


    remove_geotiff= 'rm {}.tiff*'.format(file_name)
    try:
        ret = os.system(remove_geotiff)
        logging.debug(ret)
    except Exception as e:
        logging.error(e)


    
if __name__ == "__main__":
    	main()

logging.info('*'*20 + ' ESCO NORMALMENTE' + '*'*20)     