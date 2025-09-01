<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DonationReportExport implements FromArray, WithHeadings, WithCustomStartCell, WithStyles
{
    protected $allUsers;
    protected $donation;

    public function __construct($allUsers, $donation)
    {
        $this->allUsers = $allUsers;
        $this->donation = $donation;
    }

    public function array(): array
    {
        return collect($this->allUsers)->map(function ($donationUser) {
            return [
                $donationUser->user->id, 
                $donationUser->user->firstname . ' ' . $donationUser->user->lastname, 
                $donationUser->user->email ?? 'N/A', 
                $donationUser->user->set->name ?? 'N/A',
                $donationUser->paid_amount, // Paid Amount
            ];
        })->toArray();
    }

    public function headings(): array
    {
        return [
            'ID',
            'User Name',
            'User Email',
            'User Set',
            'Paid Amount',
        ];
    }

    public function startCell(): string
    {
        return 'A3'; // Data starts from the third row
    }

    public function styles(Worksheet $sheet)
    {
        // Add donation title and description to the first two rows
        $sheet->setCellValue('A1', 'Donation Title: ' . $this->donation->title);
        $sheet->setCellValue('A2', 'Donation Goal: ' . $this->donation->goal);

        // Style for the first two rows
        $sheet->getStyle('A1:A2')->getFont()->setBold(true);

        // Style for the headings row (row 3)
        $sheet->getStyle('A3:E3')->getFont()->setBold(true);
    }
}
