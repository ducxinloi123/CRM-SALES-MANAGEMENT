<div class="row">
    <div class="col-md-4">
        <label for="">Họ Và Tên</label>
        <input type="text" name="name" class="form-control" value="{{ old('name',$user -> name) }}">
        @error('name')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>
        <div class="col-md-4">
            <label for="">Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email',$user -> email) }}">
        @error('email')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>
        <div class="col-md-4">
            <label for="">PassWord</label>
        <input type="password" name="password" class="form-control" value="{{ old('password',$user -> password) }}">
        @error('password')
        <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>
        <div class="col-md-4">
            <label for="">Ngày Sinh</label>
        <input type="date" name="brithday" class="form-control" value="{{ old('brithday',$user -> brithday) }}">
        @error('brithday')
        <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>
        <div class="col-md-4">
         <label for="">Giới Tính</label>
         <select name="" id=""><option value="">Giới Tính</option></select>
         @foreach($option['gender'] as $item)
            <option value="{{ $item['id'] }}">
                {{ $item['text'] }}
            </option>
         @endforeach
    </div>
</div>