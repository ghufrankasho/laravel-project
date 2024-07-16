<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Discount;
use Illuminate\Support\Facades\DB;

class DiscountController extends Controller
{

    public function index(Request $request)
    {
        $discounts = Discount::orderBy('id', 'DESC');
        if($request->search){
            $searchQuery=$request->search;
            $discounts = $discounts->where('name',"like" ,"%$searchQuery%")
            ->orwhere('value','like', "%$searchQuery%")
            ->orwhere('type','like', "%$searchQuery%")
            ->orwhere('code','like', "%$searchQuery%");
        }
        $discounts=$discounts->paginate(8);
        return view('backend.discounts.index', compact('discounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.discounts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Dubai');
        $this->validate(
            $request,
            [
                'name' => 'string|nullable',
                'value' => 'integer|required',
                'code' => 'string|nullable',
                'status' => 'nullable|in:active,inactive',
                'store_id' => 'nullable',
            ]
        );

        //  collect data
        $data = $request->all();
        // create slug


        // save data
        $status = Discount::create($data);
        if ($status) {
            return redirect()->route('discounts.index')->with('success', 'Successfully Crated Discount');
        } else {
            return  back()->with('error', 'Some thing went wrong');
        }
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
        date_default_timezone_set('Asia/Dubai');
        $discount = Discount::find($id);
        $tperiod = $discount->period;
        $year = substr($tperiod, 0, 4);

        $Month = substr($tperiod, 5, 2);
        $day = substr($tperiod, 8, 2);
        $hour = substr($tperiod, 11, 2);
        $minutes = substr($tperiod, 14, 2);
        $tt = $year . '-' . $Month . '-' . $day . ' ' . $hour . ':' . $minutes;
        if ($discount) {
            return view('backend.discounts.edit', compact('discount', 'tt'));
        } else {
            return back()->with('error', 'Data Not Found');
        }
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
        $discount = Discount::find($id);
        if ($discount) {
            $this->validate(
                $request,
                [
                    'name' => 'string|nullable',
                    'value' => 'integer|required',
                    'code' => 'string|nullable',
                    'status' => 'nullable|in:active,inactive',
                    'store_id' => 'nullable'
                ]
            );
            //  collect data
            $data = $request->all();

            // save data
            $status = $discount->fill($data)->save();
            if ($status) {
                return redirect()->route('discounts.index')->with('success', 'Successfully Updated Discount');
            } else {
                return  back()->with('error', 'Some thing went wrong');
            }
        } else {
            return back()->with('error', 'Data Not Found');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $discount = Discount::find($id);
        if ($discount) {
            $discount->delete();
            return redirect()->route('discounts.index')->with('success', 'Successfully Deleted Discounts');
        } else {
            return back()->with('error', 'Data Not Found');
        }
    }


    /**
     * StoreStatus // active -inactive
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function discountStatus(Request $request)
    {
        if ($request->mode) {
            DB::table('discounts')->where('id', $request->id)->update(['status' => 'active']);
        } else {
            DB::table('discounts')->where('id', $request->id)->update(['status' => 'inactive']);
        }
        return response()->json(['msg' => 'Successfully update', 'status' => true]);
    }
}
