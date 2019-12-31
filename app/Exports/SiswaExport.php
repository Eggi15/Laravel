<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

use App\Siswa;
use Maatwebsite\Excel\Concerns\FromCollection;

class SiswaExport implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Siswa::all();
    }

        public function map($siswa): array
    {
        return [
        	$siswa->nama_lengkap(),
        	$siswa->jenis_kelamin,
        	$siswa->agama,
        	$siswa->rataratanilai()
        ];
    }

        public function headings(): array
    {
        return [
            'NAMA LENGKAP',
            'JENIS KELAMIN',
            'AGAMA',
            'RATA-RATA NILAI'
        ];
    }
}
