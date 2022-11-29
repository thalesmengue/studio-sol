<p align="center"><img src="studiosol.png" target="_blank" height="70">
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Sobre o teste

Deveria ser produzida uma API para verificar se a senha recebida é válida baseada nas regras pedidas.

● minSize: tem pelo menos x caracteres. <br>
● minUppercase: tem pelo menos x caracteres maiúsculos <br>
● minLowercase: tem pelo menos x caracteres minúsculos <br>
● minDigit: tem pelo menos x dígitos (0-9) <br>
● minSpecialChars: tem pelo menos x caracteres especiais ( Os caracteres especiais são os
caracteres da seguinte string: "!@#$%^&*()-+\/{}[]" ) <br>
● noRepeted: não tenha nenhum caractere repetido em sequência ( ou seja, "aab" viola esta
condição, mas "aba" não)

### Para a criação da presente API, foi utilizada a linguagem de programação PHP, em conjunto com o Framework Laravel do PHP, um robusto framework, desenvolvido para a feitura de aplicações com a sintaxe mais elegante, seguindo o padrão MVC (Model, View e Controller).

*Para a criação das validações da senha recebida, utilizado a facade de validação do Laravel, no entanto, pelas
validações padrões disponíveis serem limitadas, foi necessária a criação de novas regras de validação [Rules], às quais
podem ser visualizadas na pasta ```app/rules```.*

# Rotas

| Método HTTP | Endpoint  | Descrição                                     |
|-------------|-----------|-----------------------------------------------|
| POST        | `/verify` | Recebe a senha para ser validada pelas regras |

# Para executar o projeto na sua máquina, siga os passos abaixo

## os comandos devem ser executados via terminal, seja o da máquina ou o da IDE

```
# extraia o arquivo

# acesse a pasta do projeto pelo terminal ou pela IDE

# instale as dependências caso necessário
$ composer install

# execute o comando abaixo para que a API seja inicializada e possa ser utilizada
$ php artisan serve
```

Para verificar as validações realizadas pode ser acessada a rota ```/verify```, com o exemplo de envio de uma senha da seguinte maneira:
```bash
{
  "password:" "alto123"
}
```
com o envio da requisição POST com o exemplo acima, a resposta esperada deve ser a seguinte:

```bash
{
	"verify": false,
	"noMatch": {
		"password": [
			"The password must be at least 8 characters.",
			"The password must contain at least one uppercase word.",
			"The password must contain at least one special character."
		]
	}
}
```

No entanto, caso o usuário preencha todos os requisitos exigidos para a formulação da senha, a resposta que se espera receber é a seguinte:
```bash
{
	"verify": true,
	"noMatch": []
}
```

Se a validação que se tenta realizar falha, no caso os requisitos definidos não são cumpridos, é retornado uma Exception, ou seja, o usuário não vai para o ponto que deseja.

## Testes

Para rodar os testes feitos, é só utilizar no terminal o comando abaixo:

```bash
php artisan test
```


### Referências:

- [PHP 8.0](https://www.php.net/docs.php).
- [Laravel 9](https://laravel.com/docs/9.x/installation).
