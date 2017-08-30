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
use PDF;
use Excel;
use Illuminate\Support\Facades\Auth;
use App\Helpers\AutoNumber;
use DateTime;

class DatapesertaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $htmlBuilder)
    {
        /*if($request->get('filter')){
            $datapeserta = Peserta::with('jeniskelas')->where('nama', 'like', "%{$request->get('filter')}%")->get();
        }else{
            $datapeserta = Peserta::with('jeniskelas')->get();
        }

        if($request->ajax()){
            // $datapeserta = Peserta::with('jeniskelas');
            // return Datatables::of($datapeserta)->make(true);
            return Datatables::of($datapeserta)->addColumn('action', function($datapeserta){
                return view('datatable._actiondatapeserta', [
                    'model' => $datapeserta,
                    'form_url' => route('datapeserta.destroy', $datapeserta->id),
                    'edit_url' => route('datapeserta.edit', $datapeserta->id),
                    'show_url' => route('datapeserta.show', $datapeserta->id),
                    'print_url' => route('print.datapeserta', $datapeserta->id),
                    'confirm_message' => 'Yakin mau menghapus'.$datapeserta->nama.'?'
                    ]);
            })->make(true);
        }
        $html = $htmlBuilder->addColumn(['data'=>'nis', 'name'=>'nis', 'title'=>'NIS'])
        ->addColumn(['data'=>'nama', 'name'=>'nama', 'title'=>'Nama'])
        ->addColumn(['data'=>'nohp', 'name'=>'nohp', 'title'=>'No. HP'])
        ->addColumn(['data'=>'jeniskelas.name', 'name'=>'jeniskelas.name', 'title'=>'Jenis Kelas'])
        ->addColumn(['data'=>'latarbelakang', 'name'=>'latarbelakang', 'title'=>'Latar Belakang'])
        ->addColumn(['data'=>'tanggalpelaksanaan', 'name'=>'tanggalpelaksanaan', 'title'=>'Tanggal Pelaksanaan'])
        ->addColumn(['data'=>'judulprogram', 'name'=>'judulprogram', 'title'=>'Judul'])
        ->addColumn(['data'=>'materi', 'name'=>'materi', 'title'=>'Materi'])
        ->addColumn(['data'=>'posted_by', 'name'=>'posted_by', 'title'=>'Input'])
        ->addColumn(['data'=>'action', 'name'=>'action', 'title'=>'', 'orderable'=>false, 'searchable'=>false]);*/

        $datapeserta = Peserta::with('jeniskelas')->paginate(10);
        return view('datapeserta.index')->with(compact('datapeserta'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $materi = Materi::all(['id','name']);
        return view('datapeserta.create')->with(compact('materi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*$this->validate($request, ['nama'=>'required','nis'=>'required','nohp'=>'numeric','email'=>'required','jeniskelas'=>'required','latarbelakang'=>'required']);*/

       /* $data = [
            'nama' => $request->nama,
            'nis' => $request->nis,
            'nohp' => $request->nohp,
            'email' => $request->email,
            'jeniskelamin' => $request->jeniskelamin,
            'jeniskelas_id' => $request->jeniskelas,
            'tempatlahir' => $request->tempatlahir,
            'tanggallahir' => $request->tanggallahir,
            'nohpdarurat' => $request->nohpdarurat,
            'alamatlengkap' => $request->alamatlengkap,
            'latarbelakang' => $request->latarbelakang,
            'perusahaan' => $request->perusahaan,
            'departemenpeserta' => $request->departemenpeserta,
            'universitas' => $request->universitas,
            'jurusan' => $request->jurusan,
            'tanggalpelaksanaan' => $request->tanggalpelaksanaan,
            'judulprogram' => $request->judulprogram,
            'lokasipelaksanaan' => $request->lokasipelaksanaan,
            'kotapelaksanaan' => $request->kotapelaksanaan,
            'akuninstagram' => $request->akuninstagram,
            'posted_by' => $request->posted_by
        ];*/
 
        /*DB::table('pesertas')->insert($data);*/
        /*$peserta = Peserta::create($request->all());

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil menyimpan $data->nama"
        ]);*/

        $this->validate($request, ['nama'=>'required']);
        $request->merge([ 
            'materi' => implode(', ', (array) $request->get('materi'))
        ]);
        $data = $request->all();

        $table = "pesertas";
        $primary = "nis";
        $getnis = $request->get('jeniskelas_id');

        if($getnis == 1){
            $prefix = "RCL.";
        }elseif ($getnis == 2){
            $prefix = "IHT.";
        }elseif ($getnis == 3){
            $prefix = "PRC.";
        }elseif ($getnis == 4){
            $prefix = "SMN.";
        }elseif ($getnis == 5){
            $prefix = "PBC.";
        }elseif ($getnis == 6){
            $prefix = "OPC.";
        }else{
            $prefix = "NUL.";
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

        return redirect()->route('datapeserta.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $datapeserta = Peserta::with('jeniskelas')->find($id);
        /*$materi = Materi::all(['id','name']);*/
        /*$jeniskelas = Jeniskelas::find($datapeserta->jeniskelas_id);*/
        return view('datapeserta.show')->with(compact('datapeserta'));
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
        return view('datapeserta.edit')->with(compact('materi','datapeserta'));
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
            $prefix = "RCL.";
        }elseif ($getnis == 2){
            $prefix = "IHT.";
        }elseif ($getnis == 3){
            $prefix = "PRC.";
        }elseif ($getnis == 4){
            $prefix = "SMN.";
        }elseif ($getnis == 5){
            $prefix = "PBC.";
        }elseif ($getnis == 6){
            $prefix = "OPC.";
        }else{
            $prefix = "NUL.";
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
        return redirect()->route('datapeserta.index');
    }

    public function export()
    {
        return view('datapeserta.export');
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
        return view('datapeserta.print')->with(compact('jeniskelas','datapeserta'));
    }

    public function exportAll(Request $request)
    {
        $getfilter = $request->get('filter');
        $getdari = $request->get('dari');
        $getsampai = $request->get('sampai');
        $getmonth = date('m');
        $getyear = date('Y');
        $gettoday = date('d');
        if($getfilter == 'all'){
            $datapeserta = Peserta::all();
        }elseif($getfilter == 'bulanan'){
            $datapeserta = Peserta::whereYear('created_at','=',$getyear)->whereMonth('created_at','=',$getmonth)->get();
        }elseif($getfilter == 'tahunan'){
            $datapeserta = Peserta::whereYear('created_at','=',$getyear)->get();
        }elseif($getfilter == 'tanggal'){
            $datapeserta = Peserta::whereBetween('created_at',array($getdari,$getsampai))->get();
        }else{
            $datapeserta = Peserta::all();
        }

        // $datapeserta = Peserta::all();
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

    public function filterdata(Request $request)
    {
        $tahunini = date('Y');
        $a = $request->get('jk');
        $b = $request->get('jeniskelas_id');
        $c = $request->get('lb');
        $d = $request->get('materi');
        $e = $request->get('jenisindustri');
        $f = $request->get('lj');
        $g = $request->get('bp');
        $h = $request->get('tp');

        // variabel jenis kelamin //
        if($a != NULL && $b == NULL && $c == NULL && $d == NULL && $e == NULL && $f == NULL && $g == NULL && $h == NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('jeniskelamin','=',$a)->paginate(10);
        }elseif($a != NULL && $b != NULL && $c == NULL && $d == NULL && $e == NULL && $f == NULL && $g == NULL && $h == NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('jeniskelamin','=',$a)->where('jeniskelas_id','=',$b)->paginate(10);
        }elseif($a != NULL && $b != NULL && $c != NULL && $d == NULL && $e == NULL && $f == NULL && $g == NULL && $h == NULL){
             $datapeserta = Peserta::with('jeniskelas')->where('jeniskelamin','=',$a)->where('jeniskelas_id','=',$b)->where('latarbelakang','=',$c)->paginate(10);
        }elseif($a != NULL && $b != NULL && $c != NULL && $d != NULL && $e == NULL && $f == NULL && $g == NULL && $h == NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('jeniskelamin','=',$a)->where('jeniskelas_id','=',$b)->where('latarbelakang','=',$c)->where('materi','=',$d)->paginate(10);
        }elseif($a != NULL && $b != NULL && $c != NULL && $d != NULL && $e != NULL && $f == NULL && $g == NULL && $h == NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('jeniskelamin','=',$a)->where('jeniskelas_id','=',$b)->where('latarbelakang','=',$c)->where('materi','=',$d)->where('jenisindustri','=',$e)->paginate(10);
        }elseif($a != NULL && $b != NULL && $c != NULL && $d != NULL && $e != NULL && $f != NULL && $g == NULL && $h == NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('jeniskelamin','=',$a)->where('jeniskelas_id','=',$b)->where('latarbelakang','=',$c)->where('materi','=',$d)->where('jenisindustri','=',$e)->where('leveljabatan','=',$f)->paginate(10);
        }elseif($a != NULL && $b != NULL && $c != NULL && $d != NULL && $e != NULL && $f != NULL && $g != NULL && $h == NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('jeniskelamin','=',$a)->where('jeniskelas_id','=',$b)->where('latarbelakang','=',$c)->where('materi','=',$d)->where('jenisindustri','=',$e)->where('leveljabatan','=',$f)->whereYear('tanggalpelaksanaan','=',$tahunini)->whereMonth('tanggalpelaksanaan','=',$g)->paginate(10);
        }elseif($a != NULL && $b != NULL && $c != NULL && $d != NULL && $e != NULL && $f != NULL && $g != NULL && $h != NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('jeniskelamin','=',$a)->where('jeniskelas_id','=',$b)->where('latarbelakang','=',$c)->where('materi','=',$d)->where('jenisindustri','=',$e)->where('leveljabatan','=',$f)->whereMonth('tanggalpelaksanaan','=',$g)->whereYear('tanggalpelaksanaan','=',$h)->paginate(10);
        }

        if($a != NULL && $b == NULL && $c != NULL && $d == NULL && $e == NULL && $f == NULL && $g == NULL && $h == NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('jeniskelamin','=',$a)->where('latarbelakang','=',$c)->paginate(10);
        }elseif($a != NULL && $b == NULL && $c != NULL && $d != NULL && $e == NULL && $f == NULL && $g == NULL && $h == NULL){
             $datapeserta = Peserta::with('jeniskelas')->where('jeniskelamin','=',$a)->where('latarbelakang','=',$c)->where('materi','=',$d)->paginate(10);
        }elseif($a != NULL && $b == NULL && $c != NULL && $d != NULL && $e != NULL && $f == NULL && $g == NULL && $h == NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('jeniskelamin','=',$a)->where('latarbelakang','=',$c)->where('materi','=',$d)->where('jenisindustri','=',$e)->paginate(10);
        }elseif($a != NULL && $b == NULL && $c != NULL && $d != NULL && $e != NULL && $f != NULL && $g == NULL && $h == NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('jeniskelamin','=',$a)->where('latarbelakang','=',$c)->where('materi','=',$d)->where('jenisindustri','=',$e)->where('leveljabatan','=',$f)->paginate(10);
        }elseif($a != NULL && $b == NULL && $c != NULL && $d != NULL && $e != NULL && $f != NULL && $g != NULL && $h == NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('jeniskelamin','=',$a)->where('latarbelakang','=',$c)->where('materi','=',$d)->where('jenisindustri','=',$e)->where('leveljabatan','=',$f)->whereYear('tanggalpelaksanaan','=',$tahunini)->whereMonth('tanggalpelaksanaan','=',$g)->paginate(10);
        }elseif($a != NULL && $b == NULL && $c != NULL && $d != NULL && $e != NULL && $f != NULL && $g != NULL && $h != NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('jeniskelamin','=',$a)->where('latarbelakang','=',$c)->where('materi','=',$d)->where('jenisindustri','=',$e)->where('leveljabatan','=',$f)->whereMonth('tanggalpelaksanaan','=',$g)->whereYear('tanggalpelaksanaan','=',$h)->paginate(10);
        }

        if($a != NULL && $b == NULL && $c == NULL && $d != NULL && $e == NULL && $f == NULL && $g == NULL && $h == NULL){
             $datapeserta = Peserta::with('jeniskelas')->where('jeniskelamin','=',$a)->where('materi','=',$d)->paginate(10);
        }elseif($a != NULL && $b == NULL && $c == NULL && $d != NULL && $e != NULL && $f == NULL && $g == NULL && $h == NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('jeniskelamin','=',$a)->where('materi','=',$d)->where('jenisindustri','=',$e)->paginate(10);
        }elseif($a != NULL && $b == NULL && $c == NULL && $d != NULL && $e != NULL && $f != NULL && $g == NULL && $h == NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('jeniskelamin','=',$a)->where('materi','=',$d)->where('jenisindustri','=',$e)->where('leveljabatan','=',$f)->paginate(10);
        }elseif($a != NULL && $b == NULL && $c == NULL && $d != NULL && $e != NULL && $f != NULL && $g != NULL && $h == NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('jeniskelamin','=',$a)->where('materi','=',$d)->where('jenisindustri','=',$e)->where('leveljabatan','=',$f)->whereYear('tanggalpelaksanaan','=',$tahunini)->whereMonth('tanggalpelaksanaan','=',$g)->paginate(10);
        }elseif($a != NULL && $b == NULL && $c == NULL && $d != NULL && $e != NULL && $f != NULL && $g != NULL && $h != NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('jeniskelamin','=',$a)->where('materi','=',$d)->where('jenisindustri','=',$e)->where('leveljabatan','=',$f)->whereMonth('tanggalpelaksanaan','=',$g)->whereYear('tanggalpelaksanaan','=',$h)->paginate(10);
        }

        if($a != NULL && $b == NULL && $c == NULL && $d == NULL && $e != NULL && $f == NULL && $g == NULL && $h == NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('jeniskelamin','=',$a)->where('jenisindustri','=',$e)->paginate(10);
        }elseif($a != NULL && $b == NULL && $c == NULL && $d == NULL && $e != NULL && $f != NULL && $g == NULL && $h == NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('jeniskelamin','=',$a)->where('jenisindustri','=',$e)->where('leveljabatan','=',$f)->paginate(10);
        }elseif($a != NULL && $b == NULL && $c == NULL && $d == NULL && $e != NULL && $f != NULL && $g != NULL && $h == NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('jeniskelamin','=',$a)->where('jenisindustri','=',$e)->where('leveljabatan','=',$f)->whereYear('tanggalpelaksanaan','=',$tahunini)->whereMonth('tanggalpelaksanaan','=',$g)->paginate(10);
        }elseif($a != NULL && $b == NULL && $c == NULL && $d == NULL && $e != NULL && $f != NULL && $g != NULL && $h != NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('jeniskelamin','=',$a)->where('jenisindustri','=',$e)->where('leveljabatan','=',$f)->whereMonth('tanggalpelaksanaan','=',$g)->whereYear('tanggalpelaksanaan','=',$h)->paginate(10);
        }

        if($a != NULL && $b == NULL && $c == NULL && $d == NULL && $e == NULL && $f != NULL && $g == NULL && $h == NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('jeniskelamin','=',$a)->where('leveljabatan','=',$f)->paginate(10);
        }elseif($a != NULL && $b == NULL && $c == NULL && $d == NULL && $e == NULL && $f != NULL && $g != NULL && $h == NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('jeniskelamin','=',$a)->where('leveljabatan','=',$f)->whereYear('tanggalpelaksanaan','=',$tahunini)->whereMonth('tanggalpelaksanaan','=',$g)->paginate(10);
        }elseif($a != NULL && $b == NULL && $c == NULL && $d == NULL && $e == NULL && $f != NULL && $g != NULL && $h != NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('jeniskelamin','=',$a)->where('leveljabatan','=',$f)->whereMonth('tanggalpelaksanaan','=',$g)->whereYear('tanggalpelaksanaan','=',$h)->paginate(10);
        }

        if($a != NULL && $b == NULL && $c == NULL && $d == NULL && $e == NULL && $f == NULL && $g != NULL && $h == NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('jeniskelamin','=',$a)->whereYear('tanggalpelaksanaan','=',$tahunini)->whereMonth('tanggalpelaksanaan','=',$g)->paginate(10);
        }elseif($a != NULL && $b == NULL && $c == NULL && $d == NULL && $e == NULL && $f == NULL && $g != NULL && $h != NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('jeniskelamin','=',$a)->whereMonth('tanggalpelaksanaan','=',$g)->whereYear('tanggalpelaksanaan','=',$h)->paginate(10);
        }

        if($a != NULL && $b == NULL && $c == NULL && $d == NULL && $e == NULL && $f == NULL && $g == NULL && $h != NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('jeniskelamin','=',$a)->whereYear('tanggalpelaksanaan','=',$h)->paginate(10);
        }
        // end variabel jenis kelamin //

        // variabel jenis Jenis Kelas //
        if($a == NULL && $b != NULL && $c == NULL && $d == NULL && $e == NULL && $f == NULL && $g == NULL && $h == NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('jeniskelas_id','=',$b)->paginate(10);
        }elseif($a == NULL && $b != NULL && $c != NULL && $d == NULL && $e == NULL && $f == NULL && $g == NULL && $h == NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('jeniskelas_id','=',$b)->where('latarbelakang','=',$c)->paginate(10);
        }elseif($a == NULL && $b != NULL && $c != NULL && $d != NULL && $e == NULL && $f == NULL && $g == NULL && $h == NULL){
             $datapeserta = Peserta::with('jeniskelas')->where('jeniskelas_id','=',$b)->where('latarbelakang','=',$c)->where('materi','=',$d)->paginate(10);
        }elseif($a == NULL && $b != NULL && $c != NULL && $d != NULL && $e != NULL && $f == NULL && $g == NULL && $h == NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('jeniskelas_id','=',$b)->where('latarbelakang','=',$c)->where('materi','=',$d)->where('jenisindustri','=',$e)->paginate(10);
        }elseif($a == NULL && $b != NULL && $c != NULL && $d != NULL && $e != NULL && $f != NULL && $g == NULL && $h == NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('jeniskelas_id','=',$b)->where('latarbelakang','=',$c)->where('materi','=',$d)->where('jenisindustri','=',$e)->where('leveljabatan','=',$f)->paginate(10);
        }elseif($a == NULL && $b != NULL && $c != NULL && $d != NULL && $e != NULL && $f != NULL && $g != NULL && $h == NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('jeniskelas_id','=',$b)->where('latarbelakang','=',$c)->where('materi','=',$d)->where('jenisindustri','=',$e)->where('leveljabatan','=',$f)->whereYear('tanggalpelaksanaan','=',$tahunini)->whereMonth('tanggalpelaksanaan','=',$g)->paginate(10);
        }elseif($a == NULL && $b != NULL && $c != NULL && $d != NULL && $e != NULL && $f != NULL && $g != NULL && $h != NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('jeniskelas_id','=',$b)->where('latarbelakang','=',$c)->where('materi','=',$d)->where('jenisindustri','=',$e)->where('leveljabatan','=',$f)->whereMonth('tanggalpelaksanaan','=',$g)->whereYear('tanggalpelaksanaan','=',$h)->paginate(10);
        }

        if($a == NULL && $b != NULL && $c == NULL && $d != NULL && $e == NULL && $f == NULL && $g == NULL && $h == NULL){
             $datapeserta = Peserta::with('jeniskelas')->where('jeniskelas_id','=',$b)->where('materi','=',$d)->paginate(10);
        }elseif($a == NULL && $b != NULL && $c == NULL && $d != NULL && $e != NULL && $f == NULL && $g == NULL && $h == NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('jeniskelas_id','=',$b)->where('materi','=',$d)->where('jenisindustri','=',$e)->paginate(10);
        }elseif($a == NULL && $b != NULL && $c == NULL && $d != NULL && $e != NULL && $f != NULL && $g == NULL && $h == NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('jeniskelas_id','=',$b)->where('materi','=',$d)->where('jenisindustri','=',$e)->where('leveljabatan','=',$f)->paginate(10);
        }elseif($a == NULL && $b != NULL && $c == NULL && $d != NULL && $e != NULL && $f != NULL && $g != NULL && $h == NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('jeniskelas_id','=',$b)->where('materi','=',$d)->where('jenisindustri','=',$e)->where('leveljabatan','=',$f)->whereYear('tanggalpelaksanaan','=',$tahunini)->whereMonth('tanggalpelaksanaan','=',$g)->paginate(10);
        }elseif($a == NULL && $b != NULL && $c == NULL && $d != NULL && $e != NULL && $f != NULL && $g != NULL && $h != NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('jeniskelas_id','=',$b)->where('materi','=',$d)->where('jenisindustri','=',$e)->where('leveljabatan','=',$f)->whereMonth('tanggalpelaksanaan','=',$g)->whereYear('tanggalpelaksanaan','=',$h)->paginate(10);
        }

        if($a == NULL && $b != NULL && $c == NULL && $d == NULL && $e != NULL && $f == NULL && $g == NULL && $h == NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('jeniskelas_id','=',$b)->where('jenisindustri','=',$e)->paginate(10);
        }elseif($a == NULL && $b != NULL && $c == NULL && $d == NULL && $e != NULL && $f != NULL && $g == NULL && $h == NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('jeniskelas_id','=',$b)->where('jenisindustri','=',$e)->where('leveljabatan','=',$f)->paginate(10);
        }elseif($a == NULL && $b != NULL && $c == NULL && $d == NULL && $e != NULL && $f != NULL && $g != NULL && $h == NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('jeniskelas_id','=',$b)->where('jenisindustri','=',$e)->where('leveljabatan','=',$f)->whereYear('tanggalpelaksanaan','=',$tahunini)->whereMonth('tanggalpelaksanaan','=',$g)->paginate(10);
        }elseif($a == NULL && $b != NULL && $c == NULL && $d == NULL && $e != NULL && $f != NULL && $g != NULL && $h != NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('jeniskelas_id','=',$b)->where('jenisindustri','=',$e)->where('leveljabatan','=',$f)->whereMonth('tanggalpelaksanaan','=',$g)->whereYear('tanggalpelaksanaan','=',$h)->paginate(10);
        }

        if($a == NULL && $b != NULL && $c == NULL && $d == NULL && $e == NULL && $f != NULL && $g == NULL && $h == NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('jeniskelas_id','=',$b)->where('leveljabatan','=',$f)->paginate(10);
        }elseif($a == NULL && $b != NULL && $c == NULL && $d == NULL && $e == NULL && $f != NULL && $g != NULL && $h == NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('jeniskelas_id','=',$b)->where('leveljabatan','=',$f)->whereYear('tanggalpelaksanaan','=',$tahunini)->whereMonth('tanggalpelaksanaan','=',$g)->paginate(10);
        }elseif($a == NULL && $b != NULL && $c == NULL && $d == NULL && $e == NULL && $f != NULL && $g != NULL && $h != NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('jeniskelas_id','=',$b)->where('leveljabatan','=',$f)->whereMonth('tanggalpelaksanaan','=',$g)->whereYear('tanggalpelaksanaan','=',$h)->paginate(10);
        }

        if($a == NULL && $b != NULL && $c == NULL && $d == NULL && $e == NULL && $f == NULL && $g != NULL && $h == NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('jeniskelas_id','=',$b)->whereYear('tanggalpelaksanaan','=',$tahunini)->whereMonth('tanggalpelaksanaan','=',$g)->paginate(10);
        }elseif($a == NULL && $b != NULL && $c == NULL && $d == NULL && $e == NULL && $f == NULL && $g != NULL && $h != NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('jeniskelas_id','=',$b)->whereMonth('tanggalpelaksanaan','=',$g)->whereYear('tanggalpelaksanaan','=',$h)->paginate(10);
        }

        if($a == NULL && $b != NULL && $c == NULL && $d == NULL && $e == NULL && $f == NULL && $g == NULL && $h != NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('jeniskelas_id','=',$b)->whereYear('tanggalpelaksanaan','=',$h)->paginate(10);
        }
        // end variabel jenis Jenis Kelas //

        // variabel latar belakang //
        if($a == NULL && $b == NULL && $c != NULL && $d == NULL && $e == NULL && $f == NULL && $g == NULL && $h == NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('latarbelakang','=',$c)->paginate(10);
        }elseif($a == NULL && $b == NULL && $c != NULL && $d != NULL && $e == NULL && $f == NULL && $g == NULL && $h == NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('latarbelakang','=',$c)->where('materi','=',$d)->paginate(10);
        }elseif($a == NULL && $b == NULL && $c != NULL && $d != NULL && $e != NULL && $f == NULL && $g == NULL && $h == NULL){
             $datapeserta = Peserta::with('jeniskelas')->where('latarbelakang','=',$c)->where('materi','=',$d)->where('jenisindustri','=',$e)->paginate(10);
        }elseif($a == NULL && $b == NULL && $c != NULL && $d != NULL && $e != NULL && $f != NULL && $g == NULL && $h == NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('latarbelakang','=',$c)->where('materi','=',$d)->where('jenisindustri','=',$e)->where('leveljabatan','=',$f)->paginate(10);
        }elseif($a == NULL && $b == NULL && $c != NULL && $d != NULL && $e != NULL && $f != NULL && $g != NULL && $h == NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('latarbelakang','=',$c)->where('materi','=',$d)->where('jenisindustri','=',$e)->where('leveljabatan','=',$f)->whereYear('tanggalpelaksanaan','=',$tahunini)->whereMonth('tanggalpelaksanaan','=',$g)->paginate(10);
        }elseif($a == NULL && $b == NULL && $c != NULL && $d != NULL && $e != NULL && $f != NULL && $g != NULL && $h != NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('latarbelakang','=',$c)->where('materi','=',$d)->where('jenisindustri','=',$e)->where('leveljabatan','=',$f)->whereMonth('tanggalpelaksanaan','=',$g)->whereYear('tanggalpelaksanaan','=',$h)->paginate(10);
        }

        if($a == NULL && $b == NULL && $c != NULL && $d == NULL && $e != NULL && $f == NULL && $g == NULL && $h == NULL){
             $datapeserta = Peserta::with('jeniskelas')->where('latarbelakang','=',$c)->where('jenisindustri','=',$e)->paginate(10);
        }elseif($a == NULL && $b == NULL && $c != NULL && $d == NULL && $e != NULL && $f != NULL && $g == NULL && $h == NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('latarbelakang','=',$c)->where('jenisindustri','=',$e)->where('leveljabatan','=',$f)->paginate(10);
        }elseif($a == NULL && $b == NULL && $c != NULL && $d == NULL && $e != NULL && $f != NULL && $g != NULL && $h == NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('latarbelakang','=',$c)->where('jenisindustri','=',$e)->where('leveljabatan','=',$f)->whereYear('tanggalpelaksanaan','=',$tahunini)->whereMonth('tanggalpelaksanaan','=',$g)->paginate(10);
        }elseif($a == NULL && $b == NULL && $c != NULL && $d == NULL && $e != NULL && $f != NULL && $g != NULL && $h != NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('latarbelakang','=',$c)->where('jenisindustri','=',$e)->where('leveljabatan','=',$f)->whereMonth('tanggalpelaksanaan','=',$g)->whereYear('tanggalpelaksanaan','=',$h)->paginate(10);
        }

        if($a == NULL && $b == NULL && $c != NULL && $d == NULL && $e == NULL && $f != NULL && $g == NULL && $h == NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('latarbelakang','=',$c)->where('leveljabatan','=',$f)->paginate(10);
        }elseif($a == NULL && $b == NULL && $c != NULL && $d == NULL && $e == NULL && $f != NULL && $g != NULL && $h == NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('latarbelakang','=',$c)->where('leveljabatan','=',$f)->whereYear('tanggalpelaksanaan','=',$tahunini)->whereMonth('tanggalpelaksanaan','=',$g)->paginate(10);
        }elseif($a == NULL && $b == NULL && $c != NULL && $d == NULL && $e == NULL && $f != NULL && $g != NULL && $h != NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('latarbelakang','=',$c)->where('leveljabatan','=',$f)->whereMonth('tanggalpelaksanaan','=',$g)->whereYear('tanggalpelaksanaan','=',$h)->paginate(10);
        }

        if($a == NULL && $b == NULL && $c != NULL && $d == NULL && $e == NULL && $f == NULL && $g != NULL && $h == NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('latarbelakang','=',$c)->whereYear('tanggalpelaksanaan','=',$tahunini)->whereMonth('tanggalpelaksanaan','=',$g)->paginate(10);
        }elseif($a == NULL && $b == NULL && $c != NULL && $d == NULL && $e == NULL && $f == NULL && $g != NULL && $h != NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('latarbelakang','=',$c)->whereMonth('tanggalpelaksanaan','=',$g)->whereYear('tanggalpelaksanaan','=',$h)->paginate(10);
        }

        if($a == NULL && $b == NULL && $c != NULL && $d == NULL && $e == NULL && $f == NULL && $g == NULL && $h != NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('latarbelakang','=',$c)->whereYear('tanggalpelaksanaan','=',$h)->paginate(10);
        }
        // end variabel latar belakang //

        // variabel materi //
        if($a == NULL && $b == NULL && $c == NULL && $d != NULL && $e == NULL && $f == NULL && $g == NULL && $h == NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('materi','=',$d)->paginate(10);
        }elseif($a == NULL && $b == NULL && $c == NULL && $d != NULL && $e != NULL && $f == NULL && $g == NULL && $h == NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('materi','=',$d)->where('jenisindustri','=',$e)->paginate(10);
        }elseif($a == NULL && $b == NULL && $c == NULL && $d != NULL && $e != NULL && $f != NULL && $g == NULL && $h == NULL){
             $datapeserta = Peserta::with('jeniskelas')->where('materi','=',$d)->where('jenisindustri','=',$e)->where('leveljabatan','=',$f)->paginate(10);
        }elseif($a == NULL && $b == NULL && $c == NULL && $d != NULL && $e != NULL && $f != NULL && $g != NULL && $h == NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('materi','=',$d)->where('jenisindustri','=',$e)->where('leveljabatan','=',$f)->whereYear('tanggalpelaksanaan','=',$tahunini)->whereMonth('tanggalpelaksanaan','=',$g)->paginate(10);
        }elseif($a == NULL && $b == NULL && $c == NULL && $d != NULL && $e != NULL && $f != NULL && $g != NULL && $h != NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('materi','=',$d)->where('jenisindustri','=',$e)->where('leveljabatan','=',$f)->whereMonth('tanggalpelaksanaan','=',$g)->whereYear('tanggalpelaksanaan','=',$h)->paginate(10);
        }

        if($a == NULL && $b == NULL && $c == NULL && $d != NULL && $e == NULL && $f != NULL && $g == NULL && $h == NULL){
             $datapeserta = Peserta::with('jeniskelas')->where('materi','=',$d)->where('leveljabatan','=',$f)->paginate(10);
        }elseif($a == NULL && $b == NULL && $c == NULL && $d != NULL && $e == NULL && $f != NULL && $g != NULL && $h == NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('materi','=',$d)->where('leveljabatan','=',$f)->whereYear('tanggalpelaksanaan','=',$tahunini)->whereMonth('tanggalpelaksanaan','=',$g)->paginate(10);
        }elseif($a == NULL && $b == NULL && $c == NULL && $d != NULL && $e == NULL && $f != NULL && $g != NULL && $h != NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('materi','=',$d)->where('leveljabatan','=',$f)->whereMonth('tanggalpelaksanaan','=',$g)->whereYear('tanggalpelaksanaan','=',$h)->paginate(10);
        }

        if($a == NULL && $b == NULL && $c == NULL && $d != NULL && $e == NULL && $f == NULL && $g != NULL && $h == NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('materi','=',$d)->whereYear('tanggalpelaksanaan','=',$tahunini)->whereMonth('tanggalpelaksanaan','=',$g)->paginate(10);
        }elseif($a == NULL && $b == NULL && $c == NULL && $d != NULL && $e == NULL && $f == NULL && $g != NULL && $h != NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('materi','=',$d)->whereMonth('tanggalpelaksanaan','=',$g)->whereYear('tanggalpelaksanaan','=',$h)->paginate(10);
        }

        if($a == NULL && $b == NULL && $c == NULL && $d != NULL && $e == NULL && $f == NULL && $g == NULL && $h != NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('materi','=',$d)->whereYear('tanggalpelaksanaan','=',$h)->paginate(10);
        }
        // end variabel materi //

        // variabel jenis industri //
        if($a == NULL && $b == NULL && $c == NULL && $d == NULL && $e != NULL && $f == NULL && $g == NULL && $h == NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('jenisindustri','=',$e)->paginate(10);
        }elseif($a == NULL && $b == NULL && $c == NULL && $d == NULL && $e != NULL && $f != NULL && $g == NULL && $h == NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('jenisindustri','=',$e)->where('leveljabatan','=',$f)->paginate(10);
        }elseif($a == NULL && $b == NULL && $c == NULL && $d == NULL && $e != NULL && $f != NULL && $g != NULL && $h == NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('jenisindustri','=',$e)->where('leveljabatan','=',$f)->whereYear('tanggalpelaksanaan','=',$tahunini)->whereMonth('tanggalpelaksanaan','=',$g)->paginate(10);
        }elseif($a == NULL && $b == NULL && $c == NULL && $d == NULL && $e != NULL && $f != NULL && $g != NULL && $h != NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('jenisindustri','=',$e)->where('leveljabatan','=',$f)->whereMonth('tanggalpelaksanaan','=',$g)->whereYear('tanggalpelaksanaan','=',$h)->paginate(10);
        }

        if($a == NULL && $b == NULL && $c == NULL && $d == NULL && $e != NULL && $f == NULL && $g != NULL && $h == NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('jenisindustri','=',$e)->whereYear('tanggalpelaksanaan','=',$tahunini)->whereMonth('tanggalpelaksanaan','=',$g)->paginate(10);
        }elseif($a == NULL && $b == NULL && $c == NULL && $d == NULL && $e != NULL && $f == NULL && $g != NULL && $h != NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('jenisindustri','=',$e)->whereMonth('tanggalpelaksanaan','=',$g)->whereYear('tanggalpelaksanaan','=',$h)->paginate(10);
        }

        if($a == NULL && $b == NULL && $c == NULL && $d == NULL && $e != NULL && $f == NULL && $g == NULL && $h != NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('jenisindustri','=',$e)->whereYear('tanggalpelaksanaan','=',$h)->paginate(10);
        }
        // end variabel jenis industri //

        // variabel level jabatan //
        if($a == NULL && $b == NULL && $c == NULL && $d == NULL && $e == NULL && $f != NULL && $g == NULL && $h == NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('leveljabatan','=',$f)->paginate(10);
        }elseif($a == NULL && $b == NULL && $c == NULL && $d == NULL && $e == NULL && $f != NULL && $g != NULL && $h == NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('leveljabatan','=',$f)->whereYear('tanggalpelaksanaan','=',$tahunini)->whereMonth('tanggalpelaksanaan','=',$g)->paginate(10);
        }elseif($a == NULL && $b == NULL && $c == NULL && $d == NULL && $e == NULL && $f != NULL && $g != NULL && $h != NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('leveljabatan','=',$f)->whereMonth('tanggalpelaksanaan','=',$g)->whereYear('tanggalpelaksanaan','=',$h)->paginate(10);
        }

        if($a == NULL && $b == NULL && $c == NULL && $d == NULL && $e == NULL && $f != NULL && $g == NULL && $h != NULL){
            $datapeserta = Peserta::with('jeniskelas')->where('leveljabatan','=',$f)->whereYear('tanggalpelaksanaan','=',$h)->paginate(10);
        }
        // end variabel level jabatan //

        // variabel bulan pelaksanaan //
        if($a == NULL && $b == NULL && $c == NULL && $d == NULL && $e == NULL && $f == NULL && $g != NULL && $h == NULL){
            $datapeserta = Peserta::with('jeniskelas')->whereYear('tanggalpelaksanaan','=',$tahunini)->whereMonth('tanggalpelaksanaan','=',$g)->paginate(10);
        }elseif($a == NULL && $b == NULL && $c == NULL && $d == NULL && $e == NULL && $f == NULL && $g != NULL && $h != NULL){
            $datapeserta = Peserta::with('jeniskelas')->whereMonth('tanggalpelaksanaan','=',$g)->whereYear('tanggalpelaksanaan','=',$h)->paginate(10);
        }
        // end variabel bulan pelaksanaan //

        // variabel tahun pelaksanaan //
        if($a == NULL && $b == NULL && $c == NULL && $d == NULL && $e == NULL && $f == NULL && $g == NULL && $h != NULL){
            $datapeserta = Peserta::with('jeniskelas')->whereYear('tanggalpelaksanaan','=',$h)->paginate(10);
        }
        // end variabel tahun pelaksanaan //

        return view('datapeserta.index')->with(compact('datapeserta'));
    }

}
