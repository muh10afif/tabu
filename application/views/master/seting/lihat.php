<!-- Page-Title -->
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h4 class="page-title"><?= $title ?> Data</h4>
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
    <div class="col-12">
        <div class="card shadow">
            <div class="card-header bg-primary">
                <div>
                    <button id="ubah_data" class="btn btn-light float-right">Ubah Data</button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 mt-0"><h5>Harga</h5></label>
                            <div class="col-sm-8">
                                <h5 id="t_harga">: Rp. <?= number_format($set['harga'],0,'.','.') ?></h5>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 mt-0"><h5>Alamat</h5></label>
                            <div class="col-sm-8">
                                <h5 id="t_alamat">: <?= ($set['alamat']) ? $set['alamat'] : '-' ?></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 mt-0"><h5>No Telp</h5></label>
                            <div class="col-sm-8">
                                <h5 id="t_no_telp">: <?= ($set['no_telp']) ? $set['no_telp'] : '-' ?></h5>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 mt-0"><h5>Judul</h5></label>
                            <div class="col-sm-8">
                                <h5 id="t_judul">: <?= ($set['judul']) ? $set['judul'] : '-' ?></h5>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modal_ubah" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title mt-0" id="judul_modal">Ubah Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="text-white">&times;</span>
        </button>
      </div>
        <form id="form_ubah" autocomplete="off" class="form-control-line">
            <input type="hidden" name="id_setting" id="id_setting" value="<?= $set['id'] ?>">
            <div class="modal-body">
                <div class="col-md-12 p-3">
                    <div class="form-group row">
                        <label for="harga" class="col-sm-3 col-form-label">Harga</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Rp. </span>
                                </div>
                                <input type="text" class="form-control numeric number_separator" name="harga" id="harga" placeholder="Masukkan Harga">
                            </div>
                        </div>
                    </div>  
                    <div class="form-group row">
                        <label for="no_telp" class="col-sm-3 col-form-label">No Telepon</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control numeric" name="no_telp" id="no_telp" placeholder="Masukkan No Telelepon">
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="alamat" id="alamat" rows="3" placeholder="Masukkan Alamat"></textarea>
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label for="judul" class="col-sm-3 col-form-label">Judul</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="judul" id="judul" rows="3" placeholder="Masukkan Judul Text Dibawah Pada Struk"></textarea>
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
        function separator(kalimat) {
            return kalimat.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        // 02-11-2020
        $('#ubah_data').on('click', function () {

            id_setting = $('#id_setting').val();

            $.ajax({
                url         : "ambil_data_setting/"+id_setting,
                type        : "GET",
                dataType    : "JSON",
                success     : function(data)
                {
                    $('#modal_ubah').modal('show');

                    if (data.harga == '') {
                        data.harga = 0;
                    }

                    $('#harga').val(separator(data.harga));
                    $('#no_telp').val(data.no_telp);
                    $('#alamat').val(data.alamat);
                    $('#judul').val(data.judul);

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data');
                }
            })

            return false;
        })

        // 02-11-2020
        $('#simpan_data').on('click', function () {

            var form_data = $('#form_ubah').serialize();

            var harga   = $('#harga').val();
            var no_telp = $('#no_telp').val();
            var alamat  = $('#alamat').val();
            var judul   = $('#judul').val();

            if (harga == '') {
                swal({
                    title               : "Peringatan",
                    text                : 'Harga harus terisi !',
                    buttonsStyling      : false,
                    type                : 'warning',
                    showConfirmButton   : false,
                    timer               : 1000
                }); 

                return false;
            }

            if (no_telp == '') {
                swal({
                    title               : "Peringatan",
                    text                : 'No telepon harus terisi !',
                    buttonsStyling      : false,
                    type                : 'warning',
                    showConfirmButton   : false,
                    timer               : 1000
                }); 

                return false;
            }

            if (alamat == '') {
                swal({
                    title               : "Peringatan",
                    text                : 'Alamat harus terisi !',
                    buttonsStyling      : false,
                    type                : 'warning',
                    showConfirmButton   : false,
                    timer               : 1000
                }); 

                return false;
            }

            if (judul == '') {
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
                    url     : "simpan_data_setting",
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

                        $('#modal_ubah').modal('hide');
                        
                        swal({
                            title               : "Berhasil",
                            text                : 'Data berhasil disimpan',
                            buttonsStyling      : false,
                            confirmButtonClass  : "btn btn-success",
                            type                : 'success',
                            showConfirmButton   : false,
                            timer               : 1000
                        });    

                        $('#t_harga').text(": Rp. "+separator(harga));
                        $('#t_no_telp').text(": "+no_telp);
                        $('#t_alamat').text(": "+alamat);
                        $('#t_judul').text(": "+judul);
                        
                        $('#form_ubah').trigger("reset");
                        
                    }
                })
        
                return false;

            }

        })
        
    })
</script>