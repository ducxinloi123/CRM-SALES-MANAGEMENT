<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Part;
use App\Models\Position;
use App\Models\Team;
use App\Models\TypeAccount;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
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
            $data = User::with(['part', 'position', 'team', 'typeAccount']);
            $data -> orderByDesc('created_at');

            if($request -> filled('part_id')){
                $data ->where('part_id', $request-> part_id);
            }
             if($request -> filled('team_id')){
                $data ->where('team_id', $request-> team_id);
            }
             if($request -> filled('status')){
                $data ->where('status', $request-> status);
            }
             if($request -> filled('type_account_id')){
                $data ->where('type_account_id', $request-> type_account_id);
            }

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('sex', function ($row) {
                    return $row->sex == 0 ? 'Nam' : 'Nữ';
                })
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

    public function FormOption(){
        return [
        'part' => Part::select('id','name as text')->orderBy('name')->get(),
        'position' => Position::seclect('id', 'name as text')->orderBy('name')->get(),
        'team' => Team::seclect('id', 'name as text')->orderBy('name')->get(),
        'type_account'=>TypeAccount::seclect('id','name as text')->orderBy('name')->get(),
        'gender'=> [
            ['id' => 0 ,'text' => 'Nam'],
            ['id'=> 1, 'text' => 'Nữ']
        ],
        'type_work' => [
            ['id'=> 0 ,'text'=>'Partime'],
            ['id'=>1,'text'=>'Fulltime']
        ],
        'status' => [
            ['id'=> 0,'text' => 'Đang Làm'],
            ['id'=> 1,'text'=> 'Đã Nghỉ']
        ]
        ];
    }
    public function create(){
        $option = $this ->FormOption();
        return view('layouts.users.add',[
            'option'=> $option,
            'mode' => 'create',
            'user' => new User(),
        ]);
    }
    public function store(User $user){
        $option = $this ->FormOption();
        return view('layouts.users.add',[
            'option'=> $option,
            'mode' => 'create',
            'user' => $user,
        ]);
    }
}
