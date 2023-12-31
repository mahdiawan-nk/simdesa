<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Format_tanggal
{

    protected $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
    }

    public function format_tanggal($tanggal)
    {
        setlocale(LC_ALL, 'id_ID');
        $bulan = array(
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember'
        );
        $newBulan = $bulan[date('m',strtotime($tanggal))];
        return date('d', strtotime($tanggal)).' '.$newBulan.' '. date('Y', strtotime($tanggal));
    }

    function hari($tanggal) {
        
        $hari = array(
            'Sun' => 'Minggu',
            'Mon' => 'Senin',
            'Tue' => 'Selasa',
            'Wed' => 'Rabu',
            'Thu' => 'Kamis',
            'Fri' => 'Jumat',
            'Sat' => 'Sabtu'
        );

        return $hari[date('D',strtotime($tanggal))];
    }
}
