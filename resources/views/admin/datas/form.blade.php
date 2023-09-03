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
                            <label for="pasien_id" class="form-label">Pilih Pasien</label>
                            <select class="form-select" id="pasien_id" name="pasien_id"
                                aria-label="Default select example">
                                <option selected disabled>---Pilih Pasien---</option>
                                @foreach ($dataPasien as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_lengkap }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-mb-3">
                            <small class="text-light fw-semibold">Pilih Gejala</small>
                            @foreach ($dataGejala as $item)
                                <div class="form-check mt-3">
                                    <input class="form-check-input" type="checkbox" value="{{ $item->kode_gejala }}" id="gejala_{{ $item->kode_gejala }}" name="gejala_kode[]">
                                    <label class="form-check-label" for="gejala_{{ $item->kode_gejala }}">{{ $item->kode_gejala }} | {{ $item->des_gejala }}</label>
                                    <select class="form-select cf-select" id="cf_user_{{ $item->kode_gejala }}" name="cf_user[]" aria-label="Default select example">
                                        <option selected disabled>---Pilih CF---</option>
                                        @foreach ($dataCf as $cfItem)
                                            <option value="{{ $cfItem->nilai_cf_user }}">{{ $cfItem->ungkapan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endforeach
                        </div>
                        
                        <script>
                            const checkboxes = document.querySelectorAll('input[type="checkbox"]');
                            checkboxes.forEach(checkbox => {
                                checkbox.addEventListener("change", function () {
                                    const selectId = "cf_user_" + this.value;
                                    const select = document.getElementById(selectId);
                                    
                                    if (this.checked) {
                                        select.style.display = "block";
                                    } else {
                                        select.style.display = "none";
                                    }
                                });
                            });
                        </script>
                        
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
                ajax: "{{ route('datas') }}",
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'get_pasien.nama_lengkap',
                        name: 'get_pasien.nama_lengkap'
                    },
                    {
                        data: 'data_terapis',
                        name: 'data_terapis'
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
                    "ajax": "{{ route('datas') }}",
                    "columns": [
                        {
                            "data": "DT_RowIndex"
                        },
                        {
                            "data": "get_pasien.nama_lengkap"
                        },
                        {
                            "data": "data_terapis"
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
                if (id != '') {
                    //kirim id lewat form data 
                    formData.append('data_id', id);
                }

                $.ajax({
                    data: formData,
                    url: "{{ route('datas.store') }}",
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
                            url: "{{ route('datas.store') }}" + '/' + id,
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

            // $('body').on('click', '.edit', function() {
            //     //reset
            //     $('#formID').trigger("reset");

            //     $.ajaxSetup({
            //         headers: {
            //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //         }
            //     });

            //     $('#btnSave').html('Update Data')

            //     var data_id = $(this).data('id');
            //     $.get("{{ route('datas') }}" + '/' + data_id + '/edit', function(data) {
            //         console.log("data id = " + data.id);
            //         // console.log("ttl" + data.ttl);
            //         $('#modalHeading').html("Edit Data");
            //         $('#btnSave').val("edit-data");
            //         $('#basicModal').modal('show');
            //         $('#data_id').val(data_id);
            //         // $('#kode_gejala').val(data.kode_gejala);
            //         // $('#des_gejala').val(data.des_gejala);
            //         // $('#cf_gejala').val(data.cf_gejala);

            //     })

            // });

            $('#btnSave').click(function(e) {
                e.preventDefault();
                var formData = $('#formID').serialize();
                console.log(formData);
                $.ajax({
                    data: formData,
                    url: "{{ route('datas.store') }}",
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
