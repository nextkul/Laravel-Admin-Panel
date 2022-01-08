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
                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#modal-default"><i class="fas fa-plus"></i> Add item</button>
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
                        <td>
                        @if($user->email_verified_at  != null)
                            <a href="{{ route('user.get.unverified',['id'=>Crypt::encrypt($user->id)]) }}"
                               class="btn btn-xs btn-success">
                                <b> Verified </b>
                           </a>
                            @else
                            <a href="{{ route('user.get.verified',['id'=>Crypt::encrypt($user->id)]) }}"
                                class="btn btn-xs btn-danger">
                               <b>Unverified</b>
                            </a>
                        @endif
                     </td>
                          <!-- @if($user->email_verified_at)
                         <td><a href="" class="btn btn-xs btn-success"><b>Verified</b></a></td>
                          @else
                          <td><a href="" class="btn btn-xs btn-danger"><b>Not Verified</b></a></td>
                          @endif -->
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
                              <x-action class="btn btn-info" title="View" icon="fas fa-eye" />
                              <x-action class="btn btn-primary" title="Edit" icon="fas fa-edit" />
                              <x-action class="btn btn-danger" title="Delete" icon="fas fa-trash" />
                              
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
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Default Modal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <x-input type="email" name="email" placeholder="Enter Email" class="fas fa-user" />
            <x-input type="password" name="password" placeholder="Enter Password" class="fas fa-lock" />
            
           </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
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