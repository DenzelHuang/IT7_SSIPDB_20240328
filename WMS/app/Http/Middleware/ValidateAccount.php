<?php

namespace App\Http\Middleware;

use Closure;

class ValidateAccount
{
    public function handle($request, Closure $next)
    {
        // Logic to check the username
        $username = $request->input('username');

        if (empty($username)) {
            return redirect()->back()->withInput()->withErrors('Username is required');
        }

        // Continue processing the request if the username is valid
        return $next($request);
    }
}
