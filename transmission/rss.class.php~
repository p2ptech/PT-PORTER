
<?php 
class  ReadRSS
{
 //Define var as ReadRSS Class property
    var $url;
    var $content;
    var $values;

    //Define construct function
    function ReadRSS($url)
 {
        $this->url=$url;
    }

 //This is the Function to get file content.(read file)
    function ReadFile()
 {   
        $fp = fopen($this->url,"r");
        echo $this->url."</br>";
        echo $fp."</br>";
		if(!$fp)
		{
			printf("fail to open ".$this->url."\n");
			return 0;
			}
        while ( !feof($fp) )
  {
            $this->content .= fgets($fp,4096);
        }
        fclose($fp);
    }

 //Read Xml File
    function ReadXML(){
        $parser = xml_parser_create();//..xml...
        xml_parser_set_option($parser,XML_OPTION_SKIP_WHITE,1);//...........
        xml_parser_set_option($parser,XML_OPTION_TARGET_ENCODING,'UTF-8');
//..........ISO-8859-1.US-ASCII . UTF-8...............
        xml_parse_into_struct($parser,$this->content,$this->values);
        xml_parser_free($parser);
    }


    function RSS($n=100){
        $this->ReadFile();
        $this->ReadXML();
        $in_item = 0;
        $i=0;
        $read=array();
		//print_r($this->values);
        foreach ($this->values as $value_item) 
		{
            $tag = $value_item["tag"];
            $type = $value_item["type"];
			if(isset($value_item["attributes"]))
			{
				$value = $value_item["attributes"];
			}
			if(isset($value_item["value"]))
			{
				$value = $value_item["value"];
			}
            $tag = strtolower($tag);
            if ($tag == "item" && $type == "open") {
                $in_item = 1;
            } else if ($tag == "item" && $type == "close"){
                $read[$i]['link']=$link;
                $read[$i]['doubanid']=$doubanid;
                $read[$i]['title']=$title;
                $read[$i]['enclosure_url']=$enclosure_url;
                $read[$i]['enclosure_length']=$enclosure_length;
                if (isset($pubDate)) 
				{
                    $read[$i]['pubDate']=$pubDate;
                }else
				{
					$read[$i]['pubDate']=' ';
				}
                $read[$i]['description']=$description;
                $in_item = 0;
                   $i++;
                if ($i>=$n) {
                    break;
                }
            }
            if ($in_item) {
                switch ($tag) {
                    case "title":
                        $title = $value;
                        break;
                    case "doubanid":
                        $doubanid =$value;
                        break;
                    case "link":
                        $link = $value;
                        break;
                    case "enclosure":
                        $enclosure_url = $value['URL'];
						$enclosure_length =  $value['LENGTH']+0;
						break;
                    case "pubDate":
                        $pubDate = $value;
                        break;
                    case "description":
                        $description = $value;
                        break;
                }
            }
        }
        return $read;
    }
}
?>
