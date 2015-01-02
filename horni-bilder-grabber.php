<?php

//echo get_content("www.hornoxe.com","/hornoxe-com-picdump-395/"); //Testen ob die Funktion greift

//Zuerst muss die Anzahl der Seiten ermittelt werden nggpage ist Bestandteil des Links und kommt so im Quellcode nicht nochmal vor
//Sollte dies doch mehrmals vorkommen, würde man auf den ganzen Link matchen.

//Quellcode laden:

$quellcode = get_content("www.hornoxe.com","/hornoxe-com-picdump-395/");
//Regex auf wie oft kommt nggpage irgendwas " (Anführungszeichen) vor

preg_match_all('/(nggpage)(.*?)(\")/i',  $quellcode , $matches); //Anführungszeichen in Regex muss mit \ maskiert werden

//Anzahl setzen + Sicherheitsfunktion bei Einseitigen Picdumps
$anz_seiten = count($matches);
if ($anz_seiten<1) {
	$anz_seiten == 1;
}

//Testen einer validen Schleife
for ($i=1;$i<=$anz_seiten;$i++) {
	echo $i."\n"; // \n = Newline
}


// Es steht fest, dass es in dem Beispiel 4 Seiten sind, die werden auch durch den count so ermittelt
// Manuell wurde überprüft, ob hinter ?nggpage=1 auch die 1. Seite aufgerufen wird.
// Da dies so ist, kann man sich die 4 Seiten, bzw. die ermittelte Anzahl von Seiten laden, ohne einen Fehler zu provozieren

//Weiter geht es


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
