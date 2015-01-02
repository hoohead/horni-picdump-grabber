<?php

echo get_content("www.hornoxe.com","/hornoxe-com-picdump-395/"); //Testen ob die Funktion greift


//Packen des Socketscriptes in eine Funktion, da wir darauf mehrmals zugreifen müssen
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
