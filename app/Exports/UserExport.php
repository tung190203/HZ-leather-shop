<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserExport implements FromQuery , WithHeadings , WithColumnWidths
{
    use Exportable;
    public function query()
    {
        return User::query();
    }
    public function headings(): array
    {
        // Trả về một mảng các cột tiêu đề cho bảng
        return [
            'Mã người dùng',
            'Họ người dùng',
            'Tên người dùng',
            'Username',
            'Số điện thoại',
            'Địa chỉ',
            'Email',
            'Bio',
            'Giới tính',
            'Mật khẩu',
            'Vai trò',
            'verification_code',
            'email_verified_at',
            'remember_token',
            'Ngày tạo',
            'Ngày cập nhật',
            
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
