<?php

namespace App\Http\Controllers;

use App\Pos;
use App\Products;
use App\Member;
use App\User;
use App\SalesTrx;
use Illuminate\Support\Carbon;
use Auth;
use Illuminate\Http\Request;

class PosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $d['product'] = Products::orderBy('name','ASC')->get();
        $d['member'] = Member::orderBy('name','ASC')->get();
        // $user_id = auth()->user()->id;
        // $user = User::find('user_id'); 
        // // $d['memberCart'] =  SalesTrx::find('member_id');
        $d['cartMember'] = SalesTrx::where('user_id', \Auth::user()->id)->where('trxStatus', 1)->orderBy("id", "DESC")->get();
        $d['status'] = ['Termin', 'Pending','Cash'];

        

        return view('admin.pos.layouts.index', $d);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $member = Member::find($request->member_id);

        $m = New SalesTrx;
        $m->member_id = $request->member_id;
        $m->trx_at = Carbon::now();
        // $m->trxTotalModal = 0;
        // $m->trxsubTotal =  0;
        // $m->trxTotal = 0;
        // $m->trxPPN = 0;
        // $m->trxDiscount =0;
        $m->trxStatus = 1;
        // $m->trxChange = null;
        $m->termin_at = Carbon::now();
        $m->user_id = Auth::user()->id;

        $m->save();
        dd($m);
        // dd($m);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pos  $pos
     * @return \Illuminate\Http\Response
     */
    public function show(Pos $pos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pos  $pos
     * @return \Illuminate\Http\Response
     */
    public function edit(Pos $pos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pos  $pos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pos $pos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pos  $pos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pos $pos)
    {
        //
    }
}
