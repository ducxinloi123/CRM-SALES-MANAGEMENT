@include('layouts/parts/header')   
@include('layouts/parts/sidebar')  
<div class="container" style="min height: 100vh ;">
    <h1>Thêm mới nhân sự</h1>
    <form action="{{ route('users.create') }}" method="post">
        @csrf
        @include('layouts.users.form')
        <button type="submit" class="btn btn-primary">Tạo mới</button>
    </form>
</div>
@include('layouts/parts/footer')
