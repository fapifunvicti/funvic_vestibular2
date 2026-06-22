<?php
namespace App\Core;


class Request {

    private array $query;

    private array $request;
    private array $server;
    private array $files;
    private array $cookies;
    private array $headers;
    private ?array $json = null;

    public readonly QueryString $query_string;

    private array $uri_args;

    public function __construct()
    {
       $this->query = $_GET;
       $this->request = $_POST;
       $this->server = $_SERVER;
       $this->files = $_FILES;
       $this->cookies = $_COOKIE;
       $this->headers = [];
       $this->json = [];
       $this->parseJsonInput();
       $this->query_string = new QueryString($_SERVER['QUERY_STRING'] ?? '');
    }

    private function parseJsonInput(): void
    {
        $contentType = $this->header('Content-Type');
        
        if ($contentType && str_contains($contentType, 'application/json')) {
            $input = !(bool)file_get_contents('php://input') ? '' : (string)file_get_contents('php://input');
            $this->json = json_decode($input, true);
            
            if (json_last_error() !== JSON_ERROR_NONE) {
                $this->json = null;
            }
        }
    }


    public function get(string $key,  mixed $default = null): mixed {
        return $this->query[$key] ?? $default;
    }

    public function post(string $key,  mixed $default = null): mixed {
        return $this->request[$key] ?? $default;
    }

    public function file(string $key) : ?array {
        return $this->file[$key] ?? null;
    }

    public function getFiles() : array {
        return $this->files;
    }

    public function cookie(string $key, mixed $default = null): mixed {
        return $this->cookie[$key] ?? $default;
    }

    public function getCookies() : array {
        return $this->cookies;
    }

    public function header(string $key, mixed $default = null) : mixed {
        return $this->headers[$key] ?? $default;
    }

    public function getHeaders(): array {
        return $this->headers;
    }

    public function request_method(): string {
        return $this->server['REQUEST_METHOD'];
    }

    public function isMethod(string $method) : bool {
        return \strtoupper($method) === $this->request_method();
    }

    public function isGet() : bool {
        return $this->isMethod("GET");
    }

    public function isPost(): bool {
        return $this->isMethod('POST');
    }

    public function isPut() : bool {
        return $this->isMethod("GET");
    }

    public function isDelete(): bool {
        return $this->isMethod('DELETE');
    }
    public function isPatch(): bool {
        return $this->isMethod('PATCH');
    }

    public function getuserAgent(): ?string {
        return $this->server['HTTP_USER_AGENT'] ?? null;
    }

    public function getUri(): string|bool {
        return parse_url($this->server['REQUEST_URI'], \PHP_URL_PATH) ?? "/";
    }

    public function getServer(string $key): mixed  {
        return !isset($_SERVER[$key]) ? null : $_SERVER[$key];
    }


    /**
     * traz $_POST sem tratamento nenhum
     * @return array
     */
    public function getBody(): array {
        return $this->request;
    }

    /**
     * traz os dados com tratamento de tipo apenas (sem filtro)
     * @return  array | bool | null
     */
    public function getParsedBody(): array | bool | null{
       
        $method_filter = \INPUT_GET;

        if($this->request_method() === "post" || $this->request_method() === "POST"){
            $method_filter = \INPUT_POST;
        }
    
        return \filter_input_array($method_filter, $this->request, true);
    }
    
    /*
    public function parse_headers(): array {
        $headers = [];

        foreach($this->server as $key => $value){

            if(\str_starts_with($key, "HTTP_")){

            }
        }
    }*/

    
    public function  is_ajax_request(bool $debug = false): bool {

        //ignora todas verificacoes para fins de debug (nao esquecer de usar debug false em produção)
        if($debug){
            return true;
        }

        // Verifica o header mais comum
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
            return true;
        }
        
        // Verifica se é uma requisição JSON
        $contentType = isset($_SERVER['CONTENT_TYPE']) ? $_SERVER['CONTENT_TYPE'] : '';
        if (strpos($contentType, 'application/json') !== false) {
            return true;
        }
        
        // Verifica outros headers comuns em AJAX
        if (isset($_SERVER['HTTP_AJAX'])) {
            return true;
        }
        
        return false;
    }

    public function is_htmx(): bool {
        return ($_SERVER['HTTP_HX_REQUEST'] ?? '') === "true";
    }

    public function htmx_trigger(): ? string {
        return $_SERVER['HTTP_HX_TRIGGER'] ?? null;
    }

    public function htmx_target(): ? string {
        return $_SERVER['HTTP_HX_TRIGGER'] ?? null;
    }

    public function set_uri_args(array $args){
        $this->uri_args = $args;
    }

    public function get_uri_args(): array {
        return $this->uri_args;

    }

    public function getSession(string $key): mixed {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    public function setSession(string $key, mixed $value): void {
        if(!isset($_SESSION[$key])){
            $_SESSION[$key] = $value;
            return;
        }
        
        $_SESSION[$key] = $value;
        return;
        
    }

}