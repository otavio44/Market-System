# Pipeline CI/CD WebSTAMP

Trabalho final do curso de Ciência da Computação cujo objetivo é disponibilizar a ferramenta de análise de hazards (situações de perigo) WebSTAMP open-source juntamente com um pipeline fim-a-fim de integração e entrega contínua, com objetivo de automatizar os testes, verificações de padrão de código e deployment, visando maior qualidade de código e facilidade na colaboração da comunidade.

# Diagrama da infraestrutura do pipeline
 imagem vai aqui
 
# Requisitos
- PHP (7.4)
- Docker (preferably the latest version)
- Composer (latest version)

# Passos para execução
Abra o terminal para clonar o repositório
```
gh clone a
```

Inicie o container docker
```
docker-compose up -d --build
```

Acesse o container
```
docker exec -i -t webstamp-app /bin/bash
```

Instale as dependências
```
composer update
```

Crie as migrations do banco de dados
```
php artisan migrate --seed
```

Uma nova chave deve ser gerada  para a nova execução
```
php artisan key:generate
```

Libere o aplicativo no servidor de desenvolvimento do PHP
```
php artisan serve
```
Depois disso, você poderá acessar o WebSTAMP (localhost:8000)
 
 ## Execução dos workflows
 
 Toda alteração feita no código fonte deve seguir o padrão de codificação [PSR-2](https://www.php-fig.org/psr/psr-2/). Quando o commit da alteração for submetido ao repositório principal, testes automatizados vão ser executados para verificação dos padrões. 
 Exemplo de saída para um trecho de código com erros de lintigin:
 - IMAGEM DO PRINT DO ERRO LINT VEM AQ
 
 O mesmo vale para os testes de unidade, integração e aceitação, o workflow tests ira executar todos os testes existentes averiguando se não houve quebra das funcionalidades. 
 Exemplo de saída após a execução de todos os testes:
 - IMAGEM DO PRINT DOS TESTES VEM AQ
 
 Além disso, a cada novo commit as execuções dos testes geram um relatório de cobertura de código, por meio dele é possível observar o estado atual de cada classe em relação a sua cobertura de código. Exemplo de saída após execução do workflow:
 - IMAGEM DO PRINT VEM  AQ
  
Todas os exemplos mostrados anteriormentes podem ser acessados na aba Actions dentro do portal do Github.
