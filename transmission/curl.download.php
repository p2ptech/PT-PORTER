<?php 
/*
=================================================
$fn = CurlTool::downloadFile('http://aaabb.com/download.php?id=zzzaaa','./');
echo "Grab file path =",$fn,"\n";
var_dump(CurlTool::$attach_info);
*/
class CurlTool {
    public static $userAgents = array(
        'FireFox20' => 'Mozilla/5.0 (Windows NT 6.1;WOW64; rv:20.0) Gecko/20100101 Firefox/20.0',
        'GoogleBot' => 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)',
        'IE7' => 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)',
        'Netscape' => 'Mozilla/4.8 [en] (Windows NT 6.0; U)',
        'Opera' => 'Opera/9.25 (Windows NT 6.0; U; en)'
        );
    public static $options = array(
        CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:20.0) Gecko/20100101  Firefox/20.0',
        CURLOPT_AUTOREFERER => true,
        CURLOPT_COOKIEFILE => '',
        CURLOPT_FOLLOWLOCATION => true
        );
    public static $header = array();
    public static $attach_info = array();

    private static $proxyServers = array();
    private static $proxyCount = 0;
    private static $currentProxyIndex = 0;

    public static function addProxyServer($url) {
        self::$proxyServers[] = $url;
        ++self::$proxyCount;
    }

    public static function fetchContent($url, $verbose = false,$url_reffer=false) {
        if (($curl = curl_init($url)) == false) {
            throw new Exception("curl_init error for url $url.");
        }

        if (self::$proxyCount > 0) {
            $proxy = self::$proxyServers[self::$currentProxyIndex++ % self::$proxyCount];
            curl_setopt($curl, CURLOPT_PROXY, $proxy);
            if ($verbose === true) {
                echo "Reading $url [Proxy: $proxy] ... ";
            }
        } else if ($verbose === true) {
            echo "Reading $url ... ";
        }
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt_array($curl, self::$options);
        if (is_string($url_reffer)) {
            curl_setopt($curl,CURLOPT_REFERER,$url_reffer);
        }
        $content = curl_exec($curl);
        if ($content === false) {
            throw new Exception("curl_exec error for url $url.");
        }
       	self::$header = curl_getinfo($curl);
        curl_close($curl);
        if ($verbose === true) {
            echo "Done.\n";
        }
        return $content;
    }

    public static function downloadFile($url, $fileName, $verbose = false) {
          
            echo "</br></br>";
          
      if (($curl = curl_init($url)) == false) {
            throw new Exception("curl_init error for url $url.");
           
        }
   
           
       if (self::$proxyCount > 0) {
            $proxy = self::$proxyServers[self::$currentProxyIndex++ % self::$proxyCount];
            curl_setopt($curl, CURLOPT_PROXY, $proxy);
            if ($verbose === true) {
                echo "Downloading $url [Proxy: $proxy] ... ";
            }
        } else if ($verbose === true) {
            echo "Downloading $url ... ";
        }
    
        
        curl_setopt_array($curl, self::$options);
        curl_setopt($curl, CURLOPT_URL, $url);
        if (substr($fileName, -1) == '/') {
            $targetDir = $fileName;
            $fileName = tempnam(sys_get_temp_dir(), 'c_');
        }
        
        if (($fp = fopen($fileName, "wb")) === false) {
            throw new Exception("fopen error for filename $fileName");
           
        }
      
        curl_setopt($curl, CURLOPT_FILE, $fp);
		curl_setopt($curl,CURLOPT_HEADERFUNCTION,'self::get_att');
        curl_setopt($curl, CURLOPT_BINARYTRANSFER, true);
        if (curl_exec($curl) === false) {
            fclose($fp);
            unlink($fileName);
            throw new Exception("curl_exec error for url $url.");
        } elseif (isset($targetDir)) {
            $eurl = curl_getinfo($curl, CURLINFO_EFFECTIVE_URL);
            preg_match('#^.*/(.+)$#', $eurl, $match);
            fclose($fp);
            rename($fileName, "$targetDir{$match[1]}");
            $fileName = "$targetDir{$match[1]}";
        } else {
            fclose($fp);
        }
		self::$header = curl_getinfo($curl);
        curl_close($curl);
        if ($verbose === true) {
            echo "Done.\n";
        }

	$basename=basename($fileName);
	$dirpath=dirname($fileName);	
	$newbasename=self::$attach_info['filename'];
	$newFileName=$dirpath."/".$newbasename;	
	echo "rename torrent file"."\n";
	echo "old file:".$fileName.">> new file:".$newFileName."\n";
	if(rename($fileName,$newFileName)===false)
	{
		 throw new Exception("rename error for file $fileName");
	}

        return $newFileName;
    }

	public static function get_att($ch, $header){
		if (preg_match("/Content-Length: (\d*)/i",$header,$matches)) {
			self::$attach_info['size'] = $matches[1];
		} elseif (preg_match('/Content-Disposition:.*?filename="(.*)"/i',$header,$matches)) {
			self::$attach_info['filename'] = $matches[1];
		} elseif (preg_match("/Content-Type: ([^; ]*)/i",$header,$matches)) {
			self::$attach_info['type'] = $matches[1];
		}
		//echo "$header";
		return strlen($header);
	}
    // activates POST and set post data
    public static function addPostData($data) {
        self::$options[CURLOPT_POST] = true;
        self::$options[CURLOPT_POSTFIELDS] = $data;
    }
}

?>
