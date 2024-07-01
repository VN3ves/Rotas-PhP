# Rotas-PHP 

Um micro-framework de roteamento simples e eficiente para PHP. Ele permite definir rotas que podem passar por middlewares antes de serem encaminhadas para um controller, facilitando a construção de aplicações web de maneira organizada e escalável.

## Recursos

- Definição simples e intuitiva de rotas.
- Suporte a middlewares para manipulação de requisições antes de chegarem ao controller.
- Integração fácil com controllers para gerenciamento das operações.
- Suporte para métodos HTTP: GET, POST, PUT, DELETE.
- Código leve e de fácil manutenção.

## Requisitos

- PHP 7.4 ou superior

## Instalação

Clone o repositório em seu ambiente de desenvolvimento:

git clone https://github.com/seuusuario/Rotas-PHP.git
cd Rotas-PHP

### Aqui está um exemplo de como definir e utilizar as rotas com o Rotas-PHP:

use App\Routes\Route;

// Define a rota principal
Route::get('/', 'HomeController@index', ['auth']);

// Rotas de sessão
Route::get('/login', 'AuthController@index');
Route::post('/logon', 'AuthController@logon');
Route::get('/logout', 'AuthController@logout');


### Você pode definir middlewares para manipular requisições antes de chegarem ao controller:

namespace App\Middleware;

class AuthMiddleware
{
    public function handle($request, $next)
    {
        // Verifica se o usuário está autenticado
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
        	exit();
        }
        return $next($request);
    }
}

### Exemplo de um controller simples:

namespace App\Controllers;

class HomeController
{
    public function index()
    {
        echo 'Bem-vindo ao Rotas-PHP!';
    }
}

Contribuições são bem-vindas! Sinta-se à vontade para abrir issues e pull requests. 1. Fork o repositório. 2. Crie sua feature branch: git checkout -b minha-feature. 3. Commit suas mudanças: git commit -am 'Adicionei uma nova feature'. 4. Push para a branch: git push origin minha-feature. 5. Abra um Pull Request.

Licença Este projeto está licenciado sob a licença MIT. Veja o arquivo LICENSE para mais detalhes.
