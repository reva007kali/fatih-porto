<?php

namespace App\Livewire\Forms;

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ForgotPasswordForm extends Form
{
    #[Validate(['required', 'string', 'email'])]
    public string $email = '';

    /**
     * Send a password reset link to the provided email address.
     */
    public function sendPasswordResetLink(): void
    {
        $this->validate();

        $status = Password::sendResetLink(
            $this->only('email')
        );

        // If the status is not "Link Sent", add a validation error to the email field
        if ($status !== Password::RESET_LINK_SENT) {
            $this->addError('email', __($status));
            return;
        }
    }
}