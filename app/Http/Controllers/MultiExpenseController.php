<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Expense;
use App\Category;
use DB;
use Auth;

class MultiExpenseController extends Controller
{
    //
    public function store(Request $request)
    {
        // dd($request->inputs);
        // return 'multistore';
        // $validated = $request->validate([
        //     'inputs.*.txtCategoryName' => 'required'
        // ],
        // [
        //     'inputs.*.txtCategoryName' => 'The Category Name field is required!',
        // ]
        // );
        foreach ($request->inputs as $input) {

            $categoryId = $input['txtCategoryId'] ?? null;
            $details = $input['txtDetails'] ?? null;
            $store = $input['txtStore'] ?? null;
            $price = $input['txtPrice'] ?? null;
            $remarks = $input['txtRemarks'] ?? null;
            $dop = $input['txtDop'] ?? null;

            Expense::create([
                'category_id' => $categoryId,
                'user_id' => Auth::id(),
                'details' => $details,
                'store' => $store,
                'price' => $price,
                'remarks' => $remarks,
                'date_of_pay' => $dop
            ]);
        }

        return back()->with('success', 'The post has been added');
    }
}
