<div class="app-content-header"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-3">Edit Pengajaran</h3>
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
                        <div class="card-title">Isi data pengajaran</div>
                    </div> <!--end::Header--> <!--begin::Form-->
                    <form method="post" enctype="multipart/form-data" id="formPengabdian">
                        <div class="card-body">
                            <div class="mb-3">
                              <label for="kredit_pengajaran_mata_kuliah_id" class="form-label">Mata Kuliah</label>
                              <select name="kredit_pengajaran_mata_kuliah_id" id="kredit_pengajaran_mata_kuliah_id" class="form-select" required disabled>
                                <option value="">Pilih Mata Kuliah</option>
                                <?php foreach($kredit_pengajaran_mata_kuliah as $k): ?>
                                <option value="<?= $k['id'] ?>" <?= $k['id'] === $kredit['kredit_pengajaran_mata_kuliah_id'] ? 'selected' : '' ?>><?= $k['name'] ?> ( <?= $k['credit'] ?> point/sks )</option>
                                <?php endforeach ?>
                              </select>
                            </div>
                            <div class="mb-3">
                                <label for="tahun_ajaran" class="form-label">Tahun Ajaran</label>
                                <input type="number" class="form-control" id="tahun_ajaran" name="tahun_ajaran" required value="<?= $kredit['tahun_ajaran'] ?>" disabled>
                            </div>

                            <div class="mb-3">
                                <label for="type" class="form-label">Tipe</label>
                                <select class="form-select" id="type" name="type" required disabled>
                                    <option value="">Pilih Tipe</option>
                                    <option value="10 SKS Pertama" <?= $kredit['type'] === '10 SKS Pertama' ? 'selected' : '' ?>>10 SKS Pertama</option>
                                    <option value="2 SKS Berikutnya" <?= $kredit['type'] === '2 SKS Berikutnya' ? 'selected' : '' ?>>2 SKS Berikutnya</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="semester" class="form-label">Semester</label>
                                <select class="form-select" id="semester" name="semester" required disabled>
                                    <option value="">Pilih Semester</option>
                                    <option value="gasal" <?= $kredit['semester'] === 'gasal' ? 'selected' : '' ?>>Gasal</option>
                                    <option value="genap" <?= $kredit['semester'] === 'genap' ? 'selected' : '' ?>>Genap</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="kelompok" class="form-label">Kelompok</label>
                                <select class="form-select" id="kelompok" name="kelompok" required disabled>
                                    <option value="">Pilih Tipe Kelompok</option>
                                    <option value="Tim" <?= $kredit['kelompok'] === 'Tim' ? 'selected' : '' ?>>Tim</option>
                                    <option value="Mandiri" <?= $kredit['kelompok'] === 'Mandiri' ? 'selected' : '' ?>>Mandiri</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="sks" class="form-label">Jumlah SKS</label>
                                <input type="number" class="form-control" id="sks" name="sks" required value="<?= $kredit['sks'] ?>" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="archive" class="form-label">Keterangan/Bukti Berkas ( Docx, Pdf, Png, Jpeg )</label>
                                <div>
                                    <button type="button" class="btn btn-primary btn-sm" onclick="window.open('<?= url('/') ?>/uploads/<?= $kredit['archives'][0]['path'] ?>')"><i class="bi bi-eye"></i> Lihat Berkas</button>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">status</label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="">Pilih Status</option>
                                    <option value="pending" <?= $kredit['status'] === 'pending' ? 'selected' : '' ?>>Pending</option>
                                    <option value="approved" <?= $kredit['status'] === 'approved' ? 'selected' : '' ?>>Approved</option>
                                    <option value="rejected" <?= $kredit['status'] === 'rejected' ? 'selected' : '' ?>>Rejected</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <textarea class="form-control" id="keterangan" name="keterangan"><?= $kredit['keterangan'] ?></textarea>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="/staf/pengajuan-pengajaran" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div> <!--end::Quick Example-->
            </div> <!-- /.Start col -->
        </div> <!-- /.row (main row) -->
    </div> <!--end::Container-->
</div> <!--end::App Content-->