<?php

namespace App\Http\Middleware;

use Closure;

class isUser
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

        $q = $request->user;  //get query param user,like http://blahblah.com?user=akhil
        if ($q === "akhil") {
            return $next($request); //success,continue to route ->Controller
        } else { //Oh no,drive him away
            $data = ['status' => 200, 'message' => 'only akhil can enter here'];
            return response()->json($data, $data['status']);
        }
    }
}
