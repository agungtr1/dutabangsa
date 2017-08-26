<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\DataTables;
use App\Peserta;
use App\Materi;
use App\Jeniskelas;
use Session;
use App\Http\Requests\StorePesertaRequest;
use Illuminate\Support\Facades\Auth;
use PDF;
use Excel;
use App\Helpers\AutoNumber;
use DateTime;

class DatainputbyuserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $htmlBuilder)
    {
        if($request->ajax()){
            $user = Auth::user()->name;
            $datapeserta = Peserta::with('jeniskelas')->where('posted_by', $user);
            // return Datatables::of($datapeserta)->make(true);
            return Datatables::of($datapeserta)->addColumn('action', function($datapeserta){
                return view('dataTable._actiondatapeserta', [
                    'model' => $datapeserta,
                    'form_url' => route('listdatapeserta.destroy', $datapeserta->id),
                    'edit_url' => route('listdatapeserta.edit', $datapeserta->id),
                    'show_url' => route('listdatapeserta.show', $datapeserta->id),
                    'print_url' => route('print.listdatapeserta', $datapeserta->id),
                    'confirm_message' => 'Yakin mau menghapus'.$datapeserta->nama.'?'
                    ]);
            })->make(true);
        }
        $html = $htmlBuilder->addColumn(['data'=>'nis', 'name'=>'nis', 'title'=>'NIS'])
        ->addColumn(['data'=>'nama', 'name'=>'nama', 'title'=>'Nama'])
        ->addColumn(['data'=>'nohp', 'name'=>'nohp', 'title'=>'No. HP'])
        /*->addColumn(['data'=>'email', 'name'=>'email', 'title'=>'Email'])*/
        ->addColumn(['data'=>'jeniskelas.name', 'name'=>'jeniskelas.name', 'title'=>'Jenis Kelas'])
        ->addColumn(['data'=>'latarbelakang', 'name'=>'latarbelakang', 'title'=>'Latar Belakang'])
        ->addColumn(['data'=>'tanggalpelaksanaan', 'name'=>'tanggalpelaksanaan', 'title'=>'Tanggal Pelaksanaan'])
        ->addColumn(['data'=>'judulprogram', 'name'=>'judulprogram', 'title'=>'Judul'])
        /*->addColumn(['data'=>'lokasipelaksanaan', 'name'=>'lokasipelaksanaan', 'title'=>'Lokasi Pelaksanaan'])*/
        /*->addColumn(['data'=>'akuninstagram', 'name'=>'akuninstagram', 'title'=>'Instagram'])*/
        ->addColumn(['data'=>'materi', 'name'=>'materi', 'title'=>'Materi'])
        ->addColumn(['data'=>'posted_by', 'name'=>'posted_by', 'title'=>'Input'])
        ->addColumn(['data'=>'action', 'name'=>'action', 'title'=>'', 'orderable'=>false, 'searchable'=>false]);

        return view('datainputbyuser.index')->with(compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $materi = Materi::all(['id','name']);
        return view('datainputbyuser.create')->with(compact('materi',$materi));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['nama'=>'required']);
        $request->merge([ 
            'materi' => implode(', ', (array) $request->get('materi'))
        ]);
        $data = $request->all();

        $table = "pesertas";
        $primary = "nis";
        $getnis = $request->get('jeniskelas_id');

        if($getnis == 1){
            $prefix = "RCL-";
        }elseif ($getnis == 2){
            $prefix = "IHT-";
        }elseif ($getnis == 3){
            $prefix = "PRC-";
        }elseif ($getnis == 4){
            $prefix = "SMN-";
        }elseif ($getnis == 5){
            $prefix = "PBC-";
        }elseif ($getnis == 6){
            $prefix = "OPC-";
        }else{
            $prefix = "NUL-";
        }

        $nis = AutoNumber::autonumber($table,$primary,$prefix);

        $didaftarkanoleh = $request->get('didaftarkanoleh');
        $mengetahuidb = $request->get('mengetahuidb');
        $leveljabatan = $request->get('leveljabatan');
        if($didaftarkanoleh == 'lainnya'){
            $data['didaftarkanoleh'] = $request->get('didaftarkanoleh_lainnya');
        }else{
            $data['didaftarkanoleh'] = $didaftarkanoleh;
        }

        if($mengetahuidb == 'Lainnya'){
            $data['mengetahuidb'] = $request->get('mengetahuidb_lainnya');
        }else{
            $data['mengetahuidb'] = $mengetahuidb;
        }

        if($leveljabatan == 'lain-lainnya'){
            $data['leveljabatan'] = $request->get('leveljabatan_lainnya');
        }else{
            $data['leveljabatan'] = $leveljabatan;
        }

        $data['nis'] = $nis;

        // Tanggal Lahir
        $birthday = $request->get('tanggallahir');

        $pelaksanaan = $request->get('tanggalpelaksanaan');

        // Convert Ke Date Time
        $biday = new DateTime($birthday);
        $bidaydate = new DateTime($birthday);
        $pelaksanaandt = new DateTime($pelaksanaan);
        $today = new DateTime();

        // $diff = $today->diff($biday);
        $diff = $pelaksanaandt->diff($bidaydate);

        if($birthday != NULL){
            $data['usia'] = $diff->y;
        }else{
            $data['usia'] = NULL;
        }

        $peserta = Peserta::create($data);
        Session::flash("flash_notification", ["level"=>"success","message"=>"Berhasil Menyimpan $peserta->nama"]);

        /*$idpeserta = $peserta->id;*/

        return redirect()->route('listdatapeserta.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $datapeserta = Peserta::find($id);
        /*$materi = Materi::all(['id','name']);*/
        $jeniskelas = Jeniskelas::find($datapeserta->jeniskelas_id);
        return view('datainputbyuser.show')->with(compact('jeniskelas','datapeserta'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $datapeserta = Peserta::find($id);
        $materi = Materi::all(['id','name']);
        return view('datainputbyuser.edit')->with(compact('datapeserta','materi'));
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
        $this->validate($request, ['nama'=>'required'.$id]);
        $datapeserta = Peserta::find($id);
        $request->merge([ 
            'materi' => implode(', ', (array) $request->get('materi'))
        ]);

        $data = $request->all();

        $didaftarkanoleh = $request->get('didaftarkanoleh');
        $mengetahuidb = $request->get('mengetahuidb');
        $leveljabatan = $request->get('leveljabatan');
        if($didaftarkanoleh == 'lainnya'){
            $data['didaftarkanoleh'] = $request->get('didaftarkanoleh_lainnya');
        }else{
            $data['didaftarkanoleh'] = $didaftarkanoleh;
        }

        if($mengetahuidb == 'Lainnya'){
            $data['mengetahuidb'] = $request->get('mengetahuidb_lainnya');
        }else{
            $data['mengetahuidb'] = $mengetahuidb;
        }

        if($leveljabatan == 'lain-lainnya'){
            $data['leveljabatan'] = $request->get('leveljabatan_lainnya');
        }else{
            $data['leveljabatan'] = $leveljabatan;
        }

        $nisdb = $datapeserta->nis;
        $substrnonis = substr($nisdb,4);

        $getnis = $request->get('jeniskelas_id');

        if($getnis == 1){
            $prefix = "RCL-";
        }elseif ($getnis == 2){
            $prefix = "IHT-";
        }elseif ($getnis == 3){
            $prefix = "PRC-";
        }elseif ($getnis == 4){
            $prefix = "SMN-";
        }elseif ($getnis == 5){
            $prefix = "PBC-";
        }elseif ($getnis == 6){
            $prefix = "OPC-";
        }else{
            $prefix = "NUL-";
        }

        $data['nis'] = $prefix.$substrnonis;


        // Tanggal Lahir
        $birthday = $request->get('tanggallahir');

        $pelaksanaan = $request->get('tanggalpelaksanaan');

        // Convert Ke Date Time
        $biday = new DateTime($birthday);
        $bidaydate = new DateTime($birthday);
        $pelaksanaandt = new DateTime($pelaksanaan);
        $today = new DateTime();

        // $diff = $today->diff($biday);
        $diff = $pelaksanaandt->diff($bidaydate);

        if($birthday != NULL){
            $data['usia'] = $diff->y;
        }else{
            $data['usia'] = NULL;
        }

        $peserta = Peserta::update($data);

        /*$peserta = Peserta::update($request->all());*/
        Session::flash("flash_notification", ["level"=>"success","message"=>"Berhasil Mengubah Data Peserta"]);

        return redirect()->route('datapeserta.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Peserta::destroy($id)) return redirect()->back();

        Session::flash("flash_notification", ["level"=>"success","message"=>"Data Peserta berhasil dihapus"]);        
        return redirect()->route('listdatapeserta.index');
    }

    public function export()
    {
        $user = Auth::user()->name;
        $datapeserta = Peserta::where('posted_by', $user)->pluck('nama', 'id');
        return view('datainputbyuser.export')->with(compact('datapeserta'));
    }

    public function exportPost(Request $request)
    {
        // validasi
        $this->validate($request, [
        'id'=>'required',
        'type'=>'required|in:pdf,xls'
        ], [
        'id.required'=>'Anda belum memilih peserta. Pilih minimal 1 peserta.'
        ]);

        $datapeserta = Peserta::whereIn('id', $request->get('id'))->get();

        /*Excel::create('Data Peserta Duta Bangsa', function($excel) use ($datapeserta) {
        
        $excel->setTitle('Data Peserta Duta Bangsa')->setCreator(Auth::user()->name);

        $excel->sheet('Data Peserta', function($sheet) use ($datapeserta) {
        $row = 1;
        $sheet->row($row, [
        'Nis','Nama','No. HP','Email','Jenis Kelamin','Jenis Kelas','Tempat Lahir','Tanggal Lahir','No. HP Darurat','Alamat Lengkap','Latar Belakang','Perusahaan','Departemen','universitas','Jurusan','Tanggal Pelaksanaan','Judul Program','Lokasi Pelaksanaan','Kota Pelaksanaan','Instagram','Materi','Input By','Waktu Input']);
        foreach ($datapeserta as $dp) {
                    $sheet->row(++$row, [
                    $dp->nis,
                    $dp->nama,
                    $dp->nohp,
                    $dp->email,
                    $dp->jeniskelamin,
                    $dp->jeniskelas->name,
                    $dp->tempatlahir,
                    $dp->tanggallahir,
                    $dp->nohpdarurat,
                    $dp->alamatlengkap,
                    $dp->latarbelakang,
                    $dp->perusahaan,
                    $dp->departemenpeserta,
                    $dp->universitas,
                    $dp->jurusan,
                    $dp->tanggalpelaksanaan,
                    $dp->judulprogram,
                    $dp->lokasipelaksanaan,
                    $dp->kotapelaksanaan,
                    $dp->akuninstagram,
                    $dp->materi,
                    $dp->posted_by,
                    $dp->created_at
                ]);
            }
        });
        })->export('xls');*/
        $handler = 'export' . ucfirst($request->get('type'));
        return $this->$handler($datapeserta);
    }

    private function exportXls($datapeserta)
    {
        Excel::create('Data Peserta Duta Bangsa', function($excel) use ($datapeserta) {
        
        $excel->setTitle('Data Peserta Duta Bangsa')->setCreator(Auth::user()->name);

        $excel->sheet('Data Peserta', function($sheet) use ($datapeserta) {
        $row = 1;
        $sheet->row($row, [
        'Nis','Nama','No. HP','Email','Jenis Kelamin','Jenis Kelas','Tempat Lahir','Tanggal Lahir','No. HP Darurat','Alamat Lengkap','Latar Belakang','Perusahaan','Departemen','universitas','Jurusan','Tanggal Pelaksanaan','Judul Program','Lokasi Pelaksanaan','Kota Pelaksanaan','Instagram','Materi','Input By','Waktu Input']);
        foreach ($datapeserta as $dp) {
                    $sheet->row(++$row, [
                    $dp->nis,
                    $dp->nama,
                    $dp->nohp,
                    $dp->email,
                    $dp->jeniskelamin,
                    $dp->jeniskelas->name,
                    $dp->tempatlahir,
                    $dp->tanggallahir,
                    $dp->nohpdarurat,
                    $dp->alamatlengkap,
                    $dp->latarbelakang,
                    $dp->perusahaan,
                    $dp->departemenpeserta,
                    $dp->universitas,
                    $dp->jurusan,
                    $dp->tanggalpelaksanaan,
                    $dp->judulprogram,
                    $dp->lokasipelaksanaan,
                    $dp->kotapelaksanaan,
                    $dp->akuninstagram,
                    $dp->materi,
                    $dp->posted_by,
                    $dp->created_at
                ]);
            }
        });
        })->export('xls');
    }

    private function exportPdf($datapeserta)
    {
        $pdf = PDF::loadview('pdf', compact('datapeserta'));
        return $pdf->download('datapeserta.pdf');
    }
    public function print($id)
    {
        $datapeserta = Peserta::find($id);
        /*$materi = Materi::all(['id','name']);*/
        $jeniskelas = Jeniskelas::find($datapeserta->jeniskelas_id);
        return view('datainputbyuser.print')->with(compact('jeniskelas','datapeserta'));
    }

    public function exportAll()
    {
        $user = Auth::user()->name;
        $getfilter = $request->get('filter');
        $getdari = $request->get('dari');
        $getsampai = $request->get('sampai');
        $getmonth = date('m');
        $getyear = date('Y');
        $gettoday = date('d');
        if($getfilter == 'all'){
            $datapeserta = Peserta::where('posted_by', $user);
        }elseif($getfilter == 'bulanan'){
            $datapeserta = Peserta::where('posted_by', $user)->whereYear('created_at','=',$getyear)->whereMonth('created_at','=',$getmonth)->get();
        }elseif($getfilter == 'tahunan'){
            $datapeserta = Peserta::where('posted_by', $user)->whereYear('created_at','=',$getyear)->get();
        }elseif($getfilter == 'tanggal'){
            $datapeserta = Peserta::whereBetween('created_at',array($getdari,$getsampai))->get();
        }else{
            $datapeserta = Peserta::where('posted_by', $user);
        }
        // $datapeserta = Peserta::where('posted_by', $user);
        Excel::create('Data Peserta Duta Bangsa', function($excel) use ($datapeserta) {
        
        $excel->setTitle('Data Peserta Duta Bangsa')->setCreator(Auth::user()->name);

        $excel->sheet('Data Peserta', function($sheet) use ($datapeserta) {
        $row = 1;
        $sheet->row($row, [
        'Nis','Nama','No. HP','Email','Jenis Kelamin','Jenis Kelas','Tempat Lahir','Tanggal Lahir','Usia','No. HP Darurat','Alamat Lengkap','Didaftarkan Oleh','Mengetahui Duta Bangsa','Latar Belakang','Perusahaan','Jenis Industri','Departemen','Jabatan','Level Jabatan','universitas','Jurusan','Sekolah','Tanggal Pelaksanaan','Judul Program','Lokasi Pelaksanaan','Kota Pelaksanaan','Instagram','Materi','Input By','Waktu Input']);
        foreach ($datapeserta as $dp) {
                    $sheet->row(++$row, [
                    $dp->nis,
                    $dp->nama,
                    $dp->nohp,
                    $dp->email,
                    $dp->jeniskelamin,
                    $dp->jeniskelas->name,
                    $dp->tempatlahir,
                    $dp->tanggallahir,
                    $dp->usia,
                    $dp->nohpdarurat,
                    $dp->alamatlengkap,
                    $dp->didaftarkanoleh,
                    $dp->mengetahuidb,
                    $dp->latarbelakang,
                    $dp->perusahaan,
                    $dp->jenisindustri,
                    $dp->departemenpeserta,
                    $dp->jabatan,
                    $dp->leveljabatan,
                    $dp->universitas,
                    $dp->jurusan,
                    $dp->namasekolah,
                    $dp->tanggalpelaksanaan,
                    $dp->judulprogram,
                    $dp->lokasipelaksanaan,
                    $dp->kotapelaksanaan,
                    $dp->akuninstagram,
                    $dp->materi,
                    $dp->posted_by,
                    $dp->created_at
                ]);
            }
        });
        })->export('xls');
    }
}
