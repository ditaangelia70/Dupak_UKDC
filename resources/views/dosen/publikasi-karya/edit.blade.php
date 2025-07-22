<div class="app-content-header"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-3">Detail Publikasi</h3>
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
                        <div class="card-title">Isi data publikasi</div>
                    </div> <!--end::Header--> <!--begin::Form-->
                    <form method="post" enctype="multipart/form-data"> <!--begin::Body-->
                        <div class="card-body">
                            <div class="form-sub-title">Menghasilkan Karya Ilmiah sesuai dengan bidangnya</div>
                            <div class="form-sub-input">
                                <input type="checkbox" id="pk_1" aria-describedby="emailHelp" name="pk_1" <?= isset($publikasi['pk_1']) && $publikasi['pk_1'] === true ? 'checked' : '' ?> <?= $publikasi['status'] !== 'pending' ? 'disabled' : '' ?>>
                                <label for="pk_1">Menerjemahkan/menyadur buku ilmiah yang Diterbitkan dan diedarkan secara nasional (Ber-ISBN)</label>
                            </div>
                            <div class="form-sub-input">
                                <input type="checkbox" id="pk_2" aria-describedby="emailHelp" name="pk_2" <?= isset($publikasi['pk_2']) && $publikasi['pk_2'] === true ? 'checked' : '' ?> <?= $publikasi['status'] !== 'pending' ? 'disabled' : '' ?>>
                                <label for="pk_2">Mengedit/menyunting karya ilmiah yang Diterbitkan dan diedarkan secara nasional (Ber-ISBN)</label>
                            </div>
                            <div class="form-sub-title">Hasil penelitian atau hasil pemikiran yang didesiminasikan</div>
                            <div class="form-sub-input">
                                <input type="checkbox" id="pk_3" aria-describedby="emailHelp" name="pk_3" <?= isset($publikasi['pk_3']) && $publikasi['pk_3'] === true ? 'checked' : '' ?> <?= $publikasi['status'] !== 'pending' ? 'disabled' : '' ?>>
                                <label for="pk_3">Hasil penelitian atau hasil pemikiran yang Dipresentasikan secara oral dan dimuat dalam prosiding yang dipublikasikan (ber ISSN/ISBN): Internasional terindeks pada Scimagojr dan Scopus</label>
                            </div>
                            <div class="form-sub-input">
                                <input type="checkbox" id="pk_4" aria-describedby="emailHelp" name="pk_4" <?= isset($publikasi['pk_4']) && $publikasi['pk_4'] === true ? 'checked' : '' ?> <?= $publikasi['status'] !== 'pending' ? 'disabled' : '' ?>>
                                <label for="pk_4">Hasil penelitian atau hasil pemikiran yang Dipresentasikan secara oral dan dimuat dalam prosiding yang dipublikasikan (ber ISSN/ISBN): Internasional terindeks Scopus, IEEE Explore, SPIE</label>
                            </div>
                            <div class="form-sub-input">
                                <input type="checkbox" id="pk_5" aria-describedby="emailHelp" name="pk_5" <?= isset($publikasi['pk_5']) && $publikasi['pk_5'] === true ? 'checked' : '' ?> <?= $publikasi['status'] !== 'pending' ? 'disabled' : '' ?>>
                                <label for="pk_5">Hasil penelitian atau hasil pemikiran yang Dipresentasikan secara oral dan dimuat dalam prosiding yang dipublikasikan (ber ISSN/ISBN): Internasional</label>
                            </div>
                            <div class="form-sub-input">
                                <input type="checkbox" id="pk_6" aria-describedby="emailHelp" name="pk_6" <?= isset($publikasi['pk_6']) && $publikasi['pk_6'] === true ? 'checked' : '' ?> <?= $publikasi['status'] !== 'pending' ? 'disabled' : '' ?>>
                                <label for="pk_6">Hasil penelitian atau hasil pemikiran yang Dipresentasikan secara oral dan dimuat dalam prosiding yang dipublikasikan (ber ISSN/ISBN): Nasional</label>
                            </div>
                            <div class="form-sub-input">
                                <input type="checkbox" id="pk_7" aria-describedby="emailHelp" name="pk_7" <?= isset($publikasi['pk_7']) && $publikasi['pk_7'] === true ? 'checked' : '' ?> <?= $publikasi['status'] !== 'pending' ? 'disabled' : '' ?>>
                                <label for="pk_7">Hasil penelitian atau hasil pemikiran yang disajikan dalam bentuk poster dan dimuat dalam prosiding yang dipublikasikan dalam seminar internasional</label>
                            </div>
                            <div class="form-sub-input">
                                <input type="checkbox" id="pk_8" aria-describedby="emailHelp" name="pk_8" <?= isset($publikasi['pk_8']) && $publikasi['pk_8'] === true ? 'checked' : '' ?> <?= $publikasi['status'] !== 'pending' ? 'disabled' : '' ?>>
                                <label for="pk_8">Hasil penelitian atau hasil pemikiran yang disajikan dalam bentuk poster dan dimuat dalam prosiding yang dipublikasikan dalam seminar nasional</label>
                            </div>
                            <div class="form-sub-input">
                                <input type="checkbox" id="pk_9" aria-describedby="emailHelp" name="pk_9" <?= isset($publikasi['pk_9']) && $publikasi['pk_9'] === true ? 'checked' : '' ?> <?= $publikasi['status'] !== 'pending' ? 'disabled' : '' ?>>
                                <label for="pk_9">Hasil penelitian atau hasil pemikiran yang Disajikan dalam seminar/simposium/lokakarya, tetapi tidak dimuat dalam prosiding yang dipublikasikan: Internasional</label>
                            </div>
                            <div class="form-sub-input">
                                <input type="checkbox" id="pk_10" aria-describedby="emailHelp" name="pk_10" <?= isset($publikasi['pk_10']) && $publikasi['pk_10'] === true ? 'checked' : '' ?> <?= $publikasi['status'] !== 'pending' ? 'disabled' : '' ?>>
                                <label for="pk_10">Hasil penelitian atau hasil pemikiran yang Disajikan dalam seminar/simposium/lokakarya, tetapi tidak dimuat dalam prosiding yang dipublikasikan: nasional</label>
                            </div>
                            <div class="form-sub-input">
                                <input type="checkbox" id="pk_11" aria-describedby="emailHelp" name="pk_11" <?= isset($publikasi['pk_11']) && $publikasi['pk_11'] === true ? 'checked' : '' ?> <?= $publikasi['status'] !== 'pending' ? 'disabled' : '' ?>>
                                <label for="pk_11">Hasil penelitian atau hasil pemikiran yang tidak disajikan dalam seminar/simposium/lokakarya, tetapi dimuat dalam prosiding: Internasional</label>
                            </div>
                            <div class="form-sub-input">
                                <input type="checkbox" id="pk_12" aria-describedby="emailHelp" name="pk_12" <?= isset($publikasi['pk_12']) && $publikasi['pk_12'] === true ? 'checked' : '' ?> <?= $publikasi['status'] !== 'pending' ? 'disabled' : '' ?>>
                                <label for="pk_12">Hasil penelitian atau hasil pemikiran yang tidak disajikan dalam seminar/simposium/lokakarya, tetapi dimuat dalam prosiding: Nasional</label>
                            </div>
                            <div class="form-sub-input">
                                <input type="checkbox" id="pk_13" aria-describedby="emailHelp" name="pk_13" <?= isset($publikasi['pk_13']) && $publikasi['pk_13'] === true ? 'checked' : '' ?> <?= $publikasi['status'] !== 'pending' ? 'disabled' : '' ?>>
                                <label for="pk_13">Hasil penelitian atau hasil pemikiran yang disajikan dalam koran/majalah populer/umum</label>
                            </div>
                            <div class="mb-3">
                                <label for="jenis_publikasi" class="form-label">Jenis *</label>
                                <select class="form-select" name="jenis_publikasi" id="jenis_publikasi" required>
                                    <option value="">Pilih Jenis Publikasi</option>
                                    <?php foreach($kredit_jenis as $kj): ?>
                                    <option value="<?= $kj['id'] ?>" <?= $publikasi['jenis_publikasi'] === $kj['id'] ? 'selected' : '' ?>><?= $kj['name'] ?> ( <?= $kj['credit'] ?> poin ) </option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="kategori_capaian" class="form-label">Kategori Capaian</label>
                                <select class="form-select" name="kategori_capaian" id="kategori_capaian">
                                    <option value="">Pilih Kategori Capaian</option>
                                    <?php foreach($kredit_capaian as $kc): ?>
                                    <option value="<?= $kc['id'] ?>" <?= $publikasi['kategori_capaian'] === $kc['id'] ? 'selected' : '' ?>><?= $kc['name'] ?> ( <?= $kc['credit'] ?> poin ) </option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="aktivitas_litabmas" class="form-label">Aktivitas Litabmas</label>
                                <select class="form-select" name="aktivitas_litabmas" id="aktivitas_litabmas" <?= $publikasi['status'] !== 'pending' ? 'disabled' : '' ?>>
                                    <option value="">Pilih Aktivitas Litabmas</option>
                                    <option value="penelitian_dasar" <?= $publikasi['aktivitas_litabmas'] === 'penelitian_dasar' ? 'selected' : '' ?>>Penelitian Dasar</option>
                                    <option value="penelitian_terapan" <?= $publikasi['aktivitas_litabmas'] === 'penelitian_terapan' ? 'selected' : '' ?>>Penelitian Terapan</option>
                                    <option value="penelitian_pengembangan" <?= $publikasi['aktivitas_litabmas'] === 'penelitian_pengembangan' ? 'selected' : '' ?>>Penelitian Pengembangan</option>
                                    <option value="pdp" <?= $publikasi['aktivitas_litabmas'] === 'pdp' ? 'selected' : '' ?>>Penelitian Dosen Pemula (PDP)</option>
                                    <option value="kompetitif_nasional" <?= $publikasi['aktivitas_litabmas'] === 'kompetitif_nasional' ? 'selected' : '' ?>>Penelitian Kompetitif Nasional</option>
                                    <option value="strategis_nasional" <?= $publikasi['aktivitas_litabmas'] === 'strategis_nasional' ? 'selected' : '' ?>>Penelitian Strategis Nasional</option>
                                    <option value="unggulan_pt" <?= $publikasi['aktivitas_litabmas'] === 'unggulan_pt' ? 'selected' : '' ?>>Penelitian Unggulan Perguruan Tinggi</option>
                                    <option value="kln" <?= $publikasi['aktivitas_litabmas'] === 'kln' ? 'selected' : '' ?>>Kerjasama Luar Negeri & Publikasi Internasional (KLN)</option>
                                    <option value="pkm" <?= $publikasi['aktivitas_litabmas'] === 'pkm' ? 'selected' : '' ?>>Program Kemitraan Masyarakat (PKM)</option>
                                    <option value="pkw" <?= $publikasi['aktivitas_litabmas'] === 'pkw' ? 'selected' : '' ?>>Program Kemitraan Wilayah (PKW)</option>
                                    <option value="kkn_tematik" <?= $publikasi['aktivitas_litabmas'] === 'kkn_tematik' ? 'selected' : '' ?>>KKN Tematik</option>
                                    <option value="hibah_internal" <?= $publikasi['aktivitas_litabmas'] === 'hibah_internal' ? 'selected' : '' ?>>Hibah Internal</option>
                                    <option value="hibah_eksternal" <?= $publikasi['aktivitas_litabmas'] === 'hibah_eksternal' ? 'selected' : '' ?>>Hibah Eksternal</option>
                                </select>
                            </div>


                            <div class="mb-3"> <label for="judul_artikel" class="form-label">Judul Artikel *</label> <input type="text" class="form-control" id="judul_artikel" aria-describedby="emailHelp" name="judul_artikel" required value="<?= $publikasi['judul_artikel'] ?>" <?= $publikasi['status'] !== 'pending' ? 'readonly' : '' ?>>
                            </div>
                            <div class="mb-3"> <label for="nama_seminar" class="form-label">Nama Seminar</label> <input type="text" class="form-control" id="nama_seminar" aria-describedby="emailHelp" name="nama_seminar" value="<?= $publikasi['nama_seminar'] ?>" <?= $publikasi['status'] !== 'pending' ? 'readonly' : '' ?>>
                            </div>
                            <div class="mb-3"> <label for="tanggal_terbit" class="form-label">Tanggal Terbit *</label> <input type="date" class="form-control" id="tanggal_terbit" aria-describedby="emailHelp" name="tanggal_terbit" required value="<?= date('Y-m-d', strtotime($publikasi['tanggal_terbit'])) ?>" <?= $publikasi['status'] !== 'pending' ? 'readonly' : '' ?>>
                            </div>
                            <div class="mb-3"> <label for="penerbit_penyelenggara" class="form-label">Penerbit/Penyelenggara *</label> <input type="text" class="form-control" id="penerbit_penyelenggara" aria-describedby="emailHelp" name="penerbit_penyelenggara" required value="<?= $publikasi['penerbit_penyelenggara'] ?>" <?= $publikasi['status'] !== 'pending' ? 'readonly' : '' ?>>
                            </div>
                            <div class="mb-3"> <label for="kota_penyelenggaraan" class="form-label">Kota Penyelenggaraan</label> <input type="text" class="form-control" id="kota_penyelenggaraan" aria-describedby="emailHelp" name="kota_penyelenggaraan" value="<?= $publikasi['kota_penyelenggaraan'] ?>" <?= $publikasi['status'] !== 'pending' ? 'readonly' : '' ?>>
                            </div>
                            <div class="form-sub-title">Apakah Seminar?</div>
                            <div class="form-sub-input">
                                <input type="checkbox" id="seminar" aria-describedby="emailHelp" name="seminar" <?= isset($publikasi['seminar']) && $publikasi['seminar'] === true ? 'checked' : '' ?> <?= $publikasi['status'] !== 'pending' ? 'disabled' : '' ?>>
                                <label for="seminar">Ya</label>
                            </div>
                            <div class="form-sub-title">Apakah Prosiding?</div>
                            <div class="form-sub-input">
                                <input type="checkbox" id="prosiding" aria-describedby="emailHelp" name="prosiding" <?= isset($publikasi['prosiding']) && $publikasi['prosiding'] === true ? 'checked' : '' ?> <?= $publikasi['status'] !== 'pending' ? 'disabled' : '' ?>>
                                <label for="prosiding">Ya</label>
                            </div>

                            <div class="mb-3"> <label for="bahasa" class="form-label">Bahasa</label> <input type="text" class="form-control" id="bahasa" aria-describedby="emailHelp" name="bahasa" value="<?= $publikasi['bahasa'] ?>" <?= $publikasi['status'] !== 'pending' ? 'readonly' : '' ?>>
                            </div>
                            <div class="mb-3"> <label for="isbn" class="form-label">ISBN</label> <input type="text" class="form-control" id="isbn" aria-describedby="emailHelp" name="isbn" value="<?= $publikasi['isbn'] ?>" <?= $publikasi['status'] !== 'pending' ? 'readonly' : '' ?>>
                            </div>
                            <div class="mb-3"> <label for="issn" class="form-label">ISSN</label> <input type="text" class="form-control" id="issn" aria-describedby="emailHelp" name="issn" value="<?= $publikasi['issn'] ?>" <?= $publikasi['status'] !== 'pending' ? 'readonly' : '' ?>>
                            </div>
                            <div class="mb-3"> <label for="e_issn" class="form-label">e-ISSN</label> <input type="text" class="form-control" id="e_issn" aria-describedby="emailHelp" value="<?= $publikasi['issn'] ?>" name="e_issn" <?= $publikasi['status'] !== 'pending' ? 'readonly' : '' ?>>
                            </div>
                            <div class="mb-3"> <label for="tautan_eksternal" class="form-label">Tautan Eksternal</label> <input type="text" class="form-control" id="tautan_eksternal" aria-describedby="emailHelp" name="tautan_eksternal" value="<?= $publikasi['tautan_eksternal'] ?>" <?= $publikasi['status'] !== 'pending' ? 'readonly' : '' ?>>
                            </div>
                            <div class="mb-3"> <label for="keterangan" class="form-label">Keterangan/Petunjuk Akses</label> <textarea type="text" class="form-control" id="keterangan" aria-describedby="emailHelp" name="keterangan" <?= $publikasi['status'] !== 'pending' ? 'readonly' : '' ?>><?= $publikasi['keterangan'] ?></textarea>
                            </div>
                            <div class="mb-3">
                                <h5>Anggota Kegiatan (Dosen)</h5>
                                <div id="anggota-dosen-container">
                                    <?php foreach ($publikasi['anggota_dosen'] as $index => $anggota): ?>
                                    <div class="anggota-dosen-item mb-3 border p-3">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label">Nama Dosen *</label>
                                                <input class="form-control" name="nama_anggota_dosen[]" value="<?= $anggota['nama_dosen'] ?>" readonly>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Peran *</label>
                                                <select class="form-select" name="peran_anggota_dosen[]" disabled>
                                                    <option value="ketua" <?= $anggota['peran'] === 'ketua' ? 'selected' : '' ?>>Ketua</option>
                                                    <option value="anggota" <?= $anggota['peran'] === 'anggota' ? 'selected' : '' ?>>Anggota</option>
                                                    <option value="penasehat" <?= $anggota['peran'] === 'penasehat' ? 'selected' : '' ?>>Penasehat</option>
                                                    <option value="reviewer" <?= $anggota['peran'] === 'reviewer' ? 'selected' : '' ?>>Reviewer</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <h5>Anggota Kegiatan (Mahasiswa)</h5>
                                <div id="anggota-mahasiswa-container">
                                    <?php foreach ($publikasi['anggota_mahasiswa'] as $index => $anggota): ?>
                                    <div class="anggota-mahasiswa-item mb-3 border p-3">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label">Nama Mahasiswa *</label>
                                                <input class="form-control" name="nama_anggota_mahasiswa[]" value="<?= $anggota['nama_mahasiswa'] ?>" readonly>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Peran *</label>
                                                <select class="form-select" name="peran_anggota_mahasiswa[]" disabled>
                                                    <option value="ketua" <?= $anggota['peran'] === 'ketua' ? 'selected' : '' ?>>Ketua</option>
                                                    <option value="anggota" <?= $anggota['peran'] === 'anggota' ? 'selected' : '' ?>>Anggota</option>
                                                    <option value="asisten" <?= $anggota['peran'] === 'asisten' ? 'selected' : '' ?>>Asisten</option>
                                                    <option value="surveyor" <?= $anggota['peran'] === 'surveyor' ? 'selected' : '' ?>>Surveyor</option>
                                                    <option value="operator" <?= $anggota['peran'] === 'operator' ? 'selected' : '' ?>>Operator</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <h5>Anggota Kegiatan (Kolaborator Eksternal)</h5>
                                <div id="anggota-eksternal-container">
                                    <?php foreach ($publikasi['anggota_eksternal'] as $index => $anggota): ?>
                                    <div class="anggota-eksternal-item mb-3 border p-3">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label">Nama *</label>
                                                <input type="text" class="form-control" name="nama_anggota_eksternal[]" value="<?= $anggota['nama'] ?>" readonly>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">Institusi *</label>
                                                <input type="text" class="form-control" name="institusi_anggota_eksternal[]" value="<?= $anggota['institusi'] ?>" readonly>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">Peran *</label>
                                                <select class="form-select" name="peran_anggota_eksternal[]" disabled>
                                                    <option value="konsultan" <?= $anggota['peran'] === 'konsultan' ? 'selected' : '' ?>>Konsultan</option>
                                                    <option value="narasumber" <?= $anggota['peran'] === 'narasumber' ? 'selected' : '' ?>>Narasumber</option>
                                                    <option value="mitra" <?= $anggota['peran'] === 'mitra' ? 'selected' : '' ?>>Mitra</option>
                                                    <option value="fasilitator" <?= $anggota['peran'] === 'fasilitator' ? 'selected' : '' ?>>Fasilitator</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" name="status" id="status" disabled>
                                    <option value="">Pilih Status Publikasi</option>
                                    <option value="pending" <?= $publikasi['status'] === 'pending' ? 'selected' : '' ?>>Pending</option>
                                    <option value="rejected" <?= $publikasi['status'] === 'rejected' ? 'selected' : '' ?>>Rejected</option>
                                    <option value="approved" <?= $publikasi['status'] === 'approved' ? 'selected' : '' ?>>Approved</option>
                                </select>
                            </div>
                            <div class="mb-3"> <label for="notes" class="form-label">Catatan Reviewer</label> <textarea type="text" class="form-control" id="notes" aria-describedby="emailHelp"readonly><?= !isset($publikasi['review_notes']) || $publikasi['review_notes'] === '' ? '-' : $publikasi['review_notes'] ?></textarea>
                            </div>
                        </div> <!--end::Body--> <!--begin::Footer-->
                        <div class="card-footer"> <button type="submit" class="btn btn-primary" style="background:#30645b;border-color:#30645b;" <?= $publikasi['status'] !== 'pending' ? 'disabled' : '' ?>>Simpan</button>                            <a type="submit" class="btn btn-secondary" href="/dosen/publikasi-karya">Kembali</a> </div> <!--end::Footer-->
                    </form> <!--end::Form-->
                </div> <!--end::Quick Example-->
            </div> <!-- /.Start col -->
        </div> <!-- /.row (main row) -->
    </div> <!--end::Container-->
</div> <!--end::App Content-->