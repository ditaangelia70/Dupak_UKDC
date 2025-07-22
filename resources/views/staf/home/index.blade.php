<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-md-12">
            <h1>Dashboard Staf</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <div class="card h-100">
                <div class="card-header">
                    <i class="bi bi-layers"></i> Jumlah Pengajuan Pending
                </div>
                <div class="card-body">
                    <h2><?= number_format($archives) ?> Pengajuan</h2>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card h-100">
                <div class="card-header">
                    <i class="bi bi-layers"></i> Jumlah Pengajuan Pengajaran Pending
                </div>
                <div class="card-body">
                    <h2><?= number_format($credit_pengajaran) ?> Pengajuan</h2>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card h-100">
                <div class="card-header">
                    <i class="bi bi-layers"></i> Jumlah Pengabdian Pending
                </div>
                <div class="card-body">
                    <h2><?= number_format($pengabdian) ?> Pengajuan</h2>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card h-100">
                <div class="card-header">
                    <i class="bi bi-layers"></i> Jumlah Publikasi Karya Pending
                </div>
                <div class="card-body">
                    <h2><?= number_format($publikasi_karya) ?> Pengajuan</h2>
                </div>
            </div>
        </div>
    </div>
</div>
