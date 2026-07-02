<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Support\DemoBusinessRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Throwable;

class DemoAccountController extends Controller
{
    public function showLogin()
    {
        return view('auth.login', [
            'demoAccount' => config('demo-account'),
        ]);
    }

    public function login(Request $request)
    {
        if ($request->boolean('quick_demo') || $this->isBlankLogin($request)) {
            $this->loginAsDefaultBusinessAccount();

            return redirect()->route('dashboard')->with('status', 'You are now signed in.');
        }

        $credentials = $request->validate([
            'Email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $databaseUser = $this->findDatabaseUser($credentials['Email'], $credentials['password']);

        if ($databaseUser) {
            $this->loginAsDatabaseUser($databaseUser);

            return redirect()->route('dashboard')->with('status', 'Welcome back, ' . $databaseUser->name . '.');
        }

        $registeredUser = $this->findRegisteredSessionUser($credentials['Email'], $credentials['password']);

        if ($registeredUser) {
            session(['demo_user' => collect($registeredUser)->except('password')->all()]);

            return redirect()->route('dashboard')->with('status', 'Welcome back, ' . $registeredUser['name'] . '.');
        }

        $defaultAccount = config('demo-account');

        if ($credentials['Email'] === $defaultAccount['email'] && $credentials['password'] === $defaultAccount['password']) {
            $this->loginAsDefaultBusinessAccount();

            return redirect()->route('dashboard')->with('status', 'You are now signed in.');
        }

        return back()
            ->withErrors(['Email' => 'The email or password is incorrect.'])
            ->onlyInput('Email');
    }

    public function dashboard()
    {
        $user = session('demo_user');

        if (! $user) {
            return redirect()->route('login')->with('status', 'Please sign in to view the dashboard.');
        }

        $business = DemoBusinessRepository::findByName($user['business'] ?? '')
            ?? DemoBusinessRepository::findByName(config('demo-account.business'));

        $quotes = collect(session('demo_quote_requests', []))
            ->filter(function ($quote) use ($business) {
                if (! $business) {
                    return true;
                }

                return ($quote['preferred_business'] ?? '') === ($business['name'] ?? '');
            })
            ->values();

        if ($quotes->isEmpty() && $business) {
            $quotes = collect([
                [
                    'reference' => 'QR-0001',
                    'customer_name' => 'Sarah Thompson',
                    'phone' => '021 555 019',
                    'email' => 'sarah@example.com',
                    'service' => $business['category'] ?? 'General Service',
                    'location' => $business['location'] ?? 'Auckland',
                    'description' => 'Customer needs a quote and would like a callback this week.',
                    'budget' => '$500 - $1,000',
                    'created_at' => now()->subHours(2)->format('d M Y, h:i A'),
                ],
            ]);
        }

        return view('account.dashboard', [
            'user' => $user,
            'business' => $business,
            'quotes' => $quotes,
        ]);
    }

    public function logout(Request $request)
    {
        $request->session()->forget('demo_user');

        return redirect()->route('home')->with('status', 'You have been logged out.');
    }

    private function isBlankLogin(Request $request): bool
    {
        return trim((string) $request->input('Email', '')) === ''
            && trim((string) $request->input('password', '')) === '';
    }

    private function findDatabaseUser(string $email, string $password): ?User
    {
        try {
            $user = User::where('email', $email)->first();

            if ($user && Hash::check($password, $user->password)) {
                return $user;
            }
        } catch (Throwable $exception) {
            report($exception);
        }

        return null;
    }

    private function loginAsDatabaseUser(User $user): void
    {
        session([
            'demo_user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'business' => $user->business_name ?: config('demo-account.business'),
                'type' => 'business',
            ],
        ]);
    }

    private function loginAsDefaultBusinessAccount(): void
    {
        $defaultAccount = config('demo-account');
        $user = $this->ensureDefaultDatabaseUser($defaultAccount);

        session([
            'demo_user' => [
                'id' => $user?->id,
                'name' => $defaultAccount['name'],
                'email' => $defaultAccount['email'],
                'business' => $defaultAccount['business'],
                'type' => 'business',
            ],
        ]);
    }

    private function ensureDefaultDatabaseUser(array $defaultAccount): ?User
    {
        try {
            return User::updateOrCreate(
                ['email' => $defaultAccount['email']],
                [
                    'name' => $defaultAccount['name'],
                    'business_name' => $defaultAccount['business'],
                    'password' => $defaultAccount['password'],
                ]
            );
        } catch (Throwable $exception) {
            report($exception);

            return null;
        }
    }

    private function findRegisteredSessionUser(string $email, string $password): ?array
    {
        return collect(session('registered_demo_users', []))->first(function ($user) use ($email, $password) {
            return ($user['email'] ?? '') === $email && ($user['password'] ?? '') === $password;
        });
    }
}
