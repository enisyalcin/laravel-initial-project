<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(["index","show"]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books=Book::all();
        return view("book.list",["books"=>$books]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("book.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBookRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookRequest $request)
    {
        $validated=$request->validated();
        if($request->hasFile('photo')){
            $file=$request->file('photo');
            $fileName=md5(time().$file->getClientOriginalName()).".".$file->getClientOriginalExtension();
            $file->move(public_path("images"),$fileName);
            $validated["photo"]=$fileName;
        }
        Book::create($validated);
        return redirect()->back()->withSuccess("Book was created.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return view("book.show",["book"=>$book]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        return view("book.edit",["book"=>$book]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBookRequest  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        $validated=$request->validated();
        if($request->hasFile("photo")){
            $photoFilePath=public_path('images/').$book->photo;
            if(file_exists($photoFilePath)){
                File::delete($photoFilePath);
            }

            $file=$request->file('photo');
            $fileName=md5(time().$file->getClientOriginalName()).".".$file->getClientOriginalExtension();
            $file->move(public_path("images"),$fileName);
            $validated["photo"]=$fileName;
        }
        $book->update($validated);
        return redirect()->back()->withSucess("Book is updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        if(!empty($book->photo)){
            $photoFilePath=public_path('images/').$book->photo;
            if(file_exists($photoFilePath)){
                File::delete($photoFilePath);
            }
        }

        $book->delete();
        return redirect()->back()->withSuccess("Book was deleted.");
    }
}
