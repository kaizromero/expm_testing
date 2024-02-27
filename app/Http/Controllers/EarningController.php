<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;

use App\Earning;

class EarningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $works = DB::table('work')
        ->where('user_id', Auth::id())
        ->get();
        $earnings = DB::table('earnings')
        ->select('earnings.id AS id', 'work.id AS work_id', 'work.work_name', 'earnings.pay', 'earnings.start_pay', 'earnings.end_pay')
        ->leftjoin('work', 'work.id', '=', 'earnings.work_id')
        ->orderby('earnings.id', 'desc')
        ->where('earnings.user_id', Auth::id())
        ->get();
        
        return view('earning.index', compact('works', 'earnings'));
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
        //


        Earning::create([
            'work_id' => $request->txtWorkName,
            'user_id' => Auth::id(),
            'pay' => $request->txtPay,
            'start_pay' => $request->txtSp,
            'end_pay' => $request->txtEp
        ]); 
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
        $earnings = Earning::find($id);
        $earnings->work_id = $request->input('txtWorkName');
        $earnings->user_id = Auth::id();
        $earnings->pay = $request->input('txtPay');
        $earnings->start_pay = $request->input('txtSp');
        $earnings->end_pay = $request->input('txtEp');
        $earnings->save();
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
        $earnings = Earning::find($id);
        $earnings->delete();
        return redirect()->back(); 
    }
}
