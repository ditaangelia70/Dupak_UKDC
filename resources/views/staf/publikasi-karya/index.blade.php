<div class="app-content-header"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-3">Publikasi Karya</h3>
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
                        <h3 class="card-title">Daftar Publikasi Karya</h3>
                    </div>
                    <div class="card-body">
                        <style type="text/css">
                            table th, table td{
                                white-space: nowrap;
                            }
                        </style>
                        <table id="myTable" class="display">
                            <thead>
                                <tr>
                                    <th style="width:100px !important;">No</th>
                                    <th>Tanggal Submit</th>
                                    <th>Tanggal Terbit</th>
                                    <th>Dosen</th>
                                    <th>NIP/NIDN</th>
                                    <th>Judul Artikel</th>
                                    <th>Penerbit/Penyelenggara</th>
                                    <th>Status</th>
                                    <th>Catatan Review</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $index = 0; ?>
                                <?php foreach($publikasi as $item): ?>
                                <?php $index += 1; ?>
                                <tr>
                                    <td style="width:100px !important;"><?= $index ?></td>
                                    <td><?= $item['created_at'] ?></td>
                                    <td><?= $item['tanggal_terbit'] ?></td>
                                    <td><?= $item['user']['name'] ?></td>
                                    <td><?= $item['user']['username'] ?></td>
                                    <td><?= $item['judul_artikel'] ?></td>
                                    <td><?= $item['penerbit_penyelenggara'] ?></td>
                                    <td><?= ucfirst($item['status']) ?></td>
                                    <td><?= $item['review_notes'] === '' || !isset($item['review_notes']) ? '-' : substr($item['review_notes'], 0, 20).'...'  ?></td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="/staf/publikasi-karya?t=edit&id=<?= $item['id'] ?>">
                                                <button class="btn btn-primary">
                                                    <i class="bi bi-eye"></i> Detail
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