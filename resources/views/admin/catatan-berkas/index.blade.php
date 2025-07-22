<div class="app-content-header"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-3">Catatan</h3>
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
                        <div class="card-title">Isi data catatan</div>
                    </div> <!--end::Header--> <!--begin::Form-->
                    <form method="post" enctype="multipart/form-data"> <!--begin::Body-->
                        <div class="card-body">
                            <?php if(isset($archive['commentator'])): ?>
                            <div class="mb-3"> <label for="kriteria" class="form-label">Dikomentari Oleh</label> <input type="text" class="form-control" id="kriteria" aria-describedby="emailHelp" required value="<?= $archive['commentator']['name'] ?> / <?= $archive['commentator']['role'] ?>" readonly>
                            </div>
                            <div class="mb-3"> <label for="kriteria" class="form-label">Dikomentari Pada</label> <input type="text" class="form-control" id="kriteria" aria-describedby="emailHelp" required value="<?= $archive['commented_at'] ?>" readonly>
                            </div>
                            <?php endif ?>
                            <div class="mb-3"> <label for="kriteria" class="form-label">Masukan Komentar Baru</label> <input type="text" class="form-control" id="kriteria" aria-describedby="emailHelp" name="comment" required value="<?= $archive['comment'] ?>">
                            </div>
                            
                        </div> <!--end::Body--> <!--begin::Footer-->
                        <div class="card-footer"> <button type="submit" class="btn btn-primary" style="background:#30645b;border-color:#30645b;">Simpan</button>                            <a type="submit" class="btn btn-secondary" href="/admin/appointment?id=<?= $_GET['old_id'] ?>">Kembali</a> </div> <!--end::Footer-->
                    </form> <!--end::Form-->
                </div> <!--end::Quick Example-->
            </div> <!-- /.Start col -->
        </div> <!-- /.row (main row) -->
    </div> <!--end::Container-->
</div> <!--end::App Content-->