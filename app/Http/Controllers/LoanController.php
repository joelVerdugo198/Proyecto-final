<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Book;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $date = Carbon::now()->timezone('America/Hermosillo');
        $currentuser = auth()->user();
        $available = 0;
        return view('loans.index', compact('loans','books','users', 'date', 'currentuser', 'available'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
        public function dashboard()
    {
            
            $dashboardLoan = Loan::select (DB::raw("COUNT(*) as count"))->whereYear('created_at', date('Y'))->groupBy(DB::raw("Month(created_at)"))->pluck('count');

            $dashboardMonthLoan = Loan::select (DB::raw("Month(created_at) as month"))->whereYear('created_at', date('Y'))->groupBy(DB::raw("Month(created_at)"))->pluck('month');

            $datasLoan = array(0,0,0,0,0,0,0,0,0,0,0,0);

            foreach ($dashboardMonthLoan as $dashboard => $month) {
                $datasLoan[$month] = $dashboardLoan[$dashboard];
            }

            
            return view('dashboard', compact('datasLoan')) ;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         
            if ($loan = Loan::create($request->all())) {

                if ($loan->update($request->all())) {
                    return response()->json([
                    'message' => "Successful loan",
                    'code' => "200"
                    ]);
                }
            }
            return response()->json([
            'message' => "Loan error, contact servicer",
            'code' => "400"
            ]);
        
         
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
