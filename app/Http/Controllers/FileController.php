<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    public function dropzoneUpload(Request $request)
    {
        dd(request()->file('file'));
        $fileArray = array();
        $uploadKey = Carbon::now()->format('YmdHis');

        $files = Collection::wrap(request()->file('file'));

        $userStorage = '/uploads';
        if (!Storage::exists($userStorage)) {
            Storage::makeDirectory($userStorage, 0755, true);
        }

        $files->each(function ($file, $key) use (&$userStorage, &$fileArray, &$uploadKey) {

            $userStorageDir = storage_path() . '/app' . $userStorage;
            $fileName = $file->getClientOriginalName();
            if (strlen($fileName) > 10){
                $fileName = substr($fileName, 1, 6);
            }
            $title = pathinfo($fileName, PATHINFO_FILENAME);
            // $extn = strtolower($file->getClientOriginalExtension());
            $extn = 'jpg';
            $slugTitle = Str::slug($title, '-');
            $path = $slugTitle."-".$uploadKey."-".auth()->id().".".$extn;
            $mime = $file->getClientMimeType();

            // File Optimization
            $img = Img::make($file);
            $img->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->encode($extn, 50);
            $file_type = 'image';

            // Save file to storage directory
            $img->save($userStorageDir . '/' . $path);

            // Setup data into array
            array_push( $fileArray, array(
                    // 'original_name' => $fileName,
                    // 'title' => $title,
                    'disk' => 'local',
                    'path' => $path,
                    'file_type' => $file_type,
                    'mime' => $mime,
                    'user_id' => auth()->id(),
                    'created_at' => Carbon::now(),
            ));
        });

        // Insert into database at once
        $uploadedFiles = File::insert($fileArray);

        return response()->json([
            'success' => true,
            'message' => 'Upload Success',
        ], 200);
    }

}
