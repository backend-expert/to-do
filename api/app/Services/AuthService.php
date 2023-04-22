<?php
namespace App\Services;

use App\Events\UserRegistered;
use App\Exceptions\LoginInvalidException;
use App\Exceptions\UserHasBeenTakenException;
use App\Models\User;
use Illuminate\Support\Str;

class AuthService{

   /**
    * This is a PHP function for logging in with a debug message.
    */
    public function login(string $email, string $password)
    {
        $credencials = [
            'email'=>$email,
            'password'=>$password,
        ];

        // if($token = Auth::attempt(['email' => $email, 'password' => $password]))
        if(!$token = auth()->attempt($credencials)){

            throw new LoginInvalidException(
                'test error'
            );

        };

        return [
            'access_token'=> $token,
            'token_type'=> 'Bearer'

        ];
    }

    public function register(string $first_Name, string $lastName, string $Email, string $Password)
    {
        // dd('register metodo');
        $user = User::where('email', $Email)->exists();
        if (!empty($user))
        {
            throw new UserHasBeenTakenException();
        }

        $user_password = bcrypt($Password ?? Str::random(10));

        $user = User::create([
            'first_name'=>$first_Name,
            'last_name'=>$lastName,
            'email'=>$Email,
            'password'=> $user_password,
            'confirmation_token'=> Str::random(60)

        ]);


        //send email bugado !
        //event(new UserRegistered($user));

        return $user;

    }

    public function verifyEmail()
    {
        dd('verify email');
    }

}
