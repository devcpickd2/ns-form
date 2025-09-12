<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'auth/login';
$route['login'] = 'auth/login';
$route['home'] = 'home';
$route['profil'] = 'profil/index';

$route['api/user-sync']['post']       = 'User/syncApi';
$route['api/user-desync']             = 'User/desyncApi'; 
$route['api/activation']['post']      = 'User/activation';
$route['api/password-change']['post'] = 'User/changePassword';

// $route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// $route['login'] = 'auth/login';
$route['logout'] = 'auth/logout';
$route['departemen'] = 'departemen';
$route['departemen/tambah'] = 'departemen/tambah';
$route['departemen/edit/(:any)'] = 'departemen/edit/$1';
$route['departemen/delete/(:any)'] = 'departemen/delete/$1';

$route['plant'] = 'plant';
$route['plant/tambah'] = 'plant/tambah';
$route['plant/edit/(:any)'] = 'plant/edit/$1';
$route['plant/delete/(:any)'] = 'plant/delete/$1';

$route['pegawai'] = 'pegawai';
$route['pegawai/tambah'] = 'pegawai/tambah';
$route['pegawai/edit/(:any)'] = 'pegawai/edit/$1';
$route['pegawai/edituser/(:any)'] = 'pegawai/edituser/$1';
$route['pegawai/editpass/(:any)'] = 'pegawai/editpass/$1';
$route['pegawai/delete/(:any)'] = 'pegawai/delete/$1';

$route['pengayakan'] = 'form/pengayakan';
$route['pengayakan/tambah'] = 'form/pengayakan/tambah';
$route['pengayakan/edit/(:any)'] = 'form/pengayakan/edit/$1';
$route['pengayakan/detail/(:any)'] = 'form/pengayakan/detail/$1';
$route['pengayakan/verifikasi'] = 'form/pengayakan/verifikasi';
$route['pengayakan/status/(:any)'] = 'form/pengayakan/status/$1';
$route['pengayakan/cetak'] = 'form/pengayakan/cetak';
$route['pengayakan/diketahui'] = 'form/pengayakan/diketahui';
$route['pengayakan/statusprod/(:any)'] = 'form/pengayakan/statusprod/$1';
$route['pengayakan/delete/(:any)'] = 'form/pengayakan/delete/$1';

$route['produksi'] = 'form/produksi';
$route['produksi/tambah'] = 'form/produksi/tambah';
$route['produksi/detail/(:any)'] = 'form/produksi/detail/$1';
$route['produksi/edit/(:any)'] = 'form/produksi/edit/$1';
$route['produksi/packing/(:any)'] = 'form/produksi/packing/$1';
$route['produksi/verifikasi'] = 'form/produksi/verifikasi';
$route['produksi/status/(:any)'] = 'form/produksi/status/$1';
$route['produksi/diketahui'] = 'form/produksi/diketahui';
$route['produksi/statusprod/(:any)'] = 'form/produksi/statusprod/$1';
$route['produksi/delete/(:any)'] = 'form/produksi/delete/$1';
$route['produksi/get_nama_produk_by_tanggal'] = 'form/produksi/get_nama_produk_by_tanggal';
$route['produksi/cetak'] = 'form/produksi/cetak';
$route['produksi/export_excel'] = 'form/produksi/export_excel';
// $route['remove-premix'] = 'form/removePremix';

$route['metal'] = 'form/metal';
$route['metal/tambah'] = 'form/metal/tambah';
$route['metal/detail/(:any)'] = 'form/metal/detail/$1';
$route['metal/edit/(:any)'] = 'form/metal/edit/$1';
$route['metal/edit2/(:any)'] = 'form/metal/edit2/$1';
$route['metal/edit3/(:any)'] = 'form/metal/edit3/$1';
$route['metal/verifikasi'] = 'form/metal/verifikasi';
$route['metal/status/(:any)'] = 'form/metal/status/$1';
$route['metal/cetak'] = 'form/metal/cetak';
$route['metal/diketahui'] = 'form/metal/diketahui';
$route['metal/statusprod/(:any)'] = 'form/metal/statusprod/$1';
$route['metal/delete/(:any)'] = 'form/metal/delete/$1';

$route['falserejection'] = 'form/falserejection';
$route['falserejection/tambah'] = 'form/falserejection/tambah';
$route['falserejection/detail/(:any)'] = 'form/falserejection/detail/$1';
$route['falserejection/edit/(:any)'] = 'form/falserejection/edit/$1';
$route['falserejection/verifikasi'] = 'form/falserejection/verifikasi';
$route['falserejection/status/(:any)'] = 'form/falserejection/status/$1';
$route['falserejection/cetak'] = 'form/falserejection/cetak';
$route['falserejection/diketahui'] = 'form/falserejection/diketahui';
$route['falserejection/statusprod/(:any)'] = 'form/falserejection/statusprod/$1';
$route['falserejection/delete/(:any)'] = 'form/falserejection/delete/$1';

$route['kontaminasi'] = 'form/kontaminasi';
$route['kontaminasi/tambah'] = 'form/kontaminasi/tambah';
$route['kontaminasi/detail/(:any)'] = 'form/kontaminasi/detail/$1';
$route['kontaminasi/edit/(:any)'] = 'form/kontaminasi/edit/$1';
$route['kontaminasi/verifikasi'] = 'form/kontaminasi/verifikasi';
$route['kontaminasi/status/(:any)'] = 'form/kontaminasi/status/$1';
$route['kontaminasi/cetak'] = 'form/kontaminasi/cetak';
$route['kontaminasi/diketahui'] = 'form/kontaminasi/diketahui';
$route['kontaminasi/statusprod/(:any)'] = 'form/kontaminasi/statusprod/$1';
$route['kontaminasi/delete/(:any)'] = 'form/kontaminasi/delete/$1';

$route['kekuatanmagnet'] = 'form/kekuatanmagnet';
$route['kekuatanmagnet/tambah'] = 'form/kekuatanmagnet/tambah';
$route['kekuatanmagnet/detail/(:any)'] = 'form/kekuatanmagnet/detail/$1';
$route['kekuatanmagnet/edit/(:any)'] = 'form/kekuatanmagnet/edit/$1';
$route['kekuatanmagnet/verifikasi'] = 'form/kekuatanmagnet/verifikasi';
$route['kekuatanmagnet/status/(:any)'] = 'form/kekuatanmagnet/status/$1';
$route['kekuatanmagnet/cetak'] = 'form/kekuatanmagnet/cetak';
$route['kekuatanmagnet/diketahui'] = 'form/kekuatanmagnet/diketahui';
$route['kekuatanmagnet/statusprod/(:any)'] = 'form/kekuatanmagnet/statusprod/$1';
$route['kekuatanmagnet/delete/(:any)'] = 'form/kekuatanmagnet/delete/$1';

$route['verifikasimagnet'] = 'form/verifikasimagnet';
$route['verifikasimagnet/tambah'] = 'form/verifikasimagnet/tambah';
$route['verifikasimagnet/detail/(:any)'] = 'form/verifikasimagnet/detail/$1';
$route['verifikasimagnet/edit/(:any)'] = 'form/verifikasimagnet/edit/$1';
$route['verifikasimagnet/verifikasi'] = 'form/verifikasimagnet/verifikasi';
$route['verifikasimagnet/status/(:any)'] = 'form/verifikasimagnet/status/$1';
$route['verifikasimagnet/cetak'] = 'form/verifikasimagnet/cetak';
$route['verifikasimagnet/diketahui'] = 'form/verifikasimagnet/diketahui';
$route['verifikasimagnet/statusprod/(:any)'] = 'form/verifikasimagnet/statusprod/$1';
$route['verifikasimagnet/delete/(:any)'] = 'form/verifikasimagnet/delete/$1';

$route['timbangan'] = 'form/timbangan';
$route['timbangan/tambah'] = 'form/timbangan/tambah';
$route['timbangan/detail/(:any)'] = 'form/timbangan/detail/$1';
$route['timbangan/edit/(:any)'] = 'form/timbangan/edit/$1';
$route['timbangan/verifikasi'] = 'form/timbangan/verifikasi';
$route['timbangan/status/(:any)'] = 'form/timbangan/status/$1';
$route['timbangan/cetak'] = 'form/timbangan/cetak';
$route['timbangan/diketahui'] = 'form/timbangan/diketahui';
$route['timbangan/statusprod/(:any)'] = 'form/timbangan/statusprod/$1';
$route['timbangan/delete/(:any)'] = 'form/timbangan/delete/$1';

$route['releasepacking'] = 'form/releasepacking';
$route['releasepacking/tambah'] = 'form/releasepacking/tambah';
$route['releasepacking/detail/(:any)'] = 'form/releasepacking/detail/$1';
$route['releasepacking/edit/(:any)'] = 'form/releasepacking/edit/$1';
$route['releasepacking/verifikasi'] = 'form/releasepacking/verifikasi';
$route['releasepacking/status/(:any)'] = 'form/releasepacking/status/$1';
$route['releasepacking/cetak'] = 'form/releasepacking/cetak';
$route['releasepacking/diketahui'] = 'form/releasepacking/diketahui';
$route['releasepacking/statusprod/(:any)'] = 'form/releasepacking/statusprod/$1';
$route['releasepacking/delete/(:any)'] = 'form/releasepacking/delete/$1';

$route['pengemasan'] = 'form/pengemasan';
$route['pengemasan/tambah'] = 'form/pengemasan/tambah';
$route['pengemasan/detail/(:any)'] = 'form/pengemasan/detail/$1';
$route['pengemasan/edit/(:any)'] = 'form/pengemasan/edit/$1';
$route['pengemasan/verifikasi'] = 'form/pengemasan/verifikasi';
$route['pengemasan/status/(:any)'] = 'form/pengemasan/status/$1';
$route['pengemasan/cetak'] = 'form/pengemasan/cetak';
$route['pengemasan/diketahui'] = 'form/pengemasan/diketahui';
$route['pengemasan/statusprod/(:any)'] = 'form/pengemasan/statusprod/$1';
$route['pengemasan/delete/(:any)'] = 'form/pengemasan/delete/$1';

$route['sanitasi'] = 'form/sanitasi';
$route['sanitasi/tambah'] = 'form/sanitasi/tambah';
$route['sanitasi/detail/(:any)'] = 'form/sanitasi/detail/$1';
$route['sanitasi/edit/(:any)'] = 'form/sanitasi/edit/$1';
$route['sanitasi/verifikasi'] = 'form/sanitasi/verifikasi';
$route['sanitasi/status/(:any)'] = 'form/sanitasi/status/$1';
$route['sanitasi/cetak'] = 'form/sanitasi/cetak';
$route['sanitasi/diketahui'] = 'form/sanitasi/diketahui';
$route['sanitasi/statusprod/(:any)'] = 'form/sanitasi/statusprod/$1';
$route['sanitasi/delete/(:any)'] = 'form/sanitasi/delete/$1';

$route['ketidaksesuaian'] = 'form/ketidaksesuaian';
$route['ketidaksesuaian/tambah'] = 'form/ketidaksesuaian/tambah';
$route['ketidaksesuaian/detail/(:any)'] = 'form/ketidaksesuaian/detail/$1';
$route['ketidaksesuaian/edit/(:any)'] = 'form/ketidaksesuaian/edit/$1';
$route['ketidaksesuaian/verifikasi'] = 'form/ketidaksesuaian/verifikasi';
$route['ketidaksesuaian/status/(:any)'] = 'form/ketidaksesuaian/status/$1';
$route['ketidaksesuaian/cetak'] = 'form/ketidaksesuaian/cetak';
$route['ketidaksesuaian/diketahui'] = 'form/ketidaksesuaian/diketahui';
$route['ketidaksesuaian/statusprod/(:any)'] = 'form/ketidaksesuaian/statusprod/$1';
$route['ketidaksesuaian/delete/(:any)'] = 'form/ketidaksesuaian/delete/$1';

$route['pemusnahan'] = 'form/pemusnahan';
$route['pemusnahan/tambah'] = 'form/pemusnahan/tambah';
$route['pemusnahan/detail/(:any)'] = 'form/pemusnahan/detail/$1';
$route['pemusnahan/edit/(:any)'] = 'form/pemusnahan/edit/$1';
$route['pemusnahan/verifikasi'] = 'form/pemusnahan/verifikasi';
$route['pemusnahan/status/(:any)'] = 'form/pemusnahan/status/$1';
$route['pemusnahan/cetak'] = 'form/pemusnahan/cetak';
$route['pemusnahan/diketahui'] = 'form/pemusnahan/diketahui';
$route['pemusnahan/statusprod/(:any)'] = 'form/pemusnahan/statusprod/$1';
$route['pemusnahan/delete/(:any)'] = 'form/pemusnahan/delete/$1';

$route['kondisikerja'] = 'form/kondisikerja';
$route['kondisikerja/tambah'] = 'form/kondisikerja/tambah';
$route['kondisikerja/detail/(:any)'] = 'form/kondisikerja/detail/$1';
$route['kondisikerja/edit/(:any)'] = 'form/kondisikerja/edit/$1';
$route['kondisikerja/verifikasi'] = 'form/kondisikerja/verifikasi';
$route['kondisikerja/status/(:any)'] = 'form/kondisikerja/status/$1';
$route['kondisikerja/cetak'] = 'form/kondisikerja/cetak';
$route['kondisikerja/diketahui'] = 'form/kondisikerja/diketahui';
$route['kondisikerja/statusprod/(:any)'] = 'form/kondisikerja/statusprod/$1';
$route['kondisikerja/delete/(:any)'] = 'form/kondisikerja/delete/$1';

$route['retain'] = 'form/retain';
$route['retain/tambah'] = 'form/retain/tambah';
$route['retain/detail/(:any)'] = 'form/retain/detail/$1';
$route['retain/edit/(:any)'] = 'form/retain/edit/$1';
$route['retain/verifikasi'] = 'form/retain/verifikasi';
$route['retain/status/(:any)'] = 'form/retain/status/$1';
$route['retain/cetak'] = 'form/retain/cetak';
$route['retain/diketahui'] = 'form/retain/diketahui';
$route['retain/statusprod/(:any)'] = 'form/retain/statusprod/$1';
$route['retain/delete/(:any)'] = 'form/retain/delete/$1';

$route['kebersihankaryawan'] = 'form/kebersihankaryawan';
$route['kebersihankaryawan/tambah'] = 'form/kebersihankaryawan/tambah';
$route['kebersihankaryawan/detail/(:any)'] = 'form/kebersihankaryawan/detail/$1';
$route['kebersihankaryawan/edit/(:any)'] = 'form/kebersihankaryawan/edit/$1';
$route['kebersihankaryawan/verifikasi'] = 'form/kebersihankaryawan/verifikasi';
$route['kebersihankaryawan/status/(:any)'] = 'form/kebersihankaryawan/status/$1';
$route['kebersihankaryawan/cetak'] = 'form/kebersihankaryawan/cetak';
$route['kebersihankaryawan/diketahui'] = 'form/kebersihankaryawan/diketahui';
$route['kebersihankaryawan/statusprod/(:any)'] = 'form/kebersihankaryawan/statusprod/$1';
$route['kebersihankaryawan/delete/(:any)'] = 'form/kebersihankaryawan/delete/$1';

$route['kebersihanperalatan'] = 'form/kebersihanperalatan';
$route['kebersihanperalatan/tambah'] = 'form/kebersihanperalatan/tambah';
$route['kebersihanperalatan/detail/(:any)'] = 'form/kebersihanperalatan/detail/$1';
$route['kebersihanperalatan/edit/(:any)'] = 'form/kebersihanperalatan/edit/$1';
$route['kebersihanperalatan/verifikasi'] = 'form/kebersihanperalatan/verifikasi';
$route['kebersihanperalatan/status/(:any)'] = 'form/kebersihanperalatan/status/$1';
$route['kebersihanperalatan/cetak'] = 'form/kebersihanperalatan/cetak';
$route['kebersihanperalatan/diketahui'] = 'form/kebersihanperalatan/diketahui';
$route['kebersihanperalatan/statusprod/(:any)'] = 'form/kebersihanperalatan/statusprod/$1';
$route['kebersihanperalatan/delete/(:any)'] = 'form/kebersihanperalatan/delete/$1';

$route['kebersihanruang'] = 'form/kebersihanruang';
$route['kebersihanruang/tambah'] = 'form/kebersihanruang/tambah';
$route['kebersihanruang/detail/(:any)'] = 'form/kebersihanruang/detail/$1';
$route['kebersihanruang/edit/(:any)'] = 'form/kebersihanruang/edit/$1';
$route['kebersihanruang/verifikasi'] = 'form/kebersihanruang/verifikasi';
$route['kebersihanruang/status/(:any)'] = 'form/kebersihanruang/status/$1';
$route['kebersihanruang/cetak'] = 'form/kebersihanruang/cetak';
$route['kebersihanruang/diketahui'] = 'form/kebersihanruang/diketahui';
$route['kebersihanruang/statusprod/(:any)'] = 'form/kebersihanruang/statusprod/$1';
$route['kebersihanruang/delete/(:any)'] = 'form/kebersihanruang/delete/$1';

$route['sanitasiwarehouse'] = 'form/sanitasiwarehouse';
$route['sanitasiwarehouse/tambah'] = 'form/sanitasiwarehouse/tambah';
$route['sanitasiwarehouse/detail/(:any)'] = 'form/sanitasiwarehouse/detail/$1';
$route['sanitasiwarehouse/edit/(:any)'] = 'form/sanitasiwarehouse/edit/$1';
$route['sanitasiwarehouse/verifikasi'] = 'form/sanitasiwarehouse/verifikasi';
$route['sanitasiwarehouse/status/(:any)'] = 'form/sanitasiwarehouse/status/$1';
$route['sanitasiwarehouse/cetak'] = 'form/sanitasiwarehouse/cetak';
$route['sanitasiwarehouse/diketahui'] = 'form/sanitasiwarehouse/diketahui';
$route['sanitasiwarehouse/statuswh/(:any)'] = 'form/sanitasiwarehouse/statuswh/$1';
$route['sanitasiwarehouse/delete/(:any)'] = 'form/sanitasiwarehouse/delete/$1';

$route['disposisi'] = 'form/disposisi';
$route['disposisi/tambah'] = 'form/disposisi/tambah';
$route['disposisi/detail/(:any)'] = 'form/disposisi/detail/$1';
$route['disposisi/edit/(:any)'] = 'form/disposisi/edit/$1';
$route['disposisi/verifikasi'] = 'form/disposisi/verifikasi';
$route['disposisi/status/(:any)'] = 'form/disposisi/status/$1';
$route['disposisi/cetak'] = 'form/disposisi/cetak';
$route['disposisi/diketahui'] = 'form/disposisi/diketahui';
$route['disposisi/statusprod/(:any)'] = 'form/disposisi/statusprod/$1';
$route['disposisi/delete/(:any)'] = 'form/disposisi/delete/$1';

$route['suhu'] = 'form/suhu';
$route['suhu/tambah'] = 'form/suhu/tambah';
$route['suhu/detail/(:any)'] = 'form/suhu/detail/$1';
$route['suhu/edit/(:any)'] = 'form/suhu/edit/$1';
$route['suhu/verifikasi'] = 'form/suhu/verifikasi';
$route['suhu/status/(:any)'] = 'form/suhu/status/$1';
$route['suhu/cetak'] = 'form/suhu/cetak';
$route['suhu/diketahui'] = 'form/suhu/diketahui';
$route['suhu/statusprod/(:any)'] = 'form/suhu/statusprod/$1';
$route['suhu/delete/(:any)'] = 'form/suhu/delete/$1';
$route['suhu/export-excel'] = 'form/suhu/export_excel';

$route['lada'] = 'form/lada';
$route['lada/tambah'] = 'form/lada/tambah';
$route['lada/detail/(:any)'] = 'form/lada/detail/$1';
$route['lada/edit/(:any)'] = 'form/lada/edit/$1';
$route['lada/verifikasi'] = 'form/lada/verifikasi';
$route['lada/status/(:any)'] = 'form/lada/status/$1';
$route['lada/cetak'] = 'form/lada/cetak';
$route['lada/diketahui'] = 'form/lada/diketahui';
$route['lada/statusprod/(:any)'] = 'form/lada/statusprod/$1';
$route['lada/delete/(:any)'] = 'form/lada/delete/$1';
