#! /bin/sh
{
FILE=test.log
NOW=$(date +%Y-%m-%d\ %H:%M:%S)
echo "**********************************************" >>${FILE}
echo ${NOW}.>>${FILE}
tid=$TR_TORRENT_HASH
echo $tid >>${FILE}

}
