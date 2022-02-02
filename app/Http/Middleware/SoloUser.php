<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SoloUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        switch(auth::user()->rol){
            case ('1'):
                return redirect('home');//si es administrador redirige al HOME
            break;
			case('2'):
                return $next($request);// si es un usuario continua ruta USER
			break;	
            case ('3'):
                return redirect('moderador');//si es administrador redirige al moderador
            break;
            case('4'):
                return redirect('DIRECTOR/director');/// si es un director redirige a la ruta director
			break;	
            case ('5'):
                return redirect('INSPECTOR/inspector');//si es inspector continua a su ruta inspector
            break;
            case ('6'):
                return redirect('SECRETARIA/secretaria');//si es inspector continua a su ruta scretaria
            break;
        }
    }
}
