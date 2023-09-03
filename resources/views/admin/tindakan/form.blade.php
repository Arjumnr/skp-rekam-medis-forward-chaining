<div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Input Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" id="formID" name="formID" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="data_id" id="data_id">

                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="kode_tindakan" class="form-label">Kode Tindakan</label>
                            <input type="text" id="kode_tindakan" class="form-control" name="kode_tindakan" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nama_tindakan" class="form-label">Nama Tindakan</label>
                            <input type="text" id="nama_tindakan" class="form-control" name="nama_tindakan" required />
                        </div>
                    </div>
                    

                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary" id="btnSave" name="btnSave">Save
                            changes</button>
                    </div>
            </form>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $(document).ready(function() {


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var table = $('#example').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('tindakan') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'kode_tindakan',
                        name: 'kode_tindakan'
                    },
                    {
                        data: 'nama_tindakan',
                        name: 'nama_tindakan'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            if ($.fn.dataTable.isDataTable('#example')) {
                table = $('#example').DataTable();
            } else {
                table = $('#example').DataTable({
                    "ajax": "{{ route('tindakan') }}",
                    "columns": [{
                            "data": "DT_RowIndex"
                        },
                        {
                            "data": "kode_tindakan"
                        },
                        {
                            "data": "nama_tindakan"
                        },
                        {
                            "data": "action"
                        },
                    ]
                });
            }

            $('#btnADD').click(function() {
                $('#btnSave').html('Simpan');
                $('#data_id').val('');
                $('#formID').trigger("reset");
                $('#modalHeading').html("Tambah Data ");
            });

            $('#formID').on('submit', function(event) {

                event.preventDefault();
                var formData = new FormData(this);
                var id = $('#data_id').val();
                var url = "{{ route('tindakan.store') }}";
                if (id != '') {
                    //kirim id lewat form data 
                    formData.append('data_id', id);
                }

                $.ajax({
                    data: formData,
                    url: "{{ route('tindakan.store') }}",
                    type: "POST",
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        console.log(data);
                        //hidden seeding
                        $('#formID').trigger("reset");
                        $('#basicModal').modal('hide');
                        $('.modal-backdrop').remove();

                        if (data.status == 'success') {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Berhasil',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function() {
                                table.draw();
                            })
                        } else {
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: 'Gagal',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function() {
                                table.draw();

                            })
                        }
                    },
                    error: function(data) {
                        console.log('Error:', data);
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'Data gagal ditambahkan',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                })
            });


            $('body').on('click', '.delete', function() {

                var id = $(this).data("id");
                console.log(id);
                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "Data yang d dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus data!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        console.log(id);
                        $.ajax({
                            type: "DELETE",
                            url: "{{ route('tindakan.store') }}" + '/' + id,
                            dataType: 'json',

                            success: function(data) {
                                console.log(data);
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: 'Data berhasil dihapus',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(function() {
                                    table.draw();
                                })
                            },
                            error: function(data) {
                                console.log('Error:', data);
                                Swal.fire({
                                    position: 'center',
                                    icon: 'error',
                                    title: 'Data gagal dihapus',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            }
                        })

                    }
                })
            });

            $('body').on('click', '.edit', function() {
                //reset
                $('#formID').trigger("reset");

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $('#btnSave').html('Update Data')

                var data_id = $(this).data('id');
                $.get("{{ route('tindakan') }}" + '/' + data_id + '/edit', function(data) {
                    console.log("data id = " + data.id);
                    // console.log("ttl" + data.ttl);
                    $('#modalHeading').html("Edit Data");
                    $('#btnSave').val("edit-data");
                    $('#basicModal').modal('show');
                    $('#data_id').val(data_id);
                    $('#kode_tindakan').val(data.kode_tindakan);
                    $('#nama_tindakan').val(data.nama_tindakan);

                })

            });

            $('#btnSave').click(function(e) {
                e.preventDefault();
                var formData = $('#formID').serialize();

                $.ajax({
                    data: formData,
                    url: "{{ route('tindakan.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);

                        $('#formID').trigger("reset");
                        $('#basicModal').modal('hide');
                        $('.modal-backdrop').remove();

                        if (data.status == 'success') {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Berhasil',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function() {
                                table.draw();
                            })
                        } else {
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: 'Gagal',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function() {
                                table.draw();

                            })
                        }
                    },
                    error: function(data) {
                        console.log('Error:', data);
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'Data gagal ditambahkan',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                })
            });








        });
    </script>
@endpush
