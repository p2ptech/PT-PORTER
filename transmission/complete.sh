#!/bin/bash
{
#get date timestamp
NOW=$(date +%Y-%m-%d\ %H:%M:%S)

LOGFILE=/var/log/autoseed_upload.log
FILE=test.log
echo  "**********************************************************" >>${LOGFILE}  2>&1 

echo  "${NOW}" >>${LOGFILE}  2>&1 
echo "**************************from complete******************" >>${FILE};
echo ${NOW} >> ${FILE};

echo  "1" >>${LOGFILE}  2>&1 

echo *************************upload begin**************************;  >>${LOGFILE} 2>&1

echo  "2" >>${LOGFILE}  2>&1 

torrent_hash=$TR_TORRENT_HASH;
#torrent_hash=aaaa;
echo  "The hash is $torrent_hash now" >>${LOGFILE}  2>&1 

echo $torrent_hash >>${FILE}

/usr/bin/php   /var/www/html/transmission/uploaddb.php   $torrent_hash  >> ${LOGFILE} 2>&1 

echo *************************upload end**************************;  >>${LOGFILE} 2>&1



} &
