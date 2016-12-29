<?php
namespace App\Commons;

class UploadFileImage {
    public static function upload($request) {
        $destinationPath = 'assets/uploads'; // upload path
        $extension = $request->getClientOriginalExtension(); // getting image extension
        $fileName = rand(1000000000,9999999999).'.'.$extension; // renameing image
        $request->move($destinationPath, $fileName); // uploading file to given path
        return $destinationPath .'/'. $fileName;
    }
}