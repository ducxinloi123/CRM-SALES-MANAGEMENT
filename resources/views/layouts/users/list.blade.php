@include('layouts/parts/header')   
@include('layouts/parts/sidebar')  

<div class="container-fluid mt-5">
    <h2 class="mb-4">Danh sách tài khoản</h2>

    <div class="table-responsive">
        <table class="table table-bordered table-striped text-nowrap" id="users-table">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Ngày Sinh</th>
                    <th>Giới Tính</th>
                    <th>Bộ Phận</th>
                    <th>Vị Trí</th>
                    <th>Đội Nhóm</th>
                    <th>SDT</th>
                    <th>Địa Chỉ</th>
                    <th>Trạng Thái</th>
                    <th>Ngày Bắt Đầu</th>
                    <th>Ngày Nghỉ Việc</th>
                    <th>Loại Tài Khoản</th>
                    <th>Tác Vụ</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

<script type="text/javascript">
$(document).ready(function () {
   
    let table = $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        dom: `
        <'row mb-3 align-items-center'
            <'col-md-2' l>
            <'col-md-10 d-flex justify-content-end align-items-center flex-wrap'
                f
                <'dt-toolbar d-flex ms-2'>
            >
        >
        rt
        <'row mt-2 justify-content-between'
            <'col-md-auto me-auto d-md-flex justify-content-between align-items-center dt-layout-start' i>
            <'col-md-auto me-auto d-md-flex justify-content-between align-items-center dt-layout-end' p>
        >
        `,
        initComplete: function () {
            const $toolbar = $('.dt-toolbar', this.api().table().container());

            if(!$toolbar.children().length){
                $toolbar.html(`
                    <select id="filter-status" class="form-select form-select-sm ms-2" style="width: 130px;">
                        <option value="">Trạng thái</option>
                    </select>
                    <select id="filter-part" class="form-select form-select-sm ms-2" style="width: 130px;">
                        <option value="">Bộ phận</option>
                    </select>
                    <select id="filter-team" class="form-select form-select-sm ms-2" style="width: 130px;">
                        <option value="">Đội nhóm</option>
                    </select>
                    <select id="filter-account" class="form-select form-select-sm ms-2" style="width: 140px;">
                        <option value="">Loại tài khoản</option>
                    </select>
                    <button id="btn-clear-filter" class="btn btn-dark btn-sm ms-2">Xóa lọc</button>
                `);
            }

            $.getJSON("{{ route('users.filter') }}").done(res => {
                if(res.status_f) {
                    res.status_f.forEach(item => {
                        $('#filter-status').append(new Option(item.text, item.id));
                    });
                }
                
                if(res.part_f) {
                    res.part_f.forEach(item => {
                        $('#filter-part').append(new Option(item.text, item.id));
                    });
                }

                if(res.team_f) {
                    res.team_f.forEach(item => {
                        $('#filter-team').append(new Option(item.text, item.id));
                    });
                }

                if(res.role_f) {
                    res.role_f.forEach(item => {
                        $('#filter-account').append(new Option(item.text, item.id));
                    });
                }
            });
           
        },
        ajax:{
            url:  "{{ route('users.data') }}",
            data: function (d){
                d.part_id = $('#filter-part').val()|| '';
                d.team_id = $('#filter-team').val()|| '';
                d.status = $('#filter-status').val()|| '';
                d.type_account_id = $('#filter-account').val() || '';
            }
           
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'birthday', name: 'birthday'},
            {data: 'sex', name: 'sex'},
            {data: 'part_name', name: 'part.name'},
            {data: 'position_name', name: 'position.name'},
            {data: 'team_name', name: 'team.name'},
            {data: 'phone', name: 'phone'},
            {data: 'address', name: 'address'},
            {data: 'status', name: 'status'},
            {data: 'start_day', name: 'start_day'},
            {data: 'end_day', name: 'end_day'},
            {data: 'type_account_name', name: 'typeAccount.name'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        language: {
            info: 'Hiển Thị _PAGE_ of _PAGES_ trang',
            infoEmpty: 'Không có dữ liệu',
            infoFiltered: '(filtered from _MAX_ total records)',
            search: "Tìm Kiếm:", 
            lengthMenu: 'Hiển thị _MENU_ user mỗi trang',
        }
    });
    
    // Sự kiện khi thay đổi các thẻ Select
    $(document).on('change', '#filter-account, #filter-part, #filter-status, #filter-team', function() {
        table.ajax.reload(null, false);
    });

    // Sự kiện khi bấm nút Xóa lọc
    $(document).on('click', '#btn-clear-filter', function() {
        $('#filter-status').val('');
        $('#filter-part').val('');
        $('#filter-team').val('');
        $('#filter-account').val('');
        
        table.ajax.reload();
    });
    
});
</script>

@include('layouts/parts/footer')