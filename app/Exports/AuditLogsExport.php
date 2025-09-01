<?php

namespace App\Exports;

use App\Models\AuditLog;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AuditLogsExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected $logs;
    protected $index = 1;

    public function __construct($logs)
    {
        $this->logs = $logs;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->logs;
    }

    /**
     * Define the headers for the Excel file.
     */
    public function headings(): array
    {
        return ['S/N', 'Log Activity', 'Description','Causer Name', 'Causer Role', 'Date'];
    }

    /**
     * @param mixed $row
     * @return array
     */
    public function map($row): array
    {
        // Format causer name
        $causerName = $row->causer ? $row->causer->firstname . ' ' . $row->causer->lastname : 'System';

        // Format causer role
        $causerRole = $row->causer && $row->causer->roles->isNotEmpty()
            ? $row->causer->roles->first()->name
            : 'N/A';

        return [
            $this->index++,
            $row->log_name,
            $row->description,
            $causerName,
            $causerRole,
            $row->created_at->format('Y-m-d H:i:s')
        ];
    }


    /**
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
