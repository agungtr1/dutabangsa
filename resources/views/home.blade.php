@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <p style="text-align: center;">Selamat Datang di Sistem Database Peserta</p>
                    <div style="clear:both;">&nbsp;</div>
                    <div class="row">
                        <div class="col-md-12">
                            {!! Form::open(['url'=>url('/home'),'method'=>'post','class'=>'form-horizontal','role'=>'form','id'=>'filter-form']) !!}
                            <div class="form-group{{ $errors->has('filter') ? ' has-error' : '' }}">
                                {!! Form::label('filter', 'FIlter:', ['class'=>'col-md-1 control-label']) !!}
                                <div class="col-md-3">
                                {!! Form::select('filter', ['all'=>'Semua Waktu','bulanan'=>'Per Bulan Ini','tahunan'=>'Per Tahun Ini','semesterawal'=>'Semester Awal','semesterakhir'=>'Semester Akhir'], 'all', ['id'=>'filter','class'=>'form-control','placeholder' => 'Pilih Waktu','onChange'=>'submitForm(this)']) !!}
                                {!! $errors->first('filter', '<p class="help-block">:message</p>') !!}
                                </div>
                                <div class="col-md-7">
                                    <!-- SHOW - - - HIDE ! -->
                                    <div style='display:none;background-color: #eaf0eb;' id='tanggal'>
                                        <div class="form-group">
                                        {!! Form::open(['url'=>url('/home'),'method'=>'post','class'=>'form-horizontal','role'=>'form']) !!}
                                            <div class="col-md-5">
                                            {!! Form::date('dari', date('Y-m-d'), ['class'=>'form-control','placeholder'=>'yyyy-mm-dd']) !!}
                                            </div>
                                            <div class="col-md-1">
                                            s/d
                                            </div>
                                            <div class="col-md-5">
                                            {!! Form::date('sampai', date('Y-m-d'), ['class'=>'form-control','placeholder'=>'yyyy-mm-dd']) !!}
                                            </div>
                                            <div class="col-md-1">
                                                <button type="submit" class="btn btn-primary"><i class="fa fa-btn fa-search"></i> </button>
                                            </div>
                                        {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Statistik Jenis Kelamin</h4>
                            <div id="chart-div"></div>
                            @barchart('jeniskelamin', 'chart-div')
                        </div>
                        <div class="col-md-6">
                            <h4>Statistik Latar Belakang</h4>
                            <div id="chart-div2"></div>
                            @barchart('latarbelakang', 'chart-div2') 
                        </div>                    
                    </div>

                    <div class="row">
                        <div class="col-md-1">&nbsp;</div>                    
                        <div class="col-md-10">
                            <hr><h4>Statistik Jenis Kelas</h4>
                            <div id="chart-div9"></div>
                            @columnchart('JenisKelass', 'chart-div9') 
                        </div>
                        <div class="col-md-1">&nbsp;</div>                    
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <hr><h4>Statistik Level Jabatan</h4>
                            <div id="chart-div3"></div>
                            @barchart('jabatan', 'chart-div3') 
                        </div>
                        <div class="col-md-6">
                            <hr><h4>Statistik Industri Pekerjaan</h4>
                            <div id="chart-div4"></div>
                            @barchart('jenisindustri', 'chart-div4') 
                        </div>                    
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <hr><h4>Statistik Universitas</h4>
                            <div id="chart-div5"></div>
                            @barchart('universitas', 'chart-div5') 
                        </div>
                        <div class="col-md-6">
                            <hr><h4>Statistik Jurusan</h4>
                            <div id="chart-div6"></div>
                            @columnchart('jurusan', 'chart-div6')
                        </div>                    
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <hr><h4>Statistik Usia</h4>
                            <div id="chart-div7"></div>
                            @columnchart('usia', 'chart-div7') 
                        </div>
                        <div class="col-md-6">
                            <hr><h4>Statistik Mengetahui Duta Bangsa</h4>
                            <div id="chart-div8"></div>
                            @barchart('mengetahuidb', 'chart-div8')
                        </div>                    
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script type="text/javascript">
    {     
         $(document).ready(function(){
            $('#filter').on('change', function() {
                if ( this.value == 'tanggal')
                {
                    $("#tanggal").show();
                }
                else
                {
                    $("#tanggal").hide();
                }
                
            });


    });  }
    </script>
     <script>
     function submitForm(elem) {
          if (elem.value == 'all' || elem.value == 'tahunan' || elem.value == 'bulanan' || elem.value == 'semesterawal' || elem.value == 'semesterakhir') {
              elem.form.submit();
          }else if (elem.value == 'tanggal') {
            console.log('dapet nih');
          }
      }
     /* function filter(elem) {
          if (elem.value == 'all' || elem.value == 'tahunan' || elem.value == 'bulanan') {
              console.log('dapet datanya nih');
              
              elem.form.submit();

          }
      }*/
      /*$( "#filter-form" ).on('change', function(e) 
        {
        //this is the #state dom element
        oTable.draw();
        e.preventDefault();

        // parameter 1 : url
            // parameter 2: post data
            //parameter 3: callback function 
        });*/
  </script>
@endsection