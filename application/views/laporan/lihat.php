<!-- Page-Title -->
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h4 class="page-title"><?= $title ?></h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Taman Batu</a></li>
                <li class="breadcrumb-item active"><?= $title ?></li>
            </ol>
        </div>
    </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="card shadow">
      <div class="card-header bg-primary">
        <h5 class="text-white mt-0 mb-0">Filter Data</h5>
      </div>
      <form action="<?php echo base_url('Laporan/download_file') ?>" method="POST" id="form_report" class="form-control-line" autocomplete="off">
        <input type="hidden" id="aksi" name="jns">
        <div class="card-body">
            <div class="d-flex justify-content-center">
                <div class="col-md-3">

                    <div class='input-group mt-1'>
                        <input type='text' name="tgl_awal" id="tgl_awal" class="form-control datepicker text-center" placeholder="Awal Periode" value="<?= date("d-m-Y", now('Asia/Jakarta')) ?>" readonly>
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <span class="ti-calendar"></span>
                            </span>
                        </div>
                    </div>

                </div>
                <div class="col-md-3">

                    <div class='input-group mt-1'>
                        <input type='text' name="tgl_akhir" id="tgl_akhir" class="form-control datepicker text-center" placeholder="Akhir Periode" value="<?= date("d-m-Y", now('Asia/Jakarta')) ?>" readonly>
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <span class="ti-calendar"></span>
                            </span>
                        </div>
                    </div>

                </div>
                
            </div>
        </div>
        <div class="card-footer">
          <div class="row">
            <div class="col-md-6">
              <button class="btn btn-primary mr-2" type="submit" name="export" data="pdf"><i class="far fa-file-pdf mr-2"></i>Download PDF</button>
              <button class="btn btn-success" type="submit" name="export" data="excel"><i class="far fa-file-excel mr-2"></i>Download Excel</button>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
              <button type="button" id="btn-filter" class="btn btn-success mr-2"><i class="fas fa-check mr-2"></i>Tampilkan</button>
              <button type="button" id="btn-reset" tgl="<?= date('d-m-Y', now('Asia/Jakarta')) ?>" class="btn btn-danger"><i class="fas fa-ban mr-2"></i>Reset</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="row d-flex justify-content-center">
    <div class="col-md-4">
        <div class="card shadow">
            <div class="card-heading p-3 text-center">
                <div>
                    <h4 class="font-20 mt-1">Transaksi</h4>
                </div>
                <h3 class="text-center t_transaksi"></h3>
                <div class="progress mt-1" style="height: 4px;">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow">
            <div class="card-heading p-3 text-center">
                <div>
                    <h4 class="font-20 mt-1">Pengunjung</h4>
                </div>
                <h3 class="text-center t_pengunjung"></h3>
                <div class="progress mt-1" style="height: 4px;">
                    <div class="progress-bar bg-primary" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow">
            <div class="card-heading p-3 text-center">
                <div>
                    <h4 class="font-20 mt-1">Pemasukan</h4>
                </div>
                <h3 class="text-center t_pendapatan"></h3>
                <div class="progress mt-1" style="height: 4px;">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-body table-responsive">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-bordered table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;"  id="tabel_report" width="100%" cellspacing="0">
                      <thead class="thead-light text-center">
                          <tr>
                              <th width="5%">No</th>
                              <th>Tanggal Transaksi</th>
                              <th>Kode Transaksi</th>
                              <th>Jumlah Pengunjung</th>
                              <th>Total Transaksi</th>
                              <th>Detail</th>
                          </tr>
                      </thead>
                      <tbody>
                              
                      </tbody>
                  </table>
                </div>
              </div>
              
            </div>
        </div>
    </div>
</div>

<div id="modal_detail_transaksi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content f_detail_transaksi">
            <div class="modal-header bg-primary">
                <h4 class="mt-0 mb-0 text-white" id="my-modal-title" style="color: black;"><i class="mdi mdi-information-outline mr-2"></i>Detail Transaksi</h4>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 table-responsive">
                        <table class="table  table-borderless table-sm">
                            <tbody>
                            <tr>
                                <th scope="row" width="35%">Tanggal</th>
                                <td class="font-weight-bold" width="5%">:</td>
                                <td class="text-right font-weight-bold t_tanggal"></td>
                            </tr>
                            <tr>
                                <th scope="row">Kode Transaksi</th>
                                <td class="font-weight-bold" width="5%">:</td>
                                <td class="text-right font-weight-bold t_kode_tr"></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12 mt-2 mb-2">
                        <div class="progress" style="height: 5px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 100%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="col-md-12 table-responsive mt-2">
                        <table class="table  table-borderless table-sm">
                            <tbody>
                            <tr>
                                <th scope="row" width="35%">Harga</th>
                                <td class="font-weight-bold">: Rp. </td>
                                <td class="text-right font-weight-bold t_harga"></td>
                            </tr>
                            <tr>
                                <th scope="row">Jumlah Pengunjung</th>
                                <td class="font-weight-bold">:</td>
                                <td class="text-right font-weight-bold t_jml_p"></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12 mt-2">
                        <div class="progress" style="height: 5px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 100%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="col-md-12 table-responsive mt-3 d-flex justify-content-center">
                        <table class="table  table-borderless table-sm">
                            <tbody>
                            <tr>
                                <th scope="row" width="35%">Total Diskon</th>
                                <td class="font-weight-bold">: Rp.</td>
                                <td class="text-right font-weight-bold t_diskon"></td>
                            </tr>
                            <tr>
                                <th scope="row">Total</th>
                                <td class="font-weight-bold">: Rp.</td>
                                <td class="text-right font-weight-bold t_total"></td>
                            </tr>
                            <tr>
                                <th scope="row">Total Bayar</th>
                                <td class="font-weight-bold">: Rp.</td>
                                <td class="text-right font-weight-bold t_tunai"></td>
                            </tr>
                            <tr>
                                <th scope="row">Kembali</th>
                                <td class="font-weight-bold">: Rp.</td>
                                <td class="text-right font-weight-bold t_kembali"></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-center">
                            <button type="button" class="btn btn-danger mr-3" data-dismiss="modal"><i class="mdi mdi-close-circle mr-2"></i><span>Close</span></button>
                            <button type="button" class="btn btn-primary mr-2 cetak" tgl="" kode_tr="" jml_p="" harga="" judul_set="<?= $judul_set ?>" judul_hb=""><i class="mdi mdi-printer mr-2"></i><span>Cetak</span></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<input type="hidden" id="tgl_t" value="<?= date("d-m-Y", now('Asia/Jakarta')) ?>">

<script>
  $(document).ready(function () {

    total();

    // 02-11-2020

    $('button[name="export"]').on('click', function () {
        var jns = $(this).attr('data');

        $('#aksi').val(jns);
    })

    // 02-11-2020

    function separator(kalimat) {
        return kalimat.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function total() {
        var awal  = $('#tgl_awal').val();
        var akhir = $('#tgl_akhir').val();

        $.ajax({
            url     : "Laporan/ambil_total",
            method  : "POST",
            data    : {tgl_awal:awal, tgl_akhir:akhir},
            dataType: "JSON",
            success : function (data) {
            
                $('.t_pendapatan').text("Rp. "+separator(data.pendapatan));
                $('.t_transaksi').text(data.transaksi);
                $('.t_pengunjung').text(data.pengunjung);
            
            }
        })

    }

    // 06-11-2020
    function tgl() {
        var tgll   = $('#tgl_t').val();
        
        var myDateVal = moment(tgll).format('DD-MM-YYYY');
        $('#tgl_awal').datepicker('setDate', myDateVal);
        $('#tgl_akhir').datepicker('setDate', myDateVal);
    }

    // 02-11-2020

    var tabel_report = $('#tabel_report').DataTable({
        "processing"        : true,
        "serverSide"        : true,
        "order"             : [],
        "ajax"              : {
            "url"   : "Laporan/tampil_report",
            "type"  : "POST",
            "data"  : function (data) {

                data.tgl_awal   = $('#tgl_awal').val();
                data.tgl_akhir  = $('#tgl_akhir').val();
            }
        },
        "columnDefs"        : [{
            "targets"   : [0,5],
            "orderable" : false
        }, {
            'targets'   : [0,1,2,3,5],
            'className' : 'text-center',
        }]
    })

    // 02-11-2020
    $('#btn-filter').on('click', function () {

      tabel_report.ajax.reload(null, false);

      var awal  = $('#tgl_awal').val();
      var akhir = $('#tgl_akhir').val();

      console.log(awal)

      $.ajax({
        url     : "Laporan/ambil_total",
        method  : "POST",
        data    : {tgl_awal:awal, tgl_akhir:akhir},
        dataType: "JSON",
        success : function (data) {

            $('.t_pendapatan').text("Rp. "+separator(data.pendapatan));
            $('.t_transaksi').text(data.transaksi);
            $('.t_pengunjung').text(data.pengunjung);
          
        }
      })

      return false;
      
    })

    $('#btn-reset').on('click', function () {

        var tgl   = $('#btn-reset').attr('tgl');
        
        $('#tgl_awal').datepicker('setDate', tgl);
        $('#tgl_akhir').datepicker('setDate', tgl);

        var awal  = $('#tgl_awal').val();
        var akhir = $('#tgl_akhir').val();

        $.ajax({
            url     : "Laporan/ambil_total",
            method  : "POST",
            data    : {tgl_awal:awal, tgl_akhir:akhir},
            dataType: "JSON",
            success : function (data) {

                console.log(data)
            
                $('.t_pendapatan').text("Rp. "+separator(data.pendapatan));
                $('.t_transaksi').text(data.transaksi);
                $('.t_pengunjung').text(data.pengunjung);

                tabel_report.ajax.reload(null, false);
            
            }
        })

        return false;
      
    })

    $('#tabel_report').on('click', '.detail-report', function () {
          
        var id          = $(this).data('id');
        var tgl         = $(this).attr('tgl');
        var kode_tr     = $(this).attr('kode_tr');
        var jml_p       = $(this).attr('jml_p');
        var harga       = $(this).attr('harga');
        var diskon      = $(this).attr('diskon');
        var tunai       = $(this).attr('tunai');
        var total       = $(this).attr('total');
        var kembali     = $(this).attr('kembali');
        var judul_hb    = $(this).attr('judul_hb');

        $('#modal_detail_transaksi').modal('show');

        $('.t_tanggal').text(tgl);
        $('.t_kode_tr').text(kode_tr);
        $('.t_harga').text(separator(harga));
        $('.t_jml_p').text(jml_p);
        $('.t_diskon').text(separator(diskon));
        $('.t_total').text(separator(total));
        $('.t_tunai').text(separator(tunai));
        $('.t_kembali').text(separator(kembali));

        $('.cetak').attr('tgl', tgl);
        $('.cetak').attr('kode_tr', kode_tr);
        $('.cetak').attr('jml_p', jml_p);
        $('.cetak').attr('harga', harga);
        $('.cetak').attr('judul_hb', judul_hb);

        // var url = "<?= base_url('Laporan/cetak/') ?>"+id;

        // $('.cetak').attr('href', url);
    })

    // 06-11-2020
    $('.cetak').on('click', function () {

        var tgl         = $(this).attr('tgl');
        var kode_tr     = $(this).attr('kode_tr');
        var jml_p       = $(this).attr('jml_p');
        var harga       = $(this).attr('harga');
        var judul_hb    = $(this).attr('judul_hb');
        var judul_set   = $(this).attr('judul_set');

        $.ajax({
                url     : "laporan/cetak_transaksi",
                type    : "POST",
                data    : {
                    tgl         :tgl, 
                    jml_p       :jml_p, 
                    harga       :harga, 
                    kode_tr     :kode_tr, 
                    judul_set   :judul_set, 
                    judul_hb    :judul_hb
                },
                dataType: "JSON",
                success : function (data) {

                },
                error       : function(xhr, status, error) {  

                    
                }
            })
    
            return false;
        
    })
    
  })
</script>