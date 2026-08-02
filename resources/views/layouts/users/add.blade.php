@include('layouts/parts/header')   
@include('layouts/parts/sidebar')  
<div class="container-fluid" style="min height: 100vh ; margin-top:20px">
    <h1>Thêm mới nhân sự</h1>
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
    <form action="{{ route('users.create') }}" method="post">
        @csrf
        @include('layouts.users.form')
        <button type="submit" class="btn btn-primary">Tạo mới</button>
    </form>
</div>
@include('layouts/parts/footer')
