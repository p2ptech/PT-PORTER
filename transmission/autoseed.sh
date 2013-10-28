#!/bin/sh
LOGFILE=/var/log/autoseed_down.log
{
NOW=$(date +%Y-%m-%d\ %H:%M:%S)

echo "************************************begin updating  RSS ******************************************************** \n"    >>${LOGFILE}  2>&1
echo  "start timestamp ${NOW}  \n" >>${LOGFILE}  2>&1 
/usr/bin/php  /var/www/html/transmission/rssdb.php  >>${LOGFILE}  2>&1 
echo  "end timestamp ${NOW} \n"  >>${LOGFILE}  2>&1
echo "************************************end updating  RSS ******************************************************** \n"   >>${LOGFILE}  2>&1 


echo "************************************begin downloading torrents ******************************************************** \n" >>${LOGFILE}  2>&1 
echo  "start timestamp ${NOW}  \n" >>${LOGFILE}  2>&1 
/usr/bin/php  /var/www/html/transmission/downloadtorrents_db.php >>${LOGFILE} 2>&1; 
echo "************************************end   downloading torrents ******************************************************** \n" >>${LOGFILE}  2>&1 
echo  "end timestamp ${NOW} \n"  >>${LOGFILE}  2>&1

#mutt -s "autoseed summary"  -a ${LOGFILE} -- nanjifengwww@qq.com ;

} &
