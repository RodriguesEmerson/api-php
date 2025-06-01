# API-PHP
API em PHP puro criada para fins de estudos.

 **Tecnologias Usadas**  
|-PHP 8.2  
|-XAMPP  
  
 **Como Rodar**  
|-Clone o repositório: `https://github.com/RodriguesEmerson/api-php`.  
|-Ative URL amigável nas configurações do Apache  
|  -Vá até `httpd.conf` e abilite: `LoadModule rewrite_module modules/mod_rewrite.so`    
|     ->Ainda em `httpd.conf`, procure por `<Directory '${SRVROOT}/htdocs'>AllowOverride None</Directory>` e mude para o texto para "*AllowOverride All*" //Isso permite que o Apache respeite as regras do .htaccess.    
|-Rode "*composer update*" no terminal.  
|-Cria o banco e depois crie a tabela com o modelo em `db.sql`.  
|-Crie `.env` de acordo o medelo de `.env_model`.  
|-Ative o Servidor e MySQL no XAMPP.  
|-Teste.