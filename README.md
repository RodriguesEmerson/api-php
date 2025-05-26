# API-PHP
API em PHP puro criada para fins de estudos.

 **Requisitos**  
|-PHP >7.4  
|-XAMPP  

 **Etapas**  
|-Ativar URL amigável nas configurações do XAMPP  
|  -Vá até `httpd.conf` e abilite:  
|     ->`LoadModule rewrite_module modules/mod_rewrite.so`  
            //Salve o arquivo e reinicie o Apache no XAMPP.  
|      ->procure por `<Directory '${SRVROOT}/htdocs'>AllowOverride None</Directory>` e mude para o texto para "*AllowOverride All*"  
            //Isso permite que o Apache respeite as regras do .htaccess.  
|-Criar `.htaccess`  
|-Criar `composer.json` e rodar "*composer update*" no terminal  
