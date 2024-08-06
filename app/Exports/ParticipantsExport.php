<?php

namespace App\Exports;

use App\Models\Peserta;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ParticipantsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $pelatihanId;
    protected $counter = 1; // Properti penghitung

    public function __construct(int $pelatihanId)
    {
        $this->pelatihanId = $pelatihanId;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Peserta::where('pelatihan_id', $this->pelatihanId)->get();
    }

    /**
     * Return the headings for the export.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Nomer',
            'Nama',
            'Institusi',
            'Jabatan',
            'Nomer Telepon',
            'Tanggal Registrasi'
        ];
    }

    /**
     * Map the data for each row.
     *
     * @param $peserta
     * @return array
     */
    public function map($peserta): array
    {
        return [
            $this->counter++, // Menampilkan nomor urut dan menambahkannya untuk baris berikutnya
            $peserta->name,
            $peserta->institut,
            $peserta->jabatan,
            $peserta->no_hp,
            $peserta->created_at,
        ];
    }
}
?>
