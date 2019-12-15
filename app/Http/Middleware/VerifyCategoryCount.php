<?php

namespace App\Http\Middleware;

use Closure;
use App\Categary;

class VerifyCategoryCount
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if(Categary::all()->count() === 0) { // count the category in the database
             return redirect()->back();  // redirect the back
        }
        return $next($request); // if category have the database then gohead
    }
}
