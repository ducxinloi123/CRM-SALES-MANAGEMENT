<div class="row">
    <div class="col-md-4">
        <label for="">Họ Và Tên</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
        @error('name')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-4">
        <label for="">Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
        @error('email')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-4">
        <label for="">Địa Chỉ</label>
        <input type="text" name="address" class="form-control" value="{{ old('name', $user->name) }}">
        @error('address')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
         </div>
    <div class="col-md-4">
        <label for="">SĐT</label>
        <input type="text" name="phone" class="form-control" value="{{ old('name', $user->name) }}">
        @error('phone')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-4">
        <label for="">Ngày Bắt Đầu</label>
        <input type="date" name="start_day" class="form-control" value="{{ old('name', $user->name) }}">
        @error('start_day')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-4">
        <label for="">Ngày Kết Thúc</label>
        <input type="date" name="end_day" class="form-control" value="{{ old('name', $user->name) }}">
        @error('end_day')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-4">
        <label for="">Mật Khẩu</label>
        <input type="password" name="password" class="form-control" value="{{ old('password', $user->password) }}"
            minlength="6">
        @error('password')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-4">
        <label for="">Ngày Sinh</label>
        <input type="date" name="birthday" class="form-control" value="{{ old('birthday', $user->brithday) }}">
        @error('birthday')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-4">
        <label for="">Giới Tính</label>
        <select name="sex" class="form-select">
            <option value="">Giới Tính</option>
            @foreach($option['gender'] as $item)
                <option value="{{ $item['id'] }} {{ ($item['id'] == old('gender', $user->gender)) ? 'selected' : ' ' }}">
                    {{ $item['text'] }}
                </option>
            @endforeach
        </select>
        @error('gender')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-4">
        <label for="">Bộ Phận</label>
        <select name="part" class="form-select">
            <option value="">Bộ Phận</option>
            @foreach($option['part'] as $item)
                  <option value="{{ $item['id'] }} {{ ($item['id'] == old('part', $user->part)) ? 'selected' : ' ' }}">
                    {{ $item['text'] }}
            </option>
            @endforeach
        </select>
        @error('part')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-4">
        <label for="">Đội Nhóm</label>
        <select name="team" class="form-select">
            <option value="">Đội Nhóm</option>
            @foreach($option['team'] as $item)
                <option value="{{ $item['id'] }} {{ ($item['id'] === old('team_id', $user->team_id)) ? 'selected' : ' ' }}">
                    {{ $item['text'] }}
                </option>
            @endforeach
        </select>
        @error('part')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-4">
        <label for="">Vị Trí</label>
        <select name="position" class="form-select">
            <option value="">Vị Trí</option>
            @foreach($option['position'] as $item)
                <option
                    value="{{ $item['id'] }}  {{ ($item['id'] === old('position_id', $user->position_id)) ? 'selected' : ' ' }}">
                    {{ $item['text'] }}
                </option>
            @endforeach
        </select>
        @error('part')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-4">
        <label for="">Loại Tài Khoản</label>
        <select name="type_account" class="form-select">
            <option value="">Loại Tài Khoản</option>
            @foreach($option['type_account'] as $item)
                <option
                    value="{{ $item['id'] }}  {{ ($item['id'] === old('type_account_id', $user->type_account_id)) ? 'selected' : ' ' }}">
                    {{ $item['text'] }}
                </option>
            @endforeach
        </select>
        @error('type_account')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-4">
        <label for="">Hình Thức</label>
        <select name="type_work" class="form-select">
            <option value="">Hình Thức</option>
            @foreach($option['type_work'] as $item)
                <option
                    value="{{ $item['id'] }}  {{ ($item['id'] === old('type_work', $user->type_work)) ? 'selected' : ' ' }}">
                    {{ $item['text'] }}
                </option>
            @endforeach
        </select>
        @error('type_work')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-4">
        <label for="">Trạng Thái</label>
        <select name="status" class="form-select">
            <option value="">Trạng Thái</option>
            @foreach($option['status'] as $item)
                <option value="{{ $item['id'] }}  {{ ($item['id'] === old('status', $user->status)) ? 'selected' : ' ' }}">
                    {{ $item['text'] }}
                </option>
            @endforeach
        </select>
        @error('status')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>
</div>