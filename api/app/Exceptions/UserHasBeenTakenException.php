<?php

namespace App\Exceptions;

use Exception;

class UserHasBeenTakenException extends Exception
{
    protected $message = 'Usuário já existe!';

    public function render()
    {
        return response()->json([
            'error'=>class_basename($this),
            // 'message'=> 'email ou senha inválido!'
            // 'message'=> $this->getMessage()
            'message'=> $this->getMessage()

        ], 400);

    }
}
