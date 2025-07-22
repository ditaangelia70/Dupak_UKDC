<div class="app-content-header"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-3">Laporan Penilaian</h3>
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
                        <h3 class="card-title mb-0">Daftar Penilaian</h3>
                        <div>
                            <button id="exportExcel" class="btn btn-primary btn-sm">
                                <i class="bi bi-upload"></i> Export ke Excel
                            </button>
                        </div>
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
                                    <?php if($user->role !== 'dosen'): ?>
                                    <th>Nama Dosen</th>
                                    <th>NIP/NIDN</th>
                                    <th>Pangkat</th>
                                    <th>Seri Karpeg</th>
                                    <th>Jurusan</th>
                                    <th>Fakultas</th>
                                	<?php endif ?>
                                    <?php foreach($criteria as $item): ?>
                                    <th><?= $item['name'] ?></th>
                                    <?php endforeach ?>
                                    <th>Penelitian</th>
                                    <th>Pengabdian</th>
                                    <th>Pengajaran</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $index = 0; ?>
                                <?php foreach($data_laporan as $item): ?>
                                <?php $index += 1; ?>
                                <tr>
                                    <td style="width:100px !important;"><?= $index ?></td>
                                    <?php if($user->role !== 'dosen'): ?>
                                    <td>
                                        <div>
                                            <?= $item['name'] ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <?= $item['username'] ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <?= $item['pangkat'] ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <?= $item['seri_karpeg'] ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <?= $item['jurusan']['name'] ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <?= $item['fakultas'] ?>
                                        </div>
                                    </td>
                                    <?php endif ?>
                                    <?php foreach($criteria as $jtem): ?>
                                    <td>
                                        <div style="display: flex;gap: 6px;align-items: center;justify-content: space-between;">
                                            <div class="btn btn-sm btn-secondary w-100">
                                                <?= number_format($item[$jtem['name']],1) ?> pts
                                            </div>
                                            <button class="btn btn-primary btn-sm" onclick="printXl('<?= $jtem['name'] ?>', <?= $item['id'] ?>)">
                                                <i class="bi bi-printer"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <?php endforeach ?>
                                    <td>
                                        <div style="display: flex;gap: 6px;align-items: center;justify-content: space-between;">
                                            <div class="btn btn-sm btn-secondary w-100">
                                                <?= number_format($item['penelitian_total'],1) ?> pts
                                            </div>
                                            <button class="btn btn-primary btn-sm" onclick="printXl('Penelitian', <?= $item['id'] ?>)">
                                                <i class="bi bi-printer"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <td>
                                        <div style="display: flex;gap: 6px;align-items: center;justify-content: space-between;">
                                            <div class="btn btn-sm btn-secondary w-100">
                                                <?= number_format($item['pengabdian_total'],1) ?> pts
                                            </div>
                                            <button class="btn btn-primary btn-sm" onclick="printXl('Pengabdian', <?= $item['id'] ?>)">
                                                <i class="bi bi-printer"></i>
                                            </button>
                                        </div>
                                    </td>
                                     <td>
                                        <div style="display: flex;gap: 6px;align-items: center;justify-content: space-between;">
                                            <div class="btn btn-sm btn-secondary w-100">
                                                <?= number_format($item['pengajaran_total'],1) ?> pts
                                            </div>
                                            <button class="btn btn-primary btn-sm" onclick="printXl('Pengajaran', <?= $item['id'] ?>)">
                                                <i class="bi bi-printer"></i>
                                            </button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        let table = new DataTable('#myTable', {});
        
        document.getElementById('exportExcel').addEventListener('click', function() {
            let html = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">';
            html += '<head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>Laporan</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head>';
            html += '<body><table>';

            html += `<tr><td colspan="${$('#myTable thead th').length}" style="background-color:#D3D3D3;"></td></tr>`;
            html += `<tr><td colspan="${$('#myTable thead th').length}" style="text-align:center;font-weight:bold;font-size:16pt;background-color:#D3D3D3;">Laporan <?= $settings->web_title ?></td></tr>`;
            html += `<tr><td colspan="${$('#myTable thead th').length}" style="background-color:#D3D3D3;"></td></tr>`;
            
            html += '<tr style="background-color:#D3D3D3;font-weight:bold;">';
            $('#myTable thead th').each(function() {
                html += `<td style="border:1px solid black;font-size:13pt;">${$(this).text()}</td>`;
            });
            html += '</tr>';
            
            $('#myTable tbody tr').each(function() {
                html += '<tr>';
                $(this).find('td').each(function() {
                    let value = $(this).text().replace(' pts', '').trim();
                    html += `<td style="border:1px solid black;font-size:13pt;">${value}</td>`;
                });
                html += '</tr>';
            });
            
            html += '</table></body></html>';
            
            const blob = new Blob([html], {type: 'application/vnd.ms-excel'});
            const date = new Date().toISOString().slice(0, 10);
            saveAs(blob, `Laporan_Penilaian_${date}.xls`);
        });
    });

    const data_laporan = <?= json_encode($data_laporan) ?>;

    const printXl = (param, user_id)=>{
        let laporan = null;
        for(let i = 0;i < data_laporan.length;i++){
            if(
                data_laporan[i].id === user_id
            ){
                laporan = data_laporan[i];
                break;
            }
        }
        if(!laporan)
            return Swal.fire({icon:'error',text:'Tidak cukup data untuk mengekspor!',title:'Error!'});

        const sub_sub_criteria_valid = [];
        laporan.credit.forEach(item=>{
            if(param === item.sub_sub_criteria.sub_criteria.criteria.name){
                sub_sub_criteria_valid.push(item);
            }
        });

        const user_publikasi_karya = laporan.publikasi_karya;
        const pengabdian_user = laporan.pengabdian;
        const pengajaran_user = laporan.pengajaran;

        if((param !== 'Penelitian' && param !== 'Pengabdian' && param !== 'Pengajaran') && sub_sub_criteria_valid.length === 0)
            return Swal.fire({icon:'error',text:'Tidak cukup data untuk mengekspor!',title:'Error!'});

        if(param === 'Penelitian' && laporan.publikasi_karya.length === 0)
            return Swal.fire({icon:'error',text:'Tidak cukup data untuk mengekspor!',title:'Error!'});

        if(param === 'Pengabdian' && laporan.pengabdian.length === 0)
            return Swal.fire({icon:'error',text:'Tidak cukup data untuk mengekspor!',title:'Error!'});

        if(param === 'Pengajaran' && laporan.pengajaran.length === 0)
            return Swal.fire({icon:'error',text:'Tidak cukup data untuk mengekspor!',title:'Error!'});

        const uri = 'data:application/vnd.ms-excel;base64,';
        if(param === 'Penelitian'){
            template = `
                <html xmlns:o="urn:schemas-microsoft-com:office:office" 
                      xmlns:x="urn:schemas-microsoft-com:office:excel" 
                      xmlns="http://www.w3.org/TR/REC-html40">
                <head>
                  <meta charset="UTF-8">
                  <style>
                    body {
                      font-family: calibri;
                    }
                    .border-bottom {
                      border-bottom: 1px solid white;
                    }
                    .border-top {
                      border-top: 1px solid black;
                    }
                    table {
                      border-collapse: collapse;
                      width: 100%;
                    }
                    td {
                      padding: 5px;
                    }
                    .table-data {
                      border: 1px solid black;
                    }
                    .table-data td {
                      border: 1px solid black;
                    }
                    .text-center {
                      text-align: center;
                    }
                    .indent {
                      padding-left: 30px;
                    }
                  </style>
                </head>
                <body>
                  <div class="text-center">
                    <h2>SURAT PERNYATAAN<br>
                    MELAKSANAKAN ${param.toUpperCase()}</h2>
                  </div>
                  
                  <div>Menyatakan bahwa :</div>
                  <br>
                  
                  <table>
                    <tr>
                      <td class="indent">Nama</td>
                      <td class="border-bottom">: ${laporan.name}</td>
                    </tr>
                    <tr>
                      <td class="indent">NIP</td>
                      <td class="border-bottom">: ${laporan.username}</td>
                    </tr>
                    <tr>
                      <td class="indent">Pangkat/golongan</td>
                      <td class="border-bottom">: ${laporan.pangkat}</td>
                    </tr>
                    <tr>
                      <td class="indent">ruang/TMT</td>
                      <td class="border-bottom">: -</td>
                    </tr>
                    <tr>
                      <td class="indent">Jabatan</td>
                      <td class="border-bottom">: ${laporan.pangkat}</td>
                    </tr>
                    <tr>
                      <td class="indent">Unit Kerja</td>
                      <td class="border-bottom">: -</td>
                    </tr>
                  </table>
                  
                  <br>
                  <div>Telah melaksanakan ${param.toLowerCase()} sebagai berikut :</div>
                  <br>
                  
                  <table class="table-data">
                    <tr class="border-top border-bottom">
                        <td class="text-center">No</td>
                        <td class="text-center">Uraian Kegiatan</td>
                        <td class="text-center">Tanggal</td>
                        <td class="text-center">Satuan Hasil</td>
                        <td class="text-center">Jumlah Volume Kegiatan</td>
                        <td class="text-center">Angka Kredit</td>
                        <td class="text-center">Jumlah Angka Kredit</td>
                        <td class="text-center">Keterangan/bukti fisik</td>
                    </tr>
            		${user_publikasi_karya.map((publikasi,i)=>{
            			return `
            			<tr>
	                        <td class="text-center">${i+1}</td>
	                        <td>Publikasi "${publikasi.judul_artikel}" di Seminar ${publikasi.nama_seminar}</td>
	                        <td>${publikasi.tanggal_terbit}</td>
	                        <td>Karya</td>
	                        <td>1</td>
	                        <td>${publikasi.kredit}</td>
	                        <td>${publikasi.kredit}</td>
	                        <td>${publikasi.tautan_eksternal}</td>
	                    </tr>`;
					})}
                </table>
                  
                  <br><br>
                  <div>Demikian pernyataan ini dibuat untuk dapat dipergunakan sebagaimana mestinya.</div>
                  <br><br><br><br>
                  
                  <table>
                    <tr>
                      <td colspan="8" style="text-align: right;">………………..,………………………..</td>
                    </tr>
                    <tr>
                      <td colspan="8" style="text-align: right;">Ketua Jurusan/Ketua Prodi</td>
                    </tr>
                    <tr><td colspan="8"><br></td></tr>
                    <tr>
                      <td colspan="8" style="text-align: right;">NIP/NIDN: </td>
                    </tr>
                  </table>
                </body>
            </html>`;
        }else if(param === 'Pengabdian'){
            template = `
                <html xmlns:o="urn:schemas-microsoft-com:office:office" 
                      xmlns:x="urn:schemas-microsoft-com:office:excel" 
                      xmlns="http://www.w3.org/TR/REC-html40">
                <head>
                  <meta charset="UTF-8">
                  <style>
                    body {
                      font-family: calibri;
                    }
                    .border-bottom {
                      border-bottom: 1px solid white;
                    }
                    .border-top {
                      border-top: 1px solid black;
                    }
                    table {
                      border-collapse: collapse;
                      width: 100%;
                    }
                    td {
                      padding: 5px;
                    }
                    .table-data {
                      border: 1px solid black;
                    }
                    .table-data td {
                      border: 1px solid black;
                    }
                    .text-center {
                      text-align: center;
                    }
                    .indent {
                      padding-left: 30px;
                    }
                  </style>
                </head>
                <body>
                  <div class="text-center">
                    <h2>SURAT PERNYATAAN<br>
                    MELAKSANAKAN ${param.toUpperCase()}</h2>
                  </div>
                  
                  <div>Menyatakan bahwa :</div>
                  <br>
                  
                  <table>
                    <tr>
                      <td class="indent">Nama</td>
                      <td class="border-bottom">: ${laporan.name}</td>
                    </tr>
                    <tr>
                      <td class="indent">NIP</td>
                      <td class="border-bottom">: ${laporan.username}</td>
                    </tr>
                    <tr>
                      <td class="indent">Pangkat/golongan</td>
                      <td class="border-bottom">: ${laporan.pangkat}</td>
                    </tr>
                    <tr>
                      <td class="indent">ruang/TMT</td>
                      <td class="border-bottom">: -</td>
                    </tr>
                    <tr>
                      <td class="indent">Jabatan</td>
                      <td class="border-bottom">: ${laporan.pangkat}</td>
                    </tr>
                    <tr>
                      <td class="indent">Unit Kerja</td>
                      <td class="border-bottom">: -</td>
                    </tr>
                  </table>
                  
                  <br>
                  <div>Telah melaksanakan ${param.toLowerCase()} sebagai berikut :</div>
                  <br>
                  
                  <table class="table-data">
                    <tr class="border-top border-bottom">
                      <td class="text-center">No</td>
                      <td class="text-center">Uraian Kegiatan</td>
                      <td class="text-center">Tanggal</td>
                      <td class="text-center">Satuan Hasil</td>
                      <td class="text-center">Jumlah Volume Kegiatan</td>
                      <td class="text-center">Angka Kredit</td>
                      <td class="text-center">Jumlah Angka Kredit</td>
                      <td class="text-center">Keterangan/bukti fisik</td>
                    </tr>
                    ${pengabdian_user.map((pengabdian, i)=>{
                        return `
                            <tr>
                              <td class="text-center">${i + 1}</td>
                              <td>Pengabdian di ${pengabdian.lokasi_kegiatan}</td>
                              <td>${pengabdian.tanggal_sk}</td>
                              <td>${pengabdian.jenis_skim}</td>
                              <td>1</td>
                              <td>${pengabdian.kredit}</td>
                              <td>${pengabdian.kredit}</td>
                              <td>-</td>
                            </tr>
                            `;
                    })}
                  </table>
                  
                  <br><br>
                  <div>Demikian pernyataan ini dibuat untuk dapat dipergunakan sebagaimana mestinya.</div>
                  <br><br><br><br>
                  
                  <table>
                    <tr>
                      <td colspan="8" style="text-align: right;">………………..,………………………..</td>
                    </tr>
                    <tr>
                      <td colspan="8" style="text-align: right;">Ketua Jurusan/Ketua Prodi</td>
                    </tr>
                    <tr><td colspan="8"><br></td></tr>
                    <tr>
                      <td colspan="8" style="text-align: right;">NIP/NIDN: </td>
                    </tr>
                  </table>
                </body>
            </html>`;
        }else if(param === 'Pengajaran'){
            template = `
                <html xmlns:o="urn:schemas-microsoft-com:office:office" 
                      xmlns:x="urn:schemas-microsoft-com:office:excel" 
                      xmlns="http://www.w3.org/TR/REC-html40">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>DAFTAR USUL PENETAPAN ANGKA KREDIT JABATAN AKADEMIK DOSEN</title>
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            margin: 0;
                            padding: 20px;
                        }
                        .header {
                            text-align: center;
                            margin-bottom: 20px;
                        }
                        .header h1 {
                            font-size: 14pt;
                            margin-bottom: 5px;
                        }
                        .header p {
                            font-size: 11pt;
                            margin-top: 0;
                        }
                        table {
                            width: 100%;
                            border-collapse: collapse;
                            margin-bottom: 20px;
                        }
                        th, td {
                            border: 1px solid #000;
                            padding: 5px;
                            vertical-align: top;
                        }
                        th {
                            background-color: #f2f2f2;
                            text-align: center;
                            font-weight: bold;
                        }
                        .bold {
                            font-weight: bold;
                        }
                        .center {
                            text-align: center;
                        }
                        .left {
                            text-align: left;
                        }
                        .border-bottom {
                            border-bottom: 1px solid #000;
                        }
                        .no-border {
                            border: none;
                        }
                        .signature {
                            margin-top: 50px;
                            text-align: right;
                        }
                    </style>
                </head>
                <body>
                    <div class="header">
                        <h1>DAFTAR USUL PENETAPAN ANGKA KREDIT JABATAN AKADEMIK DOSEN</h1>
                        <p>Nomor : .............................</p>
                    </div>

                    <table>
                        <tr>
                            <td colspan="6">UNIT KERJA : ${pengajaran_user[0]?.user?.fakultas || '.......................'}</td>
                            <td colspan="6">MASA PENILAIAN : ${pengajaran_user[0]?.tahun_ajaran || '............................'}</td>
                        </tr>
                    </table>

                    <table>
                        <tr>
                            <th width="5%">NO</th>
                            <th colspan="11">KETERANGAN PERORANGAN</th>
                        </tr>
                        <tr>
                            <td class="center">1.</td>
                            <td colspan="5">Nama</td>
                            <td colspan="6">${pengajaran_user[0]?.user?.name || ''}</td>
                        </tr>
                        <tr>
                            <td class="center">2.</td>
                            <td colspan="5">NIP/NIDN</td>
                            <td colspan="6">${pengajaran_user[0]?.user?.seri_karpeg || ''}</td>
                        </tr>
                        <tr>
                            <td class="center">3.</td>
                            <td colspan="5">Tempat dan Tanggal Lahir</td>
                            <td colspan="6">${pengajaran_user[0]?.user?.tempat_tanggal_lahir || ''}</td>
                        </tr>
                        <tr>
                            <td class="center">4.</td>
                            <td colspan="5">Jenis Kelamin</td>
                            <td colspan="6"></td>
                        </tr>
                        <tr>
                            <td class="center">5.</td>
                            <td colspan="5">Pendidikan Terakhir</td>
                            <td colspan="6"></td>
                        </tr>
                        <tr>
                            <td class="center">6.</td>
                            <td colspan="5">Jabatan Akademik Dosen, Angka Kredit/TMT</td>
                            <td colspan="6">${pengajaran_user[0]?.user?.pangkat || ''}</td>
                        </tr>
                        <tr>
                            <td rowspan="2"></td>
                            <td>a.</td>
                            <td colspan="4">Jurusan/Program Studi</td>
                            <td colspan="6">${pengajaran_user[0]?.user?.jurusan?.name || ''}</td>
                        </tr>
                        <tr>
                            <td>b.</td>
                            <td colspan="4">Bidang Ilmu</td>
                            <td colspan="6"></td>
                        </tr>
                        <tr>
                            <td class="center">7.</td>
                            <td colspan="5">Pangkat dan Golongan Ruang/TMT</td>
                            <td colspan="6">${pengajaran_user[0]?.user?.pangkat || ''}</td>
                        </tr>
                        <tr>
                            <td class="center">8.</td>
                            <td colspan="5">Masa kerja golongan lama</td>
                            <td colspan="6"></td>
                        </tr>
                        <tr>
                            <td class="center">9.</td>
                            <td colspan="5">Masa kerja golongan baru</td>
                            <td colspan="6"></td>
                        </tr>
                        <tr>
                            <td class="center">10.</td>
                            <td colspan="5">Unit Kerja</td>
                            <td colspan="6">${pengajaran_user[0]?.user?.fakultas || ''}</td>
                        </tr>
                    </table>

                    <table>
                        <tr>
                            <th rowspan="4" width="5%">NO</th>
                            <th colspan="11">UNSUR YANG DINILAI</th>
                        </tr>
                        <tr>
                            <th colspan="6">UNSUR, SUB UNSUR DAN BUTIR KEGIATAN</th>
                            <th colspan="5">ANGKA KREDIT MENURUT</th>
                        </tr>
                        <tr>
                            <th colspan="6"></th>
                            <th colspan="5">INSTANSI PENGUSUL</th>
                        </tr>
                        <tr>
                            <th colspan="6"></th>
                            <th>SKS</th>
                            <th>KREDIT</th>
                            <th colspan="3">JUMLAH</th>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="6"></td>
                            <td></td>
                            <td></td>
                            <td colspan="3"></td>
                        </tr>
                    </table>

                    <!-- Bagian Pengajaran -->
                    <table>
                        <tr>
                            <td class="bold center" rowspan="${pengajaran_user.length + 2}">I</td>
                            <td class="bold" colspan="6">PENGAJARAN</td>
                            <td></td>
                            <td></td>
                            <td colspan="3"></td>
                        </tr>
                        ${pengajaran_user.map((item, index) => `
                        <tr>
                            <td>${index + 1}</td>
                            <td colspan="5">${item.kredit_pengajaran_mata_kuliah?.name || ''} (${item.semester} ${item.tahun_ajaran}, ${item.kelompok})</td>
                            <td>${item.sks || '0'}</td>
                            <td>${item.kredit_pengajaran_mata_kuliah?.credit || ''}</td>
                            <td colspan="3">${item.kredit_pengajaran_mata_kuliah.credit * item.sks}</td>
                        </tr>
                        `).join('')}
                        <tr>
                            <td></td>
                            <td class="bold" colspan="5">JUMLAH</td>
                            <td></td>
                            <td></td>
                            <td colspan="3">${pengajaran_user.reduce((sum, item) => sum + (item.kredit_pengajaran_mata_kuliah.credit * item.sks), 0)}</td>
                        </tr>
                    </table>

                    <!-- Bagian Bahan yang Dinilai hingga Akhir -->
                    <table>
                        <tr>
                            <td class="bold" colspan="12">BAHAN YANG DINILAI :</td>
                        </tr>
                        <tr>
                            <td colspan="6">Nama</td>
                            <td colspan="6">: ${pengajaran_user[0]?.user?.name || ''}</td>
                        </tr>
                        <tr>
                            <td colspan="6">NIP / NIDN</td>
                            <td colspan="6">: ${pengajaran_user[0]?.user?.seri_karpeg || ''}</td>
                        </tr>
                        <tr>
                            <td colspan="6">Jabatan, tmt</td>
                            <td colspan="6">: ${pengajaran_user[0]?.user?.pangkat || ''}</td>
                        </tr>
                        <tr>
                            <td colspan="6">Pangkat, tmt.</td>
                            <td colspan="6">: ${pengajaran_user[0]?.user?.pangkat || ''}</td>
                        </tr>
                        <tr>
                            <td colspan="6">Bidang Ilmu</td>
                            <td colspan="6">: ${pengajaran_user[0]?.user?.jurusan.name || ''}</td>
                        </tr>
                        <tr>
                            <td colspan="6" style="border-bottom:0;"></td>
                            <td colspan="6">.......................<br>a.n. Pimpinan,<br>.......................</td>
                        </tr>
                    </table>

                    <table>
                        <tr>
                            <td colspan="6" style="border-top:0;">Telah memenuhi syarat angka kredit untuk kenaikan Jabatan dan Pangkat menjadi :</td>
                            <td colspan="6" rowspan="3">
                                <div class="signature">
                                    Surabaya,<br>
                                    Kepala LLDIKTI Wilayah VII<br>
                                    <br>
                                    <br>
                                    <br>
                                    NIP ..........................<br><br>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">Jabatan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: ..........................................</td>
                        </tr>
                        <tr>
                            <td colspan="6">Pangkat/Gol. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: ..........................................</td>
                        </tr>
                    </table>
                </body>
                </html>`;
        }else{
            template = `
                <html xmlns:o="urn:schemas-microsoft-com:office:office" 
                      xmlns:x="urn:schemas-microsoft-com:office:excel" 
                      xmlns="http://www.w3.org/TR/REC-html40">
                <head>
                  <meta charset="UTF-8">
                  <style>
                    body {
                      font-family: calibri;
                    }
                    .border-bottom {
                      border-bottom: 1px solid white;
                    }
                    .border-top {
                      border-top: 1px solid black;
                    }
                    table {
                      border-collapse: collapse;
                      width: 100%;
                    }
                    td {
                      padding: 5px;
                    }
                    .table-data {
                      border: 1px solid black;
                    }
                    .table-data td {
                      border: 1px solid black;
                    }
                    .text-center {
                      text-align: center;
                    }
                    .indent {
                      padding-left: 30px;
                    }
                  </style>
                </head>
                <body>
                  <div class="text-center">
                    <h2>SURAT PERNYATAAN<br>
                    MELAKSANAKAN ${param.toUpperCase()}</h2>
                  </div>
                  
                  <div>Menyatakan bahwa :</div>
                  <br>
                  
                  <table>
                    <tr>
                      <td class="indent">Nama</td>
                      <td class="border-bottom">: ${laporan.name}</td>
                    </tr>
                    <tr>
                      <td class="indent">NIP</td>
                      <td class="border-bottom">: ${laporan.username}</td>
                    </tr>
                    <tr>
                      <td class="indent">Pangkat/golongan</td>
                      <td class="border-bottom">: ${laporan.pangkat}</td>
                    </tr>
                    <tr>
                      <td class="indent">ruang/TMT</td>
                      <td class="border-bottom">: -</td>
                    </tr>
                    <tr>
                      <td class="indent">Jabatan</td>
                      <td class="border-bottom">: ${laporan.pangkat}</td>
                    </tr>
                    <tr>
                      <td class="indent">Unit Kerja</td>
                      <td class="border-bottom">: -</td>
                    </tr>
                  </table>
                  
                  <br>
                  <div>Telah melaksanakan ${param.toLowerCase()} sebagai berikut :</div>
                  <br>
                  
                  <table class="table-data">
                    <tr class="border-top border-bottom">
                      <td class="text-center">No</td>
                      <td class="text-center">Uraian Kegiatan</td>
                      <td class="text-center">Tanggal</td>
                      <td class="text-center">Satuan Hasil</td>
                      <td class="text-center">Jumlah Volume Kegiatan</td>
                      <td class="text-center">Angka Kredit</td>
                      <td class="text-center">Jumlah Angka Kredit</td>
                      <td class="text-center">Keterangan/bukti fisik</td>
                    </tr>
                    ${sub_sub_criteria_valid.map((valid, i)=>{
                        return `
                            <tr>
                              <td class="text-center">${i + 1}</td>
                              <td>${valid.sub_sub_criteria.name}</td>
                              <td>${valid.sub_sub_criteria.archives.length > 0 ? valid.sub_sub_criteria.archives[valid.sub_sub_criteria.archives.length-1].commented_at : '-'}</td>
                              <td>${valid.sub_sub_criteria.unit}</td>
                              <td>${valid.qty}</td>
                              <td>${valid.sub_sub_criteria.credit}</td>
                              <td>${valid.sub_sub_criteria.credit * valid.qty}</td>
                              <td>${valid.sub_sub_criteria.archives.length > 0 ? '<?= url('/uploads') ?>/'+valid.sub_sub_criteria.archives[valid.sub_sub_criteria.archives.length-1].url : '-'}</td>
                            </tr>
                            `;
                    })}
                  </table>
                  
                  <br><br>
                  <div>Demikian pernyataan ini dibuat untuk dapat dipergunakan sebagaimana mestinya.</div>
                  <br><br><br><br>
                  
                  <table>
                    <tr>
                      <td colspan="8" style="text-align: right;">………………..,………………………..</td>
                    </tr>
                    <tr>
                      <td colspan="8" style="text-align: right;">Ketua Jurusan/Ketua Prodi</td>
                    </tr>
                    <tr><td colspan="8"><br></td></tr>
                    <tr>
                      <td colspan="8" style="text-align: right;">NIP/NIDN: </td>
                    </tr>
                  </table>
                </body>
            </html>`;
        }

        const base64 = s => window.btoa(unescape(encodeURIComponent(s)));
        const data = uri + base64(template);

        const link = document.createElement("a");
        link.href = data;
        link.download = `Surat_Pernyataan_${param}.xls`;
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }
</script>