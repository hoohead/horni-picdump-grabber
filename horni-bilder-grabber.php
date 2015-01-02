<?php
//Setzen globaler Variabeln und testen
$server = "www.hornoxe.com";
$picdumpurl = "/hornoxe-com-picdump-395/";

$quellcode = get_content($server,$picdumpurl);


preg_match_all('/(nggpage)(.*?)(\")/i',  $quellcode , $matches); 


$anz_seiten = count($matches);
if ($anz_seiten<1) {
	$anz_seiten == 1;
}

for ($y=1;$y<=$anz_seiten;$y++) {
$quellcode = get_content($server,$picdumpurl."?nggpage=".$y);
$quellcode = str_replace("\n"," ",$quellcode); 
$quellcode = trim($quellcode);
preg_match_all('/(ngg-gallery-thumbnail\")(.*?)(title)/i',  $quellcode , $matches2);
$anz_bilder = count($matches2[2]);
	
	for ($i=0;$i<$anz_bilder;$i++) { 
		preg_match('/(href=\")(.*?)(\")/i',  $matches2[2][$i], $matches3);
		$bildurl = $matches3[2];   
		$bildname = basename($matches3[2]);
		$bild = file_get_contents($bildurl); 
		file_put_contents($bildname,$bild); 
		 
	}
}

function get_content($host,$pfad) {

$sock = fsockopen($host, 80); 
fputs($sock, "GET ".$pfad." HTTP/1.1\r\n");
fputs($sock, "Host: ".$host."\r\n");
fputs($sock, "User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:34.0) Gecko/20100101 Firefox/34.0\r\n");
fputs($sock, "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8\r\n");
fputs($sock, "Accept-Language: de,de-DE;q=0.5\r\n");
fputs($sock, "Connection: close\r\n\r\n");

while(!feof($sock)) 
$bla .= fgets($sock, 4096); 
fclose($sock);

return $bla;

}
?>
