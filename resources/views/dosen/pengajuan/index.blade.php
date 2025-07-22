<div class="app-content-header"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-3">Pengajuan</h3>
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
                        <h3 class="card-title">Daftar Pengajuan</h3>
                    </div>
                    <div class="card-body">
                        <style type="text/css">
                            td {
                              vertical-align: top;
                            }
                            td *{
                                white-space: nowrap;
                            }
                            th *{
                                white-space: nowrap;
                            }
                        </style>
                        <table id="myTable" class="display">
                            <thead>
                                <tr>
                                    <th style="width:100px !important;">No</th>
                                    <th>Update Terakhir</th>
                                    <th>Kriteria</th>
                                    <th>Sub Kriteria</th>
                                    <th>Sub Sub Kriteria</th>
                                    <th>Berkas</th>
                                    <th>Status Berkas</th>
                                    <th>Catatan</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $index = 0;
                                    $status_map = [
                                        'pending'=>['Belum Diperiksa', 'revision-pending'],
                                        'rejected'=>['Perlu Revisi', 'revision-rejected'],
                                        'finished'=>['Disetujui', 'revision-finished'],
                                    ];
                                ?>
                                <?php foreach($archives as $item): ?>
                                <?php $index += 1; ?>
                                <tr>
                                    <td style="width:100px !important;"><?= $index ?></td>
                                    <td>
                                        <div>
                                            <?= $item['commented_at'] ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <?= $item['sub_sub_criteria']['sub_criteria']['criteria']['name'] ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <?= $item['sub_sub_criteria']['sub_criteria']['name'] ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <?= $item['sub_sub_criteria']['name'] ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <button class="btn btn-secondary btn-sm" onclick="window.open('/uploads/<?= $item['url'] ?>', '_blank')">
                                                <i class="bi bi-eye"></i> Lihat Berkas
                                            </button>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-center <?= $status_map[$item['status']][1] ?>"><?= $status_map[$item['status']][0] ?></div>
                                    </td>
                                     <td>
                                        <div class="d-flex gap-2">
                                            <?php if(isset($item['comment'])): ?>
                                            <a style="text-decoration: none;" href="/dosen/catatan-berkas?id=<?= $item['id']?>&back=status-pengajuan">
                                                <button class="btn btn-primary btn-sm">
                                                    <i class="bi bi-chat"></i> Catatan
                                                </button>
                                            </a>
                                            <?php else: ?>
                                                -
                                            <?php endif ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="/dosen/penilaian">
                                                <button class="btn btn-primary btn-sm">
                                                    <i class="bi bi-eye"></i> Cek Detail
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