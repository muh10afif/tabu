<!-- Page-Title -->
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h4 class="page-title"><?= $title ?></h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Taman Batu</a></li>
                <li class="breadcrumb-item">Master</li>
                <li class="breadcrumb-item active"><?= $title ?></li>
            </ol>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header bg-primary">
                <button class="btn btn-light" id="tambah_data"><i class="ti-plus mr-2"></i>Tambah Data</button>
                <!-- <h5 id="judul" class="text-white mb-0 mt-1">Master setting</h5> -->
            </div>
            <div class="card-body table-responsive">

                <table class="table table-bordered table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="tabel_hari_besar" width="100%" cellspacing="0">
                    <thead class="thead-light text-center">
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%">Tanggal Awal</th>
                            <th width="20%">Tanggal Akhir</th>
                            <th width="20%">Judul Hari Besar</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                            
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal_hari_besar" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title mt-0" id="judul_modal">Tambah Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="text-white">&times;</span>
        </button>
      </div>
        <form id="form_hari_besar" autocomplete="off" class="form-control-line">
            <input type="hidden" name="id_hari_besar" id="id_hari_besar">
            <input type="hidden" name="aksi" id="aksi" value="tambah">
            <div class="modal-body">
                <div class="col-md-12 p-3">
                    <div class="form-group row">
                        <label for="tgl_awal" class="col-sm-3 col-form-label">Tanggal Awal</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control datepicker" name="tgl_awal" id="tgl_awal" placeholder="Masukkan Tanggal Awal" readonly>
                        </div>
                    </div>  
                    <div class="form-group row">
                        <label for="tgl_akhir" class="col-sm-3 col-form-label">Tanggal Akhir</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control datepicker" name="tgl_akhir" id="tgl_akhir" placeholder="Masukkan Tanggal Akhir" readonly>
                        </div>
                    </div>  
                    <div class="form-group row">
                        <label for="judul" class="col-sm-3 col-form-label">Judul</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="judul" id="judul" rows="3" placeholder="Masukkan Text Hari Besar"></textarea>
                        </div>
                    </div> 
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-ban mr-2"></i>Batal</button>
                <button type="button" class="btn btn-success" id="simpan_data"><i class="fas fa-check mr-2"></i>Simpan</button>
            </div>
        </form>
    </div>
  </div>
</div>

<script>
    $(document).ready(function () {
        
        // 02-11-2020
        var tabel_hari_besar = $('#tabel_hari_besar').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "tampil_data_hari_besar",
                "type"  : "POST"
            },
            "columnDefs"        : [{
                "targets"   : [0,4],
                "orderable" : false
            }, {
                'targets'   : [0,4],
                'className' : 'text-center',
            }]

        })
        
        // 02-11-2020
        $('#tambah_data').on('click', function () {

            $('#modal_hari_besar').modal('show');
            $('#judul_modal').text('Tambah Data');

            $('#form_hari_besar').trigger("reset");

            $('.datepicker').datepicker('setDate', null);
            
        })

        // 02-11-2020
        $('#simpan_data').on('click', function () {

            var form_data   = $('#form_hari_besar').serialize();

            var tgl_awal    = $('#tgl_awal').val();
            var tgl_akhir   = $('#tgl_akhir').val();
            var judul       = $('#judul').val();

            if (tgl_awal == '') {

                $('#tgl_awal').focus();

                swal({
                    title               : "Peringatan",
                    text                : 'Tanggal Awal harus terisi !',
                    buttonsStyling      : false,
                    type                : 'warning',
                    showConfirmButton   : false,
                    timer               : 1000
                }); 

                return false;
            }

            if (tgl_akhir == '') {

                $('#tgl_akhir').focus();

                swal({
                    title               : "Peringatan",
                    text                : 'Tanggal Akhir harus terisi !',
                    buttonsStyling      : false,
                    type                : 'warning',
                    showConfirmButton   : false,
                    timer               : 1000
                }); 

                return false;
            }

            if (judul == '') {

                $('#judul').focus();

                swal({
                    title               : "Peringatan",
                    text                : 'Judul harus terisi !',
                    buttonsStyling      : false,
                    type                : 'warning',
                    showConfirmButton   : false,
                    timer               : 1000
                }); 

                return false;

            } else {

                $.ajax({
                    url     : "simpan_data_hari_besar",
                    type    : "POST",
                    beforeSend  : function () {
                        swal({
                            title   : 'Menunggu',
                            html    : 'Memproses Data',
                            onOpen  : () => {
                                swal.showLoading();
                            }
                        })
                    },
                    data    : form_data,
                    dataType: "JSON",
                    success : function (data) {

                        $('#modal_hari_besar').modal('hide');
                        
                        swal({
                            title               : "Berhasil",
                            text                : 'Data berhasil disimpan',
                            buttonsStyling      : false,
                            confirmButtonClass  : "btn btn-success",
                            type                : 'success',
                            showConfirmButton   : false,
                            timer               : 1000
                        });    

                        tabel_hari_besar.ajax.reload(null, false);

                        $('#aksi').val('tambah');
                        
                    }
                })
        
                return false;
                
            }
            
        })

        // 02-11-2020
        $('#tabel_hari_besar').on('click', '.edit-hari-besar', function () {

            $('#judul_modal').text('Ubah Data Hari Besar');

            var id_hari_besar  = $(this).data('id');

            $.ajax({
                url         : "ambil_data_hari_besar/"+id_hari_besar,
                type        : "GET",
                beforeSend  : function () {
                    swal({
                        title   : 'Menunggu',
                        html    : 'Memproses Data',
                        onOpen  : () => {
                            swal.showLoading();
                        }
                    })
                },
                dataType    : "JSON",
                success     : function(data)
                {
                    swal.close();

                    console.log(data);

                    $('#modal_hari_besar').modal('show');
                    
                    $('#id_hari_besar').val(data.id);
                    // $("#tgl_awal").datepicker("setDate", data.tgl_awal);
                    $("#tgl_akhir").datepicker("setDate", data.tgl_akhir);

                    
                    var myDateVal = moment(data.tgl_awal).format('DD-MM-YYYY');
                    $('#tgl_awal').datepicker('setDate', myDateVal);    
                    var myDateVal2 = moment(data.tgl_akhir).format('DD-MM-YYYY');
                    $('#tgl_akhir').datepicker('setDate', myDateVal2);    
                                        
                    $('#judul').val(data.judul);

                    $('#aksi').val('ubah');

                    return false;

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            })

            return false;

        })

        // 02-11-2020
        $('#tabel_hari_besar').on('click', '.hapus-hari-besar', function () {

            var id_hari_besar = $(this).data('id');

            swal({
                title       : 'Konfirmasi',
                text        : 'Yakin akan menghapus?',
                type        : 'warning',

                buttonsStyling      : false,
                confirmButtonClass  : "btn btn-danger",
                cancelButtonClass   : "btn btn-success mr-3",

                showCancelButton    : true,
                confirmButtonText   : 'Hapus',
                confirmButtonColor  : '#d33',
                cancelButtonColor   : '#3085d6',
                cancelButtonText    : 'Batal',
                reverseButtons      : true
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url         : "simpan_data_hari_besar",
                        method      : "POST",
                        beforeSend  : function () {
                            swal({
                                title   : 'Menunggu',
                                html    : 'Memproses Data',
                                onOpen  : () => {
                                    swal.showLoading();
                                }
                            })
                        },
                        data        : {aksi:'Hapus', id_hari_besar:id_hari_besar},
                        dataType    : "JSON",
                        success     : function (data) {

                                tabel_hari_besar.ajax.reload(null,false);   

                                swal({
                                    title               : 'Berhasil',
                                    text                : 'Data Berhasil Dihapus',
                                    buttonsStyling      : false,
                                    confirmButtonClass  : "btn btn-success",
                                    type                : 'success',
                                    showConfirmButton   : false,
                                    timer               : 1000
                                }); 

                                $('#form_hari_besar').trigger("reset");

                                $('#aksi').val('tambah');
                            
                        },
                        error       : function(xhr, status, error) {
                            var err = eval("(" + xhr.responseText + ")");
                            alert(err.Message);
                        }

                    })

                    return false;
                } else if (result.dismiss === swal.DismissReason.cancel) {

                    swal({
                            title               : 'Batal',
                            text                : 'Anda membatalkan hapus data!',
                            buttonsStyling      : false,
                            confirmButtonClass  : "btn btn-primary",
                            type                : 'error',
                            showConfirmButton   : false,
                            timer               : 1000
                        }); 
                }
            })

        })
        
    })
</script>