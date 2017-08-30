<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jeniskelas;
use yajra\Datatables\Html\Builder;
use yajra\Datatables\DataTables;
use Session;

class JeniskelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $htmlBuilder)
    {
        /*if($request->ajax()){
            $jeniskelas = Jeniskelas::select(['id', 'name']);
            // return Datatables::of($jeniskelas)->make(true);
            return Datatables::of($jeniskelas)->addColumn('action', function($jeniskelas){
                return view('dataTable._actionjeniskelas', [
                    'model' => $jeniskelas,
                    'form_url' => route('jeniskelas.destroy', $jeniskelas->id),
                    'edit_url' => route('jeniskelas.edit', $jeniskelas->id),
                    'confirm_message' => 'Yakin mau menghapus'.$jeniskelas->name.'?'
                    ]);
            })->make(true);
        }

        // $html = $htmlBuilder->addColumn(['data'=>'name', 'name'=>'name', 'title'=>'Nama']);
        $html = $htmlBuilder->addColumn(['data'=>'name', 'name'=>'name', 'title'=>'Nama'])->addColumn(['data'=>'action', 'name'=>'action', 'title'=>'', 'orderable'=>false, 'searchable'=>false]);*/
        $jeniskelas = Jeniskelas::all();
        return view('jeniskelas.index')->with(compact('jeniskelas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jeniskelas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name'=>'required|unique:jeniskelas']);
        $jeniskelas = Jeniskelas::create($request->all());
        Session::flash("flash_notification", ["level"=>"success","message"=>"Berhasil Menyimpan $jeniskelas->name"]);
        return redirect()->route('jeniskelas.index');
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
        $jeniskelas = Jeniskelas::find($id);
        return view('jeniskelas.edit')->with(compact('jeniskelas'));
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
        $this->validate($request,['name'=>'required|unique:jeniskelas,name,'.$id]);
        $jeniskelas = Jeniskelas::find($id);
        $jeniskelas->update($request->only('name'));

        Session::flash("flash_notification", ["level"=>"success","message"=>"Berhasil Menyimpan $jeniskelas->name"]);

        return redirect()->route('jeniskelas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Jeniskelas::destroy($id)) return redirect()->back();

        Session::flash("flash_notification", ["level"=>"success","message"=>"Jenis Kelas berhasil dihapus"]);        
        return redirect()->route('jeniskelas.index');
    }
}
