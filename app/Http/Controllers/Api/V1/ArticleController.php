<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ArticleCollection;
use App\Http\Resources\V1\ArticleResource;
use App\Mail\MyEmail;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File as FacadesFile;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new ArticleCollection(Article::orderBy('created_at', 'desc')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validate =  Validator::make($request->all(), [
            'title' => [
                'required',
                "min:3",
                "max:50",
                Rule::unique('articles', 'title'),
            ],
            'body' => [
                'required',
                "min:20"
            ],
            'image' => [
                'required',
                File::image()
                    ->min('1kb')
                    ->max('10mb')
            ]
        ]);

        if ($validate->fails()) {
            $data = [
                "status" => 422,
                "message" => $validate->messages(),
            ];
            return response()->json($data, 422);
        }


        if ($request->hasFile('image')) {
            echo "image geldi";
            $path = $request->image->hashName();
            $request->image->move(public_path("images"), $path);
        } else {
            echo "image gelmedi";
            $path = Null;
        }

        $article = Article::create([
            'title' => $request->input('title'),
            'slug' => Str::slug($request->input('title')),
            'body' => $request->input('body'),
            'image' => $path,
            'author_id' => auth()->id() ?? 1
        ]);
        print_r($path);
        print_r($article->id);

        if ($article) {
            $mailBody = $request->input('body');
            $mailTitle = $request->input('title');
            $mailId = $article->id ?? 1;
            $mailImage = "http://localhost:8000/images/$path";
            Mail::to("sumeyyeozsahin93@gmail.com")->send(new MyEmail($mailTitle, $mailBody, $mailImage, $mailId));
        }

        echo "email gonderdi";
        return (new ArticleResource($article))->response()->setStatusCode(201); // degistirdim
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return (new ArticleResource($article))->response()->setStatusCode(200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $validate =  Validator::make($request->all(), [
            'title' => [
                'required',
                "min:3",
                "max:50",
                Rule::unique('articles', 'title')->ignore($article->id()),
            ],
            'body' => [
                'required',
                "min:20"
            ],
            'image' => [
                File::image()
                    ->min('1kb')
                    ->max('10mb'),
            ]

        ]);

        if ($validate->fails()) {
            $data = [
                "status" => 422,
                "message" => $validate->messages(),
            ];
            return response()->json($data, 422);
        }
        if ($request->hasFile('image')) {
            echo "image geldi";
            $path = $request->image->hashName();
            $request->image->move(public_path("images"), $path);
            //delete previous image record
            $this->deleteImage($article);
        } else {
            echo "image gelmedi";
            $path = $article->image;
        }


        $article->update([
            'title' => $request->input('title'),
            'slug' => Str::slug($request->input('title')),
            'body' => $request->input('body'),
            'image' => $path,
            'author_id' => auth()->id() ?? 1
        ]);

        return (new ArticleResource($article))->response()->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $this->deleteImage($article);
        $article->delete();
        return response()->json(['message' => 'Resource deleted successfully'], 200);
    }

    public function deleteImage(Article $article)
    {
        $img =  $article->image;
        $imagePath = public_path("images/$img");

        if (FacadesFile::exists($imagePath)) {
            // Delete the image
            FacadesFile::delete($imagePath);
            echo "Image deleted successfully";
        } else {
            echo "Image not found";
        }
    }
}
