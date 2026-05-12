<?php
namespace App\Attributes;

#[\Attribute(\Attribute::TARGET_METHOD)]
class Route {
    
    public function __construct(
        public string $path,
        public string $method = 'GET',
        public bool   $is_regex = false
    )
    {
        
    }
};