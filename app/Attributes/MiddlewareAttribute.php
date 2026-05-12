<?php
namespace App\Attributes;

#[\Attribute(\Attribute::TARGET_CLASS | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
class MiddlewareAttribute {
    public function __construct(public readonly string $handler)
    {
        
    }
}