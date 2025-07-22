<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

$router->get('/login','AuthController@show_login');
$router->get('/', 'Controller@home');
$router->get('/logout', 'AuthController@logout');

$router->get('/profile', 'Controller@profile');
$router->post('/profile', 'Controller@profile');

$router->get('/laporan-penilaian', 'Controller@laporan_penilaian');

$router->group(['prefix' => 'admin'], function () use ($router) {
    $router->group(['middleware' => 'auth.jwt'], function () use ($router) {
        $router->get('/', 'AdminController@home');
        $router->get('/users', 'AdminController@users');
        $router->post('/users', 'AdminController@users');
        $router->get('/criteria', 'AdminController@criteria');
        $router->post('/criteria', 'AdminController@criteria');
        $router->get('/sub-criteria', 'AdminController@sub_criteria');
        $router->post('/sub-criteria', 'AdminController@sub_criteria');
        $router->get('/sub-sub-criteria', 'AdminController@sub_sub_criteria');
        $router->post('/sub-sub-criteria', 'AdminController@sub_sub_criteria');
        $router->get('/settings', 'AdminController@settings');
        $router->post('/settings', 'AdminController@settings');
        $router->get('/appointment', 'AdminController@appointment');
        $router->post('/appointment/update', 'AdminController@appointment_update');
        $router->get('/catatan-berkas', 'AdminController@catatan_berkas');
        $router->post('/catatan-berkas', 'AdminController@catatan_berkas');
        $router->get('/upload-berkas', 'AdminController@upload_berkas');
        $router->post('/upload-berkas', 'AdminController@upload_berkas');
        $router->get('/jabatan', 'AdminController@jabatan');
        $router->post('/jabatan', 'AdminController@jabatan');
        $router->get('/kredit-jabatan', 'AdminController@kredit_jabatan');
        $router->post('/kredit-jabatan', 'AdminController@kredit_jabatan');
        $router->get('/poin-kredit-umum', 'AdminController@pk_umum');
        $router->post('/poin-kredit-umum', 'AdminController@pk_umum');
        $router->get('/poin-kredit-jenis', 'AdminController@pk_jenis');
        $router->post('/poin-kredit-jenis', 'AdminController@pk_jenis');
        $router->get('/poin-kredit-capaian', 'AdminController@pk_capaian');
        $router->post('/poin-kredit-capaian', 'AdminController@pk_capaian');
        $router->get('/poin-kredit-kegiatan', 'AdminController@pk_kegiatan');
        $router->post('/poin-kredit-kegiatan', 'AdminController@pk_kegiatan');
        $router->get('/prodi', 'AdminController@prodi');
        $router->post('/prodi', 'AdminController@prodi');
    });
});

$router->group(['prefix' => 'dosen'], function () use ($router) {
    $router->group(['middleware' => 'auth.jwt'], function () use ($router) {
        $router->get('/', 'DosenController@home');
        $router->get('/penilaian', 'DosenController@penilaian');
        $router->post('/penilaian', 'DosenController@penilaian');
        $router->get('/upload-berkas', 'DosenController@upload_berkas');
        $router->post('/upload-berkas', 'DosenController@upload_berkas');
        $router->get('/catatan-berkas', 'DosenController@catatan_berkas');
        $router->get('/status-pengajuan', 'DosenController@status_pengajuan');
        $router->get('/publikasi-karya', 'DosenController@publikasi_karya');
        $router->post('/publikasi-karya', 'DosenController@publikasi_karya');
        $router->get('/pengabdian', 'DosenController@pengabdian');
        $router->post('/pengabdian', 'DosenController@pengabdian');
        $router->get('/pengajaran', 'DosenController@pengajaran');
        $router->post('/pengajaran', 'DosenController@pengajaran');
    });
});


$router->group(['prefix' => 'staf'], function () use ($router) {
    $router->group(['middleware' => 'auth.jwt'], function () use ($router) {
        $router->get('/', 'StafController@home');
        $router->get('/appointment', 'StafController@appointment');
        $router->post('/appointment/update', 'StafController@appointment_update');
        $router->get('/catatan-berkas', 'StafController@catatan_berkas');
        $router->post('/catatan-berkas', 'StafController@catatan_berkas');
        $router->get('/upload-berkas', 'StafController@upload_berkas');
        $router->post('/upload-berkas', 'StafController@upload_berkas');
        $router->get('/pengabdian', 'StafController@pengabdian');
        $router->post('/pengabdian', 'StafController@pengabdian');
        $router->get('/publikasi-karya', 'StafController@publikasi_karya');
        $router->post('/publikasi-karya', 'StafController@publikasi_karya');
        $router->post('/special-update-status', 'StafController@spesial_update');
        $router->get('/kredit-mata-kuliah', 'StafController@kredit_mata_kuliah');
        $router->post('/kredit-mata-kuliah', 'StafController@kredit_mata_kuliah');
        $router->get('/pengajuan-pengajaran', 'StafController@pengajuan_pengajaran');
        $router->post('/pengajuan-pengajaran', 'StafController@pengajuan_pengajaran');
    });
});

$router->group(['prefix' => 'api'], function () use ($router) {
    // Auth Routes
    $router->post('login', 'AuthController@login');
});
