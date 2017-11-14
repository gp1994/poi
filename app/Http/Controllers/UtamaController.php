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
            return view('/');
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
        $det->keterangan=$detl;
        if (!empty ($img)){
        $ext1 = $request->file('editedim')->getClientOriginalExtension();
        if ($ext1 == 'jpg' || $ext1 == 'png'){
        $img = $request->file('editedim')->getClientOriginalName();
        $request->file('editedim')->move(public_path('images'), $img);
        $det->image='images/'.$img;
        }
        else{
        Session::flash('fmsg','Video or Picture(s) Update Failed');
        }
        }
        else{
        $det->image=$dat;
        }

        if (!empty ($img2)){
        $ext2 = $request->file('editedim2')->getClientOriginalExtension();
        if ($ext2 == 'jpg' || $ext2 == 'png'){
        $img2 = $request->file('editedim2')->getClientOriginalName();
        $request->file('editedim2')->move(public_path('images'), $img2);
        $det->image2='images/'.$img2;
        }
        else{
        Session::flash('fmsg', 'Video or Picture(s) Update Failed');
        }
        }   
        else{
        $det->image2=$dat2;
        }
        if (!empty ($img3)){
        $ext3 = $request->file('editedim3')->getClientOriginalExtension();
        if ($ext3 == 'jpg' || $ext3 == 'png'){
        $img3 = $request->file('editedim3')->getClientOriginalName();
        $request->file('editedim3')->move(public_path('images'), $img3);
        $det->image3='images/'.$img3;
        }
        else{
        Session::flash('fmsg', 'Video or Picture(s) Update Failed');
        }
        }
        else{
        $det->image3=$dat3;
        }
        if (!empty ($img4)){
        $ext4 = $request->file('editedim4')->getClientOriginalExtension();
        if ($ext4 == 'jpg' || $ext4 == 'png'){
        $img4 = $request->file('editedim4')->getClientOriginalName();
        $request->file('editedim4')->move(public_path('images'), $img4);
        $det->image4='images/'.$img4;
        }
        else{
        Session::flash('fmsg', 'Video or Picture(s) Update Failed');
        }
        }
        else{
        $det->image4=$dat4;
        }
        if (!empty ($img5)){
        $ext5 = $request->file('editedim5')->getClientOriginalExtension();
        if ($ext5 == 'jpg' || $ext5 == 'png'){
        $img5 = $request->file('editedim5')->getClientOriginalName();
        $request->file('editedim5')->move(public_path('images'), $img5);
        $det->image5='images/'.$img5;
        }
        else{
        Session::flash('fmsg', 'Video or Picture(s) Update Failed');
        }
        }
        else{
        $det->image5=$dat5;
        }
        if (!empty ($img6)){
        $ext6 = $request->file('editedim6')->getClientOriginalExtension();
        if ($ext6 == 'jpg' || $ext6 == 'png'){
        $img6 = $request->file('editedim6')->getClientOriginalName();
        $request->file('editedim6')->move(public_path('images'), $img6);
        $det->image6='images/'.$img6;
        }
        else{
        Session::flash('fmsg', 'Video or Picture(s) Update Failed');
        }
        }
        else{
        $det->image6=$dat6;
        }
        if (!empty ($img7)){
        $ext7 = $request->file('editedim7')->getClientOriginalExtension();
        if ($ext7 == 'jpg' || $ext7 == 'png'){
        $img7 = $request->file('editedim7')->getClientOriginalName();
        $request->file('editedim7')->move(public_path('images'), $img7);
        $det->image7='images/'.$img7;
        }
        else{
        Session::flash('fmsg', 'Video or Picture(s) Update Failed');
        }
        }
        else{
        $det->image7=$dat7;
        }
        if (!empty ($img8)){
        $ext8 = $request->file('editedim8')->getClientOriginalExtension();
        if ($ext8 == 'jpg' || $ext8 == 'png'){
        $img8 = $request->file('editedim8')->getClientOriginalName();
        $request->file('editedim8')->move(public_path('images'), $img8);
        $det->image8='images/'.$img8;
        }
        else{
        Session::flash('fmsg', 'Video or Picture(s) Update Failed');
        }
        }
        else{
        $det->image8=$dat8;
        }
        if (!empty ($img9)){
        $ext9 = $request->file('editedim9')->getClientOriginalExtension();
        if ($ext9 == 'jpg' || $ext9 == 'png'){
        $img9 = $request->file('editedim9')->getClientOriginalName();
        $request->file('editedim9')->move(public_path('images'), $img9);
        $det->image9='images/'.$img9;
        }
        else{
        Session::flash('fmsg', 'Video or Picture(s) Update Failed');
        }
        }
        else{
        $det->image9=$dat9;
        }
        if (!empty ($img10)){
        $ext10 = $request->file('editedim10')->getClientOriginalExtension();
        if ($ext10 == 'jpg' || $ext10 == 'png'){
        $img10 = $request->file('editedim10')->getClientOriginalName();
        $request->file('editedim10')->move(public_path('images'), $img10);
        $det->image10='images/'.$img10;
        }
        else{
        Session::flash('fmsg', 'Video or Picture(s) Update Failed');
        }
        }
        else{
        $det->image10=$dat10;
        }
        if (!empty ($bd)){
        $ext11 = $request->file('editedvid')->getClientOriginalExtension();
        if ($ext11 == 'mp4'){
        $bd= $request->file('editedvid')->getClientOriginalName();
        $request->file('editedvid')->move(public_path('videos'), $bd);
        $det->videos='videos/'.$bd;
        }
        else{
        Session::flash('fmsg', 'Video or Picture(s) Update Failed');
        }
        }
        else{
        $det->videos=$bid;
        }

        if($det->isDirty('keterangan') || $det->isDirty('image') || $det->isDirty('image2') || $det->isDirty('image3') || $det->isDirty('image4') || $det->isDirty('image5') || $det->isDirty('image6') || $det->isDirty('image7') || $det->isDirty('image8') || $det->isDirty('image9') || $det->isDirty('image10')|| $det->isDirty('videos')){
        $det->update_count=$det->update_count+1;
        $det->created_at = \Carbon\Carbon::now()->toDateTimeString();
        $det->updated_at = \Carbon\Carbon::now()->toDateTimeString();
        $det->last_created_by=Session::get('usrn');
        }
    
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
                'last_updated_by' =>Session::get('usrn')
            ]);
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
            'last_created_by' =>Session::get('usrn')
            ]);
        }
        else{
        Session::flash('fmsg', 'Upload Failed or Some Multiple Files Not Uploaded');
        DB::table('info_detail')->insert([
            'id' => $idd + 1,
            'keterangan' => $desc,
            'videos' => 'videos/',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'last_created_by' =>Session::get('usrn')
            ]);
        }
        }
        else{
            DB::table('info_detail')->insert([
            'id' => $idd + 1,
            'keterangan' => $desc,
            'videos' => 'videos/',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'last_created_by' =>Session::get('usrn')
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
            'last_created_by' =>Session::get('usrn')
            ]);
        }
        else{
            Session::flash('fmsg', 'Upload Failed or Some Multiple Files Not Uploaded');
             DB::table('info_detail')->insert([
            'id' => $idd + 1,
            'keterangan' => $desc,
            'image' => 'images/'.$newim[0],
            'videos' => 'videos/',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'last_created_by' =>Session::get('usrn')
            ]);
        }
        }
        else{
             DB::table('info_detail')->insert([
            'id' => $idd + 1,
            'keterangan' => $desc,
            'image' => 'images/'.$newim[0],
            'videos' => 'videos/',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'last_created_by' =>Session::get('usrn')
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
            'last_created_by' =>Session::get('usrn')
            ]);
        }
        else{
            Session::flash('fmsg', 'Upload Failed or Some Multiple Files Not Uploaded');
            DB::table('info_detail')->insert([
            'id' => $idd + 1,
            'keterangan' => $desc,
            'image' => 'images/'.$newim[0],
            'image2' => 'images/'.$newim[1],
            'videos' => 'videos/',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'last_created_by' =>Session::get('usrn')
            ]);
        }
        }
        else{
             DB::table('info_detail')->insert([
            'id' => $idd + 1,
            'keterangan' => $desc,
            'image' => 'images/'.$newim[0],
            'image2' => 'images/'.$newim[1],
            'videos' => 'videos/',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'last_created_by' =>Session::get('usrn')
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
            'last_created_by' =>Session::get('usrn')
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
            'videos' => 'videos/',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'last_created_by' =>Session::get('usrn')
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
            'videos' => 'videos/',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'last_created_by' =>Session::get('usrn')
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
            'last_created_by' =>Session::get('usrn')
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
            'videos' => 'videos/',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'last_created_by' =>Session::get('usrn')
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
            'videos' => 'videos/',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'last_created_by' =>Session::get('usrn')
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
            'last_created_by' =>Session::get('usrn')
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
            'videos' => 'videos/',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'last_created_by' =>Session::get('usrn')
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
            'videos' => 'videos/',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'last_created_by' =>Session::get('usrn')
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
            'last_created_by' =>Session::get('usrn')
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
            'videos' => 'videos/',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'last_created_by' =>Session::get('usrn')
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
            'videos' => 'videos/',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'last_created_by' =>Session::get('usrn')
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
            'last_created_by' =>Session::get('usrn')
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
            'videos' => 'videos/',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'last_created_by' =>Session::get('usrn')
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
            'videos' => 'videos/',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'last_created_by' =>Session::get('usrn')
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
            'last_created_by' =>Session::get('usrn')
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
            'videos' => 'videos/',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'last_created_by' =>Session::get('usrn')
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
            'videos' => 'videos/',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'last_created_by' =>Session::get('usrn')
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
            'last_created_by' =>Session::get('usrn')
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
            'videos' => 'videos/',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'last_created_by' =>Session::get('usrn')
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
            'videos' => 'videos/',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'last_created_by' =>Session::get('usrn')
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
            'last_created_by' =>Session::get('usrn')
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
            'videos' => 'videos/',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'last_created_by' =>Session::get('usrn')
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
            'videos' => 'videos/',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'last_created_by' =>Session::get('usrn')
            ]);
        }
        }
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
}