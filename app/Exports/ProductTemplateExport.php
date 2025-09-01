<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductTemplateExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return collect([
            [
                'category_id' => '2023-03-20',
                'product_name' => '400010001',
                'product_description' => '400010001',
                'minimum_quantity_purchase' => $allProfitCenterString,
                'cost_price' => 'trx-1311080',
                'regular_price' => 'Ref-123456789',
                'discount_percentage_members' => 'transaction description',
                'minimum_purchase_amount_members' => '100000.25',
                'discount_percentage_general' => 'Credit',
                'minimum_purchase_amount_general' => 'Credit',
                'discount_percentage_general' => 'Credit',
                'discount_percentage_general' => 'Credit',
                'discount_percentage_general' => 'Credit',
                'discount_percentage_general' => 'Credit',
                'discount_percentage_general' => 'Credit',
                'mode_of_payment' => $allPaymentMethods,
            ]
        ]);
    }

    public function headings(): array
    {
        return [
            'ID',
            'ParentID',
            'Product Name',
            'SKU',
            'Regular Price',
            // Other fields...
        ];
    }
}