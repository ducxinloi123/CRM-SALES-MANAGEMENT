<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       // 1. TẠO DATA PHÒNG BAN THỰC TẾ (parts)
        \App\Models\Part::insert([
            ['id' => 1, 'name' => 'Ban Giám Đốc', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'Phòng Hành Chính Nhân Sự', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'name' => 'Phòng Kế Toán - Tài Chính', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'name' => 'Phòng IT - Kỹ Thuật', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'name' => 'Phòng Kinh Doanh (Sales)', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 6, 'name' => 'Phòng Marketing', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 7, 'name' => 'Phòng Chăm Sóc Khách Hàng', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // 2. TẠO DATA CHỨC VỤ THEO CẤP BẬC (positions)
        \App\Models\Position::insert([
            ['id' => 1, 'name' => 'Giám Đốc', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'Phó Giám Đốc', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'name' => 'Trưởng Phòng', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'name' => 'Phó Phòng', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'name' => 'Trưởng Nhóm (Leader)', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 6, 'name' => 'Chuyên Viên', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 7, 'name' => 'Nhân Viên', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 8, 'name' => 'Thực Tập Sinh', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // 3. TẠO DATA ĐỘI NHÓM (teams)
        \App\Models\Team::insert([
            ['id' => 1, 'name' => 'Team Bán Hàng Trực Tiếp', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'Team Bán Hàng Online', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'name' => 'Team Dev Front-end', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'name' => 'Team Dev Back-end', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'name' => 'Team Support 24/7', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 6, 'name' => 'Team Content Marketing', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // 4. TẠO DATA PHÂN QUYỀN TÀI KHOẢN (type_accounts)
        \App\Models\TypeAccount::insert([
           ['id' => 1, 'name' => 'Super Admin (Toàn quyền)', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'Manager (Quản lý cấp cao)', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'name' => 'Leader (Quản lý cấp trung)', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'name' => 'User (Nhân viên tiêu chuẩn)', 'created_at' => now(), 'updated_at' => now()],
        ]);
        User::factory()->count(50)->create();
    }
}
