<div class="app-content-header"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-3">Upload Berkas</h3>
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
                        <div class="card-title">Isi data berkas</div>
                    </div> <!--end::Header--> <!--begin::Form-->
                    <form method="post" enctype="multipart/form-data"> <!--begin::Body-->
                        <div class="card-body">
                            <div class="mb-3"> <label for="kriteria" class="form-label">Kriteria</label> <input type="text" class="form-control" id="kriteria" aria-describedby="emailHelp" required value="<?= $criteria['sub_criteria']['criteria']['name'] ?>" readonly>
                            </div>
                            <div class="mb-3"> <label for="kriteria" class="form-label">Sub Kriteria</label> <input type="text" class="form-control" id="kriteria" aria-describedby="emailHelp" required value="<?= $criteria['sub_criteria']['name'] ?>" readonly>
                            </div>
                            <div class="mb-3"> <label for="kriteria" class="form-label">Sub Sub Kriteria</label> <input type="text" class="form-control" id="kriteria" aria-describedby="emailHelp" required value="<?= $criteria['name'] ?>" readonly>
                            </div>
                            <div class="mb-3"> <label for="kriteria" class="form-label">Dosen</label> <input type="text" class="form-control" id="kriteria" aria-describedby="emailHelp" required value="<?= $akun['name'] ?>" readonly>
                            </div>
                            <div class="mb-3"> <label for="kriteria" class="form-label">NIP/NIDN</label> <input type="text" class="form-control" id="kriteria" aria-describedby="emailHelp" required value="<?= $akun['username'] ?>" readonly>
                            </div>
                            <div class="mb-3"> <label for="archive" class="form-label">Berkas ( PDF )</label> <input type="file" class="form-control" id="archive" aria-describedby="emailHelp" name="archive" required accept="application/pdf">
                            </div>
                            
                        </div> <!--end::Body--> <!--begin::Footer-->
                        <div class="card-footer"> <button type="submit" class="btn btn-primary" style="background:#30645b;border-color:#30645b;">Simpan</button>                            <a type="submit" class="btn btn-secondary" href="/staf/appointment?t=edit&id=<?= $_GET['userId'] ?>">Kembali</a> </div> <!--end::Footer-->
                    </form> <!--end::Form-->
                </div> <!--end::Quick Example-->
            </div> <!-- /.Start col -->
        </div> <!-- /.row (main row) -->
    </div> <!--end::Container-->
</div> <!--end::App Content-->