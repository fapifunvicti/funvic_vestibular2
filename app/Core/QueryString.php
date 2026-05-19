<?php
namespace App\Core;

class QueryString {
    private array $params = [];

    public function __construct(string $query_string = ''){

        \parse_str($query_string, $this->params);
        $this->sanitize();
    }

    private function sanitize(): void {

        \array_walk_recursive($this->params, function(&$value){
            $value = str_replace("\0", '', $value);
            $value = \str_replace("../", '', $value);
            $value = \strip_tags($value);
            $value = \htmlentities($value, \ENT_QUOTES | \ENT_HTML5, 'UTF-8');
            $value = trim($value);


        });

    }

    public function is_int(string $key) : bool {
        return \is_int($this->get($key)) || is_numeric($this->get($key));
    }

    public function is_bool(string $key) : bool {
        return \is_bool($this->get($key));
    }

    public function is_string(string $key) : bool {
        return \is_string($this->get($key));
    }

    public function is_object(string $key): bool {
        return \is_object($this->get($key));
    }



    public function get(string $key, mixed $default = null): mixed {
            return $this->params[$key] ?? $default;
    }

    public function as_int(string $key, int $default = 0): int{
        return \filter_var($this->get($key) ?? $default, \FILTER_SANITIZE_NUMBER_INT);
    } 

    public function as_float(string $key, float $default = 0.0): int{
        return \filter_var($this->get($key) ?? $default, \FILTER_SANITIZE_NUMBER_FLOAT | \FILTER_FLAG_ALLOW_FRACTION);
    } 

    public function as_bool(string $key, bool $default = false): bool {
        if(!(bool)$this->get($key)) return $default;
        return \filter_var($this->get($key), \FILTER_VALIDATE_BOOLEAN);
    } 

    public function as_str(string $key, string $default = ""): string {
            return \filter_var($this->get($key) ?? $default, \FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }
    
    
    public function has(string $key): string | null {
        return isset($this->params[$key]) ? $this->params[$key] : null; 
    }

    public function all(): array{
        return $this->params;
    }

}