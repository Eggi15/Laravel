<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//model itu harus di tambahkan s menjadi Siswas
class Siswa extends Model
{
    protected $table  = 'siswa';
    protected $fillable = ['nama_belakang','nama_depan','jenis_kelamin','agama','alamat','avatar','user_id'];

    public function getAvatar()
    {
    	if(!$this->avatar){
    		return asset('images/default.jpg');
    	}

    	return asset('images/'.$this->avatar);
    }

    public function mapel()
    {
    	return $this->belongsToMany(Mapel::class)->withPivot(['nilai'])->withTimeStamps();
    }

    public function rataratanilai()
    {
        //ambil nilai-nilai dari mapel
        //$this ini mengambil class siswa yang sudah di bentuk
        //harus di deklarasikan dahulu $total itu berapa agar di kenal ketika di foreach(looping)
        //++ untuk melopping berapa kali ada jumlah nilai di mapel dan fungsisama seperti +=
        $total = 0;
        $hitung = 0;
        foreach ($this->mapel as $mapel) {
            $total += $mapel->pivot->nilai;
            $hitung++;
        }

        return round($total/$hitung);
    }

    public function nama_lengkap()
    {
        return $this->nama_depan. ' '.$this->nama_belakang;
    }
}
