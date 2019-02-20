<?php
	
	// verifica um registro existe e retorna o proprio registrou vazio 
	// Ex: verifRegistro("meu registro"); - retorno: "meu registro"

 	function _verifReg($registro=false)
	{
		return (isset($registro) && $registro!='') ? $registro : '';
	}

	// Altera um ou mais caracteres de uma string 
	// Ex: _subStr("teste_A", array('A' => 'B') - retorno: "teste_B"

	function _subStr($str, $filtroArray)
	{
		$result = strTr($str, $filtroArray);
		return $result;
	}

	function _arrayToObject($array) {
	    return (object) $array;
	}

	function _objectToarray($object) {
	    return (array) $object;
	}

	// strToBoolean($valueCheckBox,'on')
	// Retorna : true ou false se a string se igualar
	function _strToBoolean($str,$value)
	{
		return ($value===$str) ? True : false;
	}

	function _strToBool($str,$value)
	{
		return ($value===$str) ? 1 : 0;
	}

	function _boolResult($bool,$true,$false)
	{
		return ($bool===true) ? $true : $false ;
	}

	function _boolToStr($value=false, $return=array())
	{
		return (isset($value) && !is_null($value) && $value!='' ) ? $return[0] : $return[1] ;
	}

	function _dataOrEmpty($value=false)
	{
		return (isset($value) && !is_null($value) && $value!='' ) ? $value : '' ;
	}

	function _numberFormatValue($num=000,$casas=3,$tipo='real', $prefix='')
	{
		$num = (float)$num;	
		switch ($tipo) {
			case 'dolar': //formato americano
				$value = number_format($num, $casas, '.', ',');
				break;
			case 'real':
				$value = number_format($num, $casas, ',', '.');
				break;
		}
		return $prefix.' '.$value;
	}

	function _redirect($config=false)
	{
		if (!(isset($config))) {
			$config = array('url' => '/login', 'time' => '0' );
		}
		return '<script type="text/javascript">setTimeout(setTime, '.$config['time'].'); function setTime(){window.location = "'.$config['url'].'";}</script>';
	}

	function _redirect2($config=false)
	{
		if (!(isset($config))) {
			$config = array('url' => '/login', 'time' => '0' );
		}
		return '<script type="text/javascript">setTimeout(setTime, '.$config['time'].'); function setTime(){window.location = "'.$config['url'].'";}</script>';
	}

	function _selfUrl($str='')
	{
		if ($str!='') {
			return (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]".$str;
		}else{
			return (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]"."$_SERVER[REQUEST_URI]";
		}
	}

	function _baseUrl($str='')
	{
		return (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]".$str;
	}

	function _defineDateTime($date, $format='d/m/Y H:i:s')
	{
		if ($date!=='') {
			$date = new DateTime($date);
	        $return = $date->format($format);
		}else{
			$date = new DateTime();
	        $return = $date->format($format);
		}
			return $return;
	}
	
	function _testVar($var='', $type='')
	{
		if (isset($var)) {
			switch ($type) {
				case 'int':
					return ($var > 0) ? TRUE : FALSE;
					break;
				case 'str':
					return ($var != "") ? TRUE : FALSE;
					break;
				case 'strInt':
					return ($var!= "" && $var > 0) ? TRUE : FALSE;
					break;
				default:
					echo 'valor indefinido';
					// exit();
					break;
			}
		}
	}

	function _dataHoraAtual($format='')
	{
		$dt = new DateTime();
		if (isset($format)) {
    		return $dt->format($format);
		}else{
			return $dt->format('Y-m-d H:i:s');
		}
	}

	function _varDumpPre($data, $die=false)
	{
		echo "<pre>";
		print_r($data);
		echo "</pre>";
		if ( $die === true ){
			exit(0);
		}
	}

	function _varDumpQuery($method=false, $result=false, $die=false)
	{
		if (is_array($result)) {
			varDumpPre($data, $die);
		}else{
			echo $result;
			if ( $die === true ){
				exit(0);
			}
		}

	}

	function _debugConsole($debug=false)
	{
		// $debug[] = 'Hello World';
		// // and/or
		// $debug[] = array('a1'=>"ArrValue1",'a2'=>"ArrValue2");
		if(isset($debug)):
		echo '<script type="text/javascript">jQuery(document).ready(function(){ ';
		foreach($debug as $js): 
			if(is_array($js)) 
				$js= json_encode($js); 
			else 
				$js = '"'.$js.'"';
		    echo 'console.log('.$js.');';
		endforeach;
		echo '});</script>';
		endif;
		// add before </body>...
	}	


	function _lastQuery($db, $formated=true)
	{
		$result = $db->result_id->queryString;
		if ($formated) {
			echo '<pre>';
			var_dump($result);
			echo '</pre>';
		}else{
			return $result;
		}
		
	}

	function _base_subdominio($sub=false)
	{
		$protocolo = (isset($_SERVER['HTTPS']) ? "https" : "http");
		return $protocolo.'://'.$sub.'.'.BASE_DOMINIO.TERMINACAO;	
	}

	function _voltar_url($obj)
	{
		$r='';
		$total = $obj->total_segments();
		for ($i=1; $i < $total; $i++) { 
		  $r .= ($i>1) ? '/' : '' ;
		  $r .= $obj->segment($i);
		}
		return base_url().$r;	
	}

	function _dataHora($format=false, $data=false)
	{
		$str_array = array("/" => "-");
		$data = strtr($data, $str_array);
		$fuso = new DateTimeZone('America/Sao_Paulo');
		if ($data!=false) {
			$dt  = new DateTime($data);
		}else{
			$dt = new DateTime();
		}
		// $dt->setTimezone($fuso);
		return ($format) ? $dt->format($format) : $dt->format('Y-m-d h:i:s') ;
	}

	function _dataHora2($data=false)
	{
		$arr_semanas = array(
			'Sunday' => 'dom', 
			'Monday' => 'seg',
			'Tuesday' => 'ter',
			'Wednesday' => 'qua',
			'Thursday' => 'qui',
			'Friday' => 'sex',
			'Saturday' => 'sab'  
		);

		$fuso = new DateTimeZone('America/Sao_Paulo');
		$dt1  = new DateTime();
		$dt1  = $dt1->setTimezone($fuso);
		$dt1  = $dt1->format('Y-m-d h:i:s');
		$dt = new DateTime($dt1);
		$dt = $dt->setTimezone($fuso);

		$list = array(
			'dia_2dig'=>'d',
			'dia_1dig'=>'j',
			'semana_abrev'=>'D',
			'semana_ext'=>'l',
			'sufixo_dia'=>'S',
			'dia_do_ano'=>'z',
			'mes_abrev'=>'F',
			'mes_ext'=>'M',
			'mes_2dig'=>'m',
			'mes_1dig'=>'n',
			'ano_4dig'=>'Y',
			'ano_2dig'=>'y',
			'turno'=>'a',
			'turno2'=>'A',
			'hora_12h_2dig'=>'h',
			'hora_12h_1dig'=>'g',
			'hora_24h_2dig'=>'H',
			'hora_24h_1dig'=>'G',
			'minutos'=>'i',
			'segundos'=>'s',
			'microssegundos '=>'u',
			'fuso_local'=>'e',
			'fuso_local_abrec'=>'T',			
			'fuso_dif_utc'=>'O',
			'fuso_dif_utc_2'=>'P',			
		);

		foreach ($list as $k => $v) {
			$r[$k] = $dt->format($v);
		}
		return $r;
	}


	function _upload_imagens($files=false, $path=false, $nome_file=false, $extensions=false){
		$numeroCampos = count($files[$nome_file]['name']);
		if ($numeroCampos>1) {
			if ((count($files)>0 && $files!=false) && $path!=false) {
				for ($i = 0; $i < $numeroCampos; $i++) {
					if (!empty($files[$nome_file]['name'][$i])) {
						if(isset($nome_file) && $files[$nome_file]['error'][$i] == 0){
							$dados['name']       = ($nome_file!=false) ? $files[$nome_file]['name'][$i]      : false;
							$dados['size']       = ($nome_file!=false) ? $files[$nome_file]['size'][$i]      : false;
							$dados['type']       = ($nome_file!=false) ? $files[$nome_file]['type'][$i]      : false;
							$dados['tmp_name']   = ($nome_file!=false) ? $files[$nome_file]['tmp_name'][$i]  : false;
							$dados['path']       = ($path!=false) ? $path : false;
							$dados['extensions'] = ($extensions!=false) ? $extensions : false;
							return _fazer_upload($dados);
						}
					}
				}
			}
		}else{
			if ((count($files)>0 && $files!=false) && $path!=false) {
				$dados['name']     = ($nome_file!=false) ? $files[$nome_file]['name']     : false;
				$dados['size']     = ($nome_file!=false) ? $files[$nome_file]['size']     : false;
				$dados['type']     = ($nome_file!=false) ? $files[$nome_file]['type']     : false;
				$dados['tmp_name'] = ($nome_file!=false) ? $files[$nome_file]['tmp_name'] : false;
				$dados['path']     = ($path!=false) ? $path : false;
				$dados['extensions'] = ($extensions!=false) ? $extensions : false;
				return _fazer_upload($dados);
			}
		}
	}

	function _fazer_upload($dados=false){
		$path        = ($dados['path']!=false) ? $dados['path']         : '';
		$nomeFile    = ($dados['name']!=false) ? $dados['name']         : '';
		$sizeFile    = ($dados['size']!=false) ? $dados['size']         : '';
		$typeFile    = ($dados['type']!=false) ? $dados['type']         : '';
		$tmpNameFile = ($dados['tmp_name']!=false) ? $dados['tmp_name'] : '';
		$arrExtensao = ($dados['extensions']!=false) ? $dados['extensions']   : array('.jpg','.jpeg','.gif','.png','.webm','.mp4');

		// Pega a extensao
		$extensao = strrchr($nomeFile, '.');
		// Cria um nome único para esta imagem e evita que duplique as imagens no servidor.
		$novoNome = strtoupper(md5(microtime())).strtolower($extensao);
		// Concatena a pasta com o nome
		$destino = $path.'/'.$novoNome;
		// lista de extenções permitidas
		
			
		$result['msg'] = "Você enviou o arquivo: <strong>".$nomeFile."</strong><br />";
		$result['msg'] = "Este arquivo é do tipo: <strong>".$typeFile."</strong><br />";
		$result['msg'] = "Temporáriamente foi salvo em: <strong>".$tmpNameFile."</strong><br />";
		$result['msg'] = "Seu tamanho é: <strong>".$sizeFile."</strong> Bytes<br /><br />";

		// Somente imagens, .jpg;.jpeg;.gif;.png - Aqui eu enfilero as extesões permitidas e separo por ';'
		if($extensao!='' && in_array($extensao, $arrExtensao))
		{
			_makedirs($path, $mode=0777);
			// tenta mover o arquivo para o destino
			if( @move_uploaded_file( $tmpNameFile, $destino))
			{
				$result['msg'] = "Arquivo salvo com sucesso em : <strong>".$destino."</strong><br />";
				$result['file'] = $novoNome;
			} else {
				$result['msg'] = "Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita.<br />";
			}
		} else {
			$result['msg'] = "Você poderá enviar apenas arquivos \"*.jpg;*.jpeg;*.gif;*.png\"<br />";
		}
		return $result;
	}

	function _makedirs($path, $mode=0777) {
	    return is_dir($path) || mkdir($path, $mode, true);
	}

	function _delete_imagens($filename=false){
		$filename = $_SERVER['DOCUMENT_ROOT'].$filename; 
		if (file_exists($filename)) {
			@unlink($filename);
			return true;
		} else {
			return false;
		}
	}

	function _query_error($db=false){
        $error = $db->error();
         if (isset($error['message'])) {
         	var_dump($error['message']);
            exit();
        }
    }


?>