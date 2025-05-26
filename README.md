# API-PHP
API em PHP puro criada para fins de estudos.

 **Tecnologias Usadas**  
|-PHP >7.4  
|-XAMPP  

 **Etapas**  
|-Ativar URL amigável nas configurações do XAMPP  
|  -Vá até `httpd.conf` e abilite:  
|     ->`LoadModule rewrite_module modules/mod_rewrite.so` //Salve o arquivo e reinicie o Apache no XAMPP.  
|     ->Ainda em `httpd.conf`, procure por `<Directory '${SRVROOT}/htdocs'>AllowOverride None</Directory>` e mude para o texto para "*AllowOverride All*" //Isso permite que o Apache respeite as regras do .htaccess.  
|-Criar o aquivo `.htaccess` na raiz do projeto  
|-Criar o arquivo `composer.json` também na raiz e rodar "*composer update*" no terminal  
