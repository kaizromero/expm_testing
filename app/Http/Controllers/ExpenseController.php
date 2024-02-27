<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Expense;
use App\Category;
use DB;
use Auth;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $expenses = DB::table('expenses')
        ->orderby('id', 'desc')
        ->where('user_id', Auth::id())
        ->get();

        $categories = DB::table('category')
        ->get();
        return view('expenses.index', compact('expenses', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = DB::table('category')
        ->get();
        return view('expenses.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $validated = $request->validate([
            'txtCategoryName' => 'required'
        ]);
        Expense::create([
            'category_id' => $request->txtCategoryName,
            'user_id' => Auth::id(),
            'details' => $request->txtDetails,
            'store' => $request->txtStore,
            'price' => $request->txtPrice,
            'remarks' => $request->txtRemarks,
            'date_of_pay' => $request->txtDop
        ]); 
        // return view('divisions.index')->with('message', 'You successfully add a division.');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
        $expenses = Expense::find($id);
        $expenses->category_id = $request->input('txtCategoryName');
        $expenses->user_id = Auth::id();
        $expenses->details = $request->input('txtDetails');
        $expenses->store = $request->input('txtStore');
        $expenses->price = $request->input('txtPrice');
        $expenses->remarks = $request->input('txtRemarks');
        $expenses->date_of_pay = $request->input('txtDop');
        $expenses->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $expenses = Expense::find($id);
        $expenses->delete();
        return redirect()->back(); 
    }
}
