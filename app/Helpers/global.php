<?php 
use App\Siswa;
use App\Guru;
function rangking5Besar()
{
	$siswa = Siswa::all();
	$siswa->map(function($s){
		$s->rataratanilai =$s->rataratanilai();
		return $s;
	});
	$siswa = $siswa->sortByDesc('rataratanilai')->take(5);
	return $siswa;
}
function totalSiswa()
{
	return Siswa::count();
}
function totalGuru()
{
	return Guru::count();
}