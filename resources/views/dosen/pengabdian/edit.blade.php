<div class="app-content-header"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-3">Detail Pengabdian</h3>
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
                        <div class="card-title">Isi data pengabdian</div>
                    </div> <!--end::Header--> <!--begin::Form-->
                    <form method="post" enctype="multipart/form-data" id="formPengabdian">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="kategori_kegiatan" class="form-label">Kategori Kegiatan *</label>
                                <select name="kategori_kegiatan" id="kategori_kegiatan" class="form-select" required disabled>
                                    <option value="">Pilih Kategori</option>
                                    <?php foreach($kategori_kegiatan as $kg): ?>
                                    <option value="<?= $kg['id'] ?>" <?= $pengabdian['kategori_kegiatan'] === $kg['id'] ? 'selected' : '' ?>><?= $kg['name'] ?> ( <?= $kg['credit'] ?> poin )</option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="judul_kegiatan" class="form-label">Judul Kegiatan *</label>
                                <input type="text" class="form-control" id="judul_kegiatan" name="judul_kegiatan" required value="<?= $pengabdian['judul_kegiatan'] ?>" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="affiliasi" class="form-label">Affiliasi *</label>
                                <select class="form-select" id="affiliasi" name="affiliasi" required disabled>
                                    <option value="">Pilih...</option>
                                    <option value="fakultas_teknik" <?= $pengabdian['affiliasi'] === 'fakultas_teknik' ? 'selected' : '' ?>>Fakultas Teknik</option>
                                    <option value="fakultas_ekonomi" <?= $pengabdian['affiliasi'] === 'fakultas_ekonomi' ? 'selected' : '' ?>>Fakultas Ekonomi</option>
                                    <option value="fakultas_hukum" <?= $pengabdian['affiliasi'] === 'fakultas_hukum' ? 'selected' : '' ?>>Fakultas Hukum</option>
                                    <option value="fakultas_kedokteran" <?= $pengabdian['affiliasi'] === 'fakultas_kedokteran' ? 'selected' : '' ?>>Fakultas Kedokteran</option>
                                    <option value="fakultas_pertanian" <?= $pengabdian['affiliasi'] === 'fakultas_pertanian' ? 'selected' : '' ?>>Fakultas Pertanian</option>
                                    <option value="fakultas_sosial_politik" <?= $pengabdian['affiliasi'] === 'fakultas_sosial_politik' ? 'selected' : '' ?>>Fakultas Sosial Politik</option>
                                    <option value="fakultas_sains_teknologi" <?= $pengabdian['affiliasi'] === 'fakultas_sains_teknologi' ? 'selected' : '' ?>>Fakultas Sains dan Teknologi</option>
                                    <option value="lembaga_penelitian" <?= $pengabdian['affiliasi'] === 'lembaga_penelitian' ? 'selected' : '' ?>>Lembaga Penelitian</option>
                                    <option value="lembaga_pengabdian" <?= $pengabdian['affiliasi'] === 'lembaga_pengabdian' ? 'selected' : '' ?>>Lembaga Pengabdian Masyarakat</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="kelompok_bidang" class="form-label">Kelompok Bidang</label>
                                <select class="form-select" id="kelompok_bidang" name="kelompok_bidang" disabled>
                                    <option value="">Pilih...</option>
                                    <option value="kesehatan" <?= $pengabdian['kelompok_bidang'] === 'kesehatan' ? 'selected' : '' ?>>Kesehatan</option>
                                    <option value="pendidikan" <?= $pengabdian['kelompok_bidang'] === 'pendidikan' ? 'selected' : '' ?>>Pendidikan</option>
                                    <option value="ekonomi_kreatif" <?= $pengabdian['kelompok_bidang'] === 'ekonomi_kreatif' ? 'selected' : '' ?>>Ekonomi Kreatif</option>
                                    <option value="teknologi_pertanian" <?= $pengabdian['kelompok_bidang'] === 'teknologi_pertanian' ? 'selected' : '' ?>>Teknologi Pertanian</option>
                                    <option value="lingkungan" <?= $pengabdian['kelompok_bidang'] === 'lingkungan' ? 'selected' : '' ?>>Lingkungan</option>
                                    <option value="sosial_masyarakat" <?= $pengabdian['kelompok_bidang'] === 'sosial_masyarakat' ? 'selected' : '' ?>>Sosial Masyarakat</option>
                                    <option value="teknologi_informasi" <?= $pengabdian['kelompok_bidang'] === 'teknologi_informasi' ? 'selected' : '' ?>>Teknologi Informasi</option>
                                    <option value="kewirausahaan" <?= $pengabdian['kelompok_bidang'] === 'kewirausahaan' ? 'selected' : '' ?>>Kewirausahaan</option>
                                    <option value="hukum" <?= $pengabdian['kelompok_bidang'] === 'hukum' ? 'selected' : '' ?>>Hukum</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="litabmas_sebelumnya" class="form-label">Litabmas Sebelumnya</label>
                                <select class="form-select" id="litabmas_sebelumnya" name="litabmas_sebelumnya" disabled>
                                    <option value="">Pilih...</option>
                                    <option value="tidak_ada" <?= $pengabdian['litabmas_sebelumnya'] === 'tidak_ada' ? 'selected' : '' ?>>Tidak Ada</option>
                                    <option value="hibah_dikti" <?= $pengabdian['litabmas_sebelumnya'] === 'hibah_dikti' ? 'selected' : '' ?>>Hibah Dikti</option>
                                    <option value="hibah_internal" <?= $pengabdian['litabmas_sebelumnya'] === 'hibah_internal' ? 'selected' : '' ?>>Hibah Internal</option>
                                    <option value="kerja_sama" <?= $pengabdian['litabmas_sebelumnya'] === 'kerja_sama' ? 'selected' : '' ?>>Kerja Sama Industri</option>
                                    <option value="mandiri" <?= $pengabdian['litabmas_sebelumnya'] === 'mandiri' ? 'selected' : '' ?>>Mandiri</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="jenis_skim" class="form-label">Jenis SKIM</label>
                                <select class="form-select" id="jenis_skim" name="jenis_skim" disabled>
                                    <option value="">Pilih...</option>
                                    <option value="pkm" <?= $pengabdian['jenis_skim'] === 'pkm' ? 'selected' : '' ?>>PKM (Program Kemitraan Masyarakat)</option>
                                    <option value="pkw" <?= $pengabdian['jenis_skim'] === 'pkw' ? 'selected' : '' ?>>PKW (Program Kemitraan Wilayah)</option>
                                    <option value="kkn_tematik" <?= $pengabdian['jenis_skim'] === 'kkn_tematik' ? 'selected' : '' ?>>KKN Tematik</option>
                                    <option value="hibah_dikti" <?= $pengabdian['jenis_skim'] === 'hibah_dikti' ? 'selected' : '' ?>>Hibah Dikti</option>
                                    <option value="hibah_pt" <?= $pengabdian['jenis_skim'] === 'hibah_pt' ? 'selected' : '' ?>>Hibah Perguruan Tinggi</option>
                                    <option value="kerja_sama" <?= $pengabdian['jenis_skim'] === 'kerja_sama' ? 'selected' : '' ?>>Kerja Sama</option>
                                    <option value="mandiri" <?= $pengabdian['jenis_skim'] === 'mandiri' ? 'selected' : '' ?>>Mandiri</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="lokasi_kegiatan" class="form-label">Lokasi Kegiatan</label>
                                <input type="text" class="form-control" id="lokasi_kegiatan" name="lokasi_kegiatan" value="<?= $pengabdian['lokasi_kegiatan'] ?>" readonly>
                            </div>
                            
                            <div class="mb-3">
                                <label for="tahun_usulan" class="form-label">Tahun Usulan *</label>
                                <select class="form-select" id="tahun_usulan" name="tahun_usulan" required disabled>
                                    <option value="">Pilih...</option>
                                    <?php 
                                        $y=intval(date('Y'));
                                        for($i=$y;$i>($y-10);$i-=1):?>
                                            <option value="<?= $i ?>" <?= $pengabdian['tahun_usulan'] == $i ? 'selected' : '' ?>><?= $i ?></option>
                                    <?php endfor ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="tahun_kegiatan" class="form-label">Tahun Kegiatan *</label>
                                <select class="form-select" id="tahun_kegiatan" name="tahun_kegiatan" required disabled>
                                    <option value="">Pilih...</option>
                                    <?php 
                                        $y=intval(date('Y'));
                                        for($i=$y;$i>($y-10);$i-=1):?>
                                            <option value="<?= $i ?>" <?= $pengabdian['tahun_kegiatan'] == $i ? 'selected' : '' ?>><?= $i ?></option>
                                    <?php endfor ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="tahun_pelaksanaan" class="form-label">Tahun Pelaksanaan *</label>
                                <select class="form-select" id="tahun_pelaksanaan" name="tahun_pelaksanaan" required disabled>
                                    <option value="">Pilih...</option>
                                    <?php 
                                        $y=intval(date('Y'));
                                        for($i=$y;$i>($y-10);$i-=1):?>
                                            <option value="<?= $i ?>" <?= $pengabdian['tahun_pelaksanaan'] == $i ? 'selected' : '' ?>><?= $i ?></option>
                                    <?php endfor ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="lama_kegiatan" class="form-label">Lama Kegiatan (Tahun) *</label>
                                <input type="number" class="form-control" id="lama_kegiatan" name="lama_kegiatan" min="1" max="5" value="<?= $pengabdian['lama_kegiatan'] ?>" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="dana_dikti" class="form-label">Dana dari Dikti (Rp) *</label>
                                <input type="number" step="1000" class="form-control" id="dana_dikti" name="dana_dikti" value="<?= $pengabdian['dana_dikti'] ?>" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="dana_pt" class="form-label">Dana dari Perguruan Tinggi (Rp) *</label>
                                <input type="number" step="1000" class="form-control" id="dana_pt" name="dana_pt" value="<?= $pengabdian['dana_pt'] ?>" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="dana_lain" class="form-label">Dana dari Institusi Lain (Rp) *</label>
                                <input type="number" step="1000" class="form-control" id="dana_lain" name="dana_lain" value="<?= $pengabdian['dana_lain'] ?>" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="in_kind" class="form-label">In Kind</label>
                                <input type="text" class="form-control" id="in_kind" name="in_kind" value="<?= $pengabdian['in_kind'] ?>" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="nomor_sk" class="form-label">Nomor SK Penugasan</label>
                                <input type="text" class="form-control" id="nomor_sk" name="nomor_sk" value="<?= $pengabdian['nomor_sk'] ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_sk" class="form-label">Tanggal SK Penugasan</label>
                                <input type="date" class="form-control" id="tanggal_sk" name="tanggal_sk" value="<?= $pengabdian['tanggal_sk'] ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="nama_mitra" class="form-label">Mitra Litabmas</label>
                                <input type="text" class="form-control" id="nama_mitra" name="nama_mitra" value="<?= $pengabdian['nama_mitra'] ?>" readonly>
                            </div>
                            
                            <div class="mb-3">
                                <h5>Upload Dokumen</h5>
                                <p><small>(Maksimal total ukuran file dalam sekali proses upload: 5MB)</small></p>
                                
                                <div id="dokumen-container">
                                    <?php foreach ($pengabdian['dokumen'] as $index => $dokumen): ?>
                                    <div class="dokumen-item mb-3 border p-3">
                                        <div class="mb-3">
                                            <label class="form-label">Dokumen <?= $index + 1 ?></label>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Nama Dokumen</label>
                                            <input type="text" class="form-control" name="nama_dokumen[]" value="<?= $dokumen['nama_dokumen'] ?>" readonly>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Keterangan</label>
                                            <textarea class="form-control" name="keterangan_dokumen[]" readonly><?= $dokumen['keterangan'] ?></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Jenis Dokumen</label>
                                            <select class="form-select" name="jenis_dokumen[]" disabled>
                                                <option value="">Pilih...</option>
                                                <option value="proposal" <?= $dokumen['jenis_dokumen'] === 'proposal' ? 'selected' : '' ?>>Proposal</option>
                                                <option value="laporan" <?= $dokumen['jenis_dokumen'] === 'laporan' ? 'selected' : '' ?>>Laporan</option>
                                                <option value="surat_tugas" <?= $dokumen['jenis_dokumen'] === 'surat_tugas' ? 'selected' : '' ?>>Surat Tugas</option>
                                                <option value="surat_perjanjian" <?= $dokumen['jenis_dokumen'] === 'surat_perjanjian' ? 'selected' : '' ?>>Surat Perjanjian</option>
                                                <option value="bukti_kegiatan" <?= $dokumen['jenis_dokumen'] === 'bukti_kegiatan' ? 'selected' : '' ?>>Bukti Kegiatan</option>
                                                <option value="dokumen_pendukung" <?= $dokumen['jenis_dokumen'] === 'dokumen_pendukung' ? 'selected' : '' ?>>Dokumen Pendukung</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Tautan Eksternal Dokumen</label>
                                            <input type="url" class="form-control" name="tautan_dokumen[]" value="<?= $dokumen['tautan_dokumen'] ?>" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Tautan Internal Dokumen</label>
                                            <div>
                                                <a href="<?= url('/') ?>/uploads/<?= $dokumen['file_path'] ?>">
                                                    <button type="button" class="btn btn-primary btn-sm">
                                                        <i class="bi bi-eye"></i> Lihat Dokumen
                                                    </button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <h5>Anggota Kegiatan (Dosen)</h5>
                                <div id="anggota-dosen-container">
                                    <?php foreach ($pengabdian['anggota_dosen'] as $index => $anggota): ?>
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
                                    <?php foreach ($pengabdian['anggota_mahasiswa'] as $index => $anggota): ?>
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
                                    <?php foreach ($pengabdian['anggota_eksternal'] as $index => $anggota): ?>
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
                                <label for="status_pengabdian" class="form-label">Status</label>
                                <input type="text" class="form-control" id="status_pengabdian" value="<?= $pengabdian['status'] ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="review_notes" class="form-label">Review Notes</label>
                                <textarea type="text" class="form-control" id="review_notes" readonly><?= $pengabdian['review_notes'] ?></textarea>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" disabled>Simpan</button>
                            <a href="/dosen/pengabdian" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div> <!--end::Quick Example-->
            </div> <!-- /.Start col -->
        </div> <!-- /.row (main row) -->
    </div> <!--end::Container-->
</div> <!--end::App Content-->