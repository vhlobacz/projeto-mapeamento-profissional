<?php

namespace App\Middleware;

use Core\Http\Middleware\Middleware;
use Core\Http\Request;
use Lib\Authentication\Auth;
use Lib\FlashMessage;

class Authenticate implements Middleware
{
    public function handle(Request $request): void
    {
        if (!Auth::check()) {
            FlashMessage::danger('Você deve estar autenticado para acessar esta página');
            $this->redirectTo(route('users.login'));
        }
    }

    private function redirectTo(string $location): void
    {
        header('Location: ' . $location);
        exit;
    }
}
