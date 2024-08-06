namespace App\Exports;

use App\Models\Peserta;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PesertaExport implements FromCollection, WithHeadings, WithMapping
{
    protected $pelatihanId;

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
            'ID',
            'Name',
            'institut',
            'jabatan',
            'Phone Number',
            'Pelatihan ID',
            'Registered At'
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
            $peserta->id,
            $peserta->name,
            $peserta->institut,
            $peserta->jabatan,
            $peserta->no_hp,
            $peserta->pelatihan_id,
            $peserta->created_at,
        ];
    }
