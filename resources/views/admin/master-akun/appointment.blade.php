<div class="app-content-header"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-3">Penilaian</h3>
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
                        <h3 class="card-title">Penilaian Dosen <?= $akun->name ?> ( NIP/NIDN: <?= $akun->username ?> )</h3>
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
                                    <th class="sticky-left sticky-left-number">No</th>
                                    <th>Kriteria</th>
                                    <th>Sub Kriteria</th>
                                    <th class="sticky-left">Sub Sub Kriteria</th>
                                    <th>Satuan</th>
                                    <th>Kredit</th>
                                    <th>Qty</th>
                                    <th>Status Berkas</th>
                                    <th>Catatan</th>
                                    <th>Berkas</th>
                                    <th>Update</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $index = 0; ?>
                                <?php foreach($criteria as $item): ?>
                                <?php $index += 1; ?>
                                <tr>
                                    <td class="sticky-left sticky-left-number" style="width:100px !important;"><div class="mb-1" style="height: 31px;display: flex;align-items: center;"><?= $index ?></div></td>
                                    <td><div class="mb-1" style="height: 31px;display: flex;align-items: center;"><?= $item['name'] ?></div></td>
                                    <td>
                                        <?php if(count($item['sub_criteria']) > 0): ?>
                                            <?php foreach($item['sub_criteria'] as $jndex => $jtem): ?>
                                                <div class="mb-3 pb-2" id="bab_<?= $item['id'].'_'.$jtem['id'] ?>">
                                                    <div class="mb-1" style="height: 31px;display: flex;align-items: center;"><?= $jndex + 1 ?>. <?= $jtem['name'] ?></div>
                                                </div>
                                            <?php endforeach ?>
                                        <?php else: ?>
                                            <div>-</div>
                                        <?php endif ?>
                                    </td>
                                    <td class="sticky-left">
                                        <?php 
                                        $hasSubSub = false;
                                        if(count($item['sub_criteria']) > 0): 
                                            foreach($item['sub_criteria'] as $jtem): 
                                                if(isset($jtem['sub_sub_criteria']) && count($jtem['sub_sub_criteria']) > 0): 
                                                    $hasSubSub = true;
                                                    ?>
                                                    <div class="bab mb-3" id="bab_<?= $item['id'].'_'.$jtem['id'] ?>">
                                                    <?php foreach($jtem['sub_sub_criteria'] as $kndex => $ktem): ?>
                                                        <div class="mb-1" style="height: 31px;display: flex;align-items: center;"><?= $kndex + 1 ?>. <?= $ktem['name'] ?></div>
                                                    <?php endforeach; ?>
                                                    </div><?php
                                                endif;
                                            endforeach;
                                        endif;
                                        if(!$hasSubSub): ?>
                                            <div>-</div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php 
                                        $hasSubSub = false;
                                        if(count($item['sub_criteria']) > 0): 
                                            foreach($item['sub_criteria'] as $jtem): 
                                                if(isset($jtem['sub_sub_criteria']) && count($jtem['sub_sub_criteria']) > 0): 
                                                    $hasSubSub = true;
                                                    ?>
                                                    <div class="bab mb-3" id="bab_<?= $item['id'].'_'.$jtem['id'] ?>">
                                                    <?php foreach($jtem['sub_sub_criteria'] as $kndex => $ktem): ?>
                                                        <div class="mb-1" style="height: 31px;display: flex;align-items: center;"><?= $ktem['unit'] ?></div>
                                                    <?php endforeach; ?>
                                                    </div><?php
                                                endif;
                                            endforeach;
                                        endif;
                                        if(!$hasSubSub): ?>
                                            <div>-</div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php 
                                        $hasSubSub = false;
                                        if(count($item['sub_criteria']) > 0): 
                                            foreach($item['sub_criteria'] as $jtem): 
                                                if(isset($jtem['sub_sub_criteria']) && count($jtem['sub_sub_criteria']) > 0): 
                                                    $hasSubSub = true;
                                                    ?>
                                                    <div class="bab mb-3" id="bab_<?= $item['id'].'_'.$jtem['id'] ?>">
                                                    <?php foreach($jtem['sub_sub_criteria'] as $kndex => $ktem): ?>
                                                        <div class="mb-1" style="height: 31px;display: flex;align-items: center;"><?= $ktem['credit'] ?> pts</div>
                                                    <?php endforeach; ?>
                                                    </div><?php
                                                endif;
                                            endforeach;
                                        endif;
                                        if(!$hasSubSub): ?>
                                            <div>-</div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php 
                                        $hasSubSub = false;
                                        if(count($item['sub_criteria']) > 0): 
                                            foreach($item['sub_criteria'] as $jtem): 
                                                if(isset($jtem['sub_sub_criteria']) && count($jtem['sub_sub_criteria']) > 0): 
                                                    $hasSubSub = true;
                                                    ?>
                                                    <div class="bab mb-3" id="bab_<?= $item['id'].'_'.$jtem['id'] ?>">
                                                    <?php foreach($jtem['sub_sub_criteria'] as $kndex => $ktem): ?>
                                                        <div class="mb-1 editable-qty value_sb_<?= $ktem['id'] ?>" style="height: 31px;display: flex;align-items: center;background: white;padding: 0px 15px;border-radius: 3px;border: 1px solid gainsboro;" 
                                                             data-id="<?= $ktem['id'] ?>" 
                                                             contenteditable="true"><?= $ktem['qty'] ?></div>
                                                    <?php endforeach; ?>
                                                    </div><?php
                                                endif;
                                            endforeach;
                                        endif;
                                        if(!$hasSubSub): ?>
                                            <div>-</div>
                                        <?php endif; ?>
                                    </td>
                                     <td>
                                        <?php 
                                        $status_map = [
                                            'pending'=>['Belum Diperiksa', 'revision-pending'],
                                            'rejected'=>['Perlu Revisi', 'revision-rejected'],
                                            'finished'=>['Disetujui', 'revision-finished'],
                                        ];
                                        $hasSubSub = false;
                                        if(count($item['sub_criteria']) > 0): 
                                            foreach($item['sub_criteria'] as $jtem): 
                                                if(isset($jtem['sub_sub_criteria']) && count($jtem['sub_sub_criteria']) > 0): 
                                                    $hasSubSub = true;
                                                    ?>
                                                    <div class="bab mb-3" id="bab_<?= $item['id'].'_'.$jtem['id'] ?>">
                                                    <?php foreach($jtem['sub_sub_criteria'] as $kndex => $ktem): ?>
                                                        <?php if(count($ktem['archives']) > 0): ?>
                                                            <div class="mb-1 <?= $status_map[$ktem['archives'][count($ktem['archives']) - 1]['status']][1] ?>" style="height: 31px;display: flex;align-items: center;"><?= $status_map[$ktem['archives'][count($ktem['archives']) - 1]['status']][0] ?></div>
                                                        <?php else: ?>
                                                            <div class="mb-1 revision-none" style="height: 31px;display: flex;align-items: center;">Belum Diupload</div>
                                                        <?php endif ?>
                                                    <?php endforeach; ?>
                                                    </div><?php
                                                endif;
                                            endforeach;
                                        endif;
                                        if(!$hasSubSub): ?>
                                            <div>-</div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <?php 
                                            $hasSubSub = false;
                                            if(count($item['sub_criteria']) > 0): 
                                                foreach($item['sub_criteria'] as $jtem): 
                                                    if(isset($jtem['sub_sub_criteria']) && count($jtem['sub_sub_criteria']) > 0): 
                                                        $hasSubSub = true;
                                                        ?>
                                                        <div class="bab mb-3" id="bab_<?= $item['id'].'_'.$jtem['id'] ?>">
                                                        <?php foreach($jtem['sub_sub_criteria'] as $kndex => $ktem): ?>
                                                            <div class="w-full mb-1">
                                                            <?php if(count($ktem['archives']) > 0): ?>
                                                                <a style="text-decoration: none;" href="/admin/catatan-berkas?id=<?= $ktem['archives'][count($ktem['archives']) - 1]['id'] ?>&old_id=<?= $_GET['id'] ?>">
                                                                    <button class="btn btn-primary btn-sm">
                                                                        <i class="bi bi-chat"></i> Catatan
                                                                    </button>
                                                                </a>
                                                            <?php else: ?>
                                                                <div class="mb-1" style="height: 31px;display: flex;align-items: center;">-</div>
                                                            <?php endif ?>
                                                            </div>
                                                        <?php endforeach; ?>
                                                        </div><?php
                                                    endif;
                                                endforeach;
                                            endif;
                                            if(!$hasSubSub): ?>
                                                <div>-</div>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                   <td>
                                        <div class="d-flex flex-column">
                                            <?php 
                                            $hasSubSub = false;
                                            if(count($item['sub_criteria']) > 0): 
                                                foreach($item['sub_criteria'] as $jtem): 
                                                    if(isset($jtem['sub_sub_criteria']) && count($jtem['sub_sub_criteria']) > 0): 
                                                        $hasSubSub = true;
                                                        ?>
                                                        <div class="bab mb-3" id="bab_<?= $item['id'].'_'.$jtem['id'] ?>">
                                                        <?php foreach($jtem['sub_sub_criteria'] as $kndex => $ktem): ?>
                                                            <div class="w-full mb-1">
                                                            <?php if($item['name'] === 'Penelitian' || $item['name'] === 'Pengabdian'): ?>
                                                            <div>-</div>
                                                            <?php else: ?>
                                                            <a style="text-decoration: none;" href="/admin/upload-berkas?id=<?= $ktem['id'] ?>">
                                                                <button class="btn btn-primary btn-sm">
                                                                    <i class="bi bi-upload"></i> Upload Berkas
                                                                </button>
                                                            </a>
                                                            <?php endif ?>
                                                             <?php if(count($ktem['archives']) > 0): ?>
                                                            <button class="btn btn-secondary btn-sm" onclick="window.open('/uploads/<?= $ktem['archives'][count($ktem['archives']) - 1]['url'] ?>', '_blank')">
                                                                <i class="bi bi-eye"></i> Lihat Berkas
                                                            </button>
                                                            <button class="btn btn-secondary btn-sm" onclick="salin_link('<?= url('/') ?>/uploads/<?= $ktem['archives'][count($ktem['archives']) - 1]['url'] ?>')">
                                                                <i class="bi bi-clipboard"></i> Salin Link
                                                            </button>
                                                            <?php endif ?>
                                                            </div>
                                                        <?php endforeach; ?>
                                                        </div><?php
                                                    endif;
                                                endforeach;
                                            endif;
                                            if(!$hasSubSub): ?>
                                                <div>-</div>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            
                                        </div>
                                        <div class="d-flex flex-column">
                                            <?php 
                                            $hasSubSub = false;
                                            if(count($item['sub_criteria']) > 0): 
                                                foreach($item['sub_criteria'] as $jtem): 
                                                    if(isset($jtem['sub_sub_criteria']) && count($jtem['sub_sub_criteria']) > 0): 
                                                        $hasSubSub = true;
                                                        ?>
                                                        <div class="bab mb-3" id="bab_<?= $item['id'].'_'.$jtem['id'] ?>">
                                                        <?php foreach($jtem['sub_sub_criteria'] as $kndex => $ktem): ?>
                                                            <?php if(count($ktem['archives']) > 0): ?>
                                                            <div class="w-full mb-1">
                                                            <button class="btn btn-primary update-btn btn-sm" 
                                                                    data-id="<?= $ktem['id'] ?>"
                                                                    data-status="finished"
                                                                    data-archive_id="<?= $ktem['archives'][count($ktem['archives']) - 1]['id'] ?>"
                                                                    style="background: #31cb31 !important;border-color: #25a725 !important;">
                                                                <i class="bi bi-check-lg"></i> Terima Berkas
                                                            </button>
                                                            <button class="btn btn-secondary update-btn btn-sm" 
                                                                    data-id="<?= $ktem['id'] ?>"
                                                                    data-status="rejected"
                                                                    data-archive_id="<?= $ktem['archives'][count($ktem['archives']) - 1]['id'] ?>"
                                                                    style="background: #ff4a4a !important;border-color: #d33f3f !important;"
                                                                    >
                                                                <i class="bi bi-x-lg"></i> Tolak
                                                            </button>
                                                            </div>
                                                            <?php else: ?>
                                                                <div>-</div>
                                                            <?php endif ?>
                                                        <?php endforeach; ?>
                                                        </div><?php
                                                    endif;
                                                endforeach;
                                            endif;
                                            if(!$hasSubSub): ?>
                                                <div>-</div>
                                            <?php endif; ?>
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
<link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/4.3.0/css/fixedColumns.dataTables.min.css">
<script src="https://cdn.datatables.net/fixedcolumns/4.3.0/js/dataTables.fixedColumns.min.js"></script>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        let table = new DataTable('#myTable', {});

        // working on sub bab size height
        document.querySelectorAll('.bab').forEach((item)=>{
            const sub_bab = document.querySelectorAll('#'+item.id);
            const target_height = sub_bab[sub_bab.length - 2].offsetHeight;
            sub_bab.forEach((sbab)=>{
                sbab.style.height = target_height + 'px';
            })
        })
    });
</script>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        $(document).on('click', '.update-btn', function() {
            const sub_sub_criteria_id = $(this).data('id');
            const status = $(this).data('status');
            const archive_id = $(this).data('archive_id');
            const user_id = '<?= $akun->id ?>';
            const value = Number(document.querySelector('.value_sb_'+sub_sub_criteria_id).innerText);

            $.ajax({
                url: '/admin/appointment/update',
                method: 'POST',
                data: {
                    user_id: user_id,
                    status,
                    value,
                    sub_sub_criteria_id,
                    archive_id
                },
                success: function(response) {
                    Swal.fire({icon:'success',title:'Success',text:'Data Berhasil Diupdate!'}).then(()=>{
                        location.reload();
                    });
                },
                error: function(xhr, status, error) {
                    Swal.fire({icon:'error',title:'Error',text:'Terjadi Kesalahan!'});
                }
            });
        });
    });
    function salin_link(link) {
        const temp = document.createElement("textarea");
        temp.value = link;
        document.body.appendChild(temp);
        temp.select();
        temp.setSelectionRange(0, 99999);
        document.execCommand("copy");
        document.body.removeChild(temp);
        Swal.fire({
            icon: 'success',
            title: 'Tersalin!',
            text: 'Link berhasil disalin ke clipboard.',
            timer: 2000,
            showConfirmButton: false
        });
    }
</script>