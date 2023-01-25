<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Exception;
use Log;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::orderBy('created_at', 'desc')->paginate(10);
        // dd($books);
        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBookRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookRequest $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'content' => 'required',
                'cover' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'price' => 'required',
                'year_published' => 'required',
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
            if ($request->hasFile('cover')) {
                $image = $request->file('cover');
                $name = time() . '.' . $image->getClientOriginalExtension();
            }
            $book = new Book();
            $book->title = $request->get('title');
            $book->content = $request->get('content');
            $book->price = $request->get('price');
            $book->year_published = $request->get('year_published');
            $book->cover = $name;
            $book->author_id = auth()->user()->id;
            if ($book->save()) {
                $this->uploadImage($book, $image, $name);
                return back()->with('success', 'Book Created');
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Book Not Created');
        }
    }
    public function uploadImage($book, $image, $name)
    {
        $destinationPath = public_path('/assets/books/' . $book->id . '/');
        if (!is_dir($destinationPath)) {
            mkdir($destinationPath);
            chmod($destinationPath, 0755);
        }
        if (!empty(scandir($destinationPath))) {
            File::cleanDirectory($destinationPath);
        }
        $image->move($destinationPath, $name);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return view('books.single', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        return view('books.edit')->with('book', $book);
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
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
            'cover' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price' => 'required',
            'year_published' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }


        $book->update([
            'title' => $request->get('title'),
            'content' => $request->get('content'),
            'price' => $request->get('price'),
            'year_published' => $request->get('year_published'),
        ]);
        if ($request->hasFile('cover')) {
            $image = $request->file('cover');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/books/' . $book->id . '/');

            if (!is_dir($destinationPath)) {
                mkdir($destinationPath);
                chmod($destinationPath, 0755);
            }

            if (!empty(scandir($destinationPath))) {
                File::cleanDirectory($destinationPath);
            }
            $image->move($destinationPath, $name);

            $book->update([
                'cover' => $name,
            ]);
            return back()->with('success', 'updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        try {
            $book->delete();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Book Not Deleted');
        }
        return back()->with('success', 'Book Deleted');
    }
}
