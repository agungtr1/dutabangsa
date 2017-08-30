<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Materi;
use yajra\Datatables\Html\Builder;
use yajra\Datatables\DataTables;
use Session;

class MateriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $htmlBuilder)
    {
        /*if($request->ajax()){
            $materi = Materi::select(['id', 'name']);
            // return Datatables::of($materi)->make(true);
            return Datatables::of($materi)->addColumn('action', function($materi){
                return view('dataTable._action', [
                    'model' => $materi,
                    'form_url' => route('materi.destroy', $materi->id),
                    'edit_url' => route('materi.edit', $materi->id),
                    'confirm_message' => 'Yakin mau menghapus'.$materi->name.'?'
                    ]);
            })->make(true);
        }

        // $html = $htmlBuilder->addColumn(['data'=>'name', 'name'=>'name', 'title'=>'Nama']);
        $html = $htmlBuilder->addColumn(['data'=>'name', 'name'=>'name', 'title'=>'Nama'])->addColumn(['data'=>'action', 'name'=>'action', 'title'=>'', 'orderable'=>false, 'searchable'=>false]);*/

        $materi = Materi::select(['id', 'name'])->paginate(10);

        return view('materi.index')->with(compact('materi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('materi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name'=>'required|unique:materis']);
        $materi = Materi::create($request->all());
        Session::flash("flash_notification", ["level"=>"success","message"=>"Berhasil Menyimpan $materi->name"]);
        return redirect()->route('materi.index');
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
        $materi = Materi::find($id);
        return view('materi.edit')->with(compact('materi'));
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
        $this->validate($request,['name'=>'required|unique:materis,name,'.$id]);
        $materi = Materi::find($id);
        $materi->update($request->only('name'));

        Session::flash("flash_notification", ["level"=>"success","message"=>"Berhasil Menyimpan $materi->name"]);

        return redirect()->route('materi.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Materi::destroy($id)) return redirect()->back();

        Session::flash("flash_notification", ["level"=>"success","message"=>"Materi berhasil dihapus"]);        
        return redirect()->route('materi.index');
    }
}
