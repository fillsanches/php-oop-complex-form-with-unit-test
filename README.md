Documentação disponível em &#x1f1e7;&#x1f1f7; / Documentation available in  &#127482;&#127480; (after portuguese)

# LEIA-ME &#x1f1e7;&#x1f1f7;
### CONTEÚDO DESSE ARQUIVO
---
 * Requisitos
 * Instalações
 * Configurações
 * Resolvendo problemas
 
### REQUISITOS
---
### Softwares e packeges necessários para esse projeto:
 * php 7.0 ou mais novo, com php7.0-xml (mesma versão que o seu php)
 * mysql database
 * phpunit (7.0 mais novo, ver arquivo composer.json)
 * phpmailer (6.0 mais novo, ver arquivo composer.json)

 ### INSTALAÇÕES
 ---
No diretório raiz, clone ou baixe o projeto:
```
git clone https://github.com/fillsanches/php-oop-complex-form-with-unit-test.git
```
Ainda no diretório raiz, agora com um prompt compatível, instale as dependências do composer.json:
```
composer dump
```
Para verificar se os pacotes foram instalados com sucesso:
(A localização desses pacotes pode mudar de acordo com suas versões e seu sistema operacional)
```
vendor/bin/phpunit --version
cat vendor/phpmailer/phpmailer/VERSION
```
Agora verifique se você tem o módulo php-dom ativo:
Linux / Mac
```
php -m | grep dom
```
Windows
```
php -m | findstr /r /c:"dom"
```

 ### CONFIGURAÇÕES
Conectado a um client SQL, como DBeaver ou similar, execute o script abaixo para criar um banco de dados e uma tabela:
```
CREATE TABLE `form_data` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
 `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
 `file_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
 `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
```
Você pode alterar as configurações do banco de dados, e da conta de e-mail para envio de mensagens, de acordo com as suas necessidades. Para isso use os arquivos localizados em:
```
php-oop-complex-form-with-unit-test/config/
```
A maneira mais simples de executar um servidor web para testar o formulário é usar o servidor web php embudito. Digite no diretório raiz:
```
php -S 127.0.0.1:8000
```
A aplicação agora está disponível através do navegador em  http://127.0.0.1:8000
### RESOLVENDO PROBLEMAS

Se algo não sair como esperado na execução do formulário, você pode testar a aplicação com o phpunit (conexão ao banco de dados não coberta). Para isso digite no diretório raiz:
```
vendor/bin/phpunit --testdox
```
Se nenhum problema for detectado, mas ainda houver erros na aplicação, os pontos a seguir podem ser verificados.

Se você receber uma mensagem de erro do tipo ```email_sending_failed``` (veja todas as mensagens em ``` config / messages.json```), você possivelmente tem um problema com o banco de dados ou com o envio de e-mails, então:
 * certifique-se de que as configurações no arquivo ```db_config.php``` correspondem às esperadas para o seu ambiente.
 * certifique-se de que as configurações no arquivo ```mail_config.php``` correspondem às esperadas para seu provedor de e-mail.

# README &#127482;&#127480;
### CONTENTS OF THIS FILE
---
 * Requirements
 * Installations
 * Configurations
 * Troubleshooting
 * Maintainers
 
### REQUIREMENTS
---
### Softwares and packeges required for this project:
 * php 7.0 or higher, with php7.0-xml (same version as your php)
 * mysql database
 * phpunit (7.0 or higher, see composer.json file)
 * phpmailer (6.0 or higher, see composer.json file)

 ### INSTALLATIONS
 ---
In the root directory, clone or download the project:
```
git clone https://github.com/fillsanches/php-oop-complex-form-with-unit-test.git
```
Still in the root directory, now with a compatible prompt install the composer.json dependencies:
```
composer dump
```
To verify that the packages have been successfully installed:
(The location of these packages may change according to their versions and your operating system)
```
vendor/bin/phpunit --version
cat vendor/phpmailer/phpmailer/VERSION
```
Now check if you have the php-dom module active:
Linux / Mac
```
php -m | grep dom
```
Windows
```
php -m | findstr /r /c:"dom"
```

 ### CONFIGURATIONS
Connected to a SQL client, as DBeaver or similar, run the script below to create a database and table:
```
CREATE TABLE `form_data` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
 `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
 `file_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
 `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
```
You can change the database and email account settings for sending messages, according to what you need. For this use the files located at:
```
php-oop-complex-form-with-unit-test/config/
```
The simplest way to run a web server to test the form is to use the built-in php web server. From root directory type:
```
php -S 127.0.0.1:8000
```
The application is now available via the browser at http://127.0.0.1:8000
### TROUBLESHOOTING

If something doesn't go as expected in the execution of the form, you can test the application with phpunit (database connection not covered). From root directory type:
```
vendor/bin/phpunit --testdox
```
If no problems are detected but there are still errors in the application, the next points should be checked.

If you receive an error message like ```email_sending_failed``` (see all messages in  ```config/messages.json```) you possibly have a problem with the database or sending email, then:
 * make sure the settings in the ```db_config.php``` file match those expected for your environment.
 * make sure the settings in the ```mail_config.php``` file match those expected for your email provider.
