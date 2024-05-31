<?php

namespace App\Traits;
use Illuminate\Http\Request;

trait UploadPhotoTrait{

    public function uploadPhoto(Request $request,$folderName){
        $photo = $request->file('photo')->getClientOriginalName();
        $request->file('photo')->storeAs($folderName,$photo,'freelancers');
        return $photo;
    }
}
?>