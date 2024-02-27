<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use auth;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        $total_rent = DB::table('expenses')
                        ->select(DB::raw('SUM(price) as total_price'))
                        ->where('category_id', 1)
                        ->whereYear('created_at', 2022)
                        ->where('user_id', Auth::id())
                        ->get();
        $total_earnings = DB::table('earnings')
                        ->select(DB::raw('SUM(pay) as pay'))
                        ->whereYear('start_pay', 2022)
                        ->where('user_id', Auth::id())
                        ->get();

        $total_expenses = DB::table('expenses')
                        ->select(DB::raw('SUM(price) as price'))
                        ->whereYear('date_of_pay', 2022)
                        ->where('user_id', Auth::id())
                        ->get();
        $annual_earnings = DB::table('earnings')
                        ->select(DB::raw('SUM(pay) as pay'), DB::raw('MONTH(start_pay) as month'))
                        ->groupBy(DB::raw('MONTH(start_pay)'))
                        ->whereYear('start_pay', 2022)
                        ->where('user_id', Auth::id())
                        ->pluck('pay', 'month');
                        
                        // ->get();

        $annual_earnings_labels = json_encode($annual_earnings->keys(),JSON_NUMERIC_CHECK);
        $annual_earnings_values= json_encode($annual_earnings->values(),JSON_NUMERIC_CHECK);


        $bar_chart_array = [
            
            'labels' => range(1,12),
            'annual_rent_exp_value' => [],
            'annual_transfer_exp_value' => [],
        ];

        $total_house_exp = DB::table('expenses')
                        ->select(DB::raw('SUM(price) as price'), DB::raw('MONTH(date_of_pay) as month'))
                        ->groupBy(DB::raw('MONTH(date_of_pay)'))
                        ->where('category_id', 1)
                        ->where('user_id', Auth::id())
                        ->whereYear('date_of_pay', 2022)
                        ->pluck('price', 'month')
                        ->toArray();
     
        foreach($bar_chart_array['labels'] as $label) {
          
            if(isset($total_house_exp[$label])) {
                $bar_chart_array['annual_rent_exp_value'][] = (float)$total_house_exp[$label];
                continue;
            }
            $bar_chart_array['annual_rent_exp_value'][] = 0;
        }
        //transportation
        $total_transportation_exp = DB::table('expenses')
                        ->select(DB::raw('SUM(price) as price'), DB::raw('MONTH(date_of_pay) as month'))
                        ->groupBy(DB::raw('MONTH(date_of_pay)'))
                        ->where('category_id', 2)
                        ->where('user_id', Auth::id())
                        ->whereYear('date_of_pay', 2022)
                        ->pluck('price', 'month')
                        ->toArray();
     
        foreach($bar_chart_array['labels'] as $label) {
          
            if(isset($total_transportation_exp[$label])) {
                $bar_chart_array['annual_transportation_exp_value'][] = (float)$total_transportation_exp[$label];
                continue;
            }
            $bar_chart_array['annual_transportation_exp_value'][] = 0;
        }
        //Food
        $total_food_exp = DB::table('expenses')
                        ->select(DB::raw('SUM(price) as price'), DB::raw('MONTH(date_of_pay) as month'))
                        ->groupBy(DB::raw('MONTH(date_of_pay)'))
                        ->where('category_id', 3)
                        ->whereYear('date_of_pay', 2022)
                        ->where('user_id', Auth::id())
                        ->pluck('price', 'month')
                        ->toArray();
     
        foreach($bar_chart_array['labels'] as $label) {
          
            if(isset($total_food_exp[$label])) {
                $bar_chart_array['annual_food_exp_value'][] = (float)$total_food_exp[$label];
                continue;
            }
            $bar_chart_array['annual_food_exp_value'][] = 0;
        }
        //grocery
        $total_grocery_exp = DB::table('expenses')
                        ->select(DB::raw('SUM(price) as price'), DB::raw('MONTH(date_of_pay) as month'))
                        ->groupBy(DB::raw('MONTH(date_of_pay)'))
                        ->where('category_id', 4)
                        ->where('user_id', Auth::id())
                        ->whereYear('date_of_pay', 2022)
                        ->pluck('price', 'month')
                        ->toArray();
     
        foreach($bar_chart_array['labels'] as $label) {
          
            if(isset($total_grocery_exp[$label])) {
                $bar_chart_array['annual_grocery_exp_value'][] = (float)$total_grocery_exp[$label];
                continue;
            }
            $bar_chart_array['annual_grocery_exp_value'][] = 0;
        }
        //entertainment
        $total_entertainment_exp = DB::table('expenses')
                        ->select(DB::raw('SUM(price) as price'), DB::raw('MONTH(date_of_pay) as month'))
                        ->groupBy(DB::raw('MONTH(date_of_pay)'))
                        ->where('category_id', 5)
                        ->where('user_id', Auth::id())
                        ->whereYear('date_of_pay', 2022)
                        ->pluck('price', 'month')
                        ->toArray();
     
        foreach($bar_chart_array['labels'] as $label) {
          
            if(isset($total_entertainment_exp[$label])) {
                $bar_chart_array['annual_entertainment_exp_value'][] = (float)$total_entertainment_exp[$label];
                continue;
            }
            $bar_chart_array['annual_entertainment_exp_value'][] = 0;
        }
        //tuition
        $total_tuition_exp = DB::table('expenses')
                        ->select(DB::raw('SUM(price) as price'), DB::raw('MONTH(date_of_pay) as month'))
                        ->groupBy(DB::raw('MONTH(date_of_pay)'))
                        ->where('category_id', 6)
                        ->where('user_id', Auth::id())
                        ->whereYear('date_of_pay', 2022)
                        ->pluck('price', 'month')
                        ->toArray();
     
        foreach($bar_chart_array['labels'] as $label) {
          
            if(isset($total_tuition_exp[$label])) {
                $bar_chart_array['annual_tuition_exp_value'][] = (float)$total_tuition_exp[$label];
                continue;
            }
            $bar_chart_array['annual_tuition_exp_value'][] = 0;
        }
        //medicine
        $total_medicine_exp = DB::table('expenses')
                        ->select(DB::raw('SUM(price) as price'), DB::raw('MONTH(date_of_pay) as month'))
                        ->groupBy(DB::raw('MONTH(date_of_pay)'))
                        ->where('category_id', 7)
                        ->where('user_id', Auth::id())
                        ->whereYear('date_of_pay', 2022)
                        ->pluck('price', 'month')
                        ->toArray();
        // return $total_medicine_exp;
     
        foreach($bar_chart_array['labels'] as $label) {
          
            if(isset($total_medicine_exp[$label])) {
                $bar_chart_array['annual_medicine_exp_value'][] = (float)$total_medicine_exp[$label];
                continue;
            }
            $bar_chart_array['annual_medicine_exp_value'][] = 0;
        }
        //communication
        $total_communication_exp = DB::table('expenses')
                        ->select(DB::raw('SUM(price) as price'), DB::raw('MONTH(date_of_pay) as month'))
                        ->groupBy(DB::raw('MONTH(date_of_pay)'))
                        ->where('category_id', 8)
                        ->where('user_id', Auth::id())
                        ->whereYear('date_of_pay', 2022)
                        ->pluck('price', 'month')
                        ->toArray();
     
        foreach($bar_chart_array['labels'] as $label) {
          
            if(isset($total_communication_exp[$label])) {
                $bar_chart_array['annual_communication_exp_value'][] = (float)$total_communication_exp[$label];
                continue;
            }
            $bar_chart_array['annual_communication_exp_value'][] = 0;
        }
        //clothes
        $total_clothes_exp = DB::table('expenses')
                        ->select(DB::raw('SUM(price) as price'), DB::raw('MONTH(date_of_pay) as month'))
                        ->groupBy(DB::raw('MONTH(date_of_pay)'))
                        ->where('category_id', 9)
                        ->where('user_id', Auth::id())
                        ->whereYear('date_of_pay', 2022)
                        ->pluck('price', 'month')
                        ->toArray();
     
        foreach($bar_chart_array['labels'] as $label) {
          
            if(isset($total_clothes_exp[$label])) {
                $bar_chart_array['annual_clothes_exp_value'][] = (float)$total_clothes_exp[$label];
                continue;
            }
            $bar_chart_array['annual_clothes_exp_value'][] = 0;
        }
        //gadgets
        $total_gadgets_exp = DB::table('expenses')
                        ->select(DB::raw('SUM(price) as price'), DB::raw('MONTH(date_of_pay) as month'))
                        ->groupBy(DB::raw('MONTH(date_of_pay)'))
                        ->where('category_id', 10)
                        ->where('user_id', Auth::id())
                        ->whereYear('date_of_pay', 2022)
                        ->pluck('price', 'month')
                        ->toArray();
     
        foreach($bar_chart_array['labels'] as $label) {
          
            if(isset($total_gadgets_exp[$label])) {
                $bar_chart_array['annual_gadgets_exp_value'][] = (float)$total_gadgets_exp[$label];
                continue;
            }
            $bar_chart_array['annual_gadgets_exp_value'][] = 0;
        }

        // Money Transfer
        $total_transfer_exp = DB::table('expenses')
        ->select(DB::raw('SUM(price) as price'), DB::raw('MONTH(date_of_pay) as month'))
        ->groupBy(DB::raw('MONTH(date_of_pay)'))
        ->where('category_id', 11)
        ->where('user_id', Auth::id())
        ->whereYear('date_of_pay', 2022)
        ->pluck('price', 'month')
        ->toArray();

                        // $annual_transfer_exp_value = json_encode($total_transfer_exp->values(),JSON_NUMERIC_CHECK);
                        
        foreach($bar_chart_array['labels'] as $label) {
            
            if(isset($total_transfer_exp[$label])) {
                $bar_chart_array['annual_transfer_exp_value'][] = (float)$total_transfer_exp[$label];
                continue;
            }
            $bar_chart_array['annual_transfer_exp_value'][] = 0;
        }
        // Training
        $total_training_exp = DB::table('expenses')
        ->select(DB::raw('SUM(price) as price'), DB::raw('MONTH(date_of_pay) as month'))
        ->groupBy(DB::raw('MONTH(date_of_pay)'))
        ->where('category_id', 12)
        ->where('user_id', Auth::id())
        ->whereYear('date_of_pay', 2022)
        ->pluck('price', 'month')
        ->toArray();

                        // $annual_transfer_exp_value = json_encode($total_transfer_exp->values(),JSON_NUMERIC_CHECK);
                        
        foreach($bar_chart_array['labels'] as $label) {
            
            if(isset($total_training_exp[$label])) {
                $bar_chart_array['annual_training_exp_value'][] = (float)$total_training_exp[$label];
                continue;
            }
            $bar_chart_array['annual_training_exp_value'][] = 0;
        }
        // Personal Care
        $total_personal_care_exp = DB::table('expenses')
        ->select(DB::raw('SUM(price) as price'), DB::raw('MONTH(date_of_pay) as month'))
        ->groupBy(DB::raw('MONTH(date_of_pay)'))
        ->where('category_id', 13)
        ->where('user_id', Auth::id())
        ->whereYear('date_of_pay', 2022)
        ->pluck('price', 'month')
        ->toArray();

                        // $annual_transfer_exp_value = json_encode($total_transfer_exp->values(),JSON_NUMERIC_CHECK);
                        
        foreach($bar_chart_array['labels'] as $label) {
            
            if(isset($total_personal_care_exp[$label])) {
                $bar_chart_array['annual_personal_care_exp_value'][] = (float)$total_personal_care_exp[$label];
                continue;
            }
            $bar_chart_array['annual_personal_care_exp_value'][] = 0;
        }
        // Others
        $total_others_exp = DB::table('expenses')
        ->select(DB::raw('SUM(price) as price'), DB::raw('MONTH(date_of_pay) as month'))
        ->groupBy(DB::raw('MONTH(date_of_pay)'))
        ->where('category_id', 14)
        ->where('user_id', Auth::id())
        ->whereYear('date_of_pay', 2022)
        ->pluck('price', 'month')
        ->toArray();

                        // $annual_transfer_exp_value = json_encode($total_transfer_exp->values(),JSON_NUMERIC_CHECK);
                        
        foreach($bar_chart_array['labels'] as $label) {
            
            if(isset($total_others_exp[$label])) {
                $bar_chart_array['annual_others_exp_value'][] = (float)$total_others_exp[$label];
                continue;
            }
            $bar_chart_array['annual_others_exp_value'][] = 0;
        }
        // School Fee
        $total_school_fee_exp = DB::table('expenses')
        ->select(DB::raw('SUM(price) as price'), DB::raw('MONTH(date_of_pay) as month'))
        ->groupBy(DB::raw('MONTH(date_of_pay)'))
        ->where('category_id', 15)
        ->where('user_id', Auth::id())
        ->whereYear('date_of_pay', 2022)
        ->pluck('price', 'month')
        ->toArray();

                        // $annual_transfer_exp_value = json_encode($total_transfer_exp->values(),JSON_NUMERIC_CHECK);
                        
        foreach($bar_chart_array['labels'] as $label) {
            
            if(isset($total_school_fee_exp[$label])) {
                $bar_chart_array['annual_school_fee_exp_value'][] = (float)$total_school_fee_exp[$label];
                continue;
            }
            $bar_chart_array['annual_school_fee_exp_value'][] = 0;
        }
        
        // dd($total_transfer_exp, $bar_chart_array);
        $bar_chart_array = collect($bar_chart_array)->toJson();

        $totals = DB::table('expenses')
                ->select(DB::raw('MONTH(date_of_pay) as date'), 'category_id', DB::raw('SUM(price) as price'))
                ->groupBy(DB::raw('MONTH(date_of_pay)'), 'category_id')
                ->where('user_id', Auth::id())
                ->whereYear('date_of_pay', 2022)
                ->get()->toArray();

        // return $totals;

            //     SELECT
            //     MONTH(date_of_pay) as date, category_id, sum(price)
            // FROM
            //     `expenses`
            //     GROUP BY MONTH(date_of_pay), category_id


            // pie chart
            // SELECT `category_id`, `category_name`,sum(`price`) FROM `expenses` left join category on category.id = expenses.category_id GROUP BY `category_id`
        $total_exp_allocations = DB::table('expenses')
                                    ->select('expenses.category_id','category.category_name', DB::raw('SUM(expenses.price) as price'))
                                    ->leftjoin('category', 'category.id', '=', 'expenses.category_id')
                                    ->groupby('expenses.category_id', 'category.category_name')
                                    ->where('user_id', Auth::id())
                                    ->pluck('price', 'category_name');

                                    // return $total_exp_allocations->values();

        $annual_exp_allocation_labels = $total_exp_allocations->keys();
        $annual_exp_allocation_data = json_encode($total_exp_allocations->values(),JSON_NUMERIC_CHECK);



        $total_exp_rankings = DB::table("expenses")
                            ->select(
                            'expenses.category_id', 
                            'category.category_name', 
                            DB::raw('SUM(expenses.price) AS price'))
                            ->leftjoin('category', 'category.id', '=', 'expenses.category_id')
                            ->orderby('price', 'desc')
                            ->groupby('expenses.category_id', 'category.category_name')
                            ->where('user_id', Auth::id())
                            ->get();
        $personal_id = auth()->id();
        
        $weekly_exps = DB::select( DB::raw("SELECT weeks, SUM(expenses)  AS expenses, SUM(earnings) AS earnings FROM (SELECT
        WEEK(date_of_pay) As weeks,
        SUM(price) AS expenses,
        0 AS earnings
    FROM
        `expenses`
    WHERE
        YEAR(`date_of_pay`) = 2022 AND
        `user_id` = '$personal_id'
    GROUP BY 
        WEEK(date_of_pay)
    UNION ALL
    SELECT
        WEEK(start_pay) weeks,
        0 AS expenses,
        SUM(pay) as earnings
    FROM
        `earnings`
    WHERE
        YEAR(`start_pay`) = 2022 AND
        `user_id` = '$personal_id'
    GROUP BY
        WEEK(start_pay)
     ) AS overall
     
     GROUP BY weeks" ));
        

        return view('index', compact(
            'total_rent', 
            'total_earnings',
            'total_expenses',
            'annual_earnings_labels', 
            'annual_earnings_values',
            // 'annual_rent_exp_label',
            // 'annual_rent_exp_value',
            // 'annual_transfer_exp_label',
            // 'annual_transfer_exp_value',
            'bar_chart_array',
            'annual_exp_allocation_labels',
            'annual_exp_allocation_data',
            'total_exp_rankings',
            'weekly_exps'

        ));
    }
}
