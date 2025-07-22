<div class="app-content-header"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-3">Akun Baru</h3>
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
                            <div class="mb-3"> <label for="name" class="form-label">Nama Lengkap</label> <input type="text" class="form-control" id="name" aria-describedby="emailHelp" name="name" required>
                            </div>
                            <div class="mb-3"> <label for="username" class="form-label">NIDN / NIP</label> <input type="text" class="form-control" id="username" aria-describedby="emailHelp" name="username" required>
                            </div>
                            <div class="mb-3"> <label for="seri_karpeg" class="form-label">Seri Karpeg</label> <input type="text" class="form-control" id="seri_karpeg" aria-describedby="emailHelp" name="seri_karpeg" required>
                            </div>
                            <div class="mb-3"> <label for="tempat_tanggal_lahir" class="form-label">Tempat / Tanggal Lahir</label> <input type="text" class="form-control" id="tempat_tanggal_lahir" aria-describedby="emailHelp" name="tempat_tanggal_lahir" required>
                            </div>
                            <div class="mb-3" hidden> <label for="kredit_pendidikan_terhitung" class="form-label">Kredit Pendidikan Terhitung</label> <input type="text" class="form-control" id="kredit_pendidikan_terhitung" aria-describedby="emailHelp" name="kredit_pendidikan_terhitung" value="0" required>
                            </div>
                            <div class="mb-3"> <label for="pangkat" class="form-label">Pangkat / Golongan Ruang</label> 
                                <select class="form-select" id="pangkat" name="pangkat" required>
                                    <option value="">Pilih Pangkat / Golongan Ruang</option>
                                    <?php foreach($jabatan as $item): ?>
                                    <option value="<?= $item['name'] ?>"><?= $item['name'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="mb-3"> <label for="jurusan" class="form-label">Jurusan</label> 
                                <select class="form-select" id="jurusan" name="jurusan">
                                    <?php foreach($jurusan as $j): ?>
                                        <option value="<?= $j['id'] ?>"><?= $j['name'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="mb-3"> <label for="fakultas" class="form-label">Fakultas</label> <input type="text" class="form-control" id="fakultas" aria-describedby="emailHelp" name="fakultas" required>
                            </div>
                            <div class="mb-3"> <label for="universitas" class="form-label">Universitas</label> <input type="text" class="form-control" id="universitas" aria-describedby="emailHelp" name="universitas" required>
                            </div>
                            <div class="mb-3"> <label for="role" class="form-label">Role Akun</label> 
                                <select class="form-select" id="role" name="role">
                                    <option value="dosen">Dosen</option>
                                    <option value="staf">Staf</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                        </div> <!--end::Body--> <!--begin::Footer-->
                        <div class="card-footer"> <button type="submit" class="btn btn-primary btn-sm" style="background:#30645b;border-color:#30645b;">Simpan</button>                            <a type="submit" class="btn btn-secondary btn-sm" href="/admin/users">Kembali</a> </div> <!--end::Footer-->
                    </form> <!--end::Form-->
                </div> <!--end::Quick Example-->
            </div> <!-- /.Start col -->
        </div> <!-- /.row (main row) -->
    </div> <!--end::Container-->
</div> <!--end::App Content-->