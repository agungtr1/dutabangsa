
{
    $(document).ready(function(){
        $('#jeniskelas_id').on('change', function() {
            if ( this.value == '1' || this.value == '3')
            {
                $("#reguler").show();
            }
            else
            {
                $("#reguler").hide();
            }
            /*if ( this.value == '3')
            {
                $("#privateclass").show();
            }
            else
            {
                $("#privateclass").hide();
            }*/
        });

        $('#latarbelakang').on('change', function() {
            if ( this.value == 'bekerja')
            {
                $("#bekerja").show();
                $("#kuliah").hide();
                $("#sekolah").hide();
            }
            else if ( this.value == 'kuliah')
            {
                $("#kuliah").show();  
                $("#bekerja").hide();
                $("#sekolah").hide();    
            }
            else if ( this.value == 'sekolah')
            {
                $("#sekolah").show();
                $("#kuliah").hide();  
                $("#bekerja").hide();
            }
            else
            {
                $("#bekerja").hide();   
                $("#kuliah").hide(); 
                $("#sekolah").hide();  
            }
        });

        $('#didaftarkanoleh').on('change', function() {
            if ( this.value == 'lainnya')
            {
                $("#lainnya").show();
            }
            else
            {
                $("#lainnya").hide();
            }
        });

        $('#mengetahuidb').on('change', function() {
            if ( this.value == 'Lainnya')
            {
                $("#Lainnya").show();
            }
            else
            {
                $("#Lainnya").hide();
            }
        });

         $('#leveljabatan').on('change', function() {
            if ( this.value == 'lain-lainnya')
            {
                $("#lain-lainnya").show();
            }
            else
            {
                $("#lain-lainnya").hide();
            }
        });


});  }


$(document).ready(function(){
 $('#datapeserta').dataTable( {
            "scrollX": true
        } );

});  