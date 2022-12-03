<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Media;
use App\User;
use DB;
use Auth;

class MediaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {  
        $medias = DB::table('medias')->get();

        return view('backend.media.index', ['medias'=>$medias]); 
    }

    public function change_image(Request $request)
    {
        $request->validate([
            'image_id' => 'required',
            'image' => 'required',
        ]);
        $id = $request->image_id;

        $media = Media::find($id);
        $image_url = "";
        $image_name = "";
        if($request->hasFile('image'))
        {
            $old_filename = $media->image_name;
            if($old_filename)
            {
                $old_url = base_path().'/img/side_bannners/'.$old_filename;
                if(file_exists($old_url))        
                {
                    unlink($old_url);
                }
            }
            $image = $request->file('image');
            $image_name = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)."-".date('Ymdhis').'.'.$image->getClientOriginalExtension();
            $image->move(base_path().'/public/img/side_bannners/', $image_name);
            $image_url = url('/')."/img/side_bannners/".$image_name;
            
            $media->image_name = $image_name;
            $media->image_url = $image_url;
            $media->save();
        
        flash('Media has been updated successfully.')->success();
        return redirect()->back();
        }
        flash('NO file has been chosen to upload')->error();
        return redirect()->back();
    }
}
