<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Category;
use App\Models\Loan;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Auth;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $books = Book::all();
        $categories = Category::all();
        $loans = Loan::all();
        $date = Carbon::now();
        $available = 0;
        return view('books.index', compact('books', 'categories','loans', 'date', 'available'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       
            if($book = Book::create($request->all())){
                if ($request->hasFile('cover')) {
                    $file = $request->file('cover');
                    $fileName = 'book_cover'.$book->id.'.'.$file->getClientOriginalExtension();
                    $path = $request->file('cover')->storeAs('img/books',$fileName);
                    $book->cover = $fileName;
                    $book->save();
                }
                
                return redirect()->back()->with('success', 'The record was created successfully');
            }
        
            return  redirect()->back()->with('error', 'Do not have permission');
        

       
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        if (Auth::user()->hasPermissionTo('view users')) {
            $loans = Loan::all();
            $users = User::all();
            return view('books.record', compact('book', 'loans','users'));
        }else{
             return redirect()->back()->with('error','Do not have permission');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $book = Book::find($request->id);
        if ($book) {
            if ($book->update($request->all())) {
                if ($request->hasFile('cover')) {
                    $file = $request->file('cover');
                    $fileName = 'book_cover'.$book->id.'.'.$file->getClientOriginalExtension();
                    $path = $request->file('cover')->storeAs('img/books',$fileName);
                     $book->cover = $fileName;
                }
               
                $book->save();
                return redirect()->back()->with('success', 'The record was updated successfully');
            }
        }
        return redirect()->back()->with('error','Could not update the record');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        if ($book) {

            if ($book->delete()) {
                return response()->json([
                'message' => 'Record removed successfully',
                 'code' => '200'
                ]);
            }
            return response()->json([
                'message' => 'Could not delete the record',
                 'code' => '400'
            ]);
        }
    }
}
