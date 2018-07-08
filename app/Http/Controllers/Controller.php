<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function getUnreadMessCount(){
        $res = false;
        if (isset(auth()->user()->id) && auth()->user()->id > 0) {
            $id = auth()->user()->id;
            $res = DB::table('users_messages')->where('adresat', '=', $id)->where('dateRead','=',null)->count();
        }
        return $res;
    }
}
