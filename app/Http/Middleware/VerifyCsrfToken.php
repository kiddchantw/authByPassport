<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.      URI 將排除於 CSRF 驗證流程
     *
     * @var array
     */
    protected $except = [
        '*/*',
    ];
}
