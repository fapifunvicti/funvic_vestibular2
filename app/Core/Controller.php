<?php
namespace App\Core;


use App\Core\Template;

class Controller {

/**
 * Summary of templates
 * @var Template[]
 */
    private array $templates = [];
    protected string $group = "";

    public function __construct()
    {
        //throw new \Exception('Not implemented');
    }

}

