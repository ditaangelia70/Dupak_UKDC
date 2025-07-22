<div class="app-content-header"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-3">Publikasi Baru</h3>
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
                                <input type="checkbox" id="pk_1" aria-describedby="emailHelp" name="pk_1">
                                <label for="pk_1">Menerjemahkan/menyadur buku ilmiah yang Diterbitkan dan diedarkan secara nasional (Ber-ISBN)</label>
                            </div>
                            <div class="form-sub-input">
                                <input type="checkbox" id="pk_2" aria-describedby="emailHelp" name="pk_2">
                                <label for="pk_2">Mengedit/menyunting karya ilmiah yang Diterbitkan dan diedarkan secara nasional (Ber-ISBN)</label>
                            </div>
                            <div class="form-sub-title">Hasil penelitian atau hasil pemikiran yang didesiminasikan</div>
                            <div class="form-sub-input">
                                <input type="checkbox" id="pk_3" aria-describedby="emailHelp" name="pk_3">
                                <label for="pk_3">Hasil penelitian atau hasil pemikiran yang Dipresentasikan secara oral dan dimuat dalam prosiding yang dipublikasikan (ber ISSN/ISBN): Internasional terindeks pada Scimagojr dan Scopus</label>
                            </div>
                            <div class="form-sub-input">
                                <input type="checkbox" id="pk_4" aria-describedby="emailHelp" name="pk_4">
                                <label for="pk_4">Hasil penelitian atau hasil pemikiran yang Dipresentasikan secara oral dan dimuat dalam prosiding yang dipublikasikan (ber ISSN/ISBN): Internasional terindeks Scopus, IEEE Explore, SPIE</label>
                            </div>
                            <div class="form-sub-input">
                                <input type="checkbox" id="pk_5" aria-describedby="emailHelp" name="pk_5">
                                <label for="pk_5">Hasil penelitian atau hasil pemikiran yang Dipresentasikan secara oral dan dimuat dalam prosiding yang dipublikasikan (ber ISSN/ISBN): Internasional</label>
                            </div>
                            <div class="form-sub-input">
                                <input type="checkbox" id="pk_6" aria-describedby="emailHelp" name="pk_6">
                                <label for="pk_6">Hasil penelitian atau hasil pemikiran yang Dipresentasikan secara oral dan dimuat dalam prosiding yang dipublikasikan (ber ISSN/ISBN): Nasional</label>
                            </div>
                            <div class="form-sub-input">
                                <input type="checkbox" id="pk_7" aria-describedby="emailHelp" name="pk_7">
                                <label for="pk_7">Hasil penelitian atau hasil pemikiran yang disajikan dalam bentuk poster dan dimuat dalam prosiding yang dipublikasikan dalam seminar internasional</label>
                            </div>
                            <div class="form-sub-input">
                                <input type="checkbox" id="pk_8" aria-describedby="emailHelp" name="pk_8">
                                <label for="pk_8">Hasil penelitian atau hasil pemikiran yang disajikan dalam bentuk poster dan dimuat dalam prosiding yang dipublikasikan dalam seminar nasional</label>
                            </div>
                            <div class="form-sub-input">
                                <input type="checkbox" id="pk_9" aria-describedby="emailHelp" name="pk_9">
                                <label for="pk_9">Hasil penelitian atau hasil pemikiran yang Disajikan dalam seminar/simposium/lokakarya, tetapi tidak dimuat dalam prosiding yang dipublikasikan: Internasional</label>
                            </div>
                            <div class="form-sub-input">
                                <input type="checkbox" id="pk_10" aria-describedby="emailHelp" name="pk_10">
                                <label for="pk_10">Hasil penelitian atau hasil pemikiran yang Disajikan dalam seminar/simposium/lokakarya, tetapi tidak dimuat dalam prosiding yang dipublikasikan: nasional</label>
                            </div>
                            <div class="form-sub-input">
                                <input type="checkbox" id="pk_11" aria-describedby="emailHelp" name="pk_11">
                                <label for="pk_11">Hasil penelitian atau hasil pemikiran yang tidak disajikan dalam seminar/simposium/lokakarya, tetapi dimuat dalam prosiding: Internasional</label>
                            </div>
                            <div class="form-sub-input">
                                <input type="checkbox" id="pk_12" aria-describedby="emailHelp" name="pk_12">
                                <label for="pk_12">Hasil penelitian atau hasil pemikiran yang tidak disajikan dalam seminar/simposium/lokakarya, tetapi dimuat dalam prosiding: Nasional</label>
                            </div>
                            <div class="form-sub-input">
                                <input type="checkbox" id="pk_13" aria-describedby="emailHelp" name="pk_13">
                                <label for="pk_13">Hasil penelitian atau hasil pemikiran yang disajikan dalam koran/majalah populer/umum</label>
                            </div>
                            <div class="mb-3">
                                <label for="jenis_publikasi" class="form-label">Jenis *</label>
                                <select class="form-select" name="jenis_publikasi" id="jenis_publikasi" required>
                                    <option value="">Pilih Jenis Publikasi</option>
                                    <?php foreach($kredit_jenis as $kj): ?>
                                    <option value="<?= $kj['id'] ?>"><?= $kj['name'] ?> ( <?= $kj['credit'] ?> poin ) </option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="kategori_capaian" class="form-label">Kategori Capaian</label>
                                <select class="form-select" name="kategori_capaian" id="kategori_capaian">
                                    <option value="">Pilih Kategori Capaian</option>
                                    <?php foreach($kredit_capaian as $kc): ?>
                                    <option value="<?= $kc['id'] ?>"><?= $kc['name'] ?> ( <?= $kc['credit'] ?> poin ) </option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="aktivitas_litabmas" class="form-label">Aktivitas Litabmas</label>
                                <select class="form-select" name="aktivitas_litabmas" id="aktivitas_litabmas">
                                    <option value="">Pilih Aktivitas Litabmas</option>
                                    <option value="penelitian_dasar">Penelitian Dasar</option>
                                    <option value="penelitian_terapan">Penelitian Terapan</option>
                                    <option value="penelitian_pengembangan">Penelitian Pengembangan</option>
                                    <option value="pdp">Penelitian Dosen Pemula (PDP)</option>
                                    <option value="kompetitif_nasional">Penelitian Kompetitif Nasional</option>
                                    <option value="strategis_nasional">Penelitian Strategis Nasional</option>
                                    <option value="unggulan_pt">Penelitian Unggulan Perguruan Tinggi</option>
                                    <option value="kln">Kerjasama Luar Negeri & Publikasi Internasional (KLN)</option>
                                    <option value="pkm">Program Kemitraan Masyarakat (PKM)</option>
                                    <option value="pkw">Program Kemitraan Wilayah (PKW)</option>
                                    <option value="kkn_tematik">KKN Tematik</option>
                                    <option value="hibah_internal">Hibah Internal</option>
                                    <option value="hibah_eksternal">Hibah Eksternal</option>
                                </select>
                            </div>

                            <div class="mb-3"> <label for="judul_artikel" class="form-label">Judul Artikel *</label> <input type="text" class="form-control" id="judul_artikel" aria-describedby="emailHelp" name="judul_artikel" required>
                            </div>
                            <div class="mb-3"> <label for="nama_seminar" class="form-label">Nama Seminar</label> <input type="text" class="form-control" id="nama_seminar" aria-describedby="emailHelp" name="nama_seminar">
                            </div>
                            <div class="mb-3"> <label for="tanggal_terbit" class="form-label">Tanggal Terbit *</label> <input type="date" class="form-control" id="tanggal_terbit" aria-describedby="emailHelp" name="tanggal_terbit" required>
                            </div>
                            <div class="mb-3"> <label for="penerbit_penyelenggara" class="form-label">Penerbit/Penyelenggara *</label> <input type="text" class="form-control" id="penerbit_penyelenggara" aria-describedby="emailHelp" name="penerbit_penyelenggara" required>
                            </div>
                            <div class="mb-3"> <label for="kota_penyelenggaraan" class="form-label">Kota Penyelenggaraan</label> <input type="text" class="form-control" id="kota_penyelenggaraan" aria-describedby="emailHelp" name="kota_penyelenggaraan">
                            </div>
                            <div class="form-sub-title">Apakah Seminar?</div>
                            <div class="form-sub-input">
                                <input type="checkbox" id="seminar" aria-describedby="emailHelp" name="seminar">
                                <label for="seminar">Ya</label>
                            </div>
                            <div class="form-sub-title">Apakah Prosiding?</div>
                            <div class="form-sub-input">
                                <input type="checkbox" id="prosiding" aria-describedby="emailHelp" name="prosiding">
                                <label for="prosiding">Ya</label>
                            </div>

                            <div class="mb-3"> <label for="bahasa" class="form-label">Bahasa</label> <input type="text" class="form-control" id="bahasa" aria-describedby="emailHelp" name="bahasa">
                            </div>
                            <div class="mb-3"> <label for="isbn" class="form-label">ISBN</label> <input type="text" class="form-control" id="isbn" aria-describedby="emailHelp" name="isbn">
                            </div>
                            <div class="mb-3"> <label for="issn" class="form-label">ISSN</label> <input type="text" class="form-control" id="issn" aria-describedby="emailHelp" name="issn">
                            </div>
                            <div class="mb-3"> <label for="e_issn" class="form-label">e-ISSN</label> <input type="text" class="form-control" id="e_issn" aria-describedby="emailHelp" name="e_issn">
                            </div>
                            <div class="mb-3"> <label for="tautan_eksternal" class="form-label">Tautan Eksternal</label> <input type="text" class="form-control" id="tautan_eksternal" aria-describedby="emailHelp" name="tautan_eksternal">
                            </div>
                            <div class="mb-3"> <label for="keterangan" class="form-label">Keterangan/Petunjuk Akses</label> <textarea type="text" class="form-control" id="keterangan" aria-describedby="emailHelp" name="keterangan"></textarea>
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
                        </div> <!--end::Body--> <!--begin::Footer-->
                        <div class="card-footer"> <button type="submit" class="btn btn-primary" style="background:#30645b;border-color:#30645b;">Simpan</button>                            <a type="submit" class="btn btn-secondary" href="/dosen/publikasi-karya">Kembali</a> </div> <!--end::Footer-->
                    </form> <!--end::Form-->
                    <script>
                    document.addEventListener('DOMContentLoaded', function() {
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