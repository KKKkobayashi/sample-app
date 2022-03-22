<?php

namespace App\Actions\Fortify;

use Laravel\Fortify\Rules\Password;

trait PasswordValidationRules
{
    /**
     * Get the validation rules used to validate passwords.
     *
     * @return array
     */
    protected function passwordRules()
    {
        $password = new Password;
        $password->withMessage('パスワードは8文字以上で入力してください。');
        return ['required', 'string', $password, 'confirmed'];
    }
}
