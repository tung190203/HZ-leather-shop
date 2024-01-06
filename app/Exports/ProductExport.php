<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductExport implements FromQuery , WithHeadings , WithColumnWidths
{
    use Exportable;
    public function query()
    {
        return Product::query(); 
    }
    public function headings(): array
    {
        // Trả về một mảng các cột tiêu đề cho bảng
        return [
            'Mã sản phẩm',
            'Ảnh sản phẩm',
            'Tên sản phẩm',
            'Giá',
            'Giá khuyến mãi',
            'Số lượng',
            'Mô tả',
            'Trạng thái',
            'Ngày tạo',
            'Ngày cập nhật',
            'Mã danh mục',
            // Thêm các cột khác nếu cần
        ];
    }
    public function columnWidths(): array
    {
        return [
            'A' => 5, 
            'B' => 20,
            'C' => 15,
            'D' => 10,
            'E' => 10,
            'F' => 5,
            'G' => 20,
            'H' => 10,
            'I' => 15,
            'J' => 15,
            'K' => 10,
            
        ];
    }
   
}