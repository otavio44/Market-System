# Pipeline CI/CD WebSTAMP

Trabalho final do curso de Ciência da Computação cujo objetivo é disponibilizar a ferramenta de análise de hazards (situações de perigo) WebSTAMP open-source juntamente com um pipeline fim-a-fim de integração e entrega contínua, com objetivo de automatizar os testes, verificações de padrão de código e deployment, visando maior qualidade de código e facilidade na colaboração da comunidade.

# Diagrama da infraestrutura do pipeline
![Cópia de Diagrama CI v1 - work futuro](https://user-images.githubusercontent.com/56079012/162291534-7982c143-0204-4c4a-a7c7-9194161126f9.png)

 
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
 Exemplo de saída para um trecho de código com erros de linting:
 
 ![image](https://user-images.githubusercontent.com/56079012/162291691-45ae554f-8381-45e3-be7b-739908132943.png)
 
 O mesmo vale para os testes de unidade, integração e aceitação, o workflow tests ira executar todos os testes existentes averiguando se não houve quebra das funcionalidades. 
 Exemplo de saída após a execução de todos os testes:
![image](https://user-images.githubusercontent.com/56079012/162291393-a4eae4f8-3693-4fb2-af1f-b6720ba41b8b.png)
 
 Além disso, a cada novo commit as execuções dos testes geram um relatório de cobertura de código, por meio dele é possível observar o estado atual de cada classe em relação a sua cobertura de código. Exemplo de saída após execução do workflow:
 ![image](https://user-images.githubusercontent.com/56079012/162291019-3f3e0df3-fae6-409d-85d8-2009bab64c18.png)
  
Todas os exemplos mostrados anteriormentes podem ser acessados na aba Actions dentro do portal do Github.
