<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\View\Composers\ThemeComposer;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */

    protected function buildRateLimiting (string $message, int $retryAfter, array $headers): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'retry_after' => $retryAfter,
            'available_at' => now()->addSeconds($retryAfter)->timestamp,
        ], 429, $headers);
    }

    public function boot(): void
    {
        Schema::defaultStringLength(191);
        View::composer('components.head', ThemeComposer::class);

        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(15, 5)
            ->by($request->input('email') . '|' . $request->ip())
            ->response(function (Request $request, array $headers) {
                $retry = 300;
                $message = "Trop de tentatives. Réessayez dans" . ceil($retry) . "secondes.";

                session()->put(
                                'rate_limit_expires_at', now()
                                ->addSeconds($retry)
                                ->timestamp
                            );
                session()->put('rate_limit_message', $message);

                if ($request->expectsJson()) {
                    return response()->json([
                                                'message' => $message,
                                                'retry_after' => $retry
                                            ], 429, $headers);
                }

                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors(['email' => $message]);
            });
        });

        RateLimiter::for('register', function (Request $request) {
            return Limit::perMinute(3)
            ->by($request->ip())
            ->response(function (Request $request, array $headers) {
                $retry = (int)
                ($headers['Retry-After'] ?? 60);

                $message = "Trop de tentatives. Réessayez dans {$retry} secondes.";

                if ($request->expectsJson()) {
                    return response()->json([
                                                'message' => $message,
                                                'retry_after' => $retry
                                            ], 429, $headers);
                }

                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors(['email' => $message]);
            });
        });

        RateLimiter::for('verify-code', function (Request $request) {
            return Limit::perMinute(10)
            ->by($request->ip())
            ->response(function (Request $request, array $headers) {
                $retry = (int)
                ($headers['Retry-After'] ?? 60);

                $message = "Trop de tentatives. Réessayez dans {$retry} secondes.";

                session()->put(
                                'rate_limit_expires_at', now()
                                ->addSeconds($retry)
                                ->timestamp
                            );
                session()->put('rate_limit_message', $message);

                if ($request->expectsJson()) {
                    return response()->json([
                                                'message' => $message,
                                                'retry_after' => $retry
                                            ], 429, $headers);
                }

                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors(['email' => $message]);
            });
        });

        RateLimiter::for('email-change', function (Request $request) {
            return Limit::perMinute(3)
            ->by($request->user()->id() ?: $request->ip())
            ->response(function (Request $request, array $headers) {
                $retry = (int)
                ($headers['Retry-After'] ?? 60);

                $message = "Trop de tentatives. Réessayez dans {$retry} secondes.";

                session()->put(
                                'rate_limit_expires_at', now()
                                ->addSeconds($retry)
                                ->timestamp
                            );
                session()->put('rate_limit_message', $message);

                if ($request->expectsJson()) {
                    return response()->json([
                                                'message' => $message,
                                                'retry_after' => $retry
                                            ], 429, $headers);
                }

                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors(['email' => $message]);
            });
        });
    }
}
