<div class="form-group{{ $errors->has('nama') ? 'has-error' : '' }}">
    {!! Form::label('nama', 'Nama *', ['class'=>'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('nama', null, ['class'=>'form-control','required'=>'required','placeholder'=>'Nama Lengkap']) !!}
        {!! $errors->first('nama', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<!-- <div class="form-group{{ $errors->has('nis') ? 'has-error' : '' }}">
    {!! Form::label('nip', 'NIP', ['class'=>'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('nis', null, ['class'=>'form-control','required'=>'required','placeholder'=>'Nomer Induk Siswa']) !!}
        {!! $errors->first('nis', '<p class="help-block">:message</p>') !!}
    </div>
</div> -->

<div class="form-group{{ $errors->has('nohp') ? 'has-error' : '' }}">
    {!! Form::label('nohp', 'Nomer HP', ['class'=>'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('nohp', null, ['class'=>'form-control','required'=>'required','placeholder'=>'Nomer Handphone']) !!}
        {!! $errors->first('nohp', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group{{ $errors->has('email') ? 'has-error' : '' }}">
    {!! Form::label('email', 'Alamat Email', ['class'=>'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::email('email', null, ['class'=>'form-control','placeholder'=>'Alamat Email','required'=>'required']) !!}
        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group{{ $errors->has('jeniskelamin') ? ' has-error' : '' }}">
    {!! Form::label('jeniskelamin', 'Jenis Kelamin', ['class'=>'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('jeniskelamin', ['laki-laki'=>'Laki - Laki','perempuan'=>'Perempuan'], null, ['class'=>'form-control','placeholder' => 'Pilih Jenis Kelamin']) !!}
        {!! $errors->first('hakakses', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group{{ $errors->has('jeniskelas_id') ? ' has-error' : '' }}">
    {!! Form::label('jeniskelas_id', 'Jenis Kelas *', ['class'=>'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('jeniskelas_id', [''=>'']+App\Jeniskelas::pluck('name','id')->all(), null, ['class'=>'js-selectize','placeholder'=>'Pilih Kelas']) !!}
        {!! $errors->first('jeniskelas_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<!-- SHOW - - - HIDE !-->
<div style='display:none;background-color: #eaf0eb;' id='reguler'>

    <div class="form-group{{ $errors->has('jenisprogram') ? 'has-error' : '' }}">
        {!! Form::label('jenisprogram', 'Jenis Program', ['class'=>'col-md-5 control-label']) !!}
        <div class="col-md-5">
            {!! Form::select('jenisprogram', ['intensif'=>'Intensif','weekend'=>'Weekend','weekday'=>'Weekday','nightclass'=>'NightClass','lainnya-jenisprogram'=>'Lainnya'], null, ['id'=>'jenisprogram','class'=>'form-control','placeholder' => 'Jenis Program']) !!}
            {!! $errors->first('jenisprogram', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <!-- SHOW - - - HIDE !-->
    <div style='display:none;background-color: #eaf0eb;' id='lainnya-jenisprogram'>
        <div class="form-group{{ $errors->has('jenisprogram_lainnya') ? 'has-error' : '' }}">
            {!! Form::label('jenisprogram_lainnya', 'Lainnya', ['class'=>'col-md-6 control-label']) !!}
            <div class="col-md-5">
                {!! Form::text('jenisprogram_lainnya', null, ['class'=>'form-control','placeholder'=>'Ketik Lainnya']) !!}
                {!! $errors->first('jenisprogram_lainnya', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>
    <!-- END SHOW - - - HIDE !--> 

    <div class="form-group{{ $errors->has('tempatlahir') ? 'has-error' : '' }}">
        {!! Form::label('tempatlahir', 'Tempat Kelahiran', ['class'=>'col-md-5 control-label']) !!}
        <div class="col-md-5">
            {!! Form::text('tempatlahir', null, ['class'=>'form-control','placeholder'=>'Tempat Kelahiran']) !!}
            {!! $errors->first('tempatlahir', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group{{ $errors->has('tanggallahir') ? 'has-error' : '' }}">
        {!! Form::label('tanggallahir', 'Tanggal Lahir', ['class'=>'col-md-5 control-label']) !!}
        <div class="col-md-5">
             {!! Form::date('tanggallahir', null, ['class'=>'form-control','placeholder'=>'dd-mm-yyyy']) !!}
            {!! $errors->first('tanggallahir', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group{{ $errors->has('nohpdarurat') ? 'has-error' : '' }}">
        {!! Form::label('nohpdarurat', 'Nomer HP Darurat', ['class'=>'col-md-5 control-label']) !!}
        <div class="col-md-5">
            {!! Form::number('nohpdarurat', null, ['class'=>'form-control','placeholder'=>'Nomer Handphone Darurat']) !!}
            {!! $errors->first('nohpdarurat', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group{{ $errors->has('alamatlengkap') ? 'has-error' : '' }}">
        {!! Form::label('alamatlengkap', 'Alamat Lengkap', ['class'=>'col-md-5 control-label']) !!}
        <div class="col-md-5">
            {!! Form::textarea('alamatlengkap', null, ['class'=>'form-control','placeholder'=>'Alamat Lengkap','rows'=>'3']) !!}
            {!! $errors->first('alamatlengkap', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group{{ $errors->has('didaftarkanoleh') ? 'has-error' : '' }}">
        {!! Form::label('didaftarkanoleh', 'Didaftarkan Oleh', ['class'=>'col-md-5 control-label']) !!}
        <div class="col-md-5">
            {!! Form::select('didaftarkanoleh', ['pribadi'=>'Pribadi','perusahaan'=>'Perusahaan','keluarga'=>'Keluarga','lainnya'=>'Lainnya'], null, ['id'=>'didaftarkanoleh','class'=>'form-control','placeholder' => 'Didaftarkan Oleh']) !!}
            {!! $errors->first('didaftarkanoleh', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <!-- SHOW - - - HIDE !-->
    <div style='display:none;background-color: #eaf0eb;' id='lainnya'>
        <div class="form-group{{ $errors->has('didaftarkanoleh_lainnya') ? 'has-error' : '' }}">
            {!! Form::label('didaftarkanoleh_lainnya', 'Lainnya', ['class'=>'col-md-6 control-label']) !!}
            <div class="col-md-5">
                {!! Form::text('didaftarkanoleh_lainnya', null, ['class'=>'form-control','placeholder'=>'Ketik Lainnya']) !!}
                {!! $errors->first('didaftarkanoleh_lainnya', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>
    <!-- END SHOW - - - HIDE !-->   

    <div class="form-group{{ $errors->has('mengetahuidb') ? 'has-error' : '' }}">
        {!! Form::label('mengetahuidb', 'Bagaimana Mengetahui Duta Bangsa', ['class'=>'col-md-5 control-label']) !!}
        <div class="col-md-5">
            {!! Form::select('mengetahuidb', ['website'=>'Website','instagram'=>'Instagram','twitter'=>'Twitter','facebook'=>'Facebook','linked in'=>'Linked In','teman'=>'Teman','saudara / keluarga'=>'Saudara / Keluarga','media cetak / elektronik'=>'Media Cetak / Elektronik','Lainnya'=>'Lainnya'], null, ['id'=>'mengetahuidb','class'=>'form-control','placeholder' => 'Mengetahui Duta Bangsa ?']) !!}
            {!! $errors->first('mengetahuidb', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <!-- SHOW - - - HIDE !-->
    <div style='display:none;background-color: #eaf0eb;' id='Lainnya'>
        <div class="form-group{{ $errors->has('mengetahuidb_lainnya') ? 'has-error' : '' }}">
            {!! Form::label('mengetahuidb_lainnya', 'Lainnya', ['class'=>'col-md-6 control-label']) !!}
            <div class="col-md-5">
                {!! Form::text('mengetahuidb_lainnya', null, ['class'=>'form-control','placeholder'=>'Ketik Lainnya']) !!}
                {!! $errors->first('mengetahuidb_lainnya', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>
    <!-- END SHOW - - - HIDE !-->

</div>
<!-- END SHOW - - - HIDE !-->

<!-- SHOW - - - HIDE !-->
<!-- <div style='display:none;background-color: #eaf0eb;' id='privateclass'>
    <div class="form-group{{ $errors->has('didaftarkanoleh2') ? 'has-error' : '' }}">
        {!! Form::label('didaftarkanoleh2', 'Didaftarkan Oleh', ['class'=>'col-md-5 control-label']) !!}
        <div class="col-md-5">
            {!! Form::select('didaftarkanoleh2', ['pribadi'=>'Pribadi','perusahaan'=>'Perusahaan','keluarga'=>'Keluarga','lain-lainnya'=>'Lainnya'], null, ['id'=>'didaftarkanoleh2','class'=>'form-control','placeholder' => 'Didaftarkan Oleh']) !!}
            {!! $errors->first('didaftarkanoleh', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    
    <div style='display:none;background-color: #eaf0eb;' id='lain-lainnya'>
        <div class="form-group{{ $errors->has('didaftarkanoleh2_lainnya') ? 'has-error' : '' }}">
            {!! Form::label('didaftarkanoleh2_lainnya', 'Lainnya', ['class'=>'col-md-6 control-label']) !!}
            <div class="col-md-5">
                {!! Form::text('didaftarkanoleh2_lainnya', null, ['class'=>'form-control','placeholder'=>'Ketik Lainnya']) !!}
                {!! $errors->first('didaftarkanoleh2_lainnya', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>
    

    <div class="form-group{{ $errors->has('mengetahuidb2_lainnya') ? 'has-error' : '' }}">
        {!! Form::label('mengetahuidb2_lainnya', 'Bagaimana Mengetahui Duta Bangsa', ['class'=>'col-md-5 control-label']) !!}
        <div class="col-md-5">
            {!! Form::select('mengetahuidb2_lainnya', ['website'=>'Website','social media'=>'Social Media','teman'=>'Teman','saudara / keluarga'=>'Saudara / Keluarga','media cetak / elektronik'=>'Media Cetak / Elektronik','Lain-Lainnya'=>'Lainnya'], null, ['id'=>'mengetahuidb2','class'=>'form-control','placeholder' => 'Mengetahui Duta Bangsa ?']) !!}
            {!! $errors->first('mengetahuidb2_lainnya', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    
    <div style='display:none;background-color: #eaf0eb;' id='Lain-Lainnya'>
        <div class="form-group{{ $errors->has('mengetahuidb2') ? 'has-error' : '' }}">
            {!! Form::label('mengetahuidb2', 'Lainnya', ['class'=>'col-md-6 control-label']) !!}
            <div class="col-md-5">
                {!! Form::text('mengetahuidb2', null, ['class'=>'form-control','placeholder'=>'Ketik Lainnya']) !!}
                {!! $errors->first('mengetahuidb2', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>
    
</div> -->
<!-- END SHOW - - - HIDE !-->

<div class="form-group{{ $errors->has('latarbelakang') ? ' has-error' : '' }}">
    {!! Form::label('latarbelakang', 'Latar Belakang', ['class'=>'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('latarbelakang', ['bekerja'=>'Bekerja','kuliah'=>'Kuliah','sekolah'=>'Sekolah'], null, ['id'=>'latarbelakang','class'=>'form-control','placeholder' => 'Latar Belakang Peserta']) !!}
        {!! $errors->first('latarbelakang', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<!-- SHOW - - - HIDE !-->
<div style='display:none;background-color: #eaf0eb;' id='bekerja'>
    
    <div class="form-group{{ $errors->has('perusahaan') ? 'has-error' : '' }}">
        {!! Form::label('perusahaan', 'Perusahaan', ['class'=>'col-md-5 control-label']) !!}
        <div class="col-md-5">
            {!! Form::text('perusahaan', null, ['class'=>'form-control','placeholder'=>'Perusahaan']) !!}
            {!! $errors->first('perusahaan', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group{{ $errors->has('jenisindustri') ? ' has-error' : '' }}">
        {!! Form::label('jenisindustri', 'Jenis Industri', ['class'=>'col-md-5 control-label']) !!}
        <div class="col-md-5" style="text-transform: uppercase;">
            {!! Form::select('jenisindustri', [''=>'']+App\Jenisindustri::pluck('name','name')->all(), null, ['id'=>'jenisindustri','class'=>'form-control','placeholder' => 'Jenis Industri']) !!}
            {!! $errors->first('jenisindustri', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <!-- SHOW - - - HIDE !-->
    <div style='display:none;background-color: #eaf0eb;' id='lainnya-jenisindustri'>
        <div class="form-group{{ $errors->has('jenisindustri_lainnya') ? 'has-error' : '' }}">
            {!! Form::label('jenisindustri_lainnya', 'Lainnya', ['class'=>'col-md-6 control-label']) !!}
            <div class="col-md-5">
                {!! Form::text('jenisindustri_lainnya', null, ['class'=>'form-control','placeholder'=>'Ketik Lainnya']) !!}
                {!! $errors->first('jenisindustri_lainnya', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>
    <!-- END SHOW - - - HIDE !-->

    <div class="form-group{{ $errors->has('departemenpeserta') ? 'has-error' : '' }}">
        {!! Form::label('departemenpeserta', 'Departemen Peserta', ['class'=>'col-md-5 control-label']) !!}
        <div class="col-md-5">
            {!! Form::text('departemenpeserta', null, ['class'=>'form-control','placeholder'=>'Departemen Peserta']) !!}
            {!! $errors->first('departemenpeserta', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group{{ $errors->has('jabatan') ? 'has-error' : '' }}">
        {!! Form::label('jabatan', 'Jabatan', ['class'=>'col-md-5 control-label']) !!}
        <div class="col-md-5">
            {!! Form::text('jabatan', null, ['class'=>'form-control','placeholder'=>'Jabatan']) !!}
            {!! $errors->first('jabatan', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group{{ $errors->has('leveljabatan') ? ' has-error' : '' }}">
        {!! Form::label('leveljabatan', 'Level Jabatan', ['class'=>'col-md-5 control-label']) !!}
        <div class="col-md-5">
            {!! Form::select('leveljabatan', ['top management'=>'Top management','middle management'=>'Middle Management','fresh graduate'=>'Fresh Graduate','lain-lainnya'=>'Lainnya'], null, ['id'=>'leveljabatan','class'=>'form-control','placeholder' => 'Level Jabatan']) !!}
            {!! $errors->first('leveljabatan', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <!-- SHOW - - - HIDE !-->
    <div style='display:none;background-color: #eaf0eb;' id='lain-lainnya'>
        <div class="form-group{{ $errors->has('leveljabatan_lainnya') ? 'has-error' : '' }}">
            {!! Form::label('leveljabatan_lainnya', 'Lainnya', ['class'=>'col-md-6 control-label']) !!}
            <div class="col-md-5">
                {!! Form::text('leveljabatan_lainnya', null, ['class'=>'form-control','placeholder'=>'Ketik Lainnya']) !!}
                {!! $errors->first('leveljabatan_lainnya', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>
    <!-- END SHOW - - - HIDE !-->

</div>

<div style='display:none;background-color: #eaf0eb;' id='kuliah'>
    
    <div class="form-group{{ $errors->has('universitas') ? 'has-error' : '' }}">
        {!! Form::label('universitas', 'Universitas', ['class'=>'col-md-5 control-label']) !!}
        <div class="col-md-5">
            {!! Form::text('universitas', null, ['class'=>'form-control','placeholder'=>'Universitas']) !!}
            {!! $errors->first('universitas', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group{{ $errors->has('jurusan') ? 'has-error' : '' }}">
        {!! Form::label('jurusan', 'Jurusan', ['class'=>'col-md-5 control-label']) !!}
        <div class="col-md-5">
            {!! Form::text('jurusan', null, ['class'=>'form-control','placeholder'=>'Jurusan']) !!}
            {!! $errors->first('jurusan', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

</div>

<div style='display:none;background-color: #eaf0eb;' id='sekolah'>
    
    <div class="form-group{{ $errors->has('namasekolah') ? 'has-error' : '' }}">
        {!! Form::label('namasekolah', 'Nama Sekolah', ['class'=>'col-md-5 control-label']) !!}
        <div class="col-md-5">
            {!! Form::text('namasekolah', null, ['class'=>'form-control','placeholder'=>'Nama Sekolah']) !!}
            {!! $errors->first('namasekolah', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

</div>
<!-- END SHOW - - - HIDE !-->                    

<div class="form-group{{ $errors->has('tanggalpelaksanaan') ? 'has-error' : '' }}">
    {!! Form::label('tanggalpelaksanaan', 'Tanggal Pelaksanaan *', ['class'=>'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::date('tanggalpelaksanaan', null, ['class'=>'form-control','required'=>'required','placeholder'=>'dd-mm-yyyy']) !!}
        {!! $errors->first('tanggalpelaksanaan', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group{{ $errors->has('judulprogram') ? 'has-error' : '' }}">
    {!! Form::label('judulprogram', 'Judul Program', ['class'=>'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('judulprogram', null, ['class'=>'form-control','placeholder'=>'Judul Program']) !!}
        {!! $errors->first('judulprogram', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group{{ $errors->has('materi') ? ' has-error' : '' }}">
    {!! Form::label('materi', 'Materi *', ['class'=>'col-md-4 control-label']) !!}
    <div class="col-md-6">
        <div class="materi">
        @foreach($materi as $materis)
            <span style="white-space: nowrap;" class="materihover"><label>{!! Form::checkbox('materi[]', $materis->name) !!} {{ $materis->name }}</label></span><br/>
        @endforeach
        </div>
        {!! $errors->first('materi', '<p class="help-block">:message</p>') !!}
    </div> 
</div>

<div class="form-group{{ $errors->has('lokasipelaksanaan') ? 'has-error' : '' }}">
    {!! Form::label('lokasipelaksanaan', 'Lokasi Pelaksanaan', ['class'=>'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('lokasipelaksanaan', null, ['class'=>'form-control','placeholder'=>'Lokasi Pelaksanaan']) !!}
        <small>Contoh : LPPI, Kemang</small>
        {!! $errors->first('lokasipelaksanaan', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group{{ $errors->has('kotapelaksanaan') ? 'has-error' : '' }}">
    {!! Form::label('kotapelaksanaan', 'Kota Pelaksanaan', ['class'=>'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('kotapelaksanaan', null, ['class'=>'form-control','placeholder'=>'Kota Pelaksanaan']) !!}
        <small>Contoh : Jakarta</small>
        {!! $errors->first('kotapelaksanaan', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group{{ $errors->has('akuninstagram') ? 'has-error' : '' }}">
    {!! Form::label('akuninstagram', 'Akun Instagram', ['class'=>'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('akuninstagram', null, ['class'=>'form-control','placeholder'=>'Instagram']) !!}
        <small>bila ada</small>
        {!! $errors->first('akuninstagram', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group{{ $errors->has('linkedin') ? 'has-error' : '' }}">
    {!! Form::label('linkedin', 'Linked In', ['class'=>'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('linkedin', null, ['class'=>'form-control','placeholder'=>'Linked In']) !!}
        <small>bila ada</small>
        {!! $errors->first('linkedin', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<!-- <div class="form-group">
    {!! Form::label('posted_by', 'posted_by', ['class'=>'col-md-4 control-label']) !!}
    <div class="col-md-6"> -->
        {!! Form::hidden('posted_by', Auth::user()->name, ['class'=>'form-control','placeholder'=>'Instagram','readonly'=>'readonly']) !!}
    <!-- </div>
    </div> -->

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-btn fa-user"></i> Submit
        </button>
    </div>
</div>