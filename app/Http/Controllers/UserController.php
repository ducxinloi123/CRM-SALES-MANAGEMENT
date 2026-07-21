<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Part;
use App\Models\Team;
use App\Models\TypeAccount;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Render the table view.
     */
    public function index()
    {
        return view('layouts.users.list');
    }

    public function getFiltes(){
        $status_f = collect([
            ['id' => 1 , 'text' => 'Đã nghĩ'],
            ['id' => 0 , 'text'=> 'Đang làm']
        ]);
        $part_f = Part::select('id','name as text')-> orderBy('name')->get();
        $team_f = Team::select('id' , 'name as text')-> orderBy('name')->get();
        $role_f = TypeAccount::select('id','name as text')-> orderBy('name')->get();
        return compact('status_f', 'part_f', 'team_f', 'role_f');
    }
    public function getUsers(Request $request)
    {
        if ($request->ajax()) {
            // Kéo dữ liệu bảng User và các bảng liên kết
            $data = User::with(['part', 'position', 'team', 'typeAccount'])->select('users.*');

            return DataTables::of($data)
                ->addIndexColumn()
                // Xử lý hiển thị giới tính
                ->editColumn('sex', function ($row) {
                    return $row->sex == 0 ? 'Nam' : 'Nữ';
                })
                // Móc tên từ các bảng quan hệ (xử lý lỗi rỗng)
                ->addColumn('part_name', function ($row) {
                    return $row->part ? $row->part->name : '';
                })
                ->addColumn('position_name', function ($row) {
                    return $row->position ? $row->position->name : '';
                })
                ->addColumn('team_name', function ($row) {
                    return $row->team ? $row->team->name : '';
                })
                ->addColumn('type_account_name', function ($row) {
                    return $row->typeAccount ? $row->typeAccount->name : '';
                })
                ->editColumn('status', function ($row) {
                    return $row->status == 0 
                        ? 'Đang làm ' 
                        : 'Đã nghỉ ';
                })
                ->addColumn('action', function ($row) {
                    return '<div class = "btn btn-warning"><i class="fa-regular fa-pen-to-square"></i></div>
                    <div class ="btn btn-danger btn-delete"><i class="fa-solid fa-delete-left"></i></div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
