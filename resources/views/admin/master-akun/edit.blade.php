<div class="app-content-header"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-3">Edit Akun</h3>
            </div>
        </div> <!--end::Row-->
    </div> <!--end::Container-->
</div> <!--end::App Content Header--> <!--begin::App Content-->
<div class="app-content"> <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Row-->
        <div class="row"> <!-- Start col -->
            <div class="col-lg-12 col-12 connectedSortable">
                <div class="card card-primary card-outline mb-4" style="box-shadow:none;border-top: 3px solid #ff5733;"> <!--begin::Header-->
                    <div class="card-header">
                        <div class="card-title">Isi data akun</div>
                    </div> <!--end::Header--> <!--begin::Form-->
                    <form method="post" enctype="multipart/form-data"> <!--begin::Body-->
                        <div class="card-body">
                            <div class="mb-3"> <label for="name" class="form-label">Nama Lengkap</label> <input type="text" class="form-control" id="name" aria-describedby="emailHelp" name="name" required value="<?= $akun['name'] ?>">
                            </div>
                            <div class="mb-3"> <label for="username" class="form-label">NIDN / NIP</label> <input type="text" class="form-control" id="username" aria-describedby="emailHelp" name="username" required value="<?= $akun['username'] ?>">
                            </div>
                            <div class="mb-3"> <label for="seri_karpeg" class="form-label">Seri Karpeg</label> <input type="text" class="form-control" id="seri_karpeg" aria-describedby="emailHelp" name="seri_karpeg" required value="<?= $akun['seri_karpeg'] ?>">
                            </div>
                            <div class="mb-3"> <label for="tempat_tanggal_lahir" class="form-label">Tempat / Tanggal Lahir</label> <input type="text" class="form-control" id="tempat_tanggal_lahir" aria-describedby="emailHelp" name="tempat_tanggal_lahir" required value="<?= $akun['tempat_tanggal_lahir'] ?>">
                            </div>
                            <div class="mb-3"> <label for="pangkat" class="form-label">Pangkat / Golongan Ruang</label> 
                                <select class="form-select" id="pangkat" name="pangkat" required>
                                    <option value="">Pilih Pangkat / Golongan Ruang</option>
                                    <?php foreach($jabatan as $item): ?>
                                    <option value="<?= $item['name'] ?>" <?= $akun['pangkat'] === $item['name'] ? 'selected' : '' ?>><?= $item['name'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="mb-3"> <label for="jurusan" class="form-label">Jurusan</label> 
                                <select class="form-select" id="jurusan" name="jurusan">
                                    <?php foreach($jurusan as $j): ?>
                                        <option value="<?= $j['id'] ?>" <?= $j['id'] === $akun['jurusan']['id'] ? 'selected' : '' ?>><?= $j['name'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="mb-3"> <label for="fakultas" class="form-label">Fakultas</label> <input type="text" class="form-control" id="fakultas" aria-describedby="emailHelp" name="fakultas" required value="<?= $akun['fakultas'] ?>">
                            </div>
                            <div class="mb-3"> <label for="universitas" class="form-label">Universitas</label> <input type="text" class="form-control" id="universitas" aria-describedby="emailHelp" name="universitas" required value="<?= $akun['universitas'] ?>">
                            </div>
                            <div class="mb-3"> <label for="role" class="form-label">Role Akun</label> 
                                <select class="form-select" id="role" name="role">
                                    <option value="dosen" <?= $akun['role'] === 'dosen' ? 'selected' : '' ?>>Dosen</option>
                                    <option value="staf" <?= $akun['role'] === 'staf' ? 'selected' : '' ?>>Staf</option>
                                    <option value="admin" <?= $akun['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                                </select>
                            </div>
                            <div class="mb-3"> <label for="new_password" class="form-label">Password Baru</label> <input type="text" class="form-control" id="new_password" aria-describedby="emailHelp" name="new_password">
                            </div>
                        </div> <!--end::Body--> <!--begin::Footer-->
                        <div class="card-footer"> <button type="submit" class="btn btn-primary btn-sm" style="background:#30645b;border-color:#30645b;">Simpan</button>                            <a type="submit" class="btn btn-secondary btn-sm" href="/admin/users">Kembali</a> </div> <!--end::Footer-->
                    </form> <!--end::Form-->
                </div> <!--end::Quick Example-->
            </div> <!-- /.Start col -->
        </div> <!-- /.row (main row) -->
    </div> <!--end::Container-->
</div> <!--end::App Content-->
<script type="text/javascript">
    function salin_link(link) {
        const temp = document.createElement("textarea");
        temp.value = link;
        document.body.appendChild(temp);
        temp.select();
        temp.setSelectionRange(0, 99999);
        document.execCommand("copy");
        document.body.removeChild(temp);
        Swal.fire({
            icon: 'success',
            title: 'Tersalin!',
            text: 'Link berhasil disalin ke clipboard.',
            timer: 2000,
            showConfirmButton: false
        });
    }
</script>