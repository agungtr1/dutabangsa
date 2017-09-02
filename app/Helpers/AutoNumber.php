<?php 
/**
* 
*/
namespace App\Helpers;
use DB;

class AutoNumber 
{

	 /**
     * Returns an excerpt from a given string (between 0 and passed limit variable).
     *
     * @param $string
     * @param int $limit
     * @param string $suffix
     * @return string
     */

	/*public static function convertdate(){
        date_default_timezone_set('Asia/Jakarta');
        $date = date('dmy');
        return $date;
    }*/

    public static function autonumber($barang,$primary,$prefix){
        $q = DB::table($barang)->select(DB::raw('MAX(RIGHT('.$primary.',4)) as kd_max'));
        date_default_timezone_set('Asia/Jakarta');
        $date = date('dmy');
        $getmonth = date('m');
        $getyear = date('Y');
        $gettoday = date('d');
        $getmonth1 = date('dm');
        $prx = $prefix;
        if($getmonth1 == '0101')
        {
            $kd = $prx."00001";
        }
        elseif($getmonth1 == '0101' AND $q->count()>1)
        {
            foreach($q->get() as $k)
            {
                $tmp = ((int)$k->kd_max)+1;
                $kd = $prx.sprintf("%05s", $tmp);
            }
        }
        elseif($q->count()>0)
        {
            foreach($q->get() as $k)
            {
                $tmp = ((int)$k->kd_max)+1;
                $kd = $prx.sprintf("%05s", $tmp);
            }
        }
        else
        {
            $kd = $prx."00001";
        }

        return $kd;
    }

}
