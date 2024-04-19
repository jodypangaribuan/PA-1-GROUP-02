<?php

namespace App\Http\Controllers;

use App\Models\JamBuka;
use Illuminate\Http\Request;

class JamBukaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['page_title'] = 'Hour Open';
        $data['jamBuka'] = JamBuka::orderBy('id','asc')->get();

		return view('jambuka.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = new JamBuka();
            $data->hari = $request->hari;
            $data->jam_buka = $request->jam_buka;
            $data->jam_tutup = $request->jam_tutup;
            $data->save();

            return redirect()->back()->with('success','Save data successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed','Failed save data successfully');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(JamBuka $jamBuka)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JamBuka $jamBuka)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $data = JamBuka::find($id);
            $data->hari = $request->hari;
            $data->jam_buka = $request->jam_buka;
            $data->jam_tutup = $request->jam_tutup;
            $data->save();

            return redirect()->back()->with('success','Save data successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed','Failed save data successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $data = JamBuka::find($id);
            $data->delete();

            return redirect()->back()->with('success','Delete data successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed','Failed delete data successfully');
        }
    }
}
