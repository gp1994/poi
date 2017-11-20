<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Validator;

use App\Pengguna;

use Auth;

class PenggunaController extends Controller
{
function cekLogin(Request $req){

        $validator = Validator::make($req->all(), [
            
            'usrn' => [
                            'required',
                            'min:3',
                            'exists:pengguna,usrn'

                        ],
            'pwd' => [
                            'required',
                            'min:3',
                        ],
        
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user= $req->usrn;
        $pass = $req->pwd;


        $check = Pengguna::where('usrn',$user)->where('pwd',$pass)->count();

        if( !($check > 0) )  {
             return back()->with('status', 'salah');
        }


        $take = Pengguna::where('usrn',$user)->where('pwd',$pass)->first();

        session(['usrn' => $take->usrn]);
        session(['roles' => $take->roles]);
        session(['pwd' => true ]);

        return back();

    }

    
    function logout(Request $req){

        $req->session()->regenerate();
        $req->session()->flush();
        
        return back();

    }
}
