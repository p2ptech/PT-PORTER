<?php 
include_once("curl.download.php");
include_once("dbconfig.php");
include_once("torrent.php");
include_once("edit_torrent.php");
/***********************RSS torrent path*************************/
$rss_torrent_path='/data/transmission/PTtorrents';
$watch_path='/data/transmission/transmission_watch/';

//set size to filter giant pack 1024*1024*1024*5=5Gbytes;
$size_filter=7768709120;

dbconn();
$res=get_torrent_downloaded();
echo "1111111</br>";

if(mysql_affected_rows())
{
	while($item=mysql_fetch_array($res))
	{       
               // $fnam=iconv("gb2312//IGNORE","UTF-8",$item['filename']);
                
                $targetpath=$rss_torrent_path."/test.torrent";
               
                echo "".$targetpath."</br>";
		$id=$item['id'];
		$dl_url=$item['dl_url'];
		echo "connecting to ".$dl_url."\n";

		if($item['length']>($size_filter+0))
		{
		echo "torrent: ".$item['name']."size too big,skip download \n";
		continue;
		}
		$fn=curlTool::downloadFile($dl_url,$targetpath);
echo "goggo";
		checktorrent($fn);

		$torrent = new Torrent($fn);
		$hash=$torrent->hash_info();
		echo "torrent: ".$fn." hash_info:  ".$hash."\n";
		echo "updating torrent:".$fn.",id :".$id."\n";
		$basename=basename($fn);
		$dest_file=$watch_path.$basename;
		if(!copy($fn,$dest_file))
		{
			echo "copy torrent: ".$fn."to dest: ".$watch_path." fails \n";
		}
		update_torrent_downloaded($id,$fn,$hash);
	}
}

mysql_free_result($res);



?>
