# API-PHP

API em PHP puro criada para fins de estudos.

## Tecnologias Usadas
- PHP 8.2
- XAMPP
- Composer

## Requisitos
- PHP >= 8.1
- Composer
- XAMPP (Apache e MySQL)

## Como Rodar

1. Clone o repositório:
   ```bash
   git clone https://github.com/RodriguesEmerson/api-php
   ```
2. Ative URL amigável nas configurações do Apache:
   - No arquivo `httpd.conf`, habilite:
     ```
     LoadModule rewrite_module modules/mod_rewrite.so
     ```
   - Ainda em `httpd.conf`, altere:
     ```
     <Directory '${SRVROOT}/htdocs'>
         AllowOverride None
     </Directory>
     ```
     para
     ```
     <Directory '${SRVROOT}/htdocs'>
         AllowOverride All
     </Directory>
     ```
3. Rode o comando abaixo no terminal para instalar as dependências:
   ```bash
   composer update
   ```
4. Crie o banco de dados e a tabela usando o modelo em `db.sql`.
5. Crie o arquivo `.env` conforme o modelo `.env_model`.
6. Ative o servidor Apache e o MySQL no XAMPP.
7. Teste a API (dica: use o Insomnia ou Postman).

## Estrutura do Projeto

- `src/` - Código-fonte da API
- `db.sql` - Modelo do banco de dados
- `.env_model` - Exemplo de configuração de ambiente

## Exemplos de Requisições

### Criar Usuário

```bash
curl -X POST http://localhost/api-php/user/create \
  -H "Content-Type: application/json" \
  -d '{"name":"Seu Nome","email":"email@exemplo.com","password":"senha"}'
```

### Autenticar Usuário

```bash
curl -X POST http://localhost/api-php/user/login \
  -H "Content-Type: application/json" \
  -d '{"email":"email@exemplo.com","password":"senha"}'
```

---

Sinta-se à vontade para adaptar conforme a necessidade do seu projeto!