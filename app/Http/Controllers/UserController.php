<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Loan;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->hasPermissionTo('view users')) {
            $users = User::all();
            $loans = Loan::all();
            $books = Book::all();
            $currentuser = auth()->user();
            return view('users.index', compact('users','loans','books', 'currentuser')) ;
        }else{
             return redirect()->back()->with('error','Do not have permission');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        if (Auth::user()->hasPermissionTo('view users')) {
            
            $dashboardUser = User::select (DB::raw("COUNT(*) as count"))->whereYear('created_at', date('Y'))->groupBy(DB::raw("Month(created_at)"))->pluck('count');

            $dashboardMonthUser = User::select (DB::raw("Month(created_at) as month"))->whereYear('created_at', date('Y'))->groupBy(DB::raw("Month(created_at)"))->pluck('month');

            $dashboardLoan = Loan::select (DB::raw("COUNT(*) as count"))->whereYear('created_at', date('Y'))->groupBy(DB::raw("Month(created_at)"))->pluck('count');

            $dashboardMonthLoan = Loan::select (DB::raw("Month(created_at) as month"))->whereYear('created_at', date('Y'))->groupBy(DB::raw("Month(created_at)"))->pluck('month');

            $datasLoan = array(0,0,0,0,0,0,0,0,0,0,0,0);

            $datasUser = array(0,0,0,0,0,0,0,0,0,0,0,0);

            foreach ($dashboardMonthLoan as $dashboard => $month) {
                $datasLoan[$month] = $dashboardLoan[$dashboard];
            }

            foreach ($dashboardMonthUser as $dashboard => $month) {
                $datasUser[$month] = $dashboardUser[$dashboard];
            }

            return view('dashboard', compact('datasLoan', 'datasUser')) ;

        }else{
             return redirect()->back()->with('error','Do not have permission');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($user = User::create($request->all())) {

            $user->password = Hash::make($request['password']);

            $user->save();

            return redirect()->back()->with('success','The user was created successfully');
        }
        return redirect()->back()->with('error','The user could not be created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if (Auth::user()->hasPermissionTo('view users')) {
            $loans = Loan::all();
            $books = Book::all();
            return view('users.record', compact('user','loans', 'books'));
        }else{
             return redirect()->back()->with('error','Do not have permission');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = User::find($request->id);
        if ($user) {
            if ($user->update($request->all())) {

                $user->password = Hash::make($request['password']);

                $user->save();

                return redirect()->back()->with('success','User updated successfully');
            }
        }
        return redirect()->back()->with('error','Could not update user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user) {

            if ($user->delete()) {
                return response()->json([
                'message' => 'User deleted successfully',
                 'code' => '200'
                ]);
            }
            return response()->json([
                'message' => 'Could not delete user',
                 'code' => '400'
            ]);
        }
    }
}
