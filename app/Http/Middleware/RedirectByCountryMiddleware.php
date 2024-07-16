<?php 
namespace App\Http\Middleware;

use Closure;

use Stevebauman\Location\Facades\Location;
use Illuminate\Http\Request;

class RedirectByCountryMiddleware
{
    
    public function handle(Request $request, Closure $next)
    {
       
       echo $_SERVER["HTTP_CF_IPCOUNTRY"];
    }
}
