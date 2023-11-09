<?php
namespace App\Services\Images;

use \Image;
use Illuminate\Support\Facades\File;

class ImageServices
{
    public function uploadImage($base64ImageCode,$imageUploadPath,$newImageName=null)
    {
        $folderPath = public_path($imageUploadPath);
        $base64ImageData = explode(";base64,", $base64ImageCode);
        $explodeImage = explode("image/", $base64ImageData[0]);
        $imageExtension = trim($explodeImage[1]);
        $actualImageData = base64_decode($base64ImageData[1]);
        if($newImageName==null)
        {
            $newImageName = time() . '.' . $imageExtension;
        }
        else{
            $newImageName = $newImageName.'_' . time() . '.' . $imageExtension;
        }
        if(!File::isDirectory($folderPath)){
            File::makeDirectory($folderPath, 0777, true, true);
        } 
        $filePath = $folderPath.'/'.$newImageName;
        $trainer_pro_file = $imageUploadPath . '/' . $newImageName;
        file_put_contents($filePath, $actualImageData);
        $this->resizeImage($folderPath,$newImageName,$filePath);
        return $newImageName;
    }

    public function uploadImageAdmin($inputFile, $imageUploadPath, $newImageName=null) 
    {
        $folderPath = public_path($imageUploadPath);
        $imageExtension = $inputFile->extension();
        
        if($newImageName == null) {
            $newImageName = time() . '.' . $imageExtension;
        } else {
            $newImageName = $newImageName. '.' . $imageExtension;
        }

        if(!File::isDirectory($folderPath)){
            File::makeDirectory($folderPath, 0777, true, true);
        } 

        $filePath = $folderPath.'/'.$newImageName;
        $inputFile->move($folderPath,$newImageName);
        //$this->resizeImage($folderPath,$newImageName,$filePath);
        return $imageUploadPath.'/'.$newImageName;
    }
    

    public function resizeImage($folderPath,$newImageName,$filePath) 
    {
        $resizeFolders = array('375X245','68X63','343X160');
        foreach($resizeFolders as $key=>$value) {
            $size = explode('X',$value);
            $width = $size[0];
            $height = $size[1];
            $targetPath = $folderPath.'/'.$value;
            $targetfilePath = $folderPath.'/'.$value.'/'.$newImageName;
            if(!File::isDirectory($targetPath)){
                File::makeDirectory($targetPath, 0777, true, true);
            }
            File::copy($filePath, $targetfilePath);
            $image = Image::make($targetfilePath)->resize($width, $height);
            $result = $image->save($targetfilePath);
        }
    }
}
?>