<?php
header('Content-Type: text/html; charset=utf-8');

try{
	$pdo = new PDO("mysql:host=localhost;dbname=magtorre_db;charset=utf8", "magtorre_user", "MAGTs&!!9ms");
}catch(PDOException $e){
	echo "Erro";
}

$agents = array(
    'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.7; rv:7.0.1) Gecko/20100101 Firefox/7.0.1',
    'Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.9.1.9) Gecko/20100508 SeaMonkey/2.0.4',
    'Mozilla/5.0 (Windows; U; MSIE 7.0; Windows NT 6.0; en-US)',
    'Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_7; da-dk) AppleWebKit/533.21.1 (KHTML, like Gecko) Version/5.0.5 Safari/533.21.1'
);
 if(isset($_GET['link'])){
	$curl = curl_init($_GET['link']);
	 
	curl_setopt($curl, CURLOPT_FAILONERROR, true);
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);  
	curl_setopt($curl,CURLOPT_USERAGENT,$agents[array_rand($agents)]);
	 
	$page = curl_exec($curl);
	 
	$pattern = array(
	"imagem"=>"/<img class=\"alignleft\" title=\".*?\" src=\"(.*?)\" alt=\".*?\" width=\"260\" height=\"320\" border=\"0\" \/>/",
	//"titulo"=>"/<strong>Baixar Filme:<\/strong>(.*?)<br \/>/",
	"link" => "/<a href=\"magnet:(.*?)\" target=\"_blank\">/",
	"titulo"=>"/<strong>Baixar Filme:<\/strong>(.*?)<br \/>/",
	"formato"=>"/<strong>Formato:<\/strong>(.*?)<br \/>/",
	"qualidade"=>"/<strong>Qualidade:<\/strong>(.*?)<br \/>/",
	"idioma"=>"/<strong>Idioma:<\/strong>(.*?)<br \/>/",
	"genero"=>"/<strong>Gênero:<\/strong>(.*?)<br \/>/",
	"diretor"=>"/<strong>Diretor:<\/strong>(.*?)<br \/>/",
	"legenda"=>"/<strong>Legenda:<\/strong>(.*?)<br \/>/",
	"tamanho"=>"/<strong>Tamanho:<\/strong>(.*?)<br \/>/",
	"lancamento"=>"/<strong>Lançamento no Brasil:<\/strong>(.*?)<br \/>/",
	"duracao"=>"/<strong>Duração:<\/strong>(.*?)<br \/>/",
	"imdb"=>"/<strong>Nota IMDB:<\/strong>(.*?)<br \/>/",
	"sinopse"=>"/<strong>Sinopse:<\/strong>(.*?)<\/p>/",
	"spancategory"=>"/<strong>Gênero:<\/strong>(.*?)<br \/>/"
	);
	 
	preg_match_all($pattern['imagem'],$page,$imagem);
	$imagem = $imagem[1][0];
	 
	preg_match_all($pattern['titulo'],$page,$titulo);
	$titulo = $titulo[1][0];



	preg_match_all($pattern['formato'],$page,$formato);
	$formato = $formato[1][0];

	preg_match_all($pattern['qualidade'],$page,$qualidade);
	$qualidade = $qualidade[1][0];

	preg_match_all($pattern['idioma'],$page,$idioma);
	$idioma = $idioma[1][0];

	preg_match_all($pattern['genero'],$page,$genero);
	$genero = $genero[1][0];

	preg_match_all($pattern['diretor'],$page,$diretor);
	$diretor = $diretor[1][0];

	preg_match_all($pattern['legenda'],$page,$legenda);
	$legenda = $legenda[1][0];

	preg_match_all($pattern['tamanho'],$page,$tamanho);
	$tamanho = $tamanho[1][0];

	preg_match_all($pattern['lancamento'],$page,$lancamento);
	$lancamento = $lancamento[1][0];

	preg_match_all($pattern['duracao'],$page,$duracao);
	$duracao = $duracao[1][0];

	preg_match_all($pattern['imdb'],$page,$imdb);
	$imdb = $imdb[1][0];

	preg_match_all($pattern['sinopse'],$page,$sinopse);
	$sinopse = $sinopse[1][0];

	preg_match_all($pattern['spancategory'],$page,$spancategory);
	$spancategory = $spancategory[1][0];

	$category = array("categoria"=>"/<a href=\".*?\" rel=\".*?\">(.*?)<\/a>/");
	preg_match_all($category['categoria'],$spancategory,$categoryResult);
	$categories = $categoryResult[1];

	echo '<img src="'.$imagem.'"><br/>';
	echo 'Titulo:'.$titulo.'<br/>';
	echo 'Formato:'.$formato.'<br/>';
	echo 'Qualidade:'.$qualidade.'<br/>';
	echo 'Idioma:'.$idioma.'<br/>';
	echo 'Legenda:'.$legenda.'<br/>';
	echo 'Tamanho:'.$tamanho.'<br/>';
	echo 'Lançamento:'.$lancamento.'<br/>';
	echo 'Dração:'.$duracao.'<br/>';
	echo 'iMDB:'.$imdb.'<br/>';
	echo 'Sinopse:'.$sinopse.'<br/>';

	function sanitizeString($str) {
	    $str = preg_replace('/[áàãâä]/ui', 'a', $str);
	    $str = preg_replace('/[éèêë]/ui', 'e', $str);
	    $str = preg_replace('/[íìîï]/ui', 'i', $str);
	    $str = preg_replace('/[óòõôö]/ui', 'o', $str);
	    $str = preg_replace('/[úùûü]/ui', 'u', $str);
	    $str = preg_replace('/[ç]/ui', 'c', $str);
	    // $str = preg_replace('/[,(),;:|!"#$%&/=?~^><ªº-]/', '_', $str);
	    $str = preg_replace('/[^a-z0-9]/i', '-', $str);
	    $str = preg_replace('/_+/', '-', $str); // ideia do Bacco :)
	    return strtolower($str);
	  }

	$link = sanitizeString($titulo);

	$sql = $pdo->prepare("INSERT INTO mt_posts (title, link, sinopse, poster, category, duration, year, director, size, imdb, quality, quality_video, quality_audio, type) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
	$sql->execute(array($titulo, $link, strip_tags($sinopse), $imagem, $genero, $duracao, $lancamento, $diretor, $tamanho, $imdb, $qualidade, 9, 9, 0));


	$sql = $pdo->prepare("SELECT id_post, link FROM mt_posts WHERE link = :link LIMIT 1");
	$sql->bindValue("link", $link);
	$sql->execute();
	$ftc = $sql->fetchObject();
	$id = $ftc->id_post;

	echo $id."<hr />";
	preg_match_all($pattern['link'],$page,$link);
	$link = $link;
	for($i = 0; $i < count($link[1]); $i++){
			$sql = $pdo->prepare("INSERT INTO mt_links (link, post, type_link) VALUES (?, ?, ?)");
			$l = "magnet:".$link[1][$i];
			$sql->execute(array($l, $id, "2"));
		 
	}
}