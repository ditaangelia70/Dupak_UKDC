<div class="app-content-header"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-3">Kredit Jabatan Baru</h3>
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
                        <div class="card-title">Isi data kredit jabatan</div>
                    </div> <!--end::Header--> <!--begin::Form-->
                    <form method="post" enctype="multipart/form-data"> <!--begin::Body-->
                        <div class="card-body">
                            <div class="mb-3"> <label for="criteria" class="form-label">Kriteria</label> 
                            <select class="form-select" id="criteria" onchange="generateSubCriteria(this.value)">
                                <option value="">Pilih Kategori</option>
                                <?php foreach($criteria as $index => $item): ?>
                                    <option value="<?= $index ?>" <?= $item['id'] === $kredit_jabatan['sub_sub_criteria']['sub_criteria']['criteria']['id'] ? 'selected' : '' ?>><?= $item['name'] ?></option>
                                <?php endforeach ?>
                            </select>
                            </div>
                            <div class="mb-3"> <label for="sub_criteria_id" class="form-label">Sub Kriteria</label> 
                            <select class="form-select" id="sub_criteria_id" onchange="generateSubSubCriteria(this.value)">
                                <option value="">Pilih Sub Kriteria</option>
                            </select>
                            </div>
                            <div class="mb-3"> <label for="sub_criteria_id" class="form-label">Sub Sub Kriteria</label> 
                            <select class="form-select" name="sub_sub_criteria_id" id="sub_sub_criteria_id">
                                <option value="">Pilih Sub Sub Kriteria</option>
                            </select>
                            </div>
                            <div class="mb-3"> <label for="jabatan" class="form-label">Jabatan</label> 
                            <select class="form-select" id="jabatan" name="jabatan_id">
                                <option value="">Pilih Jabatan</option>
                                <?php foreach($jabatan as $index => $item): ?>
                                    <option value="<?= $item['id'] ?>" <?= $item['id'] === $kredit_jabatan['jabatan_id'] ? 'selected' : '' ?>><?= $item['name'] ?></option>
                                <?php endforeach ?>
                            </select>
                            </div>
                            <div class="mb-3"> <label for="credit" class="form-label">Kredit Jabatan</label> <input type="number" class="form-control" id="credit" aria-describedby="emailHelp" name="credit" required value="<?= $kredit_jabatan['credit'] ?>" step="0.1">
                            </div>
                        </div> <!--end::Body--> <!--begin::Footer-->
                        <div class="card-footer"> <button type="submit" class="btn btn-primary" style="background:#30645b;border-color:#30645b;">Simpan</button>                            <a type="submit" class="btn btn-secondary" href="/admin/kredit-jabatan">Kembali</a> </div> <!--end::Footer-->
                    </form> <!--end::Form-->
                </div> <!--end::Quick Example-->
            </div> <!-- /.Start col -->
        </div> <!-- /.row (main row) -->
    </div> <!--end::Container-->
</div> <!--end::App Content-->
<script type="text/javascript">
    const sub_criteria_el = document.querySelector('#sub_criteria_id');
    const sub_sub_criteria_el = document.querySelector('#sub_sub_criteria_id');
    const criteria_data = <?= json_encode($criteria) ?>;
    const kredit_jabatan = <?= json_encode($kredit_jabatan) ?>;
    let selected_criteria;
    const generateSubCriteria = (value, selectedId=null)=>{
        selected_criteria = Number(value);
        sub_criteria_el.innerHTML = '<option value="">Pilih Sub Kriteria</option>';
        let selected_sub_criteria = null;
        criteria_data[selected_criteria]['sub_criteria'].forEach((item,i)=>{
            const option = document.createElement('option');
            option.value = i;
            option.innerText = item.name;
            if(selectedId){
                if(item.id === selectedId){
                    option.selected = true;
                    selected_sub_criteria = i;
                }
            }
            sub_criteria_el.appendChild(option);
        })

        return selected_sub_criteria;
    }
    const generateSubSubCriteria = (value, selectedId=null)=>{
        sub_sub_criteria_el.innerHTML = '<option value="">Pilih Sub Sub Kriteria</option>';
        criteria_data[selected_criteria]['sub_criteria'][Number(value)].sub_sub_criteria.forEach((item)=>{
            const option = document.createElement('option');
            option.value = item.id;
            option.innerText = item.name;
            if(selectedId){
                if(item.id === selectedId){
                    option.selected = true;
                }
            }
            sub_sub_criteria_el.appendChild(option);
        })
    }
    for(let i=0;i<criteria_data.length;i++){
        const criteria = criteria_data[i];
        if(criteria.id === kredit_jabatan.sub_sub_criteria.sub_criteria.criteria.id){
            const selected_sub_criteria = generateSubCriteria(i, kredit_jabatan.sub_sub_criteria.sub_criteria.id);
            generateSubSubCriteria(selected_sub_criteria, kredit_jabatan.sub_sub_criteria.id)
            break;
        }
    }
</script>