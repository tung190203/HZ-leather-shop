<?php

namespace App\Exports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CategoryExport implements FromQuery , WithHeadings, WithColumnWidths
{
    use Exportable;
    public function query()
    {
        return Category::query();
    }
    public function headings(): array
    {
        return [
            'Mã danh mục',
            'Tên danh mục',
            'Mô tả',            
            'Created At',
            'Updated At',
        ];
    }
    public function columnWidths(): array
    {
        return [
            'A' => 5, 
            'B' => 20,
            'C' => 20,
            'D' => 15,
            'E' => 15,
        ];
    }
}

