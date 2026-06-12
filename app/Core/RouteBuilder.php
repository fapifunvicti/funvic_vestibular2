<?php
namespace App\Core;


final class RouteBuilder {

    public function build(string $route, array $type = []): string {
        return "#^" . \preg_replace_callback('/\{([a-z]+)(?::([^}]+))?\}/', function($matches) use($type) {
            $name = $matches[1];
            $type = $matches[2] ?? ($type[$name] ?? 'string');

            switch($type){
                case 'number':
                case 'int':
                case 'integer':
                case 'numeric':
                    return '(\d+)';

                case 'alpha':
                    return '([a-zA-Z]+)';
            case 'alnum':
                return '([a-zA-Z0-9]+)';
            case 'any':
                return '(.+)';
            default:
                return '([^/]+)';
            }

        }, $route) . "$#";
    }

}