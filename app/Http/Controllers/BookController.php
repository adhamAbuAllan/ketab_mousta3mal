<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    public function get_book_info($id)
    {
        return Book::where(['id' => $id, 'active' => 1])->
        with('categories')->
        get()->first();

    }


    public function one(Request $request)
    {
        $fields = ["id" => "required|exists:books,id"];
        $valid = Validator::make($request->all(), $fields);
        if ($valid->fails()) {
            return $this->fail($valid->messages()->first());
        }
        $id = $request->id;
        $book = $this->get_book_info($id);
        $bookResource = new \App\Http\Resources\Book($book);
        return $this->success($bookResource);
    }


    public function all(Request $request)
    {
        // Get the 'type' parameter from the request
        $type = $request->input('type');

        // Query apartments based on the type if provided
        $books = $type
            ? Book::whereHas('type', function ($query) use ($type) {
                $query->where('name', $type);
            })->get()
            : Book::all()->reverse();

        $bookResource = \App\Http\Resources\Book::collection($books);

        return $this->success($bookResource);
    }

    public function add(Request $request)
    {
        $fields = [
            "title" => "required",
            "description" => "required",
            "price" => "required",
            'category_id'=>'required|exists:categories,id',
            'count_of_reads' => 'required',
            'count_of_pages' => 'required',
            'author' => 'required',
            'about_author' => 'required',
        ];

        $validator = Validator::make($request->all(), $fields);
        $valid = $validator;
        if ($valid->fails()) {
            $msg = $valid->messages()->first();
            $res = [
                'status' => false,
                'msg' => $msg,
                'data' => null
            ];

            return response()->json($res, 404);
        }
        $category_id = $request->category_id;
        $title = $request->title;
        $price = $request->price;
        $description = $request->description;
        $count_of_reads = $request->count_of_reads;
        $count_of_pages = $request->count_of_pages;
        $author = $request->author;
        $about_author = $request->about_author;
        $data = Book::create([
            'title' => $title,
            'price' => $price,
            'description' => $description,
            'count_of_reads' => $count_of_reads,
            'count_of_pages' => $count_of_pages,
            'author' => $author,
            'about_author' => $about_author,
            'category_id'=>$category_id,
        ]);

        return $this->success(new \App\Http\Resources\Book($data));
    }

}
