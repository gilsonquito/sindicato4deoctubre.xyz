<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SoloAdmin
{
    public function handle(Request $request, Closure $next)
    {
        switch(auth::user()->rol){
            case ('1'):
                return $next($request);//si es administrador continua al HOME
            break;
			case('2'):
                return redirect('estudiante');// si es un usuario normal redirige a la ruta USER
			break;	
            case ('3'):
                return redirect('moders');//si es administrador redirige al moderador
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
