<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Update Peralatan Kebersihan</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url('peralatan')?>">
                    <i class="fas fa-arrow-left">
                    </i> Daftar Peralatan Kebersihan</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </nav>
        <div class="card shadow mb-4">
            <div class="card-body">
                <form class="user" method="post" action="<?= base_url('peralatan/edit/'.$peralatan->uuid);?>">
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label class="form-label font-weight-bold">Nama Peralatan</label>
                            <input type="text" name="peralatan" class="form-control <?= form_error('peralatan') ? 'invalid' : '' ?> " value="<?= $peralatan->peralatan; ?>">
                            <div class="invalid-feedback <?= !empty(form_error('peralatan')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('peralatan') ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-md btn-success mr-2">
                                <i class="fa fa-save"></i> Simpan
                            </button>
                            <a href="<?= base_url('peralatan')?>" class="btn btn-md btn-danger">
                                <i class="fa fa-times"></i> Batal
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style type="text/css">
    .breadcrumb{
        background-color: #2E86C1;
    }
</style>