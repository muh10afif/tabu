<div class="row mt-3">
    <div class="col-md-12 text-center">
        <div class="alert alert-success shadow" role="alert">
            <strong class="font-20">Pengunjung Ke</strong><h4 class="display-4 font-weight-bold mb-0 mt-0 jml_awal"><?= $jml_p ?></h4>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-body">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-6">
                        <form id="form-pengunjung" autocomplete="off">
                            <input type="hidden" id="kode_tr" name="kode_tr" value="<?= $kode_tr ?>">
                            <input type="hidden" id="judul_set" name="judul_set" value="<?= $judul_set ?>">
                            <input type="hidden" id="judul_hb" name="judul_hb" value="<?= $judul_hb ?>">
                            <div class="form-group row">
                                <label class="col-sm-4">Harga</label>
                                <div class="col-sm-8 text-right bg-light" style="border: 2px solid black;border-radius: 10px; color: black;">
                                    <div class="row font-18" style="padding: 3px;">
                                        <div class="col-md-3 text-left">Rp. </div>
                                        <div class="col-md-9 text-right font-weight-bold font-20" id="t_harga"><?= number_format($harga,0,'.','.') ?></div>
                                    </div>
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label for="jumlah_pengunjung" class="col-sm-4 col-form-label">Jumlah Pengunjung</label>
                                <div class="col-sm-8">
                                    <div class="input-counter input-group">
                                        <div class="input-group-prepend">
                                            <button type="button" class="btn-subtract btn btn-success btn-spin kurang" aksi="kurang" disabled>
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="form-control counter text-center numeric jumlah_p" style="font-size: 17px;" data-min="1" value="1">
                                        <div class="input-group-append">
                                            <button type="button" class="btn-add btn btn-success btn-spin tambah" aksi="tambah">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <label for="subtotal" class="col-sm-4 col-form-label">Subtotal</label>
                                <div class="col-sm-8 bg-warning text-white" style="border-radius: 10px;">
                                    <div class="row font-18" style="padding: 3px;">
                                        <div class="col-md-3 text-left">Rp. </div>
                                        <div class="col-md-9 text-right font-weight-bold font-20" id="t_subtotal">0</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="diskon" class="col-sm-4 col-form-label">Diskon</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <select name="j_diskon" id="j_diskon" class="custom-select" style="height: 40px; font-size: 14px;">
                                                <option value="harga">Rp.</option>
                                                <option value="persen">%</option>
                                            </select>
                                        </div>
                                        <input type="hidden" name="jenis" id="jenis" value="harga">
                                        <input style="font-size: 17px;" class="form-control text-right numeric number_separator" type="text" id="diskon" name="diskon" placeholder="0">
                                        <input type="hidden" id="nilai_diskon" name="nilai_diskon">
                                    </div>
                                </div>
                            </div>

                            <div class="progress" style="height: 3px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 100%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>

                            <div class="form-group row mt-3">
                                <label for="example-text-input" class="col-sm-4">Total</label>
                                <div class="col-sm-8 text-right bg-primary text-white" style="border-radius: 10px;">
                                    <div class="row font-18" style="padding: 3px;">
                                        <div class="col-md-3 text-left">Rp. </div>
                                        <div class="col-md-9 text-right font-weight-bold font-20" id="t_total">0</div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="tunai" class="col-sm-4 col-form-label">Tunai</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" style="width: 70px; font-size: 17px; background-color: white;">Rp. </span>
                                        </div>
                                        <input style="font-size: 17px;" class="form-control text-right numeric number_separator" type="text" name="tunai" id="tunai" placeholder="0">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-4">Kembali</label>
                                <div class="col-sm-8 text-right bg-danger text-white" style="border-radius: 10px;">
                                    <div class="row font-18" style="padding: 3px;">
                                        <div class="col-md-3 text-left">Rp. </div>
                                        <div class="col-md-9 text-right font-weight-bold font-20" id="t_kembali">0</div>
                                    </div>
                                </div>
                            </div> 
                            <div class="form-group row">
                                <button type="button" class="btn btn-lg btn-outline-primary btn-block mt-3 shadow" id="btn_transaksi" disabled><i class="fas fa-angle-double-right mr-2"></i>BAYAR<i class="fas fa-angle-double-left ml-2"></i></button>
                            </div> 
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

        harga();

        function separator(kalimat) {
            return kalimat.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        function harga() {

            var t_harga     = $('#t_harga').text().split('.').join('');
            var t_jml       = $('.jumlah_p').val();
            var t_diskon    = $('#diskon').val().split('.').join('');
            var tot_sb      = t_harga * t_jml;
            var tot         = tot_sb - t_diskon;

            $('#t_subtotal').text(separator(tot_sb)).fadeOut(50).fadeIn(50);
            $('#t_total').text(separator(tot)).fadeOut(50).fadeIn(50);

            var total   = $('#t_total').text().split('.').join('');
            var tunai   = $('#tunai').val().split('.').join('');
            var kembali = tunai - total;

            $('#t_kembali').text(separator(kembali));

            if (kembali < 0) {
                $('#btn_transaksi').attr('disabled', true);
                $('#btn_transaksi').css({"cursor": "default"});
            } else {
                $('#btn_transaksi').attr('disabled', false);
                $('#btn_transaksi').css({"cursor": "pointer"});
            }
            
        }

        // 03-11-2020
        $('.btn-spin').on('click', function () {
            
            var aksi        = $(this).attr('aksi');
            var harga       = $('#t_harga').text().split('.').join('');
            var diskon      = $('#diskon').val().split('.').join('');
            var jml         = $('.jumlah_p').val();
            var isi         = $('#jenis').val();

            if (aksi == 'kurang') {
                jml = jml - 1;
            } else {
                jml = parseInt(jml) + parseInt(1);
            }

            if (jml == 1) {
                $('.kurang').attr('disabled', true);
            } else {
                $('.kurang').attr('disabled', false);
            }

            var tot_sb  = harga * jml;

            var rp_diskon = 0;
            if (isi == 'persen') {
                rp_diskon = (diskon * tot_sb) / 100;
            } else {
                rp_diskon = diskon;
            }

            var tot     = tot_sb - rp_diskon;

            $('#t_subtotal').text(separator(tot_sb)).fadeOut(50).fadeIn(50);
            $('#t_total').text(separator(tot)).fadeOut(50).fadeIn(50);

            var total   = $('#t_total').text().split('.').join('');
            var tunai   = $('#tunai').val().split('.').join('');
            var kembali = tunai - total;

            $('#t_kembali').text(separator(kembali)).fadeOut(50).fadeIn(50);

            if (kembali < 0) {
                $('#btn_transaksi').attr('disabled', true);
                $('#btn_transaksi').css({"cursor": "default"});
            } else {
                $('#btn_transaksi').attr('disabled', false);
                $('#btn_transaksi').css({"cursor": "pointer"});
            }
            
        })

        // 03-11-2020
        $('#j_diskon').on('change', function () {

            var isi         = $(this).val();
            var subtotal    = $('#t_subtotal').text().split('.').join('');
            
            $('#jenis').val(isi);

            if (isi == 'persen') {
                $('#diskon').val('');
                $('#diskon').removeClass('number_separator');
            } else {
                $('#diskon').val('');
                $('#diskon').removeClass('number_separator').addClass('number_separator');
            }

            $('#t_total').text(separator(subtotal)).fadeOut(50).fadeIn(50);

            var total   = $('#t_total').text().split('.').join('');
            var tunai   = $('#tunai').val().split('.').join('');
            var kembali = tunai - total;

            $('#t_kembali').text(separator(kembali)).fadeOut(50).fadeIn(50);

            if (kembali < 0) {
                $('#btn_transaksi').attr('disabled', true);
                $('#btn_transaksi').css({"cursor": "default"});
            } else {
                $('#btn_transaksi').attr('disabled', false);
                $('#btn_transaksi').css({"cursor": "pointer"});
            }
            
        })

        // 03-11-2020
        $('#diskon').on('keyup', function () {
            
            var isi         = $('#jenis').val();
            var persen      = 100;
            var value       = $(this).val().split('.').join('');
            var subtotal    = $('#t_subtotal').text().split('.').join('');

            if (isi == 'persen') {
                $('#diskon').val(Math.max(Math.min(value, persen), -persen));
            }

            var rp_diskon = 0;
            if (isi == 'persen') {
                rp_diskon = (value * subtotal) / 100;
            } else {
                rp_diskon = value;
            }

            $('#nilai_diskon').val(rp_diskon);

            var tot = subtotal - rp_diskon;

            if (tot < 0) {
                tot = 0;
            }

            $('#t_total').text(separator(tot)).fadeOut(50).fadeIn(50);

            var total   = $('#t_total').text().split('.').join('');
            var tunai   = $('#tunai').val().split('.').join('');
            var kembali = tunai - total;

            $('#t_kembali').text(separator(kembali)).fadeOut(50).fadeIn(50);

            if (kembali < 0) {
                $('#btn_transaksi').attr('disabled', true);
                $('#btn_transaksi').css({"cursor": "default"});
            } else {
                if (tunai == '') {
                    $('#btn_transaksi').attr('disabled', true);
                    $('#btn_transaksi').css({"cursor": "default"});
                } else {
                    $('#btn_transaksi').attr('disabled', false);
                    $('#btn_transaksi').css({"cursor": "pointer"}); 
                }
            }

        })

        // 03-11-2020
        $('#tunai').on('keyup', function () {

            var total   = $('#t_total').text().split('.').join('');
            var tunai   = $('#tunai').val().split('.').join('');
            var kembali = tunai - total;

            $('#t_kembali').text(separator(kembali)).fadeOut(50).fadeIn(50);

            if (kembali < 0) {
                $('#btn_transaksi').attr('disabled', true);
                $('#btn_transaksi').css({"cursor": "default"});
            } else {
                $('#btn_transaksi').attr('disabled', false);
                $('#btn_transaksi').css({"cursor": "pointer"});
            }
            
        })

        // 03-11-2020
        $('#btn_transaksi').on('click', function () {

            var total       = $('#t_total').text().split('.').join('');
            var tunai       = $('#tunai').val().split('.').join('');
            var diskon      = $('#nilai_diskon').val().split('.').join('');
            var jml_p       = $('.jumlah_p').val();
            var jml_awal    = $('.jml_awal').text();
            var harga       = $('#t_harga').text();
            var kode_tr     = $('#kode_tr').val();
            var judul_set   = $('#judul_set').val();
            var judul_hb    = $('#judul_hb').val();

            $.ajax({
                url     : "transaksi/simpan_transaksi",
                type    : "POST",
                data    : {total:total, tunai:tunai, diskon:diskon, jml_p:jml_p, harga:harga, kode_tr:kode_tr, judul_set:judul_set, judul_hb:judul_hb},
                dataType: "JSON",
                success : function (data) {

                    $('.jml_awal').text(parseInt(jml_awal) + parseInt(jml_p)).fadeOut(50).fadeIn(50);

                    $('#form-pengunjung').trigger('reset');

                    $('#t_subtotal').text(separator(harga));
                    $('#t_total').text(separator(harga));
                    $('#t_kembali').text("-"+separator(harga));

                    $('#tunai').val('');

                    $('#btn_transaksi').attr('disabled', true);
                    $('#btn_transaksi').css({"cursor": "default"});

                    $.ajax({
                        url     : "transaksi/ambil_kode_tr",
                        dataType: "JSON",
                        success : function (data) {

                            $('#kode_tr').val(data.kode_tr);

                        },
                        error       : function(xhr, status, error) {
                            swal({
                                title               : "Gagal",
                                text                : 'Gagal memproses data',
                                buttonsStyling      : false,
                                confirmButtonClass  : "btn btn-success",
                                type                : 'error',
                                showConfirmButton   : false,
                                timer               : 1000
                            });      
                        }
                    })

                },
                error       : function(xhr, status, error) {  

                    
                }
            })
    
            return false;
            
        })

        function kode_tr() {
            $.ajax({
                url     : "transaksi/ambil_kode_tr",
                dataType: "JSON",
                success : function (data) {

                    $('#kode_tr').val(data.kode_tr);

                },
                error       : function(xhr, status, error) {
                    swal({
                        title               : "Gagal",
                        text                : 'Gagal memproses data',
                        buttonsStyling      : false,
                        confirmButtonClass  : "btn btn-success",
                        type                : 'error',
                        showConfirmButton   : false,
                        timer               : 1000
                    });      
                }
            })
        }

        // 04-11-2020
        $('.jumlah_p').on('keyup', function () {
            
            var harga       = $('#t_harga').text().split('.').join('');
            var diskon      = $('#diskon').val().split('.').join('');
            var jml         = $('.jumlah_p').val();
            var isi         = $('#jenis').val();

            var tot_sb  = harga * jml;

            var rp_diskon = 0;
            if (isi == 'persen') {
                rp_diskon = (diskon * tot_sb) / 100;
            } else {
                rp_diskon = diskon;
            }

            if (jml == 1) {
                $('.kurang').attr('disabled', true);
            } else {
                $('.kurang').attr('disabled', false);
            }

            var tot     = tot_sb - rp_diskon;

            $('#t_subtotal').text(separator(tot_sb)).fadeOut(50).fadeIn(50);
            $('#t_total').text(separator(tot)).fadeOut(50).fadeIn(50);

            var total   = $('#t_total').text().split('.').join('');
            var tunai   = $('#tunai').val().split('.').join('');
            var kembali = tunai - total;

            $('#t_kembali').text(separator(kembali)).fadeOut(50).fadeIn(50);

            if (kembali < 0) {
                $('#btn_transaksi').attr('disabled', true);
                $('#btn_transaksi').css({"cursor": "default"});
            } else {
                if (jml == 0 || jml == '') {
                    $('#btn_transaksi').attr('disabled', true);
                    $('#btn_transaksi').css({"cursor": "default"});
                } else {
                    $('#btn_transaksi').attr('disabled', false);
                    $('#btn_transaksi').css({"cursor": "pointer"});
                }
                
            }

        })
        
    })
</script>