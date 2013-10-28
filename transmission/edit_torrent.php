<?php


require_once 'torrent.php';

// 获取 torrent 文件信息

function checktorrent($filename)
{
	  $torrent = new Torrent( $filename );
	  echo 'check torrent: ' . $filename."\n"; 
	  
	  $file_media=$torrent->file_media();
	  $count= count($file_media);
	  for($i=0;$i+0<$count+0;$i++)
	  {
		  if($file_media[$i]+0<0)
		  {
			  echo $file_media[$i]."\n";
			  $file_media[$i]=0;
		  }
	  }
	  $torrent->file_media($file_media);
	  $torrent->save($filename);
	  echo 'check torrent: ' . $filename." over \n"; 

}
?>