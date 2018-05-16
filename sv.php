<?php
/////////////////////////////////////////////  função
function source($url, $proxy) {
    $curl = curl_init($url);
	$server = isset($_SERVER['HTTP_USER_AGENT']);
    curl_setopt($curl, CURLOPT_USERAGENT,$server);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    if($proxy) {
        $proxy = explode(':', autoprox());
        curl_setopt($curl, CURLOPT_PROXY, $proxy[0]);
        curl_setopt($curl, CURLOPT_PROXYPORT, $proxy[1]);
    }
    $content = curl_exec($curl);
    curl_close($curl);
    return $content;
}
////////////////////////////////////////////////////////
#
#
// inicio
echo "+-----------------------------+\n";
echo "|          svFinder           |\n";
echo "|        por Cooldsec         |\n";
echo "|       @akatsukgang666       |\n";
echo "+-----------------------------+\n";
echo "\nIP? ";
$ip = trim(fgets(STDIN));
$cript = urlencode($ip);
echo "Deseja inserir alguma dork? (S/N) ";
$inserirdork = trim(fgets(STDIN));

$vermelho="\033[0;31m";
$verde="\033[0;32m";
$amarelo="\033[1;33m";

//com dork
if($inserirdork == "S" || $inserirdork == "sim" || $inserirdork == "s" || $inserirdork == "si" || $inserirdork == "yes" || $inserirdork == "Y"){
	echo "$amarelo DICA: Use dorks simples e diretas para melhor desempenho!\n";
	echo "Insira a dork: ";
	$pegadork = trim(fgets(STDIN));

	$sites = array();
	$pagina = 1;
		while($pagina <= 10000){
			echo "$amarelo .";
			$pega = source("http://www.bing.com/search?q=ip:".$cript."%20".$pegadork."&first=".$pagina."", isset($proxy));
			if($pega) {
			$pagina = $pagina + 10;
	        preg_match_all('#<li class="b_algo"><h2><a href="(.*?)" h="ID#', $pega, $procuralink);
	        foreach ($procuralink[1] as $fl) array_push($sites, $fl);
	        if (preg_match("(first=".$pagina."&amp)siU", $pega, $linksuiv) == 0) break;
	    } else break;
	}
	$urls = array();
	foreach($sites as $url){
	    $exp = explode("/", $url);
	    $urls[] = $exp[2];
	}
	$array = array_filter($urls);
	$array = array_unique($array);
	$numerosites = count(array_unique($array));
	echo "\n$verde Encontrado $vermelho $numerosites $verde sites\n\n";
	foreach($array as $dominios) {
		fwrite(fopen("$ip.txt","a+"),"$dominios\r\n");
		echo "$verde http://$dominios/ \n";
	}
}

//sem dork
if($inserirdork == "N" || $inserirdork == "nao" || $inserirdork == "n" || $inserirdork == "no" || $inserirdork == "not" || $inserirdork == "nemfudendo"){
	$sites = array();
	$pagina = 1;
		while($pagina <= 10000){
			echo "$amarelo .";
			$pega = source("http://www.bing.com/search?q=ip:".$cript."&first=".$pagina."", isset($proxy));
			if($pega) {
			$pagina = $pagina + 10;
	        preg_match_all('#<li class="b_algo"><h2><a href="(.*?)" h="ID#', $pega, $procuralink);
	        foreach ($procuralink[1] as $fl) array_push($sites, $fl);
	        if (preg_match("(first=".$pagina."&amp)siU", $pega, $linksuiv) == 0) break;
	    } else break;
	}
	$urls = array();
	foreach($sites as $url){
	    $exp = explode("/", $url);
	    $urls[] = $exp[2];
	}
	$array = array_filter($urls);
	$array = array_unique($array);
	$numerosites = count(array_unique($array));
	echo "\n$verde Encontrado $vermelho $numerosites $verde sites\n\n";
	foreach($array as $dominios) {
		fwrite(fopen("$ip.txt","a+"),"$dominios\r\n");
		echo "$verde http://$dominios/ \n";
	}
}
?>
