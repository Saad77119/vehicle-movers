<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
    protected $table = 'vehicles';
    protected $guarded = [];

    public static function multiImage($images)
    {
        // dd($images);
        foreach($images as $key => $image){
            $fileOrignalName = $image->getClientOriginalName();
            $image_path = '/Vehicle-Images';
            $path = public_path() . $image_path;
            $filename = time().'_'.rand(000 ,999).'.'.$image->getClientOriginalExtension();
            $image->move($path, $filename);
            $paths[] = $image_path.'/'.$filename;
        }
        return implode(',',$paths);
    }
    public function deletMultiimg(){
        $multi_images = explode(',', $this->images);


        foreach($multi_images as $key => $image){
            if($image){
                unlink(public_path().$image);
            }

        }

    }
}
