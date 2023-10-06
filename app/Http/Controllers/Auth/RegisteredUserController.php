<?php

namespace App\Http\Controllers\Auth;

use App\Enums\SubscriptionFrequencyEnum;
use App\Enums\SubscriptionServiceEnum;
use App\Events\NewSubscriber;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('auth/register-page');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'role'     => 'user',
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        if ($request->newsletter) {
            $user->subscriptions()->create([
                'subscribed_service' => SubscriptionServiceEnum::NEWSLETTER,
                'frequency'          => SubscriptionFrequencyEnum::IMMEDIATE
            ]);

            event(new NewSubscriber($user->email));
        }

        Auth::login($user);

        return redirect()->route('verification.notice');
    }
}
