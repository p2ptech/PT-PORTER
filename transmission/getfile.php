 <?php 
 
 function gettorrent($url, $fileName, $verbose = false) {
	 
	 	$options = array(
        CURLOPT_USERAGENT => 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)',
        CURLOPT_AUTOREFERER => true,
        CURLOPT_COOKIEFILE => '',
        CURLOPT_FOLLOWLOCATION => true
        );
		
        if (($curl = curl_init($url)) == false) {
            throw new Exception("curl_init error for url $url.");
        }

       	if ($verbose === true) {
            echo "Downloading $url ... ";
        }

        curl_setopt_array($curl,$options);

        if (substr($fileName, -1) == '/') {
            $targetDir = $fileName;
            $fileName = tempnam(sys_get_temp_dir(), 'c_');
        }
        if (($fp = fopen($fileName, "wb")) === false) {
            throw new Exception("fopen error for filename $fileName");
        }
        
		//CURLOPT_FILE;设置输出文件的位置，值是一个资源类型，默认为STDOUT (浏览器)。
		curl_setopt($curl, CURLOPT_FILE, $fp);
		//CURLOPT_BINARYTRANSFER;在启用CURLOPT_RETURNTRANSFER的时候，返回原生的（Raw）输出。
        curl_setopt($curl, CURLOPT_BINARYTRANSFER, true);
        if (curl_exec($curl) === false) {
            fclose($fp);
            unlink($fileName);
            throw new Exception("curl_exec error for url $url.");
        } else {
            fclose($fp);
        }
		
        curl_close($curl);
        if ($verbose === true) {
            echo "Done.\n";
        }
        return $fileName;
    }
	
	

?>
