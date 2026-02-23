<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirect(route('dashboard'), navigate: false);
    }
}; ?>

<div class="relative min-h-screen flex items-center justify-center bg-[#09090b] selection:bg-orange-500/30 selection:text-orange-200 overflow-hidden">
    
    <!-- Animated Ambient Background -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-[10%] -left-[10%] w-[40%] h-[40%] rounded-full bg-orange-600/10 blur-[120px] animate-pulse"></div>
        <div class="absolute -bottom-[10%] -right-[10%] w-[40%] h-[40%] rounded-full bg-orange-900/10 blur-[120px]"></div>
    </div>

    <div class="relative w-full max-w-[440px] px-6 py-12">
        <!-- Logo & Header -->
        <div class="flex flex-col items-center mb-10">
            <a href="{{ route('home') }}" class="group flex items-center gap-2 transition-transform duration-300 hover:scale-105" wire:navigate>
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-orange-600 shadow-lg shadow-orange-600/20 group-hover:rotate-6 transition-transform">
                    <span class="text-2xl font-black text-white italic">R</span>
                </div>
                <span class="text-3xl font-black tracking-tighter text-white uppercase">
                    REVA<span class="text-orange-500">.</span>
                </span>
            </a>
            <h2 class="mt-6 text-xl font-medium text-zinc-200">Welcome back</h2>
            <p class="text-sm text-zinc-500 mt-1">Please enter your details to sign in</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <div class="backdrop-blur-xl bg-zinc-900/40 border border-zinc-800 p-8 rounded-3xl shadow-2xl">
            <form wire:submit="login" class="space-y-5">
                
                <!-- Email -->
                <div class="space-y-1.5">
                    <label for="email" class="text-xs font-semibold uppercase tracking-wider text-zinc-400 ml-1">Email Address</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-zinc-500 group-focus-within:text-orange-500 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                            </svg>
                        </div>
                        <input wire:model="form.email" id="email" type="email" required autofocus 
                            class="block w-full pl-11 pr-4 py-3 bg-zinc-950/50 border border-zinc-800 rounded-2xl text-zinc-200 placeholder-zinc-600 focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 transition-all duration-200 outline-none" 
                            placeholder="name@company.com">
                    </div>
                    <x-input-error :messages="$errors->get('form.email')" class="mt-1" />
                </div>

                <!-- Password -->
                <div class="space-y-1.5">
                    <div class="flex justify-between items-center px-1">
                        <label for="password" class="text-xs font-semibold uppercase tracking-wider text-zinc-400">Password</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" wire:navigate class="text-xs font-medium text-orange-500 hover:text-orange-400 transition-colors">
                                Forgot?
                            </a>
                        @endif
                    </div>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-zinc-500 group-focus-within:text-orange-500 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                            </svg>
                        </div>
                        <input wire:model="form.password" id="password" type="password" required 
                            class="block w-full pl-11 pr-4 py-3 bg-zinc-950/50 border border-zinc-800 rounded-2xl text-zinc-200 placeholder-zinc-600 focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 transition-all duration-200 outline-none" 
                            placeholder="••••••••">
                    </div>
                    <x-input-error :messages="$errors->get('form.password')" class="mt-1" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center px-1">
                    <label class="relative flex items-center cursor-pointer">
                        <input wire:model="form.remember" type="checkbox" class="peer sr-only">
                        <div class="w-5 h-5 bg-zinc-800 border border-zinc-700 rounded-md peer-checked:bg-orange-600 peer-checked:border-orange-600 transition-all flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-white opacity-0 peer-checked:opacity-100 transition-opacity" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <span class="ml-2.5 text-sm text-zinc-400 select-none">Keep me signed in</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="group relative w-full flex items-center justify-center py-3.5 px-4 rounded-2xl bg-orange-600 text-white font-bold text-sm uppercase tracking-widest hover:bg-orange-500 active:scale-[0.98] transition-all duration-200 shadow-lg shadow-orange-900/20">
                    <span>Sign In</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                </button>
            </form>
        </div>

        <!-- Footer Note -->
        <p class="mt-10 text-center text-xs text-zinc-600 font-medium uppercase tracking-[0.2em]">
            &copy; {{ date('Y') }} REVA Industrial Systems
        </p>
    </div>
</div>