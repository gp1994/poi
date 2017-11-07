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
            return redirect('/')->withErrors($validator)->withInput();
        }

        $user= $req->usrn;
        $pass = $req->pwd;


        $check = Pengguna::where('usrn',$user)->where('pwd',$pass)->count();

        if( !($check > 0) )  {
             return redirect('/')->with('status', 'salah');
        }


        $take = Pengguna::where('usrn',$user)->where('pwd',$pass)->first();

        session(['usrn' => $take->usrn]);
        session(['roles' => $take->roles]);
        session(['pwd' => true ]);

        return redirect('/');

    }

    
    function logout(Request $req){

        $req->session()->regenerate();
        $req->session()->flush();
        
        return redirect('/');

    }

    function cekLogin2(Request $req){

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
            return redirect('utres')->withErrors($validator)->withInput();
        }

        $user= $req->usrn;
        $pass = $req->pwd;


        $check = Pengguna::where('usrn',$user)->where('pwd',$pass)->count();

        if( !($check > 0) )  {
             return redirect('utres')->with('status', 'salah');
        }


        $take = Pengguna::where('usrn',$user)->where('pwd',$pass)->first();

        session(['usrn' => $take->usrn]);
        session(['roles' => $take->roles]);
        session(['pwd' => true ]);

        return redirect('datatable');

    }

    
    function logout2(Request $req){

        $req->session()->regenerate();
        $req->session()->flush();
        
        return redirect('utres');

    }
    function cekLogin3(Request $req){

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
            return redirect('detres')->withErrors($validator)->withInput();
        }

        $user= $req->usrn;
        $pass = $req->pwd;


        $check = Pengguna::where('usrn',$user)->where('pwd',$pass)->count();

        if( !($check > 0) )  {
             return redirect('detres')->with('status', 'salah');
        }


        $take = Pengguna::where('usrn',$user)->where('pwd',$pass)->first();

        session(['usrn' => $take->usrn]);
        session(['roles' => $take->roles]);
        session(['pwd' => true ]);

        return redirect('detable');

    }

    
    function logout3(Request $req){

        $req->session()->regenerate();
        $req->session()->flush();
        
        return redirect('detres');

    }
}
