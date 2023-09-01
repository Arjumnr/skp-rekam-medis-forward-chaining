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
                            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                            <input type="text" id="nama_lengkap" class="form-control" name="nama_lengkap" required />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col mb-3">
                            <label for="jk" class="form-label">Jenis Kelamin</label>
                            <select class="form-select" id="jk" name="jk"
                                aria-label="Default select example">
                                <option selected disabled>---Pilih Jenis Kelamin---</option>
                                <option value="Laki-laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="ttl" class="form-label">Tanggal Lahir</label>
                            <input class="form-control" type="date" value="2000-01-01" id="html5-date-input"
                                name="ttl">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" id="alamat" class="form-control" name="alamat" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="no_hp" class="form-label">No. Hp</label>
                            <input type="number" id="no_hp" class="form-control" name="no_hp" required />
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
                ajax: "{{ route('pasien') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'nama_lengkap',
                        name: 'nama_lengkap'
                    },
                    {
                        data: 'jk',
                        name: 'jk'
                    },
                    {
                        data: 'alamat',
                        name: 'alamat'
                    },
                    {
                        data: 'ttl',
                        name: 'ttl'
                    },
                    {
                        data: 'no_hp',
                        name: 'no_hp'
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
                    "ajax": "{{ route('pasien') }}",
                    "columns": [{
                            "data": "DT_RowIndex"
                        },
                        {
                            "data": "nama_lengkap"
                        },
                        {
                            "data": "jk"
                        },
                        {
                            "data": "alamat"
                        },
                        {
                            "data": "ttl"
                        },
                        {
                            "data": "no_hp"
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
                var url = "{{ route('pasien.store') }}";
                if (id != '') {
                    //kirim id lewat form data 
                    formData.append('data_id', id);
                }

                $.ajax({
                    data: formData,
                    url: "{{ route('pasien.store') }}",
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
                            url: "{{ route('pasien.store') }}" + '/' + id,
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
                $.get("{{ route('pasien') }}" + '/' + data_id + '/edit', function(data) {
                    console.log("data id = " + data.id);
                    // console.log("ttl" + data.ttl);
                    $('#modalHeading').html("Edit Data");
                    $('#btnSave').val("edit-data");
                    $('#basicModal').modal('show');
                    $('#data_id').val(data_id);
                    $('#nama_lengkap').val(data.nama_lengkap);
                    $('#jk').val(data.jk).trigger('change');
                    document.getElementById('html5-date-input').value = data.ttl;
                    $('#no_hp').val(data.no_hp);
                    $('#alamat').val(data.alamat);

                })

            });

            $('#btnSave').click(function(e) {
                e.preventDefault();
                var formData = $('#formID').serialize();

                $.ajax({
                    data: formData,
                    url: "{{ route('pasien.store') }}",
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
