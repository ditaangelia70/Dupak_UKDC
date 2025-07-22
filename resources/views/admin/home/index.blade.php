<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-md-12">
            <h1>Dashboard Admin</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <i class="bi bi-layers"></i> Total Kriteria
                </div>
                <div class="card-body">
                    <h2><?= number_format($criteria_) ?> Kriteria</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <i class="bi bi-layers"></i> Total Sub Kriteria
                </div>
                <div class="card-body">
                    <h2><?= number_format($sub_criteria) ?> Sub Kriteria</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <i class="bi bi-layers"></i> Total Sub Sub Kriteria
                </div>
                <div class="card-body">
                    <h2><?= number_format($sub_sub_criteria) ?> Sub Sub Kriteria</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <i class="bi bi-layers"></i> Total Jabatan
                </div>
                <div class="card-body">
                    <h2><?= number_format($jabatan) ?> Jabatan</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <i class="bi bi-layers"></i> Kredit Penelitian Total
                </div>
                <div class="card-body">
                    <h2><?= number_format($penelitian_total, 1) ?> pts</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <i class="bi bi-layers"></i> Kredit Pengajaran Total
                </div>
                <div class="card-body">
                    <h2><?= number_format($pengajaran_total, 1) ?> pts</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <i class="bi bi-layers"></i> Kredit Pengabdian Total
                </div>
                <div class="card-body">
                    <h2><?= number_format($pengabdian_total, 1) ?> pts</h2>
                </div>
            </div>
        </div>
        <?php foreach($criteria as $item): ?>
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <i class="bi bi-layers"></i> Kredit <?= $item['name'] ?> Total
                </div>
                <div class="card-body">
                    <h2><?= number_format($item['point'],1) ?> pts</h2>
                </div>
            </div>
        </div>
        <?php endforeach ?>
    </div>
</div>
