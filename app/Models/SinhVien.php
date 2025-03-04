<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class SinhVien extends Authenticatable
{
    use HasFactory;
    
    protected $table = 'sinh_viens';
    protected $primaryKey = 'ma_sinh_vien'; 
    public $incrementing = false; // Không dùng AUTO_INCREMENT
    protected $keyType = 'string'; // Định nghĩa khóa chính là chuỗi (VARCHAR)

    protected $fillable = [
        'ma_sinh_vien', // Bổ sung khóa chính vào fillable
        'ngay_sinh',
        'sv_khoa',
        'ho_ten',
        'gioi_tinh',
        'email',
        'so_dien_thoai',
        'password',
        'dia_chi',
        'avatar',
        'ma_khoa',
        'ma_chuyen_nganh',
        'ma_lop',
        'status',
        'remember_token',
        'created_at',
        'updated_at',
    ];

        protected static function boot(){
            parent::boot();
            
            static::creating(function ($student) {
                // Chỉ tạo mã sinh viên nếu chưa có
                if (!$student->ma_sinh_vien) {
                    $latestStudent = SinhVien::orderByRaw("CAST(ma_sinh_vien AS UNSIGNED) DESC")->first();
            
                    // Lấy số cuối cùng của mã sinh viên
                    $nextId = $latestStudent ? ((int) $latestStudent->ma_sinh_vien) + 1 : 170000; // Bắt đầu từ 170000 nếu chưa có

                    // Gán mã mới
                    $student->ma_sinh_vien = $nextId;
                }
            });
        }
    
}

