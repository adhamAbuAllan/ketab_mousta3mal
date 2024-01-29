<?php

namespace App\Http\Controllers;

use App\Http\Resources\PhotoResource;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PhotoController extends Controller
{
    public function addImages(Request $request)
    {
        $fields = [
            'book_id' => 'required|exists:books,id',
            'images.*' => 'required|image',
        ];

        $validator = Validator::make($request->all(), $fields);

        if ($validator->fails()) {
            $msg = $validator->messages()->first();
            return $this->fail($msg);
        }


        $uploadedImages = [];

        $images = $request->file('images');

        if (!is_array($images)) {
            return $this->fail('Images must be an array.');
        }
        $bookId = $request->input('book_id');

        foreach ($images as $image) {
            $imageName = 'img_' . rand(1, 150000) . '.png';
//            'img_'.date('Ymdhis').'.'.$image->extension();
            $dir = "images/books_images";
            $image->move(public_path($dir), $imageName);
            $path = $dir . '/'
                .
                $imageName;
//            $quitUrl = 'http://127.0.0.1:8000/' . $path;
            $quitUrl = url($path);

            $data = Photo::create([
                'url' => $quitUrl,
                'book_id' => $bookId,
            ]);

            $uploadedImages[] = new PhotoResource($data);
        }

        return $this->success($uploadedImages);
    }

}
