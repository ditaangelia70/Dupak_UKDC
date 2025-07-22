<div class="app-content-header"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-3">Pengabdian Baru</h3>
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
                              <select name="kategori_kegiatan" id="kategori_kegiatan" class="form-select" required>
                                <option value="">Pilih Kategori</option>
                                <?php foreach($kategori_kegiatan as $kg): ?>
                                <option value="<?= $kg['id'] ?>"><?= $kg['name'] ?> ( <?= $kg['credit'] ?> point )</option>
                                <?php endforeach ?>
                              </select>
                            </div>
                            <div class="mb-3">
                                <label for="judul_kegiatan" class="form-label">Judul Kegiatan *</label>
                                <input type="text" class="form-control" id="judul_kegiatan" name="judul_kegiatan" required>
                            </div>

                            <div class="mb-3">
                                <label for="affiliasi" class="form-label">Affiliasi *</label>
                                <select class="form-select" id="affiliasi" name="affiliasi" required>
                                    <option value="">Pilih...</option>
                                    <option value="fakultas_teknik">Fakultas Teknik</option>
                                    <option value="fakultas_ekonomi">Fakultas Ekonomi</option>
                                    <option value="fakultas_hukum">Fakultas Hukum</option>
                                    <option value="fakultas_kedokteran">Fakultas Kedokteran</option>
                                    <option value="fakultas_pertanian">Fakultas Pertanian</option>
                                    <option value="fakultas_sosial_politik">Fakultas Sosial Politik</option>
                                    <option value="fakultas_sains_teknologi">Fakultas Sains dan Teknologi</option>
                                    <option value="lembaga_penelitian">Lembaga Penelitian</option>
                                    <option value="lembaga_pengabdian">Lembaga Pengabdian Masyarakat</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="kelompok_bidang" class="form-label">Kelompok Bidang</label>
                                <select class="form-select" id="kelompok_bidang" name="kelompok_bidang">
                                    <option value="">Pilih...</option>
                                    <option value="kesehatan">Kesehatan</option>
                                    <option value="pendidikan">Pendidikan</option>
                                    <option value="ekonomi_kreatif">Ekonomi Kreatif</option>
                                    <option value="teknologi_pertanian">Teknologi Pertanian</option>
                                    <option value="lingkungan">Lingkungan</option>
                                    <option value="sosial_masyarakat">Sosial Masyarakat</option>
                                    <option value="teknologi_informasi">Teknologi Informasi</option>
                                    <option value="kewirausahaan">Kewirausahaan</option>
                                    <option value="hukum">Hukum</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="litabmas_sebelumnya" class="form-label">Litabmas Sebelumnya</label>
                                <select class="form-select" id="litabmas_sebelumnya" name="litabmas_sebelumnya">
                                    <option value="">Pilih...</option>
                                    <option value="tidak_ada">Tidak Ada</option>
                                    <option value="hibah_dikti">Hibah Dikti</option>
                                    <option value="hibah_internal">Hibah Internal</option>
                                    <option value="kerja_sama">Kerja Sama Industri</option>
                                    <option value="mandiri">Mandiri</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="jenis_skim" class="form-label">Jenis SKIM</label>
                                <select class="form-select" id="jenis_skim" name="jenis_skim">
                                    <option value="">Pilih...</option>
                                    <option value="pkm">PKM (Program Kemitraan Masyarakat)</option>
                                    <option value="pkw">PKW (Program Kemitraan Wilayah)</option>
                                    <option value="kkn_tematik">KKN Tematik</option>
                                    <option value="hibah_dikti">Hibah Dikti</option>
                                    <option value="hibah_pt">Hibah Perguruan Tinggi</option>
                                    <option value="kerja_sama">Kerja Sama</option>
                                    <option value="mandiri">Mandiri</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="lokasi_kegiatan" class="form-label">Lokasi Kegiatan</label>
                                <input type="text" class="form-control" id="lokasi_kegiatan" name="lokasi_kegiatan" placeholder="Contoh: Desa Sukamaju, Kec. Cibiru, Kota Bandung">
                            </div>
                            <div class="mb-3">
                                <label for="tahun_usulan" class="form-label">Tahun Usulan *</label>
                                <select class="form-select" id="tahun_usulan" name="tahun_usulan" required>
                                    <option value="">Pilih...</option>
                                    <?php 
                                        $y=intval(date('Y'));
                                        for($i=$y;$i>($y-10);$i-=1):?>
                                            <option value="<?= $i ?>"><?= $i ?></option>
                                    <?php endfor ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="tahun_kegiatan" class="form-label">Tahun Kegiatan *</label>
                                <select class="form-select" id="tahun_kegiatan" name="tahun_kegiatan" required>
                                    <option value="">Pilih...</option>
                                    <?php 
                                        $y=intval(date('Y'));
                                        for($i=$y;$i>($y-10);$i-=1):?>
                                            <option value="<?= $i ?>"><?= $i ?></option>
                                    <?php endfor ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="tahun_pelaksanaan" class="form-label">Tahun Pelaksanaan *</label>
                                <select class="form-select" id="tahun_pelaksanaan" name="tahun_pelaksanaan" required>
                                    <option value="">Pilih...</option>
                                    <?php 
                                        $y=intval(date('Y'));
                                        for($i=$y;$i>($y-10);$i-=1):?>
                                            <option value="<?= $i ?>"><?= $i ?></option>
                                    <?php endfor ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="lama_kegiatan" class="form-label">Lama Kegiatan (Tahun) *</label>
                                <input type="number" class="form-control" id="lama_kegiatan" name="lama_kegiatan" min="1" max="5" value="1" required>
                            </div>

                            <div class="mb-3">
                                <label for="dana_dikti" class="form-label">Dana dari Dikti (Rp) *</label>
                                <input type="number" step="1000" class="form-control" id="dana_dikti" name="dana_dikti" value="0" required>
                            </div>

                            <div class="mb-3">
                                <label for="dana_pt" class="form-label">Dana dari Perguruan Tinggi (Rp) *</label>
                                <input type="number" step="1000" class="form-control" id="dana_pt" name="dana_pt" value="0" required>
                            </div>

                            <div class="mb-3">
                                <label for="dana_lain" class="form-label">Dana dari Institusi Lain (Rp) *</label>
                                <input type="number" step="1000" class="form-control" id="dana_lain" name="dana_lain" value="0" required>
                            </div>

                            <div class="mb-3">
                                <label for="in_kind" class="form-label">In Kind</label>
                                <input type="text" class="form-control" id="in_kind" name="in_kind" placeholder="Contoh: Peralatan, Software, dll">
                            </div>

                            <div class="mb-3">
                                <label for="nomor_sk" class="form-label">Nomor SK Penugasan</label>
                                <input type="text" class="form-control" id="nomor_sk" name="nomor_sk" placeholder="Contoh: 123/UN32.9/PP/2023">
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_sk" class="form-label">Tanggal SK Penugasan</label>
                                <input type="date" class="form-control" id="tanggal_sk" name="tanggal_sk">
                            </div>
                            <div class="mb-3">
                                <label for="nama_mitra" class="form-label">Mitra Litabmas</label>
                                <input type="text" class="form-control" id="nama_mitra" name="nama_mitra">
                            </div>
                            <div class="mb-3">
                                <h5>Upload Dokumen</h5>
                                <p><small>(Maksimal total ukuran file dalam sekali proses upload: 5MB)</small></p>
                                
                                <div id="dokumen-container">
                                    <div class="dokumen-item mb-3 border p-3">
                                        <div class="mb-3">
                                            <label class="form-label">Dokumen 1</label>
                                            <div class="input-group">
                                                <input type="file" class="form-control" name="dokumen_file[]" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx,.xls,.xlsx,.txt">
                                            </div>
                                            <small>Jenis file yang diijinkan: pdf, jpg, jpeg, png, doc, docx, xls, xlsx, txt</small>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Nama Dokumen</label>
                                            <input type="text" class="form-control" name="nama_dokumen[]">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Keterangan</label>
                                            <textarea class="form-control" name="keterangan_dokumen[]"></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Jenis Dokumen</label>
                                            <select class="form-select" name="jenis_dokumen[]">
                                                <option value="">Pilih...</option>
                                                <option value="proposal">Proposal</option>
                                                <option value="laporan">Laporan</option>
                                                <option value="surat_tugas">Surat Tugas</option>
                                                <option value="surat_perjanjian">Surat Perjanjian</option>
                                                <option value="bukti_kegiatan">Bukti Kegiatan</option>
                                                <option value="dokumen_pendukung">Dokumen Pendukung</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Tautan Eksternal Dokumen</label>
                                            <input type="url" class="form-control" name="tautan_dokumen[]" placeholder="https://">
                                        </div>
                                        
                                        <button type="button" class="btn btn-danger btn-sm remove-dokumen">Hapus Dokumen</button>
                                    </div>
                                </div>

                                <button type="button" id="tambah-dokumen" class="btn btn-secondary btn-sm mt-2">+ Tambah dokumen baru</button>
                            </div>
                            <div class="mb-3">
                                <h5>Anggota Kegiatan (Dosen)</h5>
                                <div id="anggota-dosen-container">
                                    <div class="anggota-dosen-item mb-3 border p-3">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label">Nama Dosen *</label>
                                                <select class="form-select" name="nama_anggota_dosen[]" required>
                                                    <option value="">Pilih Dosen...</option>
                                                    <?php foreach($dosen_avail as $da): ?>
                                                    <option value="<?= $da['id'] ?>">[<?= $da['username'] ?>] <?= $da['name'] ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Peran *</label>
                                                <select class="form-select" name="peran_anggota_dosen[]" required>
                                                    <option value="ketua">Ketua</option>
                                                    <option value="anggota">Anggota</option>
                                                    <option value="penasehat">Penasehat</option>
                                                    <option value="reviewer">Reviewer</option>
                                                </select>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-danger btn-sm mt-2 remove-anggota-dosen">Hapus Anggota</button>
                                    </div>
                                </div>
                                <button type="button" id="tambah-anggota-dosen" class="btn btn-secondary btn-sm">+ Tambah Anggota Dosen</button>
                            </div>
                            <div class="mb-3">
                                <h5>Anggota Kegiatan (Mahasiswa)</h5>
                                <div id="anggota-mahasiswa-container">
                                    <div class="anggota-mahasiswa-item mb-3 border p-3">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label">Nama Mahasiswa *</label>
                                                <input class="form-control" name="nama_anggota_mahasiswa[]" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Peran *</label>
                                                <select class="form-select" name="peran_anggota_mahasiswa[]" required>
                                                    <option value="ketua">Ketua</option>
                                                    <option value="anggota">Anggota</option>
                                                    <option value="asisten">Asisten</option>
                                                    <option value="surveyor">Surveyor</option>
                                                    <option value="operator">Operator</option>
                                                </select>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-danger btn-sm mt-2 remove-anggota-mahasiswa">Hapus Anggota</button>
                                    </div>
                                </div>
                                <button type="button" id="tambah-anggota-mahasiswa" class="btn btn-secondary btn-sm">+ Tambah Anggota Mahasiswa</button>
                            </div>
                            <div class="mb-3">
                                <h5>Anggota Kegiatan (Kolaborator Eksternal)</h5>
                                <div id="anggota-eksternal-container">
                                    <div class="anggota-eksternal-item mb-3 border p-3">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label">Nama *</label>
                                                <input type="text" class="form-control" name="nama_anggota_eksternal[]" required>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">Institusi *</label>
                                                <input type="text" class="form-control" name="institusi_anggota_eksternal[]" required>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">Peran *</label>
                                                <select class="form-select" name="peran_anggota_eksternal[]" required>
                                                    <option value="konsultan">Konsultan</option>
                                                    <option value="narasumber">Narasumber</option>
                                                    <option value="mitra">Mitra</option>
                                                    <option value="fasilitator">Fasilitator</option>
                                                </select>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-danger btn-sm mt-2 remove-anggota-eksternal">Hapus Anggota</button>
                                    </div>
                                </div>
                                <button type="button" id="tambah-anggota-eksternal" class="btn btn-secondary btn-sm">+ Tambah Kolaborator Eksternal</button>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="/dosen/pengabdian" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>

                    <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        document.getElementById('tambah-dokumen').addEventListener('click', function() {
                            const container = document.getElementById('dokumen-container');
                            const newItem = document.querySelector('.dokumen-item').cloneNode(true);
                            const count = container.children.length + 1;
                            
                            newItem.querySelector('label').textContent = `Dokumen ${count}`;
                            newItem.querySelector('input[type="file"]').value = '';
                            newItem.querySelector('input[type="text"]').value = '';
                            newItem.querySelector('textarea').value = '';
                            newItem.querySelector('select').selectedIndex = 0;
                            newItem.querySelector('input[type="url"]').value = '';
                            container.appendChild(newItem);
                            
                            newItem.querySelector('.remove-dokumen').addEventListener('click', function() {
                                if (container.children.length > 1) {
                                    container.removeChild(newItem);
                                } else {
                                    alert('Minimal harus ada 1 dokumen');
                                }
                            });
                        });
                        document.getElementById('tambah-anggota-dosen').addEventListener('click', function() {
                            const container = document.getElementById('anggota-dosen-container');
                            const newItem = document.querySelector('.anggota-dosen-item').cloneNode(true);
                            
                            newItem.querySelector('select[name="nama_anggota_dosen[]"]').value = '';
                            container.appendChild(newItem);
                            
                            // Tambahkan event listener untuk tombol hapus
                            newItem.querySelector('.remove-anggota-dosen').addEventListener('click', function() {
                                if (container.children.length > 1) {
                                    container.removeChild(newItem);
                                } else {
                                    alert('Minimal harus ada 1 anggota dosen');
                                }
                            });
                        });
                        document.getElementById('tambah-anggota-mahasiswa').addEventListener('click', function() {
                            const container = document.getElementById('anggota-mahasiswa-container');
                            const newItem = document.querySelector('.anggota-mahasiswa-item').cloneNode(true);
                            
                            newItem.querySelector('input[name="nama_anggota_mahasiswa[]"]').value = '';
                            container.appendChild(newItem);
                            
                            // Tambahkan event listener untuk tombol hapus
                            newItem.querySelector('.remove-anggota-mahasiswa').addEventListener('click', function() {
                                container.removeChild(newItem);
                            });
                        });
                        document.getElementById('tambah-anggota-eksternal').addEventListener('click', function() {
                            const container = document.getElementById('anggota-eksternal-container');
                            const newItem = document.querySelector('.anggota-eksternal-item').cloneNode(true);
                            
                            newItem.querySelector('input[name="nama_anggota_eksternal[]"]').value = '';
                            newItem.querySelector('input[name="institusi_anggota_eksternal[]"]').value = '';
                            container.appendChild(newItem);
                            
                            // Tambahkan event listener untuk tombol hapus
                            newItem.querySelector('.remove-anggota-eksternal').addEventListener('click', function() {
                                container.removeChild(newItem);
                            });
                        });
                        document.querySelectorAll('.remove-dokumen, .remove-anggota-dosen, .remove-anggota-mahasiswa, .remove-anggota-eksternal').forEach(button => {
                            button.addEventListener('click', function() {
                                const container = this.closest('.mitra-item, .dokumen-item, .anggota-dosen-item, .anggota-mahasiswa-item, .anggota-eksternal-item').parentNode;
                                if (container.children.length > 1) {
                                    this.closest('.mitra-item, .dokumen-item, .anggota-dosen-item, .anggota-mahasiswa-item, .anggota-eksternal-item').remove();
                                } else {
                                    alert('Minimal harus ada 1 item');
                                }
                            });
                        });
                    });
                    </script>
                </div> <!--end::Quick Example-->
            </div> <!-- /.Start col -->
        </div> <!-- /.row (main row) -->
    </div> <!--end::Container-->
</div> <!--end::App Content-->