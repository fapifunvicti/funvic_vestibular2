<?php
// Core/Response.php

namespace App\Core;

/**
 * Representa uma resposta HTTP
 * 
 * @package Core
 */
class Response
{
    private int $statusCode = 200;
    private array $headers = [];
    private mixed $content = null;
    private bool $sent = false;

    private array $pendingCookies = [];
    
    /**
     * HTTP status codes and their messages
     */
    private const STATUS_MESSAGES = [
        100 => 'Continue',
        101 => 'Switching Protocols',
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        307 => 'Temporary Redirect',
        308 => 'Permanent Redirect',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Payload Too Large',
        414 => 'URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Range Not Satisfiable',
        417 => 'Expectation Failed',
        426 => 'Upgrade Required',
        428 => 'Precondition Required',
        429 => 'Too Many Requests',
        431 => 'Request Header Fields Too Large',
        451 => 'Unavailable For Legal Reasons',
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported',
        511 => 'Network Authentication Required',
    ];
    
    /**
     * Constructor
     * 
     * @param mixed $content
     * @param int $statusCode
     */
    public function __construct(mixed $content = '', int $statusCode = 200)
    {
        $this->content = $content;
        $this->statusCode = $statusCode;
    }
    
    /**
     * Set status code
     * 
     * @param int $code
     * @param string|null $message
     * @return self
     */
    public function setStatusCode(int $code, ?string $message = null): self
    {
        $this->statusCode = $code;
        
        if ($message !== null) {
            // Custom message
        }
        
        return $this;
    }
    
    /**
     * Get status code
     * 
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
    
    /**
     * Get status message
     * 
     * @return string
     */
    public function getStatusMessage(): string
    {
        return self::STATUS_MESSAGES[$this->statusCode] ?? 'Unknown Status';
    }
    
    /**
     * Add header
     * 
     * @param string $key
     * @param string $value
     * @return self
     */
    public function header(string $key, string $value): self
    {
        $this->headers[$key] = $value;
        return $this;
    }
    
    /**
     * Add multiple headers
     * 
     * @param array $headers
     * @return self
     */
    public function withHeaders(array $headers): self
    {
        foreach ($headers as $key => $value) {
            $this->header($key, $value);
        }
        return $this;
    }
    
    /**
     * Check if header exists
     * 
     * @param string $key
     * @return bool
     */
    public function hasHeader(string $key): bool
    {
        return isset($this->headers[$key]);
    }
    
    /**
     * Get header value
     * 
     * @param string $key
     * @return string|null
     */
    public function getHeader(string $key): ?string
    {
        return $this->headers[$key] ?? null;
    }
    
    /**
     * Remove header
     * 
     * @param string $key
     * @return self
     */
    public function removeHeader(string $key): self
    {
        unset($this->headers[$key]);
        return $this;
    }
    
    /**
     * Send JSON response
     * 
     * @param mixed $data
     * @param int $statusCode
     * @return self
     */
    public function json(mixed $data, int $statusCode = 200): self
    {
        $this->content = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->content = json_encode(['error' => 'JSON encoding error']);
            $this->statusCode = 500;
        } else {
            $this->statusCode = $statusCode;
        }

        header("Content-Type: application/json; charset=utf-8", true, $this->statusCode);
        //$this->header('Content-Type', 'application/json');
        
        return $this;
    }
    
    /**
     * Send HTML response
     * 
     * @param string $html
     * @param int $statusCode
     * @return self
     */
    public function html(string $html, int $statusCode = 200): self
    {
        $this->content = $html;
        $this->statusCode = $statusCode;
        $this->header('Content-Type', 'text/html; charset=utf-8');
        return $this;
    }
    
    /**
     * Send plain text response
     * 
     * @param string $text
     * @param int $statusCode
     * @return self
     */
    public function text(string $text, int $statusCode = 200): self
    {
        $this->content = $text;
        $this->statusCode = $statusCode;
        $this->header('Content-Type', 'text/plain; charset=utf-8');
        return $this;
    }
    
    /**
     * Redirect response
     * 
     * @param string $url
     * @param int $statusCode
     * @return self
     */
    public function redirect(string $url, int $statusCode = 302): self
    {
        $this->statusCode = $statusCode;
        $this->header('Location', $url);
        $this->content = '';
        return $this;
    }
    
    /**
     * Back redirect (to previous page)
     * 
     * @return self
     */
    public function back(): self
    {
        $referer = $_SERVER['HTTP_REFERER'] ?? '/';
        return $this->redirect($referer);
    }
    
    /**
     * File download response
     * 
     * @param string $filePath
     * @param string|null $fileName
     * @return self
     */
    public function download(string $filePath, ?string $fileName = null): self
    {
        if (!file_exists($filePath)) {
            return $this->json(['error' => 'File not found'], 404);
        }
        
        $fileName = $fileName ?? basename($filePath);
        $fileSize = filesize($filePath);
        $mimeType = !(bool)mime_content_type($filePath) ? 'application/octet-stream' : (string)mime_content_type($filePath);
        
        $this->header('Content-Type', $mimeType);
        $this->header('Content-Disposition', "attachment; filename=\"{$fileName}\"");
        $this->header('Content-Length', (string)$fileSize);
        $this->header('Cache-Control', 'private');
        $this->header('Pragma', 'public');
        $this->content = file_get_contents($filePath);
        
        return $this;
    }
    
    /**
     * Inline file response (display in browser)
     * 
     * @param string $filePath
     * @param string|null $fileName
     * @return self
     */
    public function file(string $filePath, ?string $fileName = null): self
    {
        if (!file_exists($filePath)) {
            return $this->json(['error' => 'File not found'], 404);
        }
        
        $fileName = $fileName ?? basename($filePath);
        $mimeType = mime_content_type($filePath) ?: 'application/octet-stream';
        
        $this->header('Content-Type', $mimeType);
        $this->header('Content-Disposition', "inline; filename=\"{$fileName}\"");
        $this->content = file_get_contents($filePath);
        
        return $this;
    }
    
    /**
     * Render a view template
     * 
     * @param string $viewPath
     * @param array $data
     * @param int $statusCode
     * @return self
     */
    public function view(string $viewPath, array $data = [], int $statusCode = 200): self
    {
        // Extract data to variables
        extract($data);
        
        // Start output buffering
        ob_start();
        
        // Define views directory (you can change this)
        $viewsDir = __DIR__ . '/../Views/';
        $viewFile = $viewsDir . str_replace('.', '/', $viewPath) . '.php';
        
        if (!file_exists($viewFile)) {
            return $this->json(['error' => "View {$viewPath} not found"], 500);
        }
        
        require $viewFile;
        $content = ob_get_clean();
        
        return $this->html($content, $statusCode);
    }
    
    /**
     * Set cookie
     * 
     * @param string $name
     * @param string $value
     * @param int $expires
     * @param string $path
     * @param string $domain
     * @param bool $secure
     * @param bool $httponly
     * @param string $sameSite
     * @return self
     */
    public function cookie(
        string $name,
        string $value = '',
        int $expires = 0,
        string $path = '/',
        string $domain = '',
        bool $secure = false,
        bool $httponly = true,
        string $sameSite = 'Lax'
    ): self {
        // Store cookie to be sent later
        $this->pendingCookies[] = [
            'name' => $name,
            'value' => $value,
            'expires' => $expires,
            'path' => $path,
            'domain' => $domain,
            'secure' => $secure,
            'httponly' => $httponly,
            'sameSite' => $sameSite
        ];
        
        return $this;
    }
    
    /**
     * Delete cookie
     * 
     * @param string $name
     * @param string $path
     * @param string $domain
     * @return self
     */
    public function withoutCookie(string $name, string $path = '/', string $domain = ''): self
    {
        return $this->cookie($name, '', time() - 3600, $path, $domain);
    }
    
    /**
     * Set cache headers
     * 
     * @param int $minutes
     * @return self
     */
    public function cache(int $minutes): self
    {
        $timestamp = time() + ($minutes * 60);
        $minutes_calc = $minutes * 60;
        $this->header('Cache-Control', "max-age={$minutes_calc}, public");
        $this->header('Expires', gmdate('D, d M Y H:i:s', $timestamp) . ' GMT');
        
        return $this;
    }
    
    /**
     * Disable cache
     * 
     * @return self
     */
    public function noCache(): self
    {
        $this->header('Cache-Control', 'no-cache, no-store, must-revalidate');
        $this->header('Pragma', 'no-cache');
        $this->header('Expires', '0');
        
        return $this;
    }
    
    /**
     * Set CORS headers
     * 
     * @param string $origin
     * @param bool $credentials
     * @return self
     */
    public function cors(string $origin = '*', bool $credentials = true): self
    {
        $this->header('Access-Control-Allow-Origin', $origin);
        $this->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS, PATCH');
        $this->header('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With');
        
        if ($credentials) {
            $this->header('Access-Control-Allow-Credentials', 'true');
        }
        
        return $this;
    }
    
    /**
     * Send response
     */
    public function send(): void
    {
        if ($this->sent) {
            return;
        }
        
        // Send cookies
        if (isset($this->pendingCookies)) {
            foreach ($this->pendingCookies as $cookie) {
                setcookie(
                    $cookie['name'],
                    $cookie['value'],
                    $cookie['expires'],
                    $cookie['path'],
                    $cookie['domain'],
                    $cookie['secure'],
                    $cookie['httponly']
                );
            }
        }
        
        // Send status code
        http_response_code($this->statusCode);
        
        // Send headers
        foreach ($this->headers as $key => $value) {
            header("{$key}: {$value}");
        }
        
        // Send content
        if ($this->content !== null && $this->content !== '') {
            echo $this->content;
        }
        
        $this->sent = true;
    }
    
    /**
     * Check if response was sent
     * 
     * @return bool
     */
    public function isSent(): bool
    {
        return $this->sent;
    }
    
    /**
     * Set content
     * 
     * @param mixed $content
     * @return self
     */
    public function setContent(mixed $content): self
    {
        $this->content = $content;
        return $this;
    }
    
    /**
     * Get content
     * 
     * @return mixed
     */
    public function getContent(): mixed
    {
        return $this->content;
    }
    
    /**
     * Clear response
     * 
     * @return self
     */
    public function clear(): self
    {
        $this->content = null;
        $this->headers = [];
        $this->statusCode = 200;
        
        return $this;
    }
    
    /**
     * Convert to string
     * 
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->content;
    }
}