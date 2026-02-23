<?php

namespace App\Livewire\Forms;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ResetPasswordForm extends Form
{
    #[Validate(['required'])]
    public string $token = '';

    #[Validate(['required', 'string', 'email'])]
    public string $email = '';

    public string $password = '';

    public string $password_confirmation = '';

    /**
     * Define validation rules dynamically for complex rules like Password defaults.
     */
    public function rules(): array
    {
        return [
            'token' => ['required'],
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ];
    }

    /**
     * Reset the password for the given user.
     */
    public function resetPassword(): void
    {
        $this->validate();

        $status = Password::reset(
            $this->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) {
                $user->forceFill([
                    'password' => Hash::make($this->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        // Instead of crashing with an Exception, show the error on the email field
        if ($status !== Password::PASSWORD_RESET) {
            $this->addError('email', __($status));
            return;
        }
    }
}