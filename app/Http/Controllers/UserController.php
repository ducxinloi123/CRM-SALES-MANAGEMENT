<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Part;
use App\Models\Position;
use App\Models\Team;
use App\Models\TypeAccount;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index()
    {
        return view('layouts.users.list');
    }

    public function getFiltes()
    {
        $status_f = collect([
            ['id' => 1, 'text' => 'Đã nghĩ'],
            ['id' => 0, 'text' => 'Đang làm']
        ]);
        $part_f = Part::select('id', 'name as text')->orderBy('name')->get();
        $team_f = Team::select('id', 'name as text')->orderBy('name')->get();
        $role_f = TypeAccount::select('id', 'name as text')->orderBy('name')->get();
        return compact('status_f', 'part_f', 'team_f', 'role_f');
    }
    public function getUsers(Request $request)
    {
        if ($request->ajax()) {
            $data = User::with(['part', 'position', 'team', 'typeAccount']);
            $data->orderByDesc('created_at');

            if ($request->filled('part_id')) {
                $data->where('part_id', $request->part_id);
            }
            if ($request->filled('team_id')) {
                $data->where('team_id', $request->team_id);
            }
            if ($request->filled('status')) {
                $data->where('status', $request->status);
            }
            if ($request->filled('type_account_id')) {
                $data->where('type_account_id', $request->type_account_id);
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
                    return '<a href="' .route('users.edit',$row -> id).'" class = "btn btn-warning"><i class="fa-regular fa-pen-to-square"></i></a>
                    <a class ="btn btn-danger btn-delete"><i class="fa-solid fa-delete-left"></i></a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function FormOption()
    {
        return [
            'part' => Part::select('id', 'name as text')->orderBy('name')->get(),
            'position' => Position::query()->select('id', 'name as text')->orderBy('name')->get(),
            'team' => Team::query()->select('id', 'name as text')->orderBy('name')->get(),
            'type_account' => TypeAccount::query()->select('id', 'name as text')->orderBy('name')->get(),
            'sex' => [
                ['id' => 0, 'text' => 'Nam'],
                ['id' => 1, 'text' => 'Nữ']
            ],
            'type_work' => [
                ['id' => 0, 'text' => 'Partime'],
                ['id' => 1, 'text' => 'Fulltime']
            ],
            'status' => [
                ['id' => 0, 'text' => 'Đang Làm'],
                ['id' => 1, 'text' => 'Đã Nghỉ']
            ]
        ];
    }
    public function create()
    {
        $option = $this->FormOption();
        return view('layouts.users.add', [
            'option' => $option,
            'mode' => 'create',
            'user' => new User(),
        ]);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            Rule::unique('users', 'email'),
            'password' => ['required', 'string', 'min:6'],
            'birthday' => ['date', 'nullable'],
            'sex' => ['required'],
            'part' => ['integer', 'nullable', 'exists:parts,id'],
            'position' => ['integer', 'nullable', 'exists:positions,id'],
            'type_work' => ['required'],
            'team' => ['integer', 'nullable', 'exists:teams,id'],
            'phone' => ['required', 'string', 'max:255'],
            'address' => ['required', 'nullable', 'string', 'max:255'],
            'status' => ['required'],
            'type_account' => ['required','exists:type_accounts,id'],
            'start_day' => ['required', 'date'],
            'end_day' => ['nullable', 'date', 'after_or_equal:start_day'],

        ], [
            'name.required' => 'Họ tên bắt buộc phải nhập',
            'email.required' => 'Email bắt buộc phải nhập',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Mật khẩu bắt buộc phải nhập',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
            'sex.required' => 'Bạn phải chọn giới tính',
            'start_day.required' => 'Ngày bắt đầu bắt buộc phải nhập',
            'end_day.after_or_equal' => 'Ngày kết thúc phải sau hoặc bằng ngày bắt đầu',
            'status.required' => 'Trạng thái là bắt buộc chọn',
            'type_work.required' => 'Hình thức là bắt buộc chọn',
            'phone.required' => 'Số điện thoại bắt buộc phải nhập',
            'address.required' => 'Địa chỉ bắt buộc phải nhập',
            'type_account.required' => 'Loại tài khoản bắt buộc phải nhập',

        ]);
       User::create([
    'name' => $validated['name'],
    'email' => $validated['email'],
    'address' => $validated['address'],
    'phone' => $validated['phone'],
    'start_day' => $validated['start_day'],
    'end_day' => $validated['end_day'] ?? null,
    'password' => Hash::make($validated['password']),
    'birthday' => $validated['birthday'] ?? null,
    'sex' => $validated['sex'],
    'part_id' => $validated['part'] ?? null,
    'team_id' => $validated['team'] ?? null,
    'position_id' => $validated['position'] ?? null,
    'type_work' => $validated['type_work'],
    'status' => $validated['status'],
    'type_account_id' => $validated['type_account'] ?? null,
]);

return redirect()
    ->route('users.list')
    ->with('success', 'Thêm mới tài khoản thành công');
    }
    public function edit(User $user)
    {
        $option = $this->FormOption();
        return view('layouts.users.edit', [
            'option' => $option,
            'mode' => 'update',
            'user' => $user,
        ]);
    }
}
