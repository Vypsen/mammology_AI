<?php

namespace App\Http\Controllers;

use App\Models\Mammogram;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ImageController extends Controller
{

    public function test()
    {
        $client = new Client();
        $response = $client->request('GET', 'http://localhost:5000/ai');

    }

    public function upload(Request $request)
    {
        $file = $request->file('file');

        if ($file->isValid()) {
            $filename = $file->getClientOriginalName();
            $model = Mammogram::create($filename);
            $file->storeAs('uploads', $model->filename, 'public');

            return response()->json(['status' =>'success', 'filename' => $model->filename]);
        }

        return response()->json(['status' => 'error']);
    }

    public function setPredict(Request $request)
    {
        $data = $request->validate([
            'predict' => 'required',
            'filename' => 'required',
        ]);

        var_dump($data);

        $file = Mammogram::query()->where('filename', $data['filename'])->first();
        $file->enterPredict($data['predict']);
    }
}
