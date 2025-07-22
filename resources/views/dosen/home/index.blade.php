<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-md-12">
            <h1>Dashboard Dosen</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <i class="bi bi-layers"></i> Kredit Penelitian
                </div>
                <div class="card-body">
                    <h2><?= number_format($penelitian_total,1) ?> pts</h2>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <i class="bi bi-layers"></i> Kredit Pengabdian
                </div>
                <div class="card-body">
                    <h2><?= number_format($pengabdian_total,1) ?> pts</h2>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <i class="bi bi-layers"></i> Kredit Pengajaran
                </div>
                <div class="card-body">
                    <h2><?= number_format($pengajaran_total,1) ?> pts</h2>
                </div>
            </div>
        </div>
        <?php foreach($criteria as $item): ?>
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <i class="bi bi-layers"></i> Kredit <?= $item['name'] ?>
                </div>
                <div class="card-body">
                    <h2><?= number_format($item['point'],1) ?> pts</h2>
                </div>
            </div>
        </div>
        <?php endforeach ?>
    </div>
</div>
