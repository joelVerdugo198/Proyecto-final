<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Book;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Auth;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loans = Loan::all();
        $books = Book::all();
        $users = User::all();
        $date = Carbon::now();
        return view('loans.index', compact('loans','books','users', 'date'));
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
         if (Auth::user()->hasPermissionTo('crud categories')){
            if ($loan = Loan::create($request->all())) {

            return redirect()->back()->with('success','El registro se creo correctamente');

            
            }
            return redirect()->back()->with('error','No se pudo crear el registro');
        }else{
            if ($loan = Loan::create($request->all())) {

                if ($loan->update($request->all())) {
                    return response()->json([
                    'message' => "Successful delivery",
                    'code' => "200"
                    ]);
                }
            }
            return response()->json([
            'message' => "Delivery error, contact the administrator.",
            'code' => "400"
            ]);
        }
         
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function show(Loan $loan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function edit(Loan $loan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $loan = Loan::find($request->id);
        if ($loan) {            
            if ($loan->update($request->all())) {
                return response()->json([
                'message' => "Successful delivery",
                'code' => "200"
                ]);
            }
            return response()->json([
            'message' => "Delivery error, contact the administrator.",
            'code' => "400"
            ]);    
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Loan $loan)
    {
        if ($loan) {

            if ($loan->delete()) {
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
