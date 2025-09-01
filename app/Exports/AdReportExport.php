<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AdReportExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{

    protected $advert;
    protected $index = 1;

    public function __construct($advert)
    {
        $this->advert = $advert->load(['metrics']);
    }


    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return collect([$this->advert->load(['metrics'])]);
    }

    /**
     * Define the headers for the Excel file.
     */
    public function headings(): array
    {
        return [
            'ID',
            'Title',
            'Short description',
            'Target Audience',
            'Start Date',
            'End Date',
            'Placement Fee',
            'Clicks',
            'Impressions',
            'Engagement Rate',
            'Date Created'
        ];
    }

    /**
     * @param mixed $row
     * @return array
     */
    public function map($advert): array
    {
        $clicks = $advert->metrics?->clicks;
        $impressions = $advert->metrics?->impressions;
        $engagementRate = $impressions > 0 ? round(($clicks / $impressions) * 100, 2) . '%' : '0%';

        return [
            $this->index,
            $advert->title,
            $advert->short_description,
            $advert->target_audience,
            $advert->start_date,
            $advert->end_date,
            $advert->placement_fee,
            $clicks,
            $impressions,
            $engagementRate,
            $advert->created_at->format('Y-m-d H:i:s')
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
