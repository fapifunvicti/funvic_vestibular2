<?php

namespace App\Controller\Admin;

use App\Attributes\RouteAttribute;
use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;
use App\Attributes\MiddlewareAttribute;

#[MiddlewareAttribute(\App\Middleware\AuthMiddleware::class)]
class DashboardAdmin extends Controller {

    #[RouteAttribute("/admin/", method:"GET|POST")]
    public function index(Request $request, Response $response): Response {
        
        return $response->html("");
    }
}