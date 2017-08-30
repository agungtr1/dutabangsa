<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Laratrust\LaratrustFacade as Laratrust;
use App\Jeniskelas;
use App\Peserta;
use Illuminate\Support\Facades\DB;
use Khill\Lavacharts\Lavacharts;

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
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Laratrust::hasRole('admin') OR Laratrust::hasRole('user')){
            $getfilter = $request->get('filter');
            $getdari = $request->get('dari');
            $getsampai = $request->get('sampai');
            $getmonth = date('m');
            $getyear = date('Y');
            $gettoday = date('d');

            //Jenis Kelamin
            $reasons =\Lava::DataTable();
            // $datajeniskelamin = Peserta::groupBy('jeniskelamin')->select('jeniskelamin', DB::raw('count(*) as j_k'))->get();
            // $pesertas = Peserta::all();
            // $pesertas_count = $pesertas->count();
            // $laki = Peserta::where('jeniskelamin','laki-laki');
            // $laki_count = $laki->count();
            // $perempuan = Peserta::where('jeniskelamin','perempuan');
            // $perempuan_count = $perempuan->count();
            // $nulljk = Peserta::whereNull('jeniskelamin');
            // $nulljk_count = $nulljk->count();
            // $lk = ($laki_count)/$pesertas_count;
            // $pr = ($perempuan_count)/$pesertas_count;
            // $nl = ($nulljk_count)/$pesertas_count;

            // $reasons->addStringColumn('Reasons')
            //         ->addNumberColumn('Percent')
            //         ->addRow(array('Laki - Laki', $laki_count))
            //         ->addRow(array('Perempuan', $perempuan_count))
            //         ->addRow(array('Null', $nulljk_count));
            if($getfilter == 'all'){
                $datajeniskelamin = Peserta::groupBy('jeniskelamin')->select('jeniskelamin', DB::raw('count(*) as j_k'))->get();
            }elseif($getfilter == 'bulanan'){
                $datajeniskelamin = Peserta::groupBy('jeniskelamin')->whereYear('created_at','=',$getyear)->whereMonth('created_at','=',$getmonth)->select('jeniskelamin', DB::raw('count(*) as j_k'))->get();
            }elseif($getfilter == 'tahunan'){
                $datajeniskelamin = Peserta::groupBy('jeniskelamin')->whereYear('created_at','=',$getyear)->select('jeniskelamin', DB::raw('count(*) as j_k'))->get();
            }elseif($getfilter == 'tanggal'){
                $datajeniskelamin = Peserta::groupBy('jeniskelamin')->whereBetween('created_at',array($getdari,$getsampai))->select('jeniskelamin', DB::raw('count(*) as j_k'))->get();
            }else{
                $datajeniskelamin = Peserta::groupBy('jeniskelamin')->select('jeniskelamin', DB::raw('count(*) as j_k'))->get();
            }
            $reasons->addStringColumn('Jenis Kelamin')
                ->addNumberColumn('Jumlah');
            foreach($datajeniskelamin as $n){
                $reasons->addRow(array($n->jeniskelamin,$n->j_k));
            }

            /*$donutchart = \Lava::DonutChart('jeniskelamin', $reasons, [
                            'title' => 'Jenis Kelamin'
                        ]);*/
             \Lava::BarChart('jeniskelamin', $reasons);

            //Latar Belakang
            $reasons2 = \Lava::DataTable();

            //$dataLB = Peserta::groupBy('latarbelakang')->select('latarbelakang', DB::raw('count(*) as lb'))->get();
            if($getfilter == 'all'){
                $dataLB = Peserta::groupBy('latarbelakang')->select('latarbelakang', DB::raw('count(*) as lb'))->get();
            }elseif($getfilter == 'bulanan'){
                $dataLB = Peserta::groupBy('latarbelakang')->whereYear('created_at','=',$getyear)->whereMonth('created_at','=',$getmonth)->select('latarbelakang', DB::raw('count(*) as lb'))->get();
            }elseif($getfilter == 'tahunan'){
                $dataLB = Peserta::groupBy('latarbelakang')->whereYear('created_at','=',$getyear)->select('latarbelakang', DB::raw('count(*) as lb'))->get();
            }elseif($getfilter == 'tanggal'){
                $dataLB = Peserta::groupBy('latarbelakang')->whereBetween('created_at',array($getdari,$getsampai))->select('latarbelakang', DB::raw('count(*) as lb'))->get();
            }else{
                $dataLB = Peserta::groupBy('latarbelakang')->select('latarbelakang', DB::raw('count(*) as lb'))->get();
            }

            $reasons2->addColumn('string','Reasons')
                ->addColumn('number','Percent');
            foreach($dataLB as $n){
                $reasons2->addRow(
                    array($n->latarbelakang,$n->lb));
            }


            /*\Lava::PieChart('latarbelakang', $reasons2, [
                'title'  => 'Latar Belakang',
                'is3D'   => true,
                'slices' => [
                    ['offset' => 0.2],
                    ['offset' => 0.25],
                    ['offset' => 0.3]
                ]
            ]);*/
            \Lava::BarChart('latarbelakang', $reasons2);

            //Level Jabatan
            $reasons3 = \Lava::DataTable();

            //$dataJAB = Peserta::groupBy('leveljabatan')->select('leveljabatan', DB::raw('count(*) as jab'))->get();
            if($getfilter == 'all'){
                $dataJAB = Peserta::groupBy('leveljabatan')->select('leveljabatan', DB::raw('count(*) as jab'))->get();
            }elseif($getfilter == 'bulanan'){
                $dataJAB = Peserta::groupBy('leveljabatan')->whereYear('created_at','=',$getyear)->whereMonth('created_at','=',$getmonth)->select('leveljabatan', DB::raw('count(*) as jab'))->get();
            }elseif($getfilter == 'tahunan'){
                $dataJAB = Peserta::groupBy('leveljabatan')->whereYear('created_at','=',$getyear)->select('leveljabatan', DB::raw('count(*) as jab'))->get();
            }elseif($getfilter == 'tanggal'){
                $dataJAB = Peserta::groupBy('leveljabatan')->whereBetween('created_at',array($getdari,$getsampai))->select('leveljabatan', DB::raw('count(*) as jab'))->get();
            }else{
                $dataJAB = Peserta::groupBy('leveljabatan')->select('leveljabatan', DB::raw('count(*) as jab'))->get();
            }

            $reasons3->addStringColumn('Level Jabatan')
                ->addNumberColumn('Jumlah');
            foreach($dataJAB as $n){
                $reasons3->addRow(array($n->leveljabatan,$n->jab));
            }

            /*\Lava::PieChart('jabatan', $reasons3, [
                'title'  => 'Jabatan',
                'is3D'   => true,
                'slices' => [
                    ['offset' => 0.2],
                    ['offset' => 0.25],
                    ['offset' => 0.3]
                ]
            ]);*/
            \Lava::BarChart('jabatan', $reasons3);

            //Usia
            $reasons4 = \Lava::DataTable();

            //$datausia = Peserta::groupBy('usia')->select('usia', DB::raw('count(*) as us'))->get();
            if($getfilter == 'all'){
                $datausia = Peserta::groupBy('usia')->select('usia', DB::raw('count(*) as us'))->get();
            }elseif($getfilter == 'bulanan'){
                $datausia = Peserta::groupBy('usia')->whereYear('created_at','=',$getyear)->whereMonth('created_at','=',$getmonth)->select('usia', DB::raw('count(*) as us'))->get();
            }elseif($getfilter == 'tahunan'){
                $datausia = Peserta::groupBy('usia')->whereYear('created_at','=',$getyear)->select('usia', DB::raw('count(*) as us'))->get();
            }elseif($getfilter == 'tanggal'){
                $datausia = Peserta::groupBy('usia')->whereBetween('created_at',array($getdari,$getsampai))->select('usia', DB::raw('count(*) as us'))->get();
            }else{
                $datausia = Peserta::groupBy('usia')->select('usia', DB::raw('count(*) as us'))->get();
            }

            $reasons4->addStringColumn('Usia')
                ->addNumberColumn('Jumlah');
            foreach($datausia as $n){
                $reasons4->addRow(
                    array($n->usia,$n->us));
            }


            /*\Lava::DonutChart('usia', $reasons4, [
                            'title' => 'Usia'
                        ]);*/
            \Lava::ColumnChart('usia', $reasons4, [
                'title' => 'Usia',
                'titleTextStyle' => [
                    'color'    => '#eb6b2c',
                    'fontSize' => 14
                ]
            ]);

            //jenisindustri
            $reasons5 = \Lava::DataTable();

            // $dataji = Peserta::groupBy('jenisindustri')->select('jenisindustri', DB::raw('count(*) as ji'))->get();
            if($getfilter == 'all'){
                $dataji = Peserta::groupBy('jenisindustri')->select('jenisindustri', DB::raw('count(*) as ji'))->get();
            }elseif($getfilter == 'bulanan'){
                $dataji = Peserta::groupBy('jenisindustri')->whereYear('created_at','=',$getyear)->whereMonth('created_at','=',$getmonth)->select('jenisindustri', DB::raw('count(*) as ji'))->get();
            }elseif($getfilter == 'tahunan'){
                $dataji = Peserta::groupBy('jenisindustri')->whereYear('created_at','=',$getyear)->select('jenisindustri', DB::raw('count(*) as ji'))->get();
            }elseif($getfilter == 'tanggal'){
                $dataji = Peserta::groupBy('jenisindustri')->whereBetween('created_at',array($getdari,$getsampai))->select('jenisindustri', DB::raw('count(*) as ji'))->get();
            }else{
                $dataji = Peserta::groupBy('jenisindustri')->select('jenisindustri', DB::raw('count(*) as ji'))->get();
            }

            $reasons5->addStringColumn('Industri')
                ->addNumberColumn('Jumlah');
            foreach($dataji as $n){
                $reasons5->addRow(
                    array($n->jenisindustri,$n->ji));
            }


            /*\Lava::DonutChart('jenisindustri', $reasons5, [
                            'title' => 'Jenis Industri'
                        ]);*/
            \Lava::BarChart('jenisindustri', $reasons5);

            //universitas
            $reasons6 = \Lava::DataTable();

            // $datauniv = Peserta::groupBy('universitas')->select('universitas', DB::raw('count(*) as univ'))->get();
            if($getfilter == 'all'){
                $datauniv = Peserta::groupBy('universitas')->select('universitas', DB::raw('count(*) as univ'))->get();
            }elseif($getfilter == 'bulanan'){
                $datauniv = Peserta::groupBy('universitas')->whereYear('created_at','=',$getyear)->whereMonth('created_at','=',$getmonth)->select('universitas', DB::raw('count(*) as univ'))->get();
            }elseif($getfilter == 'tahunan'){
                $datauniv = Peserta::groupBy('universitas')->whereYear('created_at','=',$getyear)->select('universitas', DB::raw('count(*) as univ'))->get();
            }elseif($getfilter == 'tanggal'){
                $datauniv = Peserta::groupBy('universitas')->whereBetween('created_at',array($getdari,$getsampai))->select('universitas', DB::raw('count(*) as univ'))->get();
            }else{
                $datauniv = Peserta::groupBy('universitas')->select('universitas', DB::raw('count(*) as univ'))->get();
            }

            $reasons6->addStringColumn('Industri')
                ->addNumberColumn('Jumlah');
            foreach($datauniv as $n){
                $reasons6->addRow(
                    array($n->universitas,$n->univ));
            }


           /* \Lava::DonutChart('universitas', $reasons6, [
                            'title' => 'Universitas'
                        ]);*/
            \Lava::BarChart('universitas', $reasons6);


            //Jurusan
            $reasons7 = \Lava::DataTable();

            // $datajurusan = Peserta::groupBy('jurusan')->select('jurusan', DB::raw('count(*) as jur'))->get();
            if($getfilter == 'all'){
                $datajurusan = Peserta::groupBy('jurusan')->select('jurusan', DB::raw('count(*) as jur'))->get();
            }elseif($getfilter == 'bulanan'){
                $datajurusan = Peserta::groupBy('jurusan')->whereYear('created_at','=',$getyear)->whereMonth('created_at','=',$getmonth)->select('jurusan', DB::raw('count(*) as jur'))->get();
            }elseif($getfilter == 'tahunan'){
                $datajurusan = Peserta::groupBy('jurusan')->whereYear('created_at','=',$getyear)->select('jurusan', DB::raw('count(*) as jur'))->get();
            }elseif($getfilter == 'tanggal'){
                $datajurusan = Peserta::groupBy('jurusan')->whereBetween('created_at',array($getdari,$getsampai))->select('jurusan', DB::raw('count(*) as jur'))->get();
            }else{
                $datajurusan = Peserta::groupBy('jurusan')->select('jurusan', DB::raw('count(*) as jur'))->get();
            }

            $reasons7->addStringColumn('Jurusan')
                ->addNumberColumn('Jumlah');
            foreach($datajurusan as $n){
                $reasons7->addRow(array($n->jurusan,$n->jur));
            }

            /*\Lava::PieChart('jurusan', $reasons7, [
                'title'  => 'Jurusan',
                'is3D'   => true,
                'slices' => [
                    ['offset' => 0.2],
                    ['offset' => 0.25],
                    ['offset' => 0.3]
                ]
            ]);*/

            \Lava::ColumnChart('jurusan', $reasons7, [
                'title' => 'Jurusan',
                'titleTextStyle' => [
                    'color'    => '#eb6b2c',
                    'fontSize' => 14
                ]
            ]);

            //Mengetahui DB
            $reasons8 = \Lava::DataTable();

            // $datamdb = Peserta::groupBy('mengetahuidb')->select('mengetahuidb', DB::raw('count(*) as mdb'))->get();
            if($getfilter == 'all'){
                $datamdb = Peserta::groupBy('mengetahuidb')->select('mengetahuidb', DB::raw('count(*) as mdb'))->get();
            }elseif($getfilter == 'bulanan'){
                $datamdb = Peserta::groupBy('mengetahuidb')->whereYear('created_at','=',$getyear)->whereMonth('created_at','=',$getmonth)->select('mengetahuidb', DB::raw('count(*) as mdb'))->get();
            }elseif($getfilter == 'tahunan'){
                $datamdb = Peserta::groupBy('mengetahuidb')->whereYear('created_at','=',$getyear)->select('mengetahuidb', DB::raw('count(*) as mdb'))->get();
            }elseif($getfilter == 'tanggal'){
                $datamdb = Peserta::groupBy('mengetahuidb')->whereBetween('created_at',array($getdari,$getsampai))->select('mengetahuidb', DB::raw('count(*) as mdb'))->get();
            }else{
                $datamdb = Peserta::groupBy('mengetahuidb')->select('mengetahuidb', DB::raw('count(*) as mdb'))->get();
            }

            $reasons8->addStringColumn('Mengetahui Duta Bangsa')
                ->addNumberColumn('Jumlah');
            foreach($datamdb as $n){
                $reasons8->addRow(array($n->mengetahuidb,$n->mdb));
            }

            \Lava::BarChart('mengetahuidb', $reasons8);


            //Jenis Kelas
            $reasons9 = \Lava::DataTable();

            // $datajeniskelas = Peserta::with('jeniskelas')->groupBy('jeniskelas_id')->select('jeniskelas_id', DB::raw('count(*) as jenis'))->get();
            
            if($getfilter == 'all'){
                $datajeniskelas = Peserta::with('jeniskelas')->groupBy('jeniskelas_id')->select('jeniskelas_id', DB::raw('count(*) as jenis'))->get();
            }elseif($getfilter == 'bulanan'){
                $datajeniskelas = Peserta::with('jeniskelas')->groupBy('jeniskelas_id')->whereYear('created_at','=',$getyear)->whereMonth('created_at','=',$getmonth)->select('jeniskelas_id', DB::raw('count(*) as jenis'))->get();
            }elseif($getfilter == 'tahunan'){
                $datajeniskelas = Peserta::with('jeniskelas')->groupBy('jeniskelas_id')->whereYear('created_at','=',$getyear)->select('jeniskelas_id', DB::raw('count(*) as jenis'))->get();
            }elseif($getfilter == 'tanggal'){
                $datajeniskelas = Peserta::with('jeniskelas')->groupBy('jeniskelas_id')->whereBetween('created_at',array($getdari,$getsampai))->select('jeniskelas_id', DB::raw('count(*) as jenis'))->get();
            }else{
                $datajeniskelas = Peserta::with('jeniskelas')->groupBy('jeniskelas_id')->select('jeniskelas_id', DB::raw('count(*) as jenis'))->get();
            }
            $reasons9->addStringColumn('Jenis Kelas')
                ->addNumberColumn('Jumlah');
            foreach($datajeniskelas as $n){
                $reasons9->addRow(array($n->jeniskelas->name,$n->jenis));
            }

            \Lava::ColumnChart('JenisKelass', $reasons9, [
                'title' => 'Jenis Kelas',
                'titleTextStyle' => [
                    'color'    => '#eb6b2c',
                    'fontSize' => 14
                ]
            ]);


            return view('dashboard')->with(compact('getyear'));
        }
        return view('home');

    }

    /*protected function dashboard(Request $request)
    {
        //Jenis Kelamin
        $reasons =\Lava::DataTable();
        $pesertas = Peserta::all();
        $pesertas_count = $pesertas->count();
        $laki = Peserta::where('jeniskelamin','laki-laki');
        $laki_count = $laki->count();
        $perempuan = Peserta::where('jeniskelamin','perempuan');
        $perempuan_count = $perempuan->count();
        $nulljk = Peserta::whereNull('jeniskelamin');
        $nulljk_count = $nulljk->count();
        $lk = ($laki_count)/$pesertas_count;
        $pr = ($perempuan_count)/$pesertas_count;
        $nl = ($nulljk_count)/$pesertas_count;

        $reasons->addStringColumn('Reasons')
                ->addNumberColumn('Percent')
                ->addRow(array('Laki - Laki', $laki_count))
                ->addRow(array('Perempuan', $perempuan_count))
                ->addRow(array('Null', $nulljk_count));


        $donutchart = \Lava::DonutChart('jeniskelamin', $reasons, [
                        'title' => 'Jenis Kelamin'
                    ]);


        //Latar Belakang
        $reasons2 = \Lava::DataTable();

        $dataLB = Peserta::groupBy('latarbelakang')->select('latarbelakang', DB::raw('count(*) as lb'))->get();

        $getfilter = $request->get('filter');
        $getmonth = date('y');
        $getyear = date('m');
        $gettoday = date('d');
        if($getfilter == NULL){
            $dataLB = Peserta::groupBy('latarbelakang')->select('latarbelakang', DB::raw('count(*) as lb'))->get();
        }elseif($getfilter == 'bulanan'){
            $dataLB = Peserta::groupBy('latarbelakang')->select('latarbelakang', DB::raw('count(*) as lb'))->get();
        }elseif($getfilter == 'tahunan'){
            $dataLB = Peserta::groupBy('latarbelakang')->select('latarbelakang', DB::raw('count(*) as lb'))->get();
        }elseif($getfilter == 'tanggal'){
            $dataLB = Peserta::groupBy('latarbelakang')->select('latarbelakang', DB::raw('count(*) as lb'))->get();
        }elseif($getfilter == 'harian'){
            $dataLB = Peserta::groupBy('latarbelakang')->select('latarbelakang', DB::raw('count(*) as lb'))->where('created_at','=',$gettoday)->get();
        }elseif($getfilter == 'all'){
            $dataLB = Peserta::groupBy('latarbelakang')->select('latarbelakang', DB::raw('count(*) as lb'))->get();
        }

        $reasons2->addColumn('string','Reasons')
            ->addColumn('number','Percent');
        foreach($dataLB as $n){
            $reasons2->addRow(
                array($n->latarbelakang,$n->lb));
        }


        \Lava::PieChart('latarbelakang', $reasons2, [
            'title'  => 'Latar Belakang',
            'is3D'   => true,
            'slices' => [
                ['offset' => 0.2],
                ['offset' => 0.25],
                ['offset' => 0.3]
            ]
        ]);

        //Level Jabatan
        $reasons3 = \Lava::DataTable();

        $dataJAB = Peserta::groupBy('leveljabatan')->select('leveljabatan', DB::raw('count(*) as jab'))->get();

        $reasons3->addStringColumn('Level Jabatan')
            ->addNumberColumn('Jumlah');
        foreach($dataJAB as $n){
            $reasons3->addRow(array($n->leveljabatan,$n->jab));
        }

        \Lava::PieChart('jabatan', $reasons3, [
            'title'  => 'Jabatan',
            'is3D'   => true,
            'slices' => [
                ['offset' => 0.2],
                ['offset' => 0.25],
                ['offset' => 0.3]
            ]
        ]);

        //Usia
        $reasons4 = \Lava::DataTable();

        $datausia = Peserta::groupBy('usia')->select('usia', DB::raw('count(*) as us'))->get();

        $reasons4->addStringColumn('Usia')
            ->addNumberColumn('Jumlah');
        foreach($datausia as $n){
            $reasons4->addRow(
                array($n->usia,$n->us));
        }


        \Lava::DonutChart('usia', $reasons4, [
                        'title' => 'Usia'
                    ]);

        //jenisindustri
        $reasons5 = \Lava::DataTable();

        $dataji = Peserta::groupBy('jenisindustri')->select('jenisindustri', DB::raw('count(*) as ji'))->get();

        $reasons5->addStringColumn('Industri')
            ->addNumberColumn('Jumlah');
        foreach($dataji as $n){
            $reasons5->addRow(
                array($n->jenisindustri,$n->ji));
        }


        \Lava::DonutChart('jenisindustri', $reasons5, [
                        'title' => 'Jenis Industri'
                    ]);

        //universitas
        $reasons6 = \Lava::DataTable();

        $datauniv = Peserta::groupBy('universitas')->select('universitas', DB::raw('count(*) as univ'))->get();

        $reasons6->addStringColumn('Industri')
            ->addNumberColumn('Jumlah');
        foreach($datauniv as $n){
            $reasons6->addRow(
                array($n->universitas,$n->univ));
        }


        \Lava::DonutChart('universitas', $reasons6, [
                        'title' => 'Universitas'
                    ]);


        //Jurusan
        $reasons7 = \Lava::DataTable();

        $datajurusan = Peserta::groupBy('jurusan')->select('jurusan', DB::raw('count(*) as jur'))->get();

        $reasons7->addStringColumn('Jurusan')
            ->addNumberColumn('Jumlah');
        foreach($datajurusan as $n){
            $reasons7->addRow(array($n->jurusan,$n->jur));
        }

        \Lava::PieChart('jurusan', $reasons7, [
            'title'  => 'Jurusan',
            'is3D'   => true,
            'slices' => [
                ['offset' => 0.2],
                ['offset' => 0.25],
                ['offset' => 0.3]
            ]
        ]);

        //Mengetahui DB
        $reasons8 = \Lava::DataTable();

        $datamdb = Peserta::groupBy('mengetahuidb')->select('mengetahuidb', DB::raw('count(*) as mdb'))->get();

        $reasons8->addStringColumn('Mengetahui Duta Bangsa')
            ->addNumberColumn('Jumlah');
        foreach($datamdb as $n){
            $reasons8->addRow(array($n->mengetahuidb,$n->mdb));
        }

        \Lava::BarChart('mengetahuidb', $reasons8);


        //Jenis Kelas
        $reasons9 = \Lava::DataTable();

        $datajeniskelas = Peserta::with('jeniskelas')->groupBy('jeniskelas_id')->select('jeniskelas_id', DB::raw('count(*) as jenis'))->get();

        $reasons9->addStringColumn('Jenis Kelas')
            ->addNumberColumn('Jumlah');
        foreach($datajeniskelas as $n){
            $reasons9->addRow(array($n->jeniskelas->name,$n->jenis));
        }

        \Lava::ColumnChart('JenisKelass', $reasons9, [
            'title' => 'Jenis Kelas',
            'titleTextStyle' => [
                'color'    => '#eb6b2c',
                'fontSize' => 14
            ]
        ]);


        return view('dashboard');
    }*/
}
