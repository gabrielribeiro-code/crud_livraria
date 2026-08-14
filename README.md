# Pesquisa sobre Prepared Statements


O que é?

O prepared statement ou instrução separada é um recurso de banco de dados que separa o código SQL dos dados do usuário. Ele basicamente serve para executar consultas de segurança contra invasões e assim também melhorando o desempenho das repetições.

Como funciona: 

Preparação: O banco de dados recebe o modelo da consulta e cria um plano de execução sem os dados reais.

Execução: O sistema envia os valores separadamente para preencher os espaços vazios e roda o comando.


Principais Vantagens: 

Segurança: Bloqueia ataques de SQL injection, pois os dados nunca são misturados diretamente na estrutura do comando SQL.

Velocidade: O banco compila o código apenas uma vez e reutiliza o mesmo plano várias vezes.


Prepared Statements no PHP

No php o prepared statement separa o código SQL dos dados do usuário. Você envia um modelo de consulta com espaços vazios (? ou :nome) para o banco, que faz a leitura e a otimização antes de receber os valores reais. Isso bloqueia ataques de SQL injection e acelera execuções repetidas.










Por que não inserir diretamente informações do usuário no SQL?

Não é recomendado colocar diretamente informações fornecidas pelo usuário dentro de uma consulta SQL por que esses dados podem conter caracteres ou comandos que alterem a estrutura original da consulta.

Por exemplo, uma aplicação poderia montar uma consulta dessa forma:
$nome = $_POST['nome'];

$sql = "SELECT * FROM clientes WHERE nome = '$nome'";
$resultado = $conexao->query($sql);
Nesse caso, o valor recebido pelo formulário é colocado diretamente dentro do comando SQL. Isso cria uma vulnerabilidade porque a aplicação não consegue garantir que o conteúdo recebido será apenas um dado.
Basicamente de uma forma mais simples é basicamente como se disséssemos banco de dados, execute este comando e coloque exatamente o que o usuário escreveu aqui. Se alguem colocar algo que pareça parte de um comando SQL, pode acabar alterando a consulta e isso é chamado de SQL injection.

O que é o SQL injection?

É basicamente quando alguém consegue fazer uma informação que digitou ser interpretada como comando SQL, em vez de ser tratada apenas como informação. Basicamente o banco fica em duvida sobre o que é comando e o que é informação.


O que é Prepared Statement de uma forma simplificada:

Como dito anteriormente nos temos o SQL injection e o  prepared statement existe para combater justamente isso, ele funciona basicamente como uma caixa de separação, você fala pro banco meu comando é esse e dps minha informação é essa.

Basicamente vamos pensar num restaurante, sem o prepared statement você entregaria uma mensagem ao cozinheiro bem assim “faça um hamburguer (tudo que o cliente escreveu) O cliente poderia escrever qualquer coisa na mensagem. Já com o prepared Statement você fala “faça com hamburguer” e depois “o ingrediente escolhido pelo cliente é queijo”, assim o cozinheiro sabe que queijo é um ingrediente e não uma nova instrução nesse exemplo de forma simples entendemos o funcionamento do prepared statement.

Como funciona o processo de preparação, associação dos valores e execução de uma consulta utilizando prepared statements no PHP.

PREPARAR -> VINCULAR -> EXECUTAR


Segundo a documentação oficial do PHP, um prepared statement usa ? como espaços reservados e esses espaços precisam receber os valores antes da execução. O processo básico é preparar -> associar os valores e executar.

Preparação prepare():

Primeiro nesta etapa você escreve o SQL, mas não coloca o valor do usuário diretamente nele.

Por exemplo queremos procurar um cliente pelo nome:

$sql = "SELECT * FROM clientes WHERE nome = ?"; 

o ? significa basicamente que ira entrar um valor depois

então fazemos:
$stmt = $conexao->prepare($sql); 

Então basicamente o prepare() prepara essa consulta para ser executada. O php permite usar ? como marcador de parâmetro.

Associação do valor - bind_param():

Agora a ideia é outra temos por exemplo a variavel $nome recebendo “joao”, precisamos colocar Joao no lugar do “?”, então fazemos esse comando:

$stmt->bind_param("s", $nome); 
Ai então o “s” sendo o valor de uma string e o $nome é o valor que será colocado no ?

Essa parte é super importante para que João não fosse colocado diretamente dentro do texto SQL, assim ele sendo associado ao parâmetro. Isso mantém os dados separados do comando SQL, que é justamente uma das principais proteções contra SQL injection.






Execução - execute()

Depois de todos os processos anteriores, executamos:

$stmt->execute(); 

É nesse momento que o banco executa a consulta usando o valor que foi associado ao ?

Então basicamente num exemplo o processo todo fica assim: 

$nome = "João"; 

$sql = "SELECT * FROM clientes WHERE nome = ?";

$stmt = $conexao->prepare($sql);

$stmt->bind_param("s", $nome); 

$stmt->execute(); 

Então o processo de forma resumida é este: prepare() → bind_param() → execute(). 

A principal vantagem desse processo é que o comando SQL fica separado dos dados fornecidos pelo usuário. Dessa forma, os dados são tratados como valores e não como parte do código SQL, ajudando a proteger a aplicação contra SQL injection.

Então de uma forma bem resumida e simples o prepare() prepara o SQL, bind_param() coloca os valores e execute() executa a consulta.


Prepared Statements e Segurança

Como já dito anteriormente o prepared statements é uma boa prática para segurança por que ele separa os dados de comandos SQL e isso ajuda a prevenir SQL injection, e então deixa o código mais organizado e seguro.






Alterações no código:


Antes: $livros = mysqli_query($conexao, "SELECT * FROM livros");

Depois: 


(FOTO NO DOCS)



Antes: 

(FOTO NO DOCS)

Depois: 

(FOTO NO DOCS)


Antes:
 
(FOTO NO DOCS)


Depois:

(FOTO NO DOCS)



Antes:

(FOTO NO DOCS)

Depois: 

(FOTO NO DOCS)




Conclusão das Alterações:

Na atividade eu consegui compreender bem a utilização do prepared statements e a sua estrutura bem fixada, nós entendemos que em qualquer utilização do banco de dados temos que utilizar 3 passos para não dar erros na verificação de uma informação é um comando e assim utilizamos os 3 passos que é preparar, vincular e executar e assim conseguimos utilizar o crud no php com mas segurança com o banco de dados assim ficando também um código mais organizado que você sabe o que está fazendo e bem mais seguro.


Problemas encontrados no meu código:

Os problemas identificados no meu código foram exatamente o que pesquisamos o trabalho todo principalmente sobre SQL injection que é quando o SQL acha que uma informação é um comando assim confundindo as coisas e dando problema e então para arrumar em todo comando SQL quando usássemos por exemplo um comando de delete e fossemos falar onde que é o WHERE em vez de a gente colocar a variavel para onde ia, nós colocamos “?” assim arrumando o erro que acontecia de SQL injection.




Conclusão do Trabalho

Este trabalho foi um ótimo exercício para aprendermos sobre como utilizar o Prepared Statements e a sua importância em todas as linguagens de programação mas também principalmente no PHP, foi ótimo para entender sobre segurança e organização de código e evitar problemas futuros utilizando está linguagem. É de suma importância entender sobre este conceito para evitar erros como o de SQL injection que foi tanto falado durante o trabalho e assim deixar um código mais organizado e seguro.
