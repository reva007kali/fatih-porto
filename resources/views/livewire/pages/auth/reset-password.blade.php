<?php

use App\Livewire\Forms\ResetPasswordForm;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public ResetPasswordForm $form;

    /**
     * Mount the component.
     */
    public function mount(string $token): void
    {
        $this->form->token = $token;
        $this->form->email = request()->string('email');
    }

    /**
     * Reset the password for the given user.
     */
    public function resetPassword(): void
    {
        try {
            $this->form->resetPassword();

            session()->flash('status', __('passwords.reset'));

            $this->redirectRoute('login', navigate: true);
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
                        Reset Password
                    </h1>
                 </a>
                 <p class="mt-2 text-lg text-gray-400">
                    Choose a new password for your account
                 </p>
            </div>


            <div
                class="rounded-2xl border border-white/10 bg-white/5 p-8 shadow-2xl shadow-black/20 backdrop-blur-lg">
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form wire:submit="resetPassword" class="space-y-6">
                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" value="Email" class="sr-only" />
                        <x-text-input wire:model="form.email" id="email"
                            class="block w-full rounded-lg border-white/10 bg-white/5 px-4 py-3 text-white placeholder-white/40 focus:border-cyan-500 focus:ring-cyan-500"
                            type="email" name="email" required autofocus autocomplete="username"
                            placeholder="Email" />
                        <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div>
                         <x-input-label for="password" value="Password" class="sr-only" />
                         <x-text-input wire:model="form.password" id="password"
                                class="block w-full rounded-lg border-white/10 bg-white/5 px-4 py-3 text-white placeholder-white/40 focus:border-cyan-500 focus:ring-cyan-500"
                                type="password"
                                name="password"
                                required autocomplete="new-password"
                                placeholder="New Password"/>
                        <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div>
                         <x-input-label for="password_confirmation" value="Confirm Password" class="sr-only" />
                         <x-text-input wire:model="form.password_confirmation" id="password_confirmation"
                                class="block w-full rounded-lg border-white/10 bg-white/5 px-4 py-3 text-white placeholder-white/40 focus:border-cyan-500 focus:ring-cyan-500"
                                type="password"
                                name="password_confirmation"
                                required autocomplete="new-password"
                                placeholder="Confirm New Password"/>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div>
                        <x-primary-button class="flex w-full justify-center rounded-lg bg-gradient-to-r from-cyan-500 to-fuchsia-500 px-4 py-3 font-semibold text-white shadow-lg transition-transform duration-200 ease-in-out hover:scale-105 hover:bg-gradient-to-l hover:shadow-cyan-500/30 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 focus:ring-offset-gray-900">
                            {{ __('Reset Password') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>

             <p class="mt-8 text-center text-sm text-gray-500">
                This is a restricted area. Only authorized users are allowed.
             </p>

        </div>
    </div>
</div>
