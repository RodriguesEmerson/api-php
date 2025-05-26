# api-php
API em PHP puro criada para fins de estudos.

# Requisitos
|-PHP >7.4
|-XAMPP
|-Ativar URL amigável nas configurações do XAMPP
|  -Vá até httpd.conf e abilite:
|     ->LoadModule rewrite_module modules/mod_rewrite.so //Salve o arquivo e reinicie o Apache no XAMPP.
|      ->procure por <Directory '${SRVROOT}/htdocs'>AllowOverride none e coloque "AllowOverride all"  //Isso permite que o Apache   respeite as regras do .htaccess.

# Etapas
|-Criar .htaccess
|-Criar composer.json e rodar "composer update" no terminal

