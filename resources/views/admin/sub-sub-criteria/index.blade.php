<div class="app-content-header"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-3">Master Sub Sub Kriteria</h3>
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
                        <h3 class="card-title">Daftar Sub Sub Kriteria</h3>
                        <a href="/admin/sub-sub-criteria?t=add">
                            <button class="btn btn-primary" style="background:#30645b;border-color:#30645b;"><i class="bi bi-plus"></i> Sub Sub Kriteria Baru</button>
                        </a>
                    </div>
                    <div class="card-body">
                        <table id="myTable" class="display">
                            <thead>
                                <tr>
                                    <th style="width:100px !important;">No</th>
                                    <th>Kriteria</th>
                                    <th>Sub Kriteria</th>
                                    <th>Nama</th>
                                    <th>Satuan</th>
                                    <th>Kredit Umum</th>
                                    <!-- <th>Kredit Jabatan</th> -->
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $index = 0; ?>
                                <?php foreach($sub_sub_criteria as $item): ?>
                                <?php $index += 1; ?>
                                <tr>
                                    <td style="width:100px !important;"><?= $index ?></td>
                                    <td><?= $item['sub_criteria']['criteria']['name'] ?></td>
                                    <td><?= $item['sub_criteria']['name'] ?></td>
                                    <td><?= $item['name'] ?></td>
                                    <td><?= $item['unit'] ?></td>
                                    <td><?= $item['credit'] ?></td>
                                    <!-- <td>
                                        <?php if(count($item['credit_on_pos']) > 0): ?>
                                            <?php foreach($item['credit_on_pos'] as $jndex => $cop): ?>
                                                <div style="font-size:13px;white-space: nowrap;"><?= $jndex + 1 ?>. <?= $cop['jabatan']['name'] ?> ( <?= $cop['credit'] ?> pts )</div>
                                            <?php endforeach ?>
                                        <?php else: ?>
                                            -
                                        <?php endif ?>
                                    </td> -->
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="/admin/sub-sub-criteria?t=edit&id=<?= $item['id'] ?>">
                                                <button class="btn btn-secondary">
                                                    <i class="bi bi-pen"></i>
                                                </button>
                                            </a>
                                            <a href="/admin/sub-sub-criteria?t=delete&id=<?= $item['id'] ?>">
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