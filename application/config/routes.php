<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['default_controller'] = 'login';

$route['profile'] = 'dashboard/profile';

// ======================= master data =================================
// akses
$route['akses'] = 'master/akses';
$route['add-akses'] = 'master/akses/add';
$route['edit-akses/(:any)'] = 'master/akses/update/$1';

// user
$route['user'] = 'master/user';
$route['add-user'] = 'master/user/add';
$route['edit-user/(:any)'] = 'master/user/update/$1';

// insentif mingguan
$route['mingguan'] = 'master/mingguan';

// ==================== insentif =============================
// mingguan
$route['insentif-mingguan'] = 'insentif/mingguan';
$route['add-mingguan'] = 'insentif/mingguan/add';
$route['edit-insentif-mingguan/(:any)'] = 'insentif/mingguan/update/$1';

// uang mingguan
$route['uang-mingguan'] = 'insentif/mingguanpegawai';

// gapok
$route['insentif-gapok'] = 'insentif/gapok';
$route['add-gapok'] = 'insentif/gapok/add';
$route['edit-gapok/(:any)'] = 'insentif/gapok/update/$1';


// ======================== report ============================
$route['report-absen'] = 'report/absensi';
$route['report-mingguan'] = 'report/mingguan';
$route['report-gapok'] = 'report/gapok';

















