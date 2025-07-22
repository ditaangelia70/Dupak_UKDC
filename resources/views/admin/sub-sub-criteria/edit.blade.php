<div class="app-content-header"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-3">Edit Sub Sub Kriteria</h3>
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
                        <div class="card-title">Isi data sub-sub kriteria</div>
                    </div> <!--end::Header--> <!--begin::Form-->
                    <form method="post" enctype="multipart/form-data"> <!--begin::Body-->
                        <div class="card-body">
                            <div class="mb-3"> <label for="criteria" class="form-label">Kriteria</label> 
                            <select class="form-select" id="criteria" onchange="generateSubCriteria(this.value)">
                                <option value="">Pilih Kategori</option>
                                <?php foreach($criteria as $index => $item): ?>
                                    <option value="<?= $index ?>" <?= $this_sub_sub_criteria['sub_criteria']['criteria']['id'] === $item['id'] ? 'selected' : '' ?>><?= $item['name'] ?></option>
                                <?php endforeach ?>
                            </select>
                            </div>
                            <div class="mb-3"> <label for="sub_criteria_id" class="form-label">Sub Kriteria</label> 
                            <select class="form-select" name="sub_criteria_id" id="sub_criteria_id">
                                <option value="">Pilih Sub Kriteria</option>
                            </select>
                            </div>
                            <div class="mb-3"> <label for="name" class="form-label">Nama</label> <input type="text" class="form-control" id="name" aria-describedby="emailHelp" name="name" required value="<?= $this_sub_sub_criteria['name'] ?>">
                            </div>
                            <div class="mb-3"> <label for="unit" class="form-label">Satuan</label> <input type="text" class="form-control" id="unit" aria-describedby="emailHelp" name="unit" required value="<?= $this_sub_sub_criteria['unit'] ?>">
                            </div>
                            <div class="mb-3"> <label for="credit" class="form-label">Kredit Umum</label> <input type="number" class="form-control" id="credit" aria-describedby="emailHelp" name="credit" required value="<?= $this_sub_sub_criteria['credit'] ?>" step="0.1">
                            </div>
                        </div> <!--end::Body--> <!--begin::Footer-->
                        <div class="card-footer"> <button type="submit" class="btn btn-primary" style="background:#30645b;border-color:#30645b;">Simpan</button>                            <a type="submit" class="btn btn-secondary" href="/admin/sub-sub-criteria">Kembali</a> </div> <!--end::Footer-->
                    </form> <!--end::Form-->
                </div> <!--end::Quick Example-->
            </div> <!-- /.Start col -->
        </div> <!-- /.row (main row) -->
    </div> <!--end::Container-->
</div> <!--end::App Content-->
<script type="text/javascript">
    const sub_criteria_el = document.querySelector('#sub_criteria_id');
    const criteria_data = <?= json_encode($criteria) ?>;
    console.log(criteria_data);
    const generateSubCriteria = (value)=>{
        sub_criteria_el.innerHTML = '<option value="">Pilih Sub Kriteria</option>';
        if(value === ''){
            return;
        }
        criteria_data[Number(value)]['sub_criteria'].forEach((item)=>{
            const option = document.createElement('option');
            option.value = item.id;
            option.innerText = item.name;
            if(item.id === <?= $this_sub_sub_criteria['sub_criteria']['id'] ?>){
                option.selected = true;
            }
            sub_criteria_el.appendChild(option);
        })
    }
    <?php foreach($criteria as $index => $item): ?>
        <?php if($this_sub_sub_criteria['sub_criteria']['criteria']['id'] === $item['id']): ?>
        generateSubCriteria('<?= $index ?>');
        <?php break; ?>
        <?php endif ?>
    <?php endforeach ?>
</script>