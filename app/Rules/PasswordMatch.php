<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class PasswordMatch implements Rule
{
    protected $password;

    public function __construct($password)
    {
        $this->password = $password;
    }

    public function passes($attribute, $value)
    {
        return Hash::check($value, $this->password);
    }

    public function message()
    {
        return 'The provided password does not match your current password.';
    }
}