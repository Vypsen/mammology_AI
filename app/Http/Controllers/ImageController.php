<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function upload(Request $request)
    {
        $fileName = $request->file('file')->getClientOriginalName();
        $request->file('file')->storeAs('uploads', $fileName, 'public');

        return $fileName;
    }

}
