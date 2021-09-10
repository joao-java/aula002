<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>

<body>
    <div id="container" class="container " >
        <div class="testeTudo">
            <div>
                <ul>
                </ul>
            </div>
            <button>TESTE</button>
        </div>    
        
        <div class="testeTudo1">
            <div>
            <P></P>
            </div>
            <button>TESTE</button>
        </div>
    </div>
    <div class="pegarValor">
        <h1>Ensira os valores abaixo</h1>
        <input type="value" id="valor1" placeholder="caixa 1">
        <input type="value" id="valor2" placeholder="caixa 2">
        <p></p>
        <button>TABUADA</button>
    </div>

    <button class="buttonLimpa" id="buttonLimpa">Limpar</button>
    <button style="display: none;" class="uum" id="uum">open</button>

    <a href="https://mercadocotacao.com/dolar-hoje/" id="USD" title="Cotação do Dólar Americano Hoje" name="mercado_cotacao">Dólar Hoje</a><script async src="https://mercadocotacao.com/money/mercadocotacao.js"></script>

    <?
/*
   class.uolCotacoes.php - classe usada para extrair as cotações de moedas 
   do dia junto ao site de Economia da UOL - economia.uol.com.br/cotacoes/

   Autor: Fábio Berbert de Paula <fberbert@gmail.com>
   http://www.vivaolinux.com.br/~fabio

   17/01/2013
   Versão: 1.0
*/

class UOLCotacoes {

   public function pegaValores() {

      // o fopen também funciona para arquivos da rede, uau!
      if(!$fp=fopen("http://economia.uol.com.br/cotacoes/" ,"r" )) { 
         echo "Erro ao abrir a página de cotação" ; 
         return(0);
      } 

      //variáveis de classe
      $arrayValores = array();

      //inicio do processamento - ler página
      $uolHTML = "";
      while(!feof($fp)) { // leia o conteúdo da página, uma linha por vez, armazene na variável uolHTML
         $uolHTML .= fgets($fp); 
      }
      fclose($fp);

      /* o bloco do código HTML referente a cotação é assim:

      <td class="pg-color4"><a href="http://economia.uol.com.br/cotacoes/cambio/dolar-comercial-estados-unidos/">Dólar com.</a></td>
      <td>2,0435</td>
      <td>2,0442</td>

      Então o que farei é extrair os valores 2,0435 (compra) e 2,0442 (venda)
      O mesmo conceito se repete para as demais cotações
      */

      //array contendo as expressoes regulares que indicam cada moeda
      $patterns = array(
         "dolarComercial" => "/pg-color4.*dolar-comercial-estados-unidos/",
         "dolarTurismo"   => "/pg-color4.*dolar-turismo-estados-unidos/",
         "euro"  => "/pg-color4.*euro-uniao-europeia/",
         "libra" => "/pg-color4.*libra-esterlina/",
         "pesos" => "/pg-color4.*peso-argentina/",
      );


      $uolHTML = preg_replace("/.*div id=.cambio.>/", "", $uolHTML); 
      $uolHTML = preg_replace("/<tr>/", "\n<tr>", $uolHTML); //acrescentar quebra de linha
      $uolHTML = preg_replace("/<td/", "\n<td", $uolHTML); //acrescentar quebra de linha

      $arrayHTML = split("\n", $uolHTML);


      //loop para cada moeda
      while( list($moeda, $pattern) = each($patterns) ) {

         $arrayHTML = split("\n", $uolHTML);

         //loop por cada linha da pagina HTML
         while ( list($indice, $linha) = each($arrayHTML) ) {

            //se bloco HTML casa com a pattern da moeda do looping atual...
            if (preg_match($pattern, $linha)) {

               //print "Encontrei '$pattern' em: $linha\n\n";

               //ler proxima linha
               $linha = $arrayHTML[++$indice]; 

               //pegar cotacao compra
               preg_match("/<td>(.*)<\/td>/", $linha, $valor);
               $compra = $valor[1];

               //ler proxima linha
               $linha = $arrayHTML[++$indice]; 

               //pegar cotacao venda
               preg_match("/<td>(.*)<\/td>/", $linha, $valor);
               $venda = $valor[1];

               //atribuindo valores ao array de retorno
               array_push($arrayValores, $compra, $venda);
            }

         } // fim while

      } // fim while

      return($arrayValores);

   } //fim function pegaValores

} //fim classe
?> 
</body>

<script src="script.js"></script>
</html>