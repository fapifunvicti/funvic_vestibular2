<?php
use \App\Core\Request;

function request() : Request {
    return Request::getInstance();
}