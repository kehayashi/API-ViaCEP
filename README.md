# Teste 3
<h1 align="center">Teste 3</h1>

## Descrição do Projeto
<p align="center">Construir uma aplicação em PHP utilizando o framework Laravel para consumir a API do ViaCEP, podendo consultar um ou mais CEP's por ve, mostrando o resultado em um tabela com opções de exportar para Excel bem como apaga a tabela e seu conteúdo da pagina.</p>

<h4 align="center"> 
	Teste concluído
</h4>

### Requisitos
- [x] Consumit API ViaCEP com código nativo
- [x] Possibilitar consultar um ou mais CEP's
- [x] Preencher uma table com as informacões retornadas
- [x] Botão para exportar os registros em um arquivo no formato CSV
- [x] Criar um botão para limpar o contéudo

### Features
- [x] Buscar por um ou mais CEP's
- [x] Exportar para CSV
- [x] Limpar dados da tabela


#### Aplicação
Consiste em uma aplicação com frontend em HTML, CSS e JS, que possibilita ao usuário informar um valor para obter informações sobre CEP's. Esse(s) valor(res) são enviados por POST o backend utilizando PHP com framework laravel. Foi criada uma route para a comunicão entre front e back.
No backend temos uma Model para podemos instanciar um CEP com suas respectivas informações. Para existe um Controller "ApiControler" que é resposável por receber os dados do front, fazer uma verificação no formato e reduzir possíveis dados não compativeis com a API. É no método "searchCep()" que isto acontece, fazendo também a criação do endpoint para a requisição que é feita por meio do método "requestAPI()".
O método "requestAPI()" tem como responsabilidade pegar o endpoint recebido e utilizando o Curl, abre uma conexão, faz a request, fecha a conexão e devole os dados em formato de array para quem o chamou.
É ai que o "searchCep()" verifica se existe um campo de retorno chamado "cep", que confirma que os dados retornados estem aptos para retornarem para view em forma de array. Por fim o frontend recebe estes dados e os joga em uma tabela para melhor visualização.
Para as funcionalides de criar inputs dinamicos, exportar para CSV e limpar a tabela temos script js puros.
A função addInput() gera dinamicamente um input apos o ultimo filho do elemento pai "div-inputs".
A função removeTable() remove todo elemento de id content
E temos uma ação de click no botao "Exportar para CSV" onde são pegos todos os elementos "tr", feito um mapeamentos das celulas e um mapeamento para pegar todos os textos "cell.content", separando por virgula cada celula e uma quebra de linha ao final. Montando entao a estrutura do arquivo que utilizando a funcao "encodeURIComponent()" codifica e permite o formato csv







