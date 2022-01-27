<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'LoginAdmin::index');
$routes->get('/LoginUser', 'LoginUser::index');
$routes->post('/LoginAdmin','LoginAdmin::login');
$routes->post('/SignUpAdmin','SignUpAdmin::signup');
$routes->post('/SignUpuser','SignUpUser::signup');
//======================================================================
$routes->post('/DashboardAdmin','DashboardAdmin::logout');
$routes->get('/DashboardAdmin','DashboardAdmin::index');
$routes->get('/DashboardAdmin/editTicketView','DashboardAdmin::editTicketView');
$routes->post('/DashboardAdmin/deleteTicket','DashboardAdmin::deleteTicket');
$routes->post('/DashboardAdmin/addTicket','DashboardAdmin::addTicket');
$routes->post('/DashboardAdmin/getDetailInfo','DashboardAdmin::getDetailInfo');
$routes->post('/DashboardAdmin/editTicket','DashboardAdmin::editTicket');
//======================================================================
$routes->get('/DashboardSupir','DashboardSupir::index');
$routes->get('/DashboardSupir/editSupirView','DashboardSupir::editSupirView');
$routes->post('/DashboardSupir/deleteSupir','DashboardSupir::deleteSupir');
$routes->post('/DashboardSupir/addSupir','DashboardSupir::addSupir');
$routes->post('/DashboardSupir/editSupir','DashboardSupir::editSupir');
//======================================================================
$routes->get('/DashboardTempat','DashboardTempat::index');
$routes->get('/DashboardTempat/editTempatView','DashboardTempat::editTempatView');
$routes->get('/DashboardTempat/editTempat','DashboardTempat::editTempat');
$routes->post('/DashboardTempat/addTempat','DashboardTempat::addTempat');
$routes->post('/DashboardTempat/deleteTempat','DashboardTempat::deleteTempat');
//======================================================================
$routes->get('/DashboardHarga','DashboardHarga::index');
$routes->get('/DashboardHarga/editHargaView','DashboardHarga::editHargaView');
$routes->post('/DashboardHarga/addHarga','DashboardHarga::addHarga');
$routes->post('/DashboardHarga/deleteHarga','DashboardHarga::deleteHarga');
$routes->post('/DashboardHarga/editHarga','DashboardHarga::editHarga');
//======================================================================
$routes->get('/tiket','DashboardTiket::index');
$routes->get('/tiket/detail/(:segment)','DashboardTiket::detail/$1');
$routes->post('/tiket/logout','DashboardTiket::logout');
$routes->post('/tiket/payment','DashboardTiket::payment');
$routes->post('/tiket/deleteOrder','DashboardTiket::deleteOrder');
$routes->post('/tiket/orderTiket','DashboardTiket::orderTiket',['filter' => 'filterUser']);
$routes->post('/tiket/printOrder','DashboardTiket::printOrder',['filter' => 'filterUser']);
$routes->get('/tiket/user/purchase','DashboardTiket::purchase',['filter' => 'filterUser']);
$routes->get('/tiket/(:any)','DashboardTiket::user/$1',['filter' => 'filterUser']);
//======================================================================
$routes->get('/DashboardOrder','DashboardOrder::index');
$routes->post('/DashboardOrder/deleteOrder','DashboardOrder::deleteOrder');
//======================================================================
$routes->get('/DashboardUser', 'DashboardUser::index');
$routes->post('/DashboardDeleteUser', 'DashboardUser::deleteUser');








/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
