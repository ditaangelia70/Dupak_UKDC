<div class="app-content-header"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-3">Pengabdian</h3>
            </div>
        </div> <!--end::Row-->
    </div> <!--end::Container-->
</div> <!--end::App Content Header--> <!--begin::App Content-->
<div class="app-content"> <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Row-->
        <div class="row"> <!-- Start col -->
            <div class="col-lg-12 col-12 connectedSortable">
                <div class="card mb-4" style="box-shadow:none;">
                    <div class="p-3 d-flex justify-content-between align-items-center" style="border-bottom:1px solid gainsboro;">
                        <h3 class="card-title">Daftar Pengabdian</h3>
                        <a href="/dosen/pengabdian?t=add">
                            <button class="btn btn-primary" style="background:#30645b;border-color:#30645b;"><i class="bi bi-plus"></i> Pengabdian Baru</button>
                        </a>
                    </div>
                    <div class="card-body">
                        <table id="myTable" class="display">
                            <thead>
                                <tr>
                                    <th style="width:100px !important;">No</th>
                                    <th>Tanggal Submit</th>
                                    <th>Tanggal Update</th>
                                    <th>Nomor SK</th>
                                    <th>Kategori Kegiatan</th>
                                    <th>Lokasi Kegiatan</th>
                                    <th>Tahun Kegiatan</th>
                                    <th>Status</th>
                                    <th>Catatan Review</th>
                                    <th>Total Poin</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $index = 0; ?>
                                <?php foreach($pengabdian as $item): ?>
                                <?php $index += 1; ?>
                                <tr>
                                    <td style="width:100px !important;"><?= $index ?></td>
                                    <td><?= $item['created_at'] ?></td>
                                    <td><?= $item['updated_at'] ?></td>
                                    <td><?= $item['nomor_sk'] ?></td>
                                    <td><?= $item['kategori_kegiatan'] ?></td>
                                    <td><?= $item['lokasi_kegiatan'] ?></td>
                                    <td><?= $item['tahun_kegiatan'] ?></td>
                                    <td><?= ucfirst($item['status']) ?></td>
                                    <td><?= !isset($item['review_notes']) || $item['review_notes'] === '' ? '-' : substr($item['review_notes'], 0, 20).'...'  ?></td>
                                    <td>-</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="/dosen/pengabdian?t=detail&id=<?= $item['id'] ?>">
                                                <button class="btn btn-primary">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                            </a>
                                            <a href="/dosen/pengabdian?t=delete&id=<?= $item['id'] ?>">
                                                <button class="btn btn-danger">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div> <!-- /.card -->
            </div> <!-- /.Start col -->
        </div> <!-- /.row (main row) -->
    </div> <!--end::Container-->
</div> <!--end::App Content-->
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        let table = new DataTable('#myTable', {});
    });
</script>