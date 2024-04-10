# Escola-Fácil

Escola-Fácil é uma aplicação em desenvolvimento utilizando PHP Laravel para ajudar na gestão de uma frota de alunos no transporte escolar. Este README fornecerá informações sobre como configurar e executar o projeto localmente para desenvolvimento.

## Pré-requisitos

Antes de começar, certifique-se de ter os seguintes pré-requisitos instalados em sua máquina:

- Node.js (npm será instalado junto)
- PHP
- Composer
- MySQL ou outro banco de dados compatível com Laravel

## Instalação

1. Clone este repositório:

    ```
    git clone https://github.com/seu-usuario/escola-facil.git
    ```

2. Instale as dependências do Composer:

    ```
    composer install
    ```

3. Instale as dependências do Node.js:

    ```
    npm install
    ```

4. Copie o arquivo de configuração `.env.example` para `.env`:

    ```
    cp .env.example .env
    ```

5. Gere a chave de aplicação:

    ```
    php artisan key:generate
    ```

6. Configure as variáveis de ambiente no arquivo `.env`, especialmente as configurações de banco de dados:

    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=sua_basedados
    DB_USERNAME=seu_usuario
    DB_PASSWORD=sua_senha
    ```

## Execução

Para executar o projeto localmente, siga os passos abaixo:

1. Inicie o servidor de desenvolvimento com Laravel Mix:

    ```
    npm run dev
    ```

2. Inicie o servidor Laravel:

    ```
    php artisan serve
    ```

3. Certifique-se de iniciar seu servidor MySQL ou o banco de dados configurado.

4. Acesse a aplicação em seu navegador em [http://localhost:8000](http://localhost:8000).

## Observações

- Certifique-se de que o ambiente de desenvolvimento está configurado corretamente, especialmente o servidor MySQL ou outro banco de dados compatível com Laravel.
- Este projeto está em desenvolvimento e pode conter bugs e falta de recursos. Teste cuidadosamente antes de utilizar em produção.
- Utilize Sweet Alert 2 para mensagens de validações no blade para fornecer uma experiência de usuário mais amigável.
- Lembre-se de proteger os dados sensíveis e evitar expô-los publicamente.

## Contribuindo

Contribuições são bem-vindas! Sinta-se à vontade para abrir uma issue para relatar problemas ou propor novos recursos. Se desejar contribuir diretamente, siga estas etapas:

1. Fork o repositório
2. Crie uma branch para sua feature (`git checkout -b feature/NomeDaFeature`)
3. Faça commit das suas mudanças (`git commit -am 'Adicionando uma nova feature'`)
4. Faça push para a branch (`git push origin feature/NomeDaFeature`)
5. Abra um Pull Request

## Licença

Este projeto está licenciado sob a MIT License.
