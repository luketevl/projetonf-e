<?php

class File{
	static function createFile($nome="semnome",$ext=".txt", $conteudo="",$caminho="../resources/nfe/txt/"){
		$file = fopen($caminho.$nome.$ext,"w");
		echo ($file)?"Sucesso, criado em ".$caminho ."<br />": die('Não foi possível criar o arquivo.'); 		
		$write = fwrite($file,$conteudo);
		fclose($file);
	}
}