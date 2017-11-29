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
use Validator;
use App\Log;

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

    public function editloc(Request $request){

        $idtempat = $request->input('idloc');
        $oname = $request->input('oeditednama');
        $name = $request->input('editednama');
        $olong = $request->input('oeditedlong');
        $long = $request->input('editedlong');
        $olat = $request->input('oeditedlat');
        $lat = $request->input('editedlat');
        $loc = Utama::find($idtempat);
        $loc->olokasi=$oname;
        $loc->lokasi=$name;
        $loc->olongitude=$olong;
        $loc->longitude=$long;
        $loc->olatitude=$olat;
        $loc->latitude=$lat;
        $loc->created_at = \Carbon\Carbon::now()->toDateTimeString();
        $loc->updated_at = \Carbon\Carbon::now()->toDateTimeString();
        $loc->last_updated_by=Session::get('peng');
        UtamaController::editLog($loc,'POI');
        $loc->save();
        return redirect ('datatable');
    }

     public function editdet(Request $request){
        $iddesc = $request->input('iddts');
        $odetl = $request->input('oediteddet');
        $detl = $request->input('editeddet');
        $dat = $request->input('edtim');
        $dat2 = $request->input('edtim2');
        $dat3 = $request->input('edtim3');
        $dat4 = $request->input('edtim4');
        $dat5 = $request->input('edtim5');
        $dat6 = $request->input('edtim6');
        $dat7 = $request->input('edtim7');
        $dat8 = $request->input('edtim8');
        $dat9 = $request->input('edtim9');
        $dat10 = $request->input('edtim10');
        $bid = $request->input('edtvid');
        $odat = $request->input('oedtim');
        $odat2 = $request->input('oedtim2');
        $odat3 = $request->input('oedtim3');
        $odat4 = $request->input('oedtim4');
        $odat5 = $request->input('oedtim5');
        $odat6 = $request->input('oedtim6');
        $odat7 = $request->input('oedtim7');
        $odat8 = $request->input('oedtim8');
        $odat9 = $request->input('oedtim9');
        $odat10 = $request->input('oedtim10');
        $obid = $request->input('oedtvid');
        $det = Detil::find($iddesc);
        $img = $request->file('editedim');
        $img2 = $request->file('editedim2');
        $img3 = $request->file('editedim3');
        $img4 = $request->file('editedim4');
        $img5 = $request->file('editedim5');
        $img6 = $request->file('editedim6');
        $img7 = $request->file('editedim7');
        $img8 = $request->file('editedim8');
        $img9 = $request->file('editedim9');
        $img10 = $request->file('editedim10');
        $bd = $request->file('editedvid');
        $det->oketerangan=$odetl;
        $det->keterangan=$detl;
        if (!empty ($img)){
        $ext1 = $request->file('editedim')->getClientOriginalExtension();
        if ($ext1 == 'jpg' || $ext1 == 'png'){
        $img = $request->file('editedim')->getClientOriginalName();
        $request->file('editedim')->move(public_path('images'), $img);
        $det->image='images/'.$img;
        $det->oimage = $odat;
        }
        else{
        Session::flash('fmsg','Video or Picture(s) Update Failed');
        }
        }
        else{
        $det->image=$odat;
        $det->oimage = $odat;
        }

        if (!empty ($img2)){
        $ext2 = $request->file('editedim2')->getClientOriginalExtension();
        if ($ext2 == 'jpg' || $ext2 == 'png'){
        $img2 = $request->file('editedim2')->getClientOriginalName();
        $request->file('editedim2')->move(public_path('images'), $img2);
        $det->image2='images/'.$img2;
        $det->oimage2 = $odat2;
        }
        else{
        Session::flash('fmsg', 'Video or Picture(s) Update Failed');
        }
        }   
        else{
        $det->image2=$odat2;
        $det->oimage2 = $odat2;
        }
        if (!empty ($img3)){
        $ext3 = $request->file('editedim3')->getClientOriginalExtension();
        if ($ext3 == 'jpg' || $ext3 == 'png'){
        $img3 = $request->file('editedim3')->getClientOriginalName();
        $request->file('editedim3')->move(public_path('images'), $img3);
        $det->image3='images/'.$img3;
        $det->oimage3 = $odat3;
        }
        else{
        Session::flash('fmsg', 'Video or Picture(s) Update Failed');
        }
        }
        else{
        $det->image3=$odat3;
        $det->oimage3 = $odat3;
        }
        if (!empty ($img4)){
        $ext4 = $request->file('editedim4')->getClientOriginalExtension();
        if ($ext4 == 'jpg' || $ext4 == 'png'){
        $img4 = $request->file('editedim4')->getClientOriginalName();
        $request->file('editedim4')->move(public_path('images'), $img4);
        $det->image4='images/'.$img4;
        $det->oimage4 = $odat4;
        }
        else{
        Session::flash('fmsg', 'Video or Picture(s) Update Failed');
        }
        }
        else{
        $det->image4=$odat4;
        $det->oimage4 = $odat4;
        }
        if (!empty ($img5)){
        $ext5 = $request->file('editedim5')->getClientOriginalExtension();
        if ($ext5 == 'jpg' || $ext5 == 'png'){
        $img5 = $request->file('editedim5')->getClientOriginalName();
        $request->file('editedim5')->move(public_path('images'), $img5);
        $det->image5='images/'.$img5;
        $det->oimage5 = $odat5;
        }
        else{
        Session::flash('fmsg', 'Video or Picture(s) Update Failed');
        }
        }
        else{
        $det->image5=$odat5;
        $det->oimage5 = $odat5;
        }
        if (!empty ($img6)){
        $ext6 = $request->file('editedim6')->getClientOriginalExtension();
        if ($ext6 == 'jpg' || $ext6 == 'png'){
        $img6 = $request->file('editedim6')->getClientOriginalName();
        $request->file('editedim6')->move(public_path('images'), $img6);
        $det->image6='images/'.$img6;
        $det->oimage6 = $odat6;
        }
        else{
        Session::flash('fmsg', 'Video or Picture(s) Update Failed');
        }
        }
        else{
        $det->image6 = $odat6;
        $det->oimage6 = $odat6;
        }
        if (!empty ($img7)){
        $ext7 = $request->file('editedim7')->getClientOriginalExtension();
        if ($ext7 == 'jpg' || $ext7 == 'png'){
        $img7 = $request->file('editedim7')->getClientOriginalName();
        $request->file('editedim7')->move(public_path('images'), $img7);
        $det->image7='images/'.$img7;
        $det->oimage7 = $odat7;
        }
        else{
        Session::flash('fmsg', 'Video or Picture(s) Update Failed');
        }
        }
        else{
        $det->image7=$odat7;
        $det->oimage7 = $odat7;
        }
        if (!empty ($img8)){
        $ext8 = $request->file('editedim8')->getClientOriginalExtension();
        if ($ext8 == 'jpg' || $ext8 == 'png'){
        $img8 = $request->file('editedim8')->getClientOriginalName();
        $request->file('editedim8')->move(public_path('images'), $img8);
        $det->image8='images/'.$img8;
        $det->oimage8 = $odat8;
        }
        else{
        Session::flash('fmsg', 'Video or Picture(s) Update Failed');
        }
        }
        else{
        $det->image8=$odat8;
        $det->oimage8 = $odat8;
        }
        if (!empty ($img9)){
        $ext9 = $request->file('editedim9')->getClientOriginalExtension();
        if ($ext9 == 'jpg' || $ext9 == 'png'){
        $img9 = $request->file('editedim9')->getClientOriginalName();
        $request->file('editedim9')->move(public_path('images'), $img9);
        $det->image9='images/'.$img9;
        $det->oimage9 = $odat9;
        }
        else{
        Session::flash('fmsg', 'Video or Picture(s) Update Failed');
        }
        }
        else{
        $det->image9=$odat9;
        $det->oimage9 = $odat9;
        }
        if (!empty ($img10)){
        $ext10 = $request->file('editedim10')->getClientOriginalExtension();
        if ($ext10 == 'jpg' || $ext10 == 'png'){
        $img10 = $request->file('editedim10')->getClientOriginalName();
        $request->file('editedim10')->move(public_path('images'), $img10);
        $det->image10='images/'.$img10;
        $det->oimage10 = $odat10;
        }
        else{
        Session::flash('fmsg', 'Video or Picture(s) Update Failed');
        }
        }
        else{
        $det->image10=$odat10;
        $det->oimage10 = $odat10;
        }
        if (!empty ($bd)){
        $ext11 = $request->file('editedvid')->getClientOriginalExtension();
        if ($ext11 == 'mp4'){
        $bd= $request->file('editedvid')->getClientOriginalName();
        $request->file('editedvid')->move(public_path('videos'), $bd);
        $det->videos='videos/'.$bd;
        $det->ovideos = $obid;
        }
        else{
        Session::flash('fmsg', 'Video or Picture(s) Update Failed');
        }
        }
        else{
        $det->videos=$obid;
        $det->ovideos = $obid;
        }

        if($det->isDirty('keterangan') || $det->isDirty('image') || $det->isDirty('image2') || $det->isDirty('image3') || $det->isDirty('image4') || $det->isDirty('image5') || $det->isDirty('image6') || $det->isDirty('image7') || $det->isDirty('image8') || $det->isDirty('image9') || $det->isDirty('image10')|| $det->isDirty('videos')||$det->isDirty('oketerangan') || $det->isDirty('oimage') || $det->isDirty('oimage2') || $det->isDirty('oimage3') || $det->isDirty('oimage4') || $det->isDirty('oimage5') || $det->isDirty('oimage6') || $det->isDirty('oimage7') || $det->isDirty('oimage8') || $det->isDirty('oimage9') || $det->isDirty('oimage10')|| $det->isDirty('ovideos')){
        $det->update_count=$det->update_count+1;
        $det->created_at = \Carbon\Carbon::now()->toDateTimeString();
        $det->updated_at = \Carbon\Carbon::now()->toDateTimeString();
        $det->last_created_by=Session::get('peng');
        }
        
        UtamaController::editLog($det,'Detail');
        $det->save();
        return redirect()->back();

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
                'last_updated_by' =>Session::get('peng')
            ]);
        $utam = Utama::find($idu);
        UtamaController::storeLog($utam,'POI');
        return redirect ('datatable');
        // echo "Term added successfully.<br/>";
        // echo '<a href="./archive">Click Here</a> to go back';
    }

    public function storedet(Request $request)
    {
        $idd = Detil::max('id');
        $desc = $request->input('newdet');
        $newim = array();
        $bd = $request->file('newvid');
        if($files=$request->file('newim')){
            foreach($files as $file){
                $ext2 = $file->getClientOriginalExtension();
                if ($ext2 == 'jpg'|| $ext2 =='png'){
                $name=$file->getClientOriginalName();
                $file->move(public_path('images'),$name);
                $newim[]=$name;
                }
                else{
                Session::flash('fmsg', 'Upload Failed or Some Multiple Files Not Uploaded');
                }
            }
        }
        
        if (count($newim)==0 ){
        if (!empty($bd)){
        $ext = $request->file('newvid')->getClientOriginalExtension();
        if ($ext == 'mp4'){
        $bd= $request->file('newvid')->getClientOriginalName();
        $request->file('newvid')->move(public_path('videos'), $bd);
         DB::table('info_detail')->insert([
            'id' => $idd + 1,
            'keterangan' => $desc,
            'videos' => 'videos/'. $bd,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'last_created_by' =>Session::get('peng')
            ]);


        }
        else{
        Session::flash('fmsg', 'Upload Failed or Some Multiple Files Not Uploaded');
        DB::table('info_detail')->insert([
            'id' => $idd + 1,
            'keterangan' => $desc,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'last_created_by' =>Session::get('peng')
            ]);

        }
        }
        else{
            DB::table('info_detail')->insert([
            'id' => $idd + 1,
            'keterangan' => $desc,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'last_created_by' =>Session::get('peng')
            ]);

        }     
        }

        if(count($newim)==1){
        if (!empty($bd)){
        $ext = $request->file('newvid')->getClientOriginalExtension();
        if ($ext == 'mp4'){
        $bd= $request->file('newvid')->getClientOriginalName();
        $request->file('newvid')->move(public_path('videos'), $bd);
        DB::table('info_detail')->insert([
            'id' => $idd + 1,
            'keterangan' => $desc,
            'image' => 'images/'.$newim[0],
            'videos' => 'videos/'. $bd,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'last_created_by' =>Session::get('peng')
            ]);
       
   }
        else{
            Session::flash('fmsg', 'Upload Failed or Some Multiple Files Not Uploaded');
             DB::table('info_detail')->insert([
            'id' => $idd + 1,
            'keterangan' => $desc,
            'image' => 'images/'.$newim[0],
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
           'last_created_by' =>Session::get('peng')
            ]);

        }
        }
        else{
             DB::table('info_detail')->insert([
            'id' => $idd + 1,
            'keterangan' => $desc,
            'image' => 'images/'.$newim[0],
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'last_created_by' =>Session::get('peng')
            ]);

        }
        }

        if(count($newim)==2){
        if (!empty($bd)){
        $ext = $request->file('newvid')->getClientOriginalExtension();
        if ($ext == 'mp4'){
        $bd= $request->file('newvid')->getClientOriginalName();
        $request->file('newvid')->move(public_path('videos'), $bd);
        DB::table('info_detail')->insert([
            'id' => $idd + 1,
            'keterangan' => $desc,
            'image' => 'images/'.$newim[0],
            'image2' => 'images/'.$newim[1],
            'videos' => 'videos/'. $bd,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'last_created_by' =>Session::get('peng')
            ]);
 
        }
        else{
            Session::flash('fmsg', 'Upload Failed or Some Multiple Files Not Uploaded');
            DB::table('info_detail')->insert([
            'id' => $idd + 1,
            'keterangan' => $desc,
            'image' => 'images/'.$newim[0],
            'image2' => 'images/'.$newim[1],
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'last_created_by' =>Session::get('peng')
            ]);
   
        }
        }
        else{
             DB::table('info_detail')->insert([
            'id' => $idd + 1,
            'keterangan' => $desc,
            'image' => 'images/'.$newim[0],
            'image2' => 'images/'.$newim[1],
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'last_created_by' =>Session::get('peng')
            ]);

        }
        }

        if(count($newim)==3){
        if (!empty($bd)){
        $ext = $request->file('newvid')->getClientOriginalExtension();
        if ($ext == 'mp4'){
        $bd= $request->file('newvid')->getClientOriginalName();
        $request->file('newvid')->move(public_path('videos'), $bd);
        DB::table('info_detail')->insert([
            'id' => $idd + 1,
            'keterangan' => $desc,
            'image' => 'images/'.$newim[0],
            'image2' => 'images/'.$newim[1],
            'image3' => 'images/'.$newim[2],
            'videos' => 'videos/'. $bd,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'last_created_by' =>Session::get('peng')
            ]);

        }
        else{
            Session::flash('fmsg', 'Upload Failed or Some Multiple Files Not Uploaded');
            DB::table('info_detail')->insert([
            'id' => $idd + 1,
            'keterangan' => $desc,
            'image' => 'images/'.$newim[0],
            'image2' => 'images/'.$newim[1],
            'image3' => 'images/'.$newim[2],
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'last_created_by' =>Session::get('peng')
            ]);

        }
        }
        else{
             DB::table('info_detail')->insert([
            'id' => $idd + 1,
            'keterangan' => $desc,
            'image' => 'images/'.$newim[0],
            'image2' => 'images/'.$newim[1],
            'image3' => 'images/'.$newim[2],
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'last_created_by' =>Session::get('peng')
            ]);

        }
        }

        if(count($newim)==4){
        if (!empty($bd)){
        $ext = $request->file('newvid')->getClientOriginalExtension();
        if ($ext == 'mp4'){
        $bd= $request->file('newvid')->getClientOriginalName();
        $request->file('newvid')->move(public_path('videos'), $bd);
        DB::table('info_detail')->insert([
            'id' => $idd + 1,
            'keterangan' => $desc,
            'image' => 'images/'.$newim[0],
            'image2' => 'images/'.$newim[1],
            'image3' => 'images/'.$newim[2],
            'image4' => 'images/'.$newim[3],
            'videos' => 'videos/'.$bd,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'last_created_by' =>Session::get('peng')
            ]);

        }
        else{
            Session::flash('fmsg', 'Upload Failed or Some Multiple Files Not Uploaded');
            DB::table('info_detail')->insert([
            'id' => $idd + 1,
            'keterangan' => $desc,
            'image' => 'images/'.$newim[0],
            'image2' => 'images/'.$newim[1],
            'image3' => 'images/'.$newim[2],
            'image4' => 'images/'.$newim[3],
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'last_created_by' =>Session::get('peng')
            ]);

        }
        }
        else{
             DB::table('info_detail')->insert([
            'id' => $idd + 1,
            'keterangan' => $desc,
            'image' => 'images/'.$newim[0],
            'image2' => 'images/'.$newim[1],
            'image3' => 'images/'.$newim[2],
            'image4' => 'images/'.$newim[3],
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'last_created_by' =>Session::get('peng')
            ]);

        }
        }

        if(count($newim)==5){
         if (!empty($bd)){
        $ext = $request->file('newvid')->getClientOriginalExtension();
        if ($ext == 'mp4'){
        $bd= $request->file('newvid')->getClientOriginalName();
        $request->file('newvid')->move(public_path('videos'), $bd);
        DB::table('info_detail')->insert([
            'id' => $idd + 1,
            'keterangan' => $desc,
            'image' => 'images/'.$newim[0],
            'image2' => 'images/'.$newim[1],
            'image3' => 'images/'.$newim[2],
            'image4' => 'images/'.$newim[3],
            'image5' => 'images/'.$newim[4],
            'videos' => 'videos/'. $bd,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'last_created_by' =>Session::get('peng')
            ]);

        }
        else{
            Session::flash('fmsg', 'Upload Failed or Some Multiple Files Not Uploaded');
             DB::table('info_detail')->insert([
            'id' => $idd + 1,
            'keterangan' => $desc,
            'image' => 'images/'.$newim[0],
            'image2' => 'images/'.$newim[1],
            'image3' => 'images/'.$newim[2],
            'image4' => 'images/'.$newim[3],
            'image5' => 'images/'.$newim[4],
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'last_created_by' =>Session::get('peng')
            ]);

        }
        }
        else{
            DB::table('info_detail')->insert([
            'id' => $idd + 1,
            'keterangan' => $desc,
            'image' => 'images/'.$newim[0],
            'image2' => 'images/'.$newim[1],
            'image3' => 'images/'.$newim[2],
            'image4' => 'images/'.$newim[3],
            'image5' => 'images/'.$newim[4],
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'last_created_by' =>Session::get('peng')
            ]);

        }
        }

        if(count($newim)==6){
        if (!empty($bd)){
        $ext = $request->file('newvid')->getClientOriginalExtension();
        if ($ext == 'mp4'){
        $bd= $request->file('newvid')->getClientOriginalName();
        $request->file('newvid')->move(public_path('videos'), $bd);
        DB::table('info_detail')->insert([
            'id' => $idd + 1,
            'keterangan' => $desc,
            'image' => 'images/'.$newim[0],
            'image2' => 'images/'.$newim[1],
            'image3' => 'images/'.$newim[2],
            'image4' => 'images/'.$newim[3],
            'image5' => 'images/'.$newim[4],
            'image6' => 'images/'.$newim[5],
            'videos' => 'videos/'. $bd,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'last_created_by' =>Session::get('peng')
            ]);
        }
        else{
            Session::flash('fmsg', 'Upload Failed or Some Multiple Files Not Uploaded');
             DB::table('info_detail')->insert([
            'id' => $idd + 1,
            'keterangan' => $desc,
            'image' => 'images/'.$newim[0],
            'image2' => 'images/'.$newim[1],
            'image3' => 'images/'.$newim[2],
            'image4' => 'images/'.$newim[3],
            'image5' => 'images/'.$newim[4],
            'image6' => 'images/'.$newim[5],
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'last_created_by' =>Session::get('peng')
            ]);
        }
        }
        else{
            DB::table('info_detail')->insert([
            'id' => $idd + 1,
            'keterangan' => $desc,
            'image' => 'images/'.$newim[0],
            'image2' => 'images/'.$newim[1],
            'image3' => 'images/'.$newim[2],
            'image4' => 'images/'.$newim[3],
            'image5' => 'images/'.$newim[4],
            'image6' => 'images/'.$newim[5],
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'last_created_by' =>Session::get('peng')
            ]);
        }
        }

        if(count($newim)==7){
        if (!empty($bd)){
        $ext = $request->file('newvid')->getClientOriginalExtension();
        if ($ext == 'mp4'){
        $bd= $request->file('newvid')->getClientOriginalName();
        $request->file('newvid')->move(public_path('videos'), $bd);
        DB::table('info_detail')->insert([
            'id' => $idd + 1,
            'keterangan' => $desc,
            'image' => 'images/'.$newim[0],
            'image2' => 'images/'.$newim[1],
            'image3' => 'images/'.$newim[2],
            'image4' => 'images/'.$newim[3],
            'image5' => 'images/'.$newim[4],
            'image6' => 'images/'.$newim[5],
            'image7' => 'images/'.$newim[6],
            'videos' => 'videos/'. $bd,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'last_created_by' =>Session::get('peng')
            ]);
        }
        else{
            Session::flash('fmsg', 'Upload Failed or Some Multiple Files Not Uploaded');
             DB::table('info_detail')->insert([
            'id' => $idd + 1,
            'keterangan' => $desc,
            'image' => 'images/'.$newim[0],
            'image2' => 'images/'.$newim[1],
            'image3' => 'images/'.$newim[2],
            'image4' => 'images/'.$newim[3],
            'image5' => 'images/'.$newim[4],
            'image6' => 'images/'.$newim[5],
            'image7' => 'images/'.$newim[6],
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'last_created_by' =>Session::get('peng')
            ]);
        }
        }
        else{
             DB::table('info_detail')->insert([
            'id' => $idd + 1,
            'keterangan' => $desc,
            'image' => 'images/'.$newim[0],
            'image2' => 'images/'.$newim[1],
            'image3' => 'images/'.$newim[2],
            'image4' => 'images/'.$newim[3],
            'image5' => 'images/'.$newim[4],
            'image6' => 'images/'.$newim[5],
            'image7' => 'images/'.$newim[6],
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'last_created_by' =>Session::get('peng')
            ]);
        }
        }

        if(count($newim)==8){
        if (!empty($bd)){
        $ext = $request->file('newvid')->getClientOriginalExtension();
        if ($ext == 'mp4'){
        $bd= $request->file('newvid')->getClientOriginalName();
        $request->file('newvid')->move(public_path('videos'), $bd);
        DB::table('info_detail')->insert([
            'id' => $idd + 1,
            'keterangan' => $desc,
            'image' => 'images/'.$newim[0],
            'image2' => 'images/'.$newim[1],
            'image3' => 'images/'.$newim[2],
            'image4' => 'images/'.$newim[3],
            'image5' => 'images/'.$newim[4],
            'image6' => 'images/'.$newim[5],
            'image7' => 'images/'.$newim[6],
            'image8' => 'images/'.$newim[7],
            'videos' => 'videos/'. $bd,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'last_created_by' =>Session::get('peng')
            ]);
        }
        else{
             Session::flash('fmsg', 'Upload Failed or Some Multiple Files Not Uploaded');
              DB::table('info_detail')->insert([
            'id' => $idd + 1,
            'keterangan' => $desc,
            'image' => 'images/'.$newim[0],
            'image2' => 'images/'.$newim[1],
            'image3' => 'images/'.$newim[2],
            'image4' => 'images/'.$newim[3],
            'image5' => 'images/'.$newim[4],
            'image6' => 'images/'.$newim[5],
            'image7' => 'images/'.$newim[6],
            'image8' => 'images/'.$newim[7],
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'last_created_by' =>Session::get('peng')
            ]);
        }
        }
        else{
            DB::table('info_detail')->insert([
            'id' => $idd + 1,
            'keterangan' => $desc,
            'image' => 'images/'.$newim[0],
            'image2' => 'images/'.$newim[1],
            'image3' => 'images/'.$newim[2],
            'image4' => 'images/'.$newim[3],
            'image5' => 'images/'.$newim[4],
            'image6' => 'images/'.$newim[5],
            'image7' => 'images/'.$newim[6],
            'image8' => 'images/'.$newim[7],
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'last_created_by' =>Session::get('peng')
            ]);
        }
        }

        if(count($newim)==9){
        if (!empty($bd)){
        $ext = $request->file('newvid')->getClientOriginalExtension();
        if ($ext == 'mp4'){
        $bd= $request->file('newvid')->getClientOriginalName();
        $request->file('newvid')->move(public_path('videos'), $bd);
        DB::table('info_detail')->insert([
            'id' => $idd + 1,
            'keterangan' => $desc,
            'image' => 'images/'.$newim[0],
            'image2' => 'images/'.$newim[1],
            'image3' => 'images/'.$newim[2],
            'image4' => 'images/'.$newim[3],
            'image5' => 'images/'.$newim[4],
            'image6' => 'images/'.$newim[5],
            'image7' => 'images/'.$newim[6],
            'image8' => 'images/'.$newim[7],
            'image9' => 'images/'.$newim[8],
            'videos' => 'videos/'. $bd,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'last_created_by' =>Session::get('peng')
            ]);
        }
        else{
             Session::flash('fmsg', 'Upload Failed or Some Multiple Files Not Uploaded');
             DB::table('info_detail')->insert([
            'id' => $idd + 1,
            'keterangan' => $desc,
            'image' => 'images/'.$newim[0],
            'image2' => 'images/'.$newim[1],
            'image3' => 'images/'.$newim[2],
            'image4' => 'images/'.$newim[3],
            'image5' => 'images/'.$newim[4],
            'image6' => 'images/'.$newim[5],
            'image7' => 'images/'.$newim[6],
            'image8' => 'images/'.$newim[7],
            'image9' => 'images/'.$newim[8],
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'last_created_by' =>Session::get('peng')
            ]);
        }
        }
        else{
             DB::table('info_detail')->insert([
            'id' => $idd + 1,
            'keterangan' => $desc,
            'image' => 'images/'.$newim[0],
            'image2' => 'images/'.$newim[1],
            'image3' => 'images/'.$newim[2],
            'image4' => 'images/'.$newim[3],
            'image5' => 'images/'.$newim[4],
            'image6' => 'images/'.$newim[5],
            'image7' => 'images/'.$newim[6],
            'image8' => 'images/'.$newim[7],
            'image9' => 'images/'.$newim[8],
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'last_created_by' =>Session::get('peng')
            ]);
        }
        }

        if(count($newim)==10){
        if (!empty($bd)){
        $ext = $request->file('newvid')->getClientOriginalExtension();
        if ($ext == 'mp4'){
        $bd= $request->file('newvid')->getClientOriginalName();
        $request->file('newvid')->move(public_path('videos'), $bd);
        DB::table('info_detail')->insert([
            'id' => $idd + 1,
            'keterangan' => $desc,
            'image' => 'images/'.$newim[0],
            'image2' => 'images/'.$newim[1],
            'image3' => 'images/'.$newim[2],
            'image4' => 'images/'.$newim[3],
            'image5' => 'images/'.$newim[4],
            'image6' => 'images/'.$newim[5],
            'image7' => 'images/'.$newim[6],
            'image8' => 'images/'.$newim[7],
            'image9' => 'images/'.$newim[8],
            'image10' => 'images/'.$newim[9],
            'videos' => 'videos/'. $bd,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'last_created_by' =>Session::get('peng')
            ]);

        }
        else{
             Session::flash('fmsg', 'Upload Failed or Some Multiple Files Not Uploaded');
             DB::table('info_detail')->insert([
            'id' => $idd + 1,
            'keterangan' => $desc,
            'image' => 'images/'.$newim[0],
            'image2' => 'images/'.$newim[1],
            'image3' => 'images/'.$newim[2],
            'image4' => 'images/'.$newim[3],
            'image5' => 'images/'.$newim[4],
            'image6' => 'images/'.$newim[5],
            'image7' => 'images/'.$newim[6],
            'image8' => 'images/'.$newim[7],
            'image9' => 'images/'.$newim[8],
            'image10' => 'images/'.$newim[9],
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
           'last_created_by' =>Session::get('peng')
            ]);
        }
        }
        else{
             DB::table('info_detail')->insert([
            'id' => $idd + 1,
            'keterangan' => $desc,
            'image' => 'images/'.$newim[0],
            'image2' => 'images/'.$newim[1],
            'image3' => 'images/'.$newim[2],
            'image4' => 'images/'.$newim[3],
            'image5' => 'images/'.$newim[4],
            'image6' => 'images/'.$newim[5],
            'image7' => 'images/'.$newim[6],
            'image8' => 'images/'.$newim[7],
            'image9' => 'images/'.$newim[8],
            'image10' => 'images/'.$newim[9],
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'last_created_by' =>Session::get('peng')
            ]);
        }
        }
        if(count($newim)>10){
        if (!empty($bd)){
        $ext = $request->file('newvid')->getClientOriginalExtension();
        if ($ext == 'mp4'){
        $bd= $request->file('newvid')->getClientOriginalName();
        $request->file('newvid')->move(public_path('videos'), $bd);
        Session::flash('fmsg', 'Multi Upload Reached Maximum, Some May Not Uploaded');
        DB::table('info_detail')->insert([
            'id' => $idd + 1,
            'keterangan' => $desc,
            'image' => 'images/'.$newim[0],
            'image2' => 'images/'.$newim[1],
            'image3' => 'images/'.$newim[2],
            'image4' => 'images/'.$newim[3],
            'image5' => 'images/'.$newim[4],
            'image6' => 'images/'.$newim[5],
            'image7' => 'images/'.$newim[6],
            'image8' => 'images/'.$newim[7],
            'image9' => 'images/'.$newim[8],
            'image10' => 'images/'.$newim[9],
            'videos' => 'videos/'. $bd,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'last_created_by' =>Session::get('peng')
            ]);
        }
        else{
             Session::flash('fmsg', 'Multi Upload Reached Maximum and Video Not Uploaded');
             DB::table('info_detail')->insert([
            'id' => $idd + 1,
            'keterangan' => $desc,
            'image' => 'images/'.$newim[0],
            'image2' => 'images/'.$newim[1],
            'image3' => 'images/'.$newim[2],
            'image4' => 'images/'.$newim[3],
            'image5' => 'images/'.$newim[4],
            'image6' => 'images/'.$newim[5],
            'image7' => 'images/'.$newim[6],
            'image8' => 'images/'.$newim[7],
            'image9' => 'images/'.$newim[8],
            'image10' => 'images/'.$newim[9],
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'last_created_by' =>Session::get('peng')
            ]);
        }
        }
        else{
             Session::flash('fmsg', 'Multi Upload Reached Maximum, Some May Not Uploaded');
             DB::table('info_detail')->insert([
            'id' => $idd + 1,
            'keterangan' => $desc,
            'image' => 'images/'.$newim[0],
            'image2' => 'images/'.$newim[1],
            'image3' => 'images/'.$newim[2],
            'image4' => 'images/'.$newim[3],
            'image5' => 'images/'.$newim[4],
            'image6' => 'images/'.$newim[5],
            'image7' => 'images/'.$newim[6],
            'image8' => 'images/'.$newim[7],
            'image9' => 'images/'.$newim[8],
            'image10' => 'images/'.$newim[9],
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'last_created_by' =>Session::get('peng')
            ]);
        }
        }
        $det = Detil::find($idd);
        UtamaController::storeDetLog($det);
        return redirect()->back();
    }

    public function downloadPDF($idlok){
      $locations= Utama::find($idlok);
      $det = Detil::find($idlok);
      $pdf = PDF::loadView('pdf', compact('det','locations'));
      return $pdf->download('PointOfInterest.pdf');
    }

    public function showDet($id) {
        $utama = Utama::where('id',$id)->get();
        $detil = Detil::where('id',$id)->get();
        return view('detail',compact('detil','utama'));
    }

    public function showLog() {
        $log= Log::orderBy('id', 'desc')->get();
         if (Session::get('roles') == 'admin'){
         return view('historylog',compact('log'));
        }
        else{
         return redirect('/');
        }
    }

    public function storeLog($ob,$type){
        $object_id = $ob->id+1;
        $ut = Utama::find($object_id);
        $poi_admin = $ut->last_updated_by;
        $olokasi = $ut->olokasi;
        $lokasi = $ut->lokasi;
        $olongitude = $ut->olongitude;
        $longitude = $ut->longitude;
        $olatitude = $ut->olatitude;
        $latitude = $ut->latitude;
    
            if(!empty($lokasi)){
                DB::table('log')->insert([
                'nama_admin' => $poi_admin,
                'tipe' => 'POI',
                'action' => 'add',
                'poi_id' => $object_id,
                'object' => 'Lokasi',
                'before' => $olokasi,
                'after' => $lokasi,
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
            ]);
            }
            if(!empty($longitude)){
                DB::table('log')->insert([
                'nama_admin' => $poi_admin,
                'tipe' => 'POI',
                'action' => 'add',
                'poi_id' => $object_id,
                'object' => 'Longitude',
                'before' => $olongitude,
                'after' => $longitude,
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
            ]);
            }
            if(!empty($latitude)){
                DB::table('log')->insert([
                'nama_admin' => $poi_admin,
                'tipe' => 'POI',
                'action' => 'add',
                'poi_id' => $object_id,
                'object' => 'Latitude',
                'before' => $olatitude,
                'after' => $latitude,
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
            ]);
            }
    }

     public function storeDetLog($ob){
        $object_id = $ob->id+1;
        $deta = Detil::find($object_id);
        $nama_admin = $deta->last_created_by;
        $oketerangan = $deta->keterangan;
        $keterangan=$deta->keterangan;
        $oimage = $deta->oimage;
        $image =$deta->image;
        $oimage2 = $deta->oimage2;
        $image2 = $deta->image2;
        $oimage3 =$deta->oimage3;
        $image3 = $deta->image3;
        $oimage4 = $deta->oimage4;
        $image4 = $deta->image4;
        $oimage5 =$deta->oimage5;
        $image5 = $deta->image5;
        $oimage6 = $deta->oimage6;
        $image6 = $deta->image6;
        $oimage7 = $deta->oimage7;
        $image7 =$deta->image7;
        $oimage8 =$deta->oimage8;
        $image8 = $deta->image8;
        $oimage9 =$deta->oimage9;
        $image9 = $deta->image9;
        $oimage10 = $deta->oimage10;
        $image10 =$deta->image10;
        $ovideos = $deta->ovideos;
        $videos = $deta->videos;

    
                DB::table('log')->insert([
                'nama_admin' => $nama_admin,
                'tipe' => 'Detail',
                'action' => 'add',
                'object_id' => $object_id,
                'object' => 'Detail',
                'before' => $oketerangan,
                'after' => $keterangan,
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
            ]);


                DB::table('log')->insert([
                'nama_admin' => $nama_admin,
                'tipe' => 'Detail',
                'action' => 'add',
                'object_id' => $object_id,
                'object' => 'Image 1',
                'before' => $oimage,
                'after' => $image,
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
            ]);

                DB::table('log')->insert([
                'nama_admin' => $nama_admin,
                'tipe' => 'Detail',
                'action' => 'add',
                'object_id' => $object_id,
                'object' => 'Image 2',
                'before' => $oimage2,
                'after' => $image2,
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
]);

                DB::table('log')->insert([
                'nama_admin' => $nama_admin,
                'tipe' => 'Detail',
                'action' => 'add',
                'object_id' => $object_id,
                'object' => 'Image 3',
                'before' => $oimage3,
                'after' => $image3,
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
            ]);

      
                DB::table('log')->insert([
                'nama_admin' => $nama_admin,
                'tipe' => 'Detail',
                'action' => 'add',
                'object_id' => $object_id,
                'object' => 'Image 4',
                'before' => $oimage4,
                'after' => $image4,
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
            ]);

                DB::table('log')->insert([
                'nama_admin' => $nama_admin,
                'tipe' => 'Detail',
                'action' => 'add',
                'object_id' => $object_id,
                'object' => 'Image 5',
                'before' => $oimage5,
                'after' => $image5,
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
            ]);


                DB::table('log')->insert([
                'nama_admin' => $nama_admin,
                'tipe' => 'Detail',
                'action' => 'add',
                'object_id' => $object_id,
                'object' => 'Image 6',
                'before' => $oimage6,
                'after' => $image6,
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
            ]);


                DB::table('log')->insert([
                'nama_admin' => $nama_admin,
                'tipe' => 'Detail',
                'action' => 'add',
                'object_id' => $object_id,
                'object' => 'Image 7',
                'before' => $oimage7,
                'after' => $image7,
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
            ]);

        
                DB::table('log')->insert([
                'nama_admin' => $nama_admin,
                'tipe' => 'Detail',
                'action' => 'add',
                'object_id' => $object_id,
                'object' => 'Image 8',
                'before' => $oimage8,
                'after' => $image8,
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
            ]);


                DB::table('log')->insert([
                'nama_admin' => $nama_admin,
                'tipe' => 'Detail',
                'action' => 'add',
                'object_id' => $object_id,
                'object' => 'Image 9',
                'before' => $oimage9,
                'after' => $image9,
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
            ]);

                DB::table('log')->insert([
                'nama_admin' => $nama_admin,
                'tipe' => 'Detail',
                'action' => 'add',
                'object_id' => $object_id,
                'object' => 'Image 10',
                'before' => $oimage10,
                'after' => $image10,
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
            ]);

                DB::table('log')->insert([
                'nama_admin' => $nama_admin,
                'tipe' => 'Detail',
                'action' => 'add',
                'object_id' => $object_id,
                'object' => 'Video',
                'before' => $ovideos,
                'after' => $videos,
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
            ]);

    }

     public function editLog($obj,$type){
         $object_id = $obj->id;
        $poi_admin = $obj->last_updated_by;
        $nama_admin = $obj->last_created_by;
        $olokasi = $obj->olokasi;
        $lokasi = $obj->lokasi;
        $olongitude = $obj->olongitude;
        $longitude = $obj->longitude;
        $olatitude = $obj->olatitude;
        $latitude = $obj->latitude;
        $oketerangan = $obj->oketerangan;
        $keterangan=$obj->keterangan;
        $diff = UtamaController::htmlDiff($oketerangan,$keterangan);
        $oimage = $obj->oimage;
        $image =$obj->image;
        $oimage2 = $obj->oimage2;
        $image2 = $obj->image2;
        $oimage3 = $obj->oimage3;
        $image3 = $obj->image3;
        $oimage4 = $obj->oimage4;
        $image4 = $obj->image4;
        $oimage5 = $obj->oimage5;
        $image5 = $obj->image5;
        $oimage6 = $obj->oimage6;
        $image6 = $obj->image6;
        $oimage7 = $obj->oimage7;
        $image7 = $obj->image7;
        $oimage8 =$obj->oimage8;
        $image8 = $obj->image8;
        $oimage9 =$obj->oimage9;
        $image9 = $obj->image9;
        $oimage10 = $obj->oimage10;
        $image10 =$obj->image10;
        $ovideos = $obj->ovideos;
        $videos = $obj->videos;

        if($type == 'POI'){
            if(!empty($olokasi) || !empty($lokasi)){
                DB::table('log')->insert([
                'nama_admin' => $poi_admin,
                'tipe' => 'POI',
                'action' => 'edit',
                'poi_id' => $object_id,
                'object' => 'Lokasi',
                'before' => $olokasi,
                'after' => $lokasi,
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
            ]);
            }
            if(!empty($olongitude) || !empty($longitude)){
                DB::table('log')->insert([
                'nama_admin' => $poi_admin,
                'tipe' => 'POI',
                'action' => 'edit',
                'poi_id' => $object_id,
                'object' => 'Longitude',
                'before' => $olongitude,
                'after' => $longitude,
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
            ]);
            }
            if(!empty($olatitude) || !empty($latitude)){
                DB::table('log')->insert([
                'nama_admin' => $poi_admin,
                'tipe' => 'POI',
                'action' => 'edit',
                'poi_id' => $object_id,
                'object' => 'Latitude',
                'before' => $olatitude,
                'after' => $latitude,
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
            ]);
            }
        }
        if($type == 'Detail'){
            if(!empty($oketerangan) || !empty($keterangan)){
                DB::table('log')->insert([
                'nama_admin' => $nama_admin,
                'tipe' => 'Detail',
                'action' => 'edit',
                'object_id' => $object_id,
                'object' => 'Detail',
                'before' => $oketerangan.' ',
                'after' => $diff,
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
            ]);
            }
            if(!empty($oimage) || !empty($image)){
                DB::table('log')->insert([
                'nama_admin' => $nama_admin,
                'tipe' => 'Detail',
                'action' => 'edit',
                'object_id' => $object_id,
                'object' => 'Image 1',
                'before' => $oimage,
                'after' => $image,
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
            ]);
            }
            if(!empty($oimage2) || !empty($image2)){
                DB::table('log')->insert([
                'nama_admin' => $nama_admin,
                'tipe' => 'Detail',
                'action' => 'edit',
                'object_id' => $object_id,
                'object' => 'Image 2',
                'before' => $oimage2,
                'after' => $image2,
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
            ]);
            }
            if(!empty($oimage3) || !empty($image3)){
                DB::table('log')->insert([
                'nama_admin' => $nama_admin,
                'tipe' => 'Detail',
                'action' => 'edit',
                'object_id' => $object_id,
                'object' => 'Image 3',
                'before' => $oimage3,
                'after' => $image3,
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
            ]);
            }
            if(!empty($oimage4) || !empty($image4)){
                DB::table('log')->insert([
                'nama_admin' => $nama_admin,
                'tipe' => 'Detail',
                'action' => 'edit',
                'object_id' => $object_id,
                'object' => 'Image 4',
                'before' => $oimage4,
                'after' => $image4,
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
            ]);
            }
            if(!empty($oimage5) || !empty($image5)){
                DB::table('log')->insert([
                'nama_admin' => $nama_admin,
                'tipe' => 'Detail',
                'action' => 'edit',
                'object_id' => $object_id,
                'object' => 'Image 5',
                'before' => $oimage5,
                'after' => $image5,
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
            ]);
            }
            if(!empty($oimage6) || !empty($image6)){
                DB::table('log')->insert([
                'nama_admin' => $nama_admin,
                'tipe' => 'Detail',
                'action' => 'edit',
                'object_id' => $object_id,
                'object' => 'Image 6',
                'before' => $oimage6,
                'after' => $image6,
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
            ]);
            }
            if(!empty($oimage7) || !empty($image7)){
                DB::table('log')->insert([
                'nama_admin' => $nama_admin,
                'tipe' => 'Detail',
                'action' => 'edit',
                'object_id' => $object_id,
                'object' => 'Image 7',
                'before' => $oimage7,
                'after' => $image7,
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
            ]);
            }
            if(!empty($oimage8) || !empty($image8)){
                DB::table('log')->insert([
                'nama_admin' => $nama_admin,
                'tipe' => 'Detail',
                'action' => 'edit',
                'object_id' => $object_id,
                'object' => 'Image 8',
                'before' => $oimage8,
                'after' => $image8,
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
            ]);
            }
            if(!empty($oimage9) || !empty($image9)){
                DB::table('log')->insert([
                'nama_admin' => $nama_admin,
                'tipe' => 'Detail',
                'action' => 'edit',
                'object_id' => $object_id,
                'object' => 'Image 9',
                'before' => $oimage9,
                'after' => $image9,
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
            ]);
            }
            if(!empty($oimage10) || !empty($image10)){
                DB::table('log')->insert([
                'nama_admin' => $nama_admin,
                'tipe' => 'Detail',
                'action' => 'edit',
                'object_id' => $object_id,
                'object' => 'Image 10',
                'before' => $oimage10,
                'after' => $image10,
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
            ]);
            }
            if(!empty($ovideos) || !empty($videos)){
                DB::table('log')->insert([
                'nama_admin' => $nama_admin,
                'tipe' => 'Detail',
                'action' => 'edit',
                'object_id' => $object_id,
                'object' => 'Video',
                'before' => $ovideos,
                'after' => $videos,
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
            ]);
            }
        }
    }

    function diff($old, $new){
        $matrix = array();
        $maxlen = 0;
        foreach($old as $oindex => $ovalue){
            $nkeys = array_keys($new, $ovalue);
            foreach($nkeys as $nindex){
                $matrix[$oindex][$nindex] = isset($matrix[$oindex - 1][$nindex - 1]) ?
                    $matrix[$oindex - 1][$nindex - 1] + 1 : 1;
                if($matrix[$oindex][$nindex] > $maxlen){
                    $maxlen = $matrix[$oindex][$nindex];
                    $omax = $oindex + 1 - $maxlen;
                    $nmax = $nindex + 1 - $maxlen;
                }
            }   
        }
        if($maxlen == 0) return array(array('d'=>$old, 'i'=>$new));
        return array_merge(
            UtamaController::diff(array_slice($old, 0, $omax), array_slice($new, 0, $nmax)),
            array_slice($new, $nmax, $maxlen),
            UtamaController::diff(array_slice($old, $omax + $maxlen), array_slice($new, $nmax + $maxlen)));
    }

    function htmlDiff($old, $new){
        $ret = '';
        $diff = UtamaController::diff(preg_split("/[\s]+/", $old), preg_split("/[\s]+/", $new));
        foreach($diff as $k){
            if(is_array($k))
                $ret .= (!empty($k['d'])?"<del>".implode(' ',$k['d'])."</del> ":'').
                    (!empty($k['i'])?"<b>".implode(' ',$k['i'])."</b> ":'');
            else $ret .= $k . ' ';
        }
        return $ret;
    }
}