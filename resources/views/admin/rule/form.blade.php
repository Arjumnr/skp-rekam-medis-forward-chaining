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
                            <label for="tindakan_kode" class="form-label">Pilih Tindakan</label>
                            <select class="form-select" id="tindakan_kode" name="tindakan_kode"
                                aria-label="Default select example">
                                <option selected disabled>---Pilih Tindakan---</option>
                                @foreach ($dataTindakan as $item)
                                    <option value="{{ $item->kode_tindakan }}"> {{ $item->kode_tindakan }} |
                                        {{ $item->nama_tindakan }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-mb-3">
                            <small class="text-light fw-semibold">Pilih Gejalan</small>
                            @foreach ($dataGejala as $item)
                                <div class="form-check mt-3">
                                    <input class="form-check-input" type="checkbox" value="{{ $item->kode_gejala }}"
                                        id="defaultCheck" name="gejala_kode[]">
                                    <label class="form-check-label" for="defaultCheck">{{ $item->kode_gejala }} |
                                        {{ $item->des_gejala }} </label>
                                </div>
                            @endforeach
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
                ajax: "{{ route('rule') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'tindakan_kode',
                        name: 'tindakan_kode'
                    },
                    {
                        data: 'gejala_kode',
                        name: 'gejala_kode'
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
                    "ajax": "{{ route('rule') }}",
                    "columns": [{
                            "data": "DT_RowIndex"
                        },
                        {
                            "data": "tindakan_kode"
                        },
                        {
                            "data": "gejala_kode"
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
                console.log(formData);
                var id = $('#data_id').val();
                var url = "{{ route('rule.store') }}";
                if (id != '') {
                    //kirim id lewat form data 
                    formData.append('data_id', id);
                }

                $.ajax({
                    data: formData,
                    url: "{{ route('rule.store') }}",
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
                            url: "{{ route('rule.store') }}" + '/' + id,
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
                $.get("{{ route('rule') }}" + '/' + data_id + '/edit', function(data) {
                    console.log("data id = " + data.id);
                    console.log("gejala_kode" + data.gejala_kode);
                    $('#modalHeading').html("Edit Data");
                    $('#btnSave').val("edit-data");
                    $('#basicModal').modal('show');
                    $('#data_id').val(data_id);
                    $('#tindakan_kode').val(data.tindakan_kode);
                    //tercheck
                    let gejala_kode = data.gejala_kode.split(',');
                    console.log(gejala_kode);

                    $('input[type="checkbox"]').each(function() {
                        // Get the value attribute of the checkbox
                        var checkboxValue = $(this).val();

                        // Check if the value exists in the 'gejala_kode' array
                        if (gejala_kode.includes(checkboxValue)) {
                            // If it exists, set the checkbox as checked
                            $(this).prop('checked', true);
                        }
                    });


                })

            });

            $('#btnSave').click(function(e) {
                e.preventDefault();
                var formData = $('#formID').serialize();

                $.ajax({
                    data: formData,
                    url: "{{ route('rule.store') }}",
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
