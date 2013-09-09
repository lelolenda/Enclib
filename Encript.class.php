<?php
	
	/*
		Autor: Sousa Gaspar
		Versão: 1.0
		Data de criação: 01/09/2013
		Licença: Creative Commons, 2013
		
		
		Classe para encriptar a senha e gerar um hash para guardar no banco de dados e realizar a operação reversa
		Class Encript
		propriedades:
		@param hash = hash gerado ou guardado no banco de dados
		@param custo = força da senha, paramentro usado no método crypt
		@param salto = string gerada aleatoriamente usado no método bcript
		
		Métodos:
		gerarSalto() - gera o salto aleatoriamente
		gerarHash(){} - gera um hash pela funcao bcript
		verificarSenha(){}  - verificar se a senha do usuario esta correcta
	*/
	
	class Encript{	
				 	protected $hash_user;
					protected $custo;
					protected $salto;
				
				//metodo construtor
				function __construct(){
				//define a força do hashing
				$this->custo = 08;
				//gera uma string alfanumérica aleatória
				$this->salto = $this->gerarSalto(16);
				}
				
				//função que gera o salto aleatoriamente
				public function gerarSalto($tamanho){
					$string = '0 1 2 3 4 5 6 7 8 9 a b c d e f g h i j k l m n o p q r s t u v x y z A B C D E F G H I J K L M N O P Q R S T U V X Y W Z';
					$array  = explode(' ',$string);
					for($i=0;$i<=$tamanho;$i++){
						$string_result .= $string[rand(0, count($array))]; 
					}
				return $string_result;
				}
	
				//função que gera o hash que é guardado no banco de dados.
				public function gerarHash($senha){
					$this->hash_user = crypt($senha,'$2a$'. $this->custo.'$'.$this->gerarSalto(64).'$');
					
					return $this->hash_user;
				}
				
				//Função que Desincripta a senha guardada no banco de dados.(Que você vai usar no formulário de login)
				public function verificarSenha($senha, $hash_user){
					if(crypt($senha, $hash_user)===$hash_user){
						return true;
					}
					else{
						return false;
					}
				}

	}
	
?>