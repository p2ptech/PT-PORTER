<html>
<body>
<?php
include_once('rss.class.php');
include_once('curl.download.php');
include_once('uploadFile.php');
//include_once('download.class.php');
include_once('html2ubb.php');
include_once('html2bbc.php');
$tail="&passkey=292f839cc1c4dcd3da580eb23963e105";
$url="http://bt.6xvod.com/torrentrss.php?rows=10";
$url_detail='http://bt.6xvod.com/torrentrss.php?rows=10&linktype=dl&passkey=292f839cc1c4dcd3da580eb23963e105';
$rss=new ReadRSS($url);
$values=$rss->RSS(10);
//print_r($values);
foreach ($values as $value) {
    
	echo "</br>*********************************************************************\n</br>";
	echo "*********************************************************************\n</br>";
	echo $value['title']."  ";
	echo  "url->".$value['enclosure_url']."|"."size->".$value['enclosure_length']."\n";
	
	/****************begin download torrent *********************/
	//$fn=curlTool::downloadFile($value['enclosure_url'],'/root/autoseed/release/torrents/');
	//uploadTorrent($fn);
	echo html2ubb($value['description'])."\n";
	echo html2bbc($value['description'])."\n";
//	downloadFile($value['link'].$tail,"test");
}
?>
</body>
</html>
