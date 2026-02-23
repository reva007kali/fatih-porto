<?php

use App\Livewire\Forms\ForgotPasswordForm;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public ForgotPasswordForm $form;

    /**
     * Send a password reset link to the provided email address.
     */
    public function sendPasswordResetLink(): void
    {
        try {
            $this->form->sendPasswordResetLink();

            session()->flash('status', __('passwords.sent'));
        } catch (\Exception $e) {
            $this->addError('form.email', __($e->getMessage()));
        }
    }
}; ?>

<div class="relative min-h-screen antialiased">
    {{-- Background --}}
    <div class="absolute inset-0 -z-10 bg-gray-950">
        <div aria-hidden="true" class="absolute inset-0 flex items-center justify-center">
            <div
                class="relative h-full w-full max-w-3xl animate-blob-bounce rounded-full bg-gradient-to-tr from-fuchsia-500 to-cyan-500 opacity-20 blur-3xl">
            </div>
        </div>
    </div>

    {{-- Content --}}
    <div class="flex min-h-screen flex-col items-center justify-center p-4">
        <div class="w-full max-w-md">
            <div class="mb-8 text-center">
                 <a href="{{ route('home') }}" class="inline-block" wire:navigate>
                    <h1 class="text-4xl font-black tracking-tighter text-white lg:text-5xl">
                        Forgot Password
                    </h1>
                 </a>
                 <p class="mt-2 text-lg text-gray-400">
                    Enter your email to reset your password
                 </p>
            </div>


            <div
                class="rounded-2xl border border-white/10 bg-white/5 p-8 shadow-2xl shadow-black/20 backdrop-blur-lg">
                <div class="mb-4 text-sm text-gray-400">
                    {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                </div>
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form wire:submit="sendPasswordResetLink" class="space-y-6">
                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" value="Email" class="sr-only" />
                        <x-text-input wire:model="form.email" id="email"
                            class="block w-full rounded-lg border-white/10 bg-white/5 px-4 py-3 text-white placeholder-white/40 focus:border-cyan-500 focus:ring-cyan-500"
                            type="email" name="email" required autofocus
                            placeholder="Email" />
                        <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
                    </div>

                    <div>
                        <x-primary-button class="flex w-full justify-center rounded-lg bg-gradient-to-r from-cyan-500 to-fuchsia-500 px-4 py-3 font-semibold text-white shadow-lg transition-transform duration-200 ease-in-out hover:scale-105 hover:bg-gradient-to-l hover:shadow-cyan-500/30 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 focus:ring-offset-gray-900">
                            {{ __('Email Password Reset Link') }}
                        </x-primary-button>
                    </div>

                    <div class="text-center">
                        <a class="text-sm text-gray-400 hover:text-white" href="{{ route('login') }}" wire:navigate>
                            Back to login
                        </a>
                    </div>
                </form>

            </div>

             <p class="mt-8 text-center text-sm text-gray-500">
                This is a restricted area. Only authorized users are allowed.
             </p>

        </div>
    </div>
</div>
