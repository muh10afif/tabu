<!-- Page-Title -->
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h4 class="page-title"><?= $title ?></h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Taman Batu</a></li>
                <li class="breadcrumb-item">Potongan</li>
                <li class="breadcrumb-item active"><?= $title ?></li>
            </ol>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header bg-primary">
                <button class="btn btn-light" id="tambah_kategori" data-toggle="modal" data-target="#modal_kategori"><i class="ti-plus mr-2"></i>Tambah Data</button>
                <!-- <h5 id="judul" class="text-white mb-0 mt-1">Master Kategori</h5> -->
            </div>
            <div class="card-body table-responsive">

                <table class="table table-bordered table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="tabel_kategori" width="100%" cellspacing="0">
                    <thead class="thead-light text-center">
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%">Nama Kupon</th>
                            <th width="20%">Kode Kupon</th>
                            <th width="20%">Mulai Berlaku</th>
                            <th width="20%">Tanggal Berakhir</th>
                            <th width="20%">Status</th>
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