<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Utama;
use App\Detil;
use \Carbon\Carbon;
use Faker\Factory as Faker;
use DB;
use PDF;
use Session;

class UtamaController extends Controller

{

    public function gmaps()
    {
    	$locations= Utama::orderBy('id')->get();
    	$det=Detil::orderBy('id')->get();
    	return view('gmaps',compact('det','locations'));
    }

    public function infoutama(){
    	$locs= Utama::orderBy('id')->get();
        if (Session::get('roles') == 'admin'){
    	return view('datatable',compact('locs'));
        }
        else{
            return redirect('/');
        }
    }

     public function infodetail(){
        $dets=Detil::orderBy('id')->get();
        if (Session::get('roles') == 'admin'){
        return view('detable',compact('dets'));
        }
        else{
            return redirect('/');
        }
    }

    public function editloc(Request $request){

        $idtempat = $request->input('idloc');
        $name = $request->input('editednama');
        $long = $request->input('editedlong');
        $lat = $request->input('editedlat');
        $loc = Utama::find($idtempat);
        $loc->lokasi=$name;
        $loc->longitude=$long;
        $loc->latitude=$lat;
        $loc->created_at = \Carbon\Carbon::now()->toDateTimeString();
        $loc->updated_at = \Carbon\Carbon::now()->toDateTimeString();
        $loc->last_updated_by=Session::get('usrn');
        $loc->save();
        return redirect ('datatable');
    }

     public function editdet(Request $request){
        $iddesc = $request->input('iddts');
        $detl = $request->input('editeddet');
        $img = $request->file('editedim')->getClientOriginalName();;
        $request->file('editedim')->move(public_path('images'), $img);
        $det = Detil::find($iddesc);
        $det->keterangan=$detl;
        $det->image='images/'.$img;
        $det->update_count=$det->update_count+1;
        $det->created_at = \Carbon\Carbon::now()->toDateTimeString();
        $det->updated_at = \Carbon\Carbon::now()->toDateTimeString();
        $det->last_created_by=Session::get('usrn');
        $det->save();

        
        return redirect ('detable');
    }

    public function storeloc(Request $request)
    {
        $idu = Utama::max('id');
        $nama = $request->input('newnama');
        $long = $request->input('newlong');
        $lat = $request->input('newlat');
        DB::table('info_utama')->insert([
                'id' => $idu + 1,
                'lokasi' => $nama,
                'longitude' => $long,
                'latitude' => $lat,
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'last_updated_by' =>Session::get('usrn')
            ]);
        return redirect ('datatable');
        // echo "Term added successfully.<br/>";
        // echo '<a href="./archive">Click Here</a> to go back';
    }

    public function storedet(Request $request)
    {
        $this->validate($request, [
            'image' => 'mimes:jpeg,bmp,png', //only allow this type extension file.
        ]);
        $idd = Detil::max('id');
        $desc = $request->input('newdet');
        $imgName = $request->file('newim')->getClientOriginalName();
        $request->file('newim')->move(public_path('images'), $imgName);
        DB::table('info_detail')->insert([
                'id' => $idd + 1,
                'keterangan' => $desc,
                'image' => 'images/'.$imgName,
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'last_created_by' =>Session::get('usrn')
            ]);
        return redirect ('detable');
        // echo "Term added successfully.<br/>";
        // echo '<a href="./archive">Click Here</a> to go back';
    }

    public function downloadPDF($idlok){
      $locations= Utama::find($idlok);
      $det = Detil::find($idlok);
      $pdf = PDF::loadView('pdf', compact('det','locations'));
      return $pdf->download('PointOfInterest.pdf');
    }
}