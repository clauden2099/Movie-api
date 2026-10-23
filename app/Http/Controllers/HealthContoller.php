<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HealthContoller extends Controller
{
    use ApiResponse;

    /**
     * Cuando un controlador tiene un solo método o solo hace
     * una accion se usa el método __invoke para definirlo
     */
    public function __invoke(): JsonResponse
    {
        return $this->successResponse(['status' => 'ok', 'app' => 'MovieApi'], 'Health Check');
    }
}
