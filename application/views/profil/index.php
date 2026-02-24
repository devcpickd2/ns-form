<div class="container-fluid">
    <?php if($this->session->flashdata('success_msg')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $this->session->flashdata('success_msg') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-body">
                    <div class="text-center mt-4">
                        <h1 class="h3 mb-4 text-gray-800">PROFIL PEGAWAI</h1>
                    </div>
                    <form action="<?= base_url('profil/update'); ?>" method="post" enctype="multipart/form-data">
                        <h5 class="text-muted">Informasi Anda</h5>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Plant</label>
                                <input type="text" class="form-control" value="<?= $pegawai->nama_plant ?>" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Departemen</label>
                                <input type="text" class="form-control" value="<?= $pegawai->nama_departemen ?>" readonly>
                            </div>
                        </div>
                        <hr>
                        <h5 class="text-muted">Update Infromasi Anda</h5>

                        <div class="form-group">
                            <div class="form-group">
                                <label>Foto Profil</label>
                                <div class="profile-pic-wrapper">
                                    <?php if (!empty($pegawai->foto) && file_exists(FCPATH . 'uploads/foto/' . $pegawai->foto)): ?>
                                    <img id="preview-image" 
                                    src="<?= base_url('uploads/foto/' . $pegawai->foto); ?>" 
                                    alt="Foto Profil">
                                <?php else: ?>
                                    <div id="preview-image" class="default-user-icon">
                                        <i class="fa fa-user"></i>
                                    </div>
                                <?php endif; ?>

                                <label class="edit-btn" title="Ganti Foto">
                                    <i class="fa fa-camera"></i>
                                    <input type="file" name="foto" accept="image/*" onchange="previewFoto(this)">
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="nama" class="form-control <?= form_error('nama') ? 'is-invalid' : '' ?>" value="<?= set_value('nama', $pegawai->nama) ?>" required>
                            <div class="invalid-feedback"><?= form_error('nama') ?></div>
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control <?= form_error('email') ? 'is-invalid' : '' ?>" value="<?= set_value('email', $pegawai->email) ?>" required>
                            <div class="invalid-feedback"><?= form_error('email') ?></div>
                        </div>

                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control <?= form_error('username') ? 'is-invalid' : '' ?>" value="<?= set_value('username', $pegawai->username); ?>" required>
                            <div class="invalid-feedback"><?= form_error('username') ?></div>
                        </div>
                        <div class="form-group">
                            <label>Password (kosongkan jika tidak diubah)</label>
                            <div class="input-group">
                                <input type="password" name="password" class="form-control" id="passwordInput">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary toggle-password" type="button" data-target="passwordInput">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Konfirmasi Password</label>
                            <input type="password" name="confirm_password" class="form-control <?= form_error('confirm_password') ? 'is-invalid' : '' ?>">
                            <div class="invalid-feedback">
                                <?= form_error('confirm_password') ?>
                            </div>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<script>
    document.querySelectorAll('.toggle-password').forEach(button => {
        button.addEventListener('click', function () {
            const targetId = this.getAttribute('data-target');
            const input = document.getElementById(targetId);
            const icon = this.querySelector('i');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    });
</script>
<script>
    function previewFoto(input) {
        const file = input.files[0];
        const reader = new FileReader();

        reader.onload = function (e) {
            const preview = document.getElementById('preview-image');

            if (preview.tagName.toLowerCase() === 'img') {
                preview.src = e.target.result;
            } else {
                const newImg = document.createElement('img');
                newImg.id = 'preview-image';
                newImg.src = e.target.result;
                newImg.style.width = '120px';
                newImg.style.height = '120px';
                newImg.style.borderRadius = '50%';
                newImg.style.objectFit = 'cover';
                newImg.style.border = '3px solid #ccc';

                preview.parentNode.replaceChild(newImg, preview);
            }
        }

        if (file) {
            reader.readAsDataURL(file);
        }
    }
</script>

<style>
    .profile-pic-wrapper {
        position: relative;
        width: 120px;
        height: 120px;
        margin-bottom: 10px;
    }

    .profile-pic-wrapper img,
    .default-user-icon {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #ccc;
    }

    .default-user-icon {
        background-color: #eaeaea;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 40px;
        color: #aaa;
    }

    .edit-btn {
        position: absolute;
        bottom: 0;
        right: 0;
        background-color: #007bff;
        color: white;
        border-radius: 50%;
        padding: 6px;
        cursor: pointer;
        font-size: 14px;
        border: 2px solid white;
    }

    .edit-btn input[type="file"] {
        display: none;
    }
</style>
