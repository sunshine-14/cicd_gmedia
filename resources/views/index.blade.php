@extends('layout.main')

@section('title')
  <title>HOME</title>
@endsection
        
@section('content')
<div class="modal-header float-right">
  <h3 class="fw-bold">Data Karyawan
  <a href="{{ route('karyawan.create') }}">
    <img alt="Qries" src="{{ asset('image/plus.png') }}" height="20">
  </a>
</h3>
</div>
    <table id="data-table" class="table table-hover table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>NIP</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
    </table>
@stop

@push('scripts')
<script>
  function DeleteFunction() {
    event.preventDefault(); // prevent form submit
    var form = event.target.form; // storing the form
            swal({
      title: "Apakah anda yakin ingin menghapus ini?",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Ya",
      cancelButtonText: "Tidak",
      closeOnConfirm: false,
      closeOnCancel: false
    },
    function(isConfirm){
      if (isConfirm) {
        form.submit();          // submitting the form when user press yes
      } else {
        swal("Cancelled");
      }
    });
  }
</script> 
<script>
$(function() {
    $('#data-table').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        processing: true,
        serverSide: true,
        ajax: 'json',
        columns: [
          {  
              "data": null,
              "class": "align-top",
              "orderable": false,
              "searchable": false,
              "render": function (data, type, row, meta) {
                  return meta.row + meta.settings._iDisplayStart + 1;
              }  
          },
            { data: 'nip', name: 'nip' },
            { data: 'nama', name: 'nama' },
            { data: 'alamat', name: 'alamat' },
            { data: 'action', name: 'action', orderable: false, searchable: false},
            
        ]
    });
    
});
</script>
@endpush