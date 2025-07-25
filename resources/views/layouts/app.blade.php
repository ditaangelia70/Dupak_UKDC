<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nerko+One&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Space+Grotesk:wght@300..700&display=swap" rel="stylesheet">
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- DataTables CSS -->
    <style>
        .below-minimum {
            color: red;
        }
        
        .not-passed {
            background-color: rgba(255, 0, 0, 0.1);
        }
    </style>

    <style>
        *{
            font-weight: 600;
        }
        .navbar {
            position: sticky;
            top: 0;
            z-index: 1020;
            width: 100%;
        }
        .btn-primary {
            background-color: #ff5733 !important; /* Change to your desired color */
            border-color: #ff5733 !important;
        }

        .btn-primary:hover {
            background-color: #e04e2b !important;
            border-color: #e04e2b !important;
        }

        .btn-primary:active, 
        .btn-primary:focus {
            background-color: #c74424 !important;
            border-color: #c74424 !important;
            box-shadow: 0 0 0 0.2rem rgba(255, 87, 51, 0.5) !important;
        }

        .text-primary {
            --bs-text-opacity: 1;
            color: #ff5733 !important;
        }
        .poppins-thin {
          font-family: "Poppins", sans-serif;
          font-weight: 100;
          font-style: normal;
        }

        .poppins-extralight {
          font-family: "Poppins", sans-serif;
          font-weight: 200;
          font-style: normal;
        }

        .poppins-light {
          font-family: "Poppins", sans-serif;
          font-weight: 300;
          font-style: normal;
        }

        .poppins-regular {
          font-family: "Poppins", sans-serif;
          font-weight: 400;
          font-style: normal;
        }

        .poppins-medium {
          font-family: "Poppins", sans-serif;
          font-weight: 500;
          font-style: normal;
        }

        .poppins-semibold {
          font-family: "Poppins", sans-serif;
          font-weight: 600;
          font-style: normal;
        }

        .poppins-bold {
          font-family: "Poppins", sans-serif;
          font-weight: 700;
          font-style: normal;
        }

        .poppins-extrabold {
          font-family: "Poppins", sans-serif;
          font-weight: 800;
          font-style: normal;
        }

        .poppins-black {
          font-family: "Poppins", sans-serif;
          font-weight: 900;
          font-style: normal;
        }

        .poppins-thin-italic {
          font-family: "Poppins", sans-serif;
          font-weight: 100;
          font-style: italic;
        }

        .poppins-extralight-italic {
          font-family: "Poppins", sans-serif;
          font-weight: 200;
          font-style: italic;
        }

        .poppins-light-italic {
          font-family: "Poppins", sans-serif;
          font-weight: 300;
          font-style: italic;
        }

        .poppins-regular-italic {
          font-family: "Poppins", sans-serif;
          font-weight: 400;
          font-style: italic;
        }

        .poppins-medium-italic {
          font-family: "Poppins", sans-serif;
          font-weight: 500;
          font-style: italic;
        }

        .poppins-semibold-italic {
          font-family: "Poppins", sans-serif;
          font-weight: 600;
          font-style: italic;
        }

        .poppins-bold-italic {
          font-family: "Poppins", sans-serif;
          font-weight: 700;
          font-style: italic;
        }

        .poppins-extrabold-italic {
          font-family: "Poppins", sans-serif;
          font-weight: 800;
          font-style: italic;
        }

        .poppins-black-italic {
          font-family: "Poppins", sans-serif;
          font-weight: 900;
          font-style: italic;
        }
    </style>
    <?php if(isset($user->id)): ?>
    <style>
        body {
            display: flex;
            position: relative;
        }
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #D9D9D9;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 20px;
            transition: 0.3s;
            z-index: 1000;
        }
        .sidebar a {
            display: flex;
            align-items: center;
            padding: 10px 25px;
            text-decoration: none;
            color: black;font-weight: bold;
            border-bottom: 1px solid #c3c3c3
        }
        .sidebar a:hover {
            background-color: #e9e5e5;
        }
        .sidebar h4 a:hover{
            background-color: black !important;
        }
        .sidebar i {
            margin-right: 10px;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
            width: 100%;
        }
        .menu-toggle {
            display: none;
            position: fixed;
            top: 2px;
            left: 6px;
            background: none;
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
            z-index: 1100;
            background: #00000066;
            border-radius: 50%;
            width: 48px;
            height: 48px;
        }
        .backdrop {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 900;
        }
        @media (max-width: 768px) {
            .sidebar {
                width: 0;
                overflow: hidden;
                position: fixed;
            }
            .content {
                margin-left: 0;
            }
            .menu-toggle {
                display: block;
            }
        }
        div.dt-container div.dt-layout-row div.dt-layout-cell{
            overflow: auto;
        }
        body{
            overflow-x: hidden;
        }
        /* Navbar Top */
        .top-navbar {
            background-color: #c3c3c3 !important;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 0.5rem 0;
            position: fixed;
            top: 0;
            z-index: 1030;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #666;
        }

        @media (max-width: 991.98px) {
            .top-navbar {
                padding-left: 16px;
                padding-right: 16px;
            }
        }

        /* Adjust content margin when navbar is present */
        body {
            padding-top: 56px;
        }

        @media (min-width: 992px) {
            body {
                padding-top: 0;
            }
            .content {
                margin-left: 250px;
                padding-top: 20px;
            }
        }
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #D9D9D9;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 0;
            transition: 0.3s;
            z-index: 1040;
            overflow: auto;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
            width: calc(100% - 250px);
            margin-top: 0;
        }

        @media (max-width: 991.98px) {
            body {
                padding-top: 56px;
            }
            .sidebar {
                top: 52px;
                height: calc(100vh - 52px);
            }
            .content {
                margin-left: 0;
                width: 100%;
            }
        }

/*        style for archives status*/
        .revision-none{
            background-color: lightgray;
            color: gray !important;
            padding: 5px;
            border-radius: 5px;
            justify-content: center;
            font-size: 14px;
        }
        .revision-pending{
            background-color: #2f8aff;
            color: white !important;
            padding: 5px;
            border-radius: 5px;
            justify-content: center;
            font-size: 14px;
        }
        .revision-rejected{
            background-color: #ff4a4a;
            color: white;
            padding: 5px;
            border-radius: 5px;
            justify-content: center;
            font-size: 14px;
        }
        .revision-finished{
            background-color: #31cb31;
            color: white;
            padding: 5px;
            border-radius: 5px;
            justify-content: center;
            font-size: 14px;
        }
    </style>
    <?php endif ?>
    <style>

      table.dataTable thead {
        background-color: #d9d9d9;
        color: #000000;
      }

      table.dataTable tbody tr:nth-child(even) {
        background-color: #f4f4f4;
      }

      table.dataTable tbody tr:hover {
        background-color: #eaeaea;
      }

      table.dataTable td, table.dataTable th {
        padding: 10px 14px;
        border: 1px solid #ddd;
      }

      table.dataTable tr{
      	border-color: transparent !important;
      }

      .dataTables_wrapper .dataTables_filter input {
        border: 1px solid #ccc;
        padding: 6px;
        border-radius: 4px;
      }

      .card-title{
        margin-bottom: 0 !important;
      }
    	.sticky-left{
    		position: sticky !important;
    		left: 63px !important;
    		z-index: 1;
            backdrop-filter: blur(50px);
    	}
    	thead tr th.sticky-left{
    		background: #d9d9d9;
    	}
    	.sticky-left-number{
    		left: 0 !important;
    	}
        .form-sub-title{
            margin-bottom: 15px;
            border-left: 5px solid lightgray;
            padding-left: 8px;
            font-size: 18px;
        }
        .form-sub-input{
            margin-left: 20px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 15px;
            border-bottom: 1px solid gainsboro;
            padding-bottom: 15px;
        }
        .form-sub-input input{
            height: 12px;
            width: 12px;
            margin-top: 3px;
        }
        .form-sub-input label{
            font-size: 13px !important;
        }
    </style>


</head>
<body class="poppins-thin">
    <body class="poppins-thin">
    <!-- Navbar Baru -->
    <nav class="top-navbar navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <button class="menu-toggle d-lg-none me-2" onclick="toggleMenu()">
                <i class="bi bi-list"></i>
            </button>
            
            <?php if(isset($user)): ?>
            <div class="ms-auto d-flex align-items-center">
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="me-2 text-end d-none d-sm-block">
                            <div class="fw-bold poppins-semibold"><?= $user->name ?></div>
                            <div class="small text-muted text-capitalize"><?= $user->role ?></div>
                        </div>
                        <div class="user-avatar">
                            <i class="bi bi-person-circle fs-3"></i>
                            <!-- Jika ingin pakai foto: -->
                            <img src="/uploads/<?= $user->photo ?? '' ?>" class="rounded-circle" width="32" height="32" onerror="this.onerror=null;this.src='data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%2232%22%20height%3D%2232%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%2032%2032%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_18a5b9a7e8a%20text%20%7B%20fill%3A%23ffffff%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A2pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_18a5b9a7e8a%22%3E%3Crect%20width%3D%2232%22%20height%3D%2232%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2211.546875%22%20y%3D%2216.9%22%3E32x32%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E'">
                           
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">
                        <li><a class="dropdown-item" href="{{ url('/profile') }}"><i class="bi bi-person me-2"></i> Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ url('/logout') }}"><i class="bi bi-box-arrow-right me-2"></i> Logout</a></li>
                    </ul>
                </div>
            </div>
            <?php endif ?>
        </div>
    </nav>
    <button class="menu-toggle" onclick="toggleMenu()"><i class="bi bi-list"></i></button>
    <div class="backdrop" id="backdrop" onclick="toggleMenu()"></div>
    <style type="text/css">
        .menu-category {
            padding: 10px 15px;
            margin-top: 15px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
            color: #858383;
        }
    </style>
    <nav class="sidebar" id="sidebar" style="padding-top:0;">
        <h4 class="mb-3">
            <a style="margin-right:0;margin-right: 0;
            white-space: pre-wrap;
            text-align: center;
            border-bottom: 2px solid white;
            background: #D9D9D9 !important;
            padding-top:0;
            padding-bottom: 20px;" class="navbar-brand d-flex align-items-center flex-column" href="{{ url('/') }}">
                  <img src="/uploads/{{ $settings->web_icon }}" style="width: 64px;height: 64px;object-fit: contain;">
                  <div style="font-size:12px;text-transform: uppercase;font-weight: bold;"><?= str_replace('<br>', ' ',$settings->web_title) ?></div>
              </a>
        </h4>
        <?php if(isset($user)): ?>
        <?php if($user->role === 'admin'): ?>
        <div class="menu-category">Administrator</div>
        <a href="{{ url('/admin/') }}"><i class="bi bi-house-door"></i> Dashboard</a>
        <div class="menu-category">Master Data</div>
        <a href="{{ url('/admin/users') }}"><i class="bi bi-people"></i> Master Akun</a>
        <a href="{{ url('/admin/prodi') }}"><i class="bi bi-layers"></i> Master Prodi</a>
        <a href="{{ url('/admin/jabatan') }}"><i class="bi bi-layers"></i> Master Jabatan</a>
        <a href="{{ url('/admin/criteria') }}"><i class="bi bi-layers"></i> Master Kriteria</a>
        <a href="{{ url('/admin/sub-criteria') }}"><i class="bi bi-layers"></i> Master Sub Kriteria</a>
        <a href="{{ url('/admin/sub-sub-criteria') }}"><i class="bi bi-layers"></i> Sub Sub Kriteria</a>
        <!-- <a href="{{ url('/admin/kredit-jabatan') }}"><i class="bi bi-layers"></i> Kredit Jabatan</a> -->
        <div class="menu-category">Publikasi Karya & Pengabdian</div>
        <a href="{{ url('/admin/poin-kredit-umum') }}"><i class="bi bi-layers"></i> Poin Kredit Umum</a>
        <a href="{{ url('/admin/poin-kredit-jenis') }}"><i class="bi bi-layers"></i> Poin Kredit Jenis</a>
        <a href="{{ url('/admin/poin-kredit-capaian') }}"><i class="bi bi-layers"></i> Kredit Capaian</a>
        <a href="{{ url('/admin/poin-kredit-kegiatan') }}"><i class="bi bi-layers"></i> Kredit Kegiatan</a>
        <div class="menu-category">Laporan</div>
        <a href="{{ url('/laporan-penilaian') }}"><i class="bi-file-earmark-text"></i> Laporan Penilaian</a>
        <div class="menu-category">Sistem</div>
        <a href="{{ url('/admin/settings') }}"><i class="bi bi-gear"></i> Pengaturan Web</a>
        <a href="{{ url('/profile') }}"><i class="bi bi-person"></i> Profil Akun</a>
        <?php elseif($user->role === 'staf'): ?>
        <div class="menu-category">Dashboard</div>
        <a href="{{ url('/staf/') }}"><i class="bi bi-house-door"></i> Dashboard</a>
        <div class="menu-category">Data Penilaian</div>
        <a href="{{ url('/staf/appointment') }}"><i class="bi bi-journal-check"></i> Data Pengajuan</a>
        <a href="{{ url('/laporan-penilaian') }}"><i class="bi-file-earmark-text"></i> Laporan Penilaian</a>
        <div class="menu-category">Publikasi Karya</div>
        <a href="{{ url('/staf/publikasi-karya') }}"><i class="bi-file-earmark-text"></i> Publikasi Karya</a>
        <a href="{{ url('/staf/pengabdian') }}"><i class="bi-file-earmark-text"></i> Pengabdian</a>
        <div class="menu-category">Pengajaran</div>
        <a href="{{ url('/staf/kredit-mata-kuliah') }}"><i class="bi-file-earmark-text"></i> Kredit Mata Kuliah</a>
        <a href="{{ url('/staf/pengajuan-pengajaran') }}"><i class="bi-file-earmark-text"></i> Data Pengajuan</a>
        <div class="menu-category">Sistem</div>
        <a href="{{ url('/profile') }}"><i class="bi bi-person"></i> Profil Akun</a>
        <?php else: ?>
        <div class="menu-category">Dashboard</div>
        <a href="{{ url('/dosen/') }}"><i class="bi bi-house-door"></i> Dashboard</a>
        <div class="menu-category">Data Penilaian</div>
        <a href="{{ url('/dosen/penilaian') }}"><i class="bi bi-journal-check"></i> Data Penilaian</a>
        <a href="{{ url('/dosen/status-pengajuan') }}"><i class="bi bi-hourglass-split"></i> Status Pengajuan</a>
        <div class="menu-category">Publikasi Karya</div>
        <a href="{{ url('/dosen/publikasi-karya') }}"><i class="bi-file-earmark-text"></i> Publikasi Karya</a>
        <a href="{{ url('/dosen/pengabdian') }}"><i class="bi-file-earmark-text"></i> Pengabdian</a>
        <div class="menu-category">Pengajaran</div>
        <a href="{{ url('/dosen/pengajaran') }}"><i class="bi-file-earmark-text"></i> Poin Pengajaran</a>
        <div class="menu-category">Laporan Penilaian</div>
        <a href="{{ url('/laporan-penilaian') }}"><i class="bi-file-earmark-text"></i> Laporan Penilaian</a>
        <div class="menu-category">Sistem</div>
        <a href="{{ url('/profile') }}"><i class="bi bi-person"></i> Profil Akun</a>
        <?php endif ?>
        <a href="{{ url('/logout') }}"><i class="bi bi-box-arrow-right"></i> Logout</a>
        <?php endif ?>
    </nav>
    <div class="content">
        <div class="container my-5" style="margin-top: 70px !important;">
            <?php include $content ?>
        </div>
    </div>

    <script>
        function toggleMenu() {
            let sidebar = document.getElementById("sidebar");
            let backdrop = document.getElementById("backdrop");
            if (sidebar.style.width === "250px") {
                sidebar.style.width = "0";
                backdrop.style.display = "none";
            } else {
                sidebar.style.width = "250px";
                backdrop.style.display = "block";
            }
        }

        function handleResize() {
            let sidebar = document.getElementById("sidebar");
            let backdrop = document.getElementById("backdrop");
            if (window.innerWidth > 991.98) {
                sidebar.style.width = "250px";
                backdrop.style.display = "none";
            } else {
                sidebar.style.width = "0";
            }
        }

        window.addEventListener("resize", handleResize);
        handleResize();
    </script>
    <!-- Bootstrap JS dan Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <script type="text/javascript">
        // working on button style
        document.querySelectorAll('.btn').forEach((item)=>{
            if(!item.classList.contains('btn-sm')){
                item.classList.add('btn-sm');
            }
        })
    </script>

</body>
</html>