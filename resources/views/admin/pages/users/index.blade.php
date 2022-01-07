@extends('admin.layouts.admin-app')
@section('title',__('Dashboard'))
{{-- Page js files --}}
@push('page-style')
 <!-- DataTables -->
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush
@section('content')
 <!-- Main content -->
 <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><b>All User Details</b></h3>
                <button type="button" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Add item</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Email(s)</th>
                    <th>Email verified</th>
                    <th>Status</th>
                    <th>action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($Users as $user)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>

                          @if($user->email_verified_at)
                         <td><a href="" class="btn btn-xs btn-success"><b>Verified</b></a></td>
                          @else
                          <td><a href="" class="btn btn-xs btn-danger"><b>Not Verified</b></a></td>
                          @endif
                        <td>
                          <div class="btn-group">
                              <button type="button" class="btn btn-primary btn-xs"><b>Active</b></button>
                              <button type="button" class="btn btn-primary dropdown-toggle dropdown-icon btn-xs" data-toggle="dropdown">
                              </button>
                              <div class="dropdown-menu" role="menu">
                                <a class="dropdown-item" href="#">Active</a>
                                <a class="dropdown-item" href="#">InActive</a>
                                <a class="dropdown-item" href="#">Pending</a>
                              </div>
                          </div>
                      </td>
                        <td class="align-middle">
                          <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info" title="View"><i class="fas fa-eye"></i></a>
                            <a href="#" class="btn btn-primary" title="Edit"><i class="fas fa-edit"></i></a>
                            <a href="#" class="btn btn-danger" title="Delete"><i class="fas fa-trash"></i></a>
                          </div>
                        </td>
                      </tr>
                    @endforeach  
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
{{-- Page js files --}}
@push('page-script')
<!-- DataTables  & Plugins -->
<script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('admin/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('admin/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
@endpush