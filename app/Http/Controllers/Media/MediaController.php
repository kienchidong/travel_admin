<?php

namespace App\Http\Controllers\Media;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class MediaController extends Controller
{
    //
    public function upload(Request $request)
    {

        $this->validate($request, [
            'image' => 'bail|required',
        ]);

        $image = $request->get('image', '');
        $folder = $request->get('folder', '');
        $name = $request->get('name', null);
        $file = '';
        try {
            $file = $this->saveImgBase64($image, 'upload' . $folder, $name);
        } catch (\Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
        return response()->json([
            'file' => $file
        ], 200);
    }

    public function removeImage(Request $request)
    {
        $this->validate($request, [
            'link' => 'required',
        ]);
        $server = URL::to('/') .'/';
        $link = $request->get('link', null);

        $link = str_replace($server, '',$link);
        if($link[0] == '/'){
            $link = substr($link, 1);
        }

        if (file_exists($link)) {
            unlink($link);
        }
        return response()->json([], 200);
    }
}
