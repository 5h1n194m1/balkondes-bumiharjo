<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setAutoRoute(false);

$routes->get('/', 'Home::index');
$routes->get('/booking', 'Home::booking');
$routes->get('/gerbang-senja-bumiharjo', 'Admin\\AuthController::login');
$routes->post('/gerbang-senja-bumiharjo', 'Admin\\AuthController::attemptLogin');

$routes->group('admin', static function ($routes) {
    $routes->get('login', 'Admin\\AuthController::login');
    $routes->post('login', 'Admin\\AuthController::attemptLogin');
    $routes->get('logout', 'Admin\\AuthController::logout');

    $routes->group('', ['filter' => 'auth'], static function ($routes) {
        $routes->get('/', 'Admin\\DashboardController::index');
        $routes->get('dashboard', 'Admin\\DashboardController::index');

        $routes->get('site-settings', 'Admin\\SiteSettingsController::edit');
        $routes->post('site-settings', 'Admin\\SiteSettingsController::update');

        $routes->get('booking-links', 'Admin\\BookingLinksController::index');
        $routes->get('booking-links/create', 'Admin\\BookingLinksController::create');
        $routes->post('booking-links', 'Admin\\BookingLinksController::store');
        $routes->get('booking-links/(:num)/edit', 'Admin\\BookingLinksController::edit/$1');
        $routes->post('booking-links/(:num)', 'Admin\\BookingLinksController::update/$1');
        $routes->post('booking-links/(:num)/delete', 'Admin\\BookingLinksController::delete/$1');

        $routes->get('hero-slides', 'Admin\\HeroSlidesController::index');
        $routes->get('hero-slides/create', 'Admin\\HeroSlidesController::create');
        $routes->post('hero-slides', 'Admin\\HeroSlidesController::store');
        $routes->get('hero-slides/(:num)/edit', 'Admin\\HeroSlidesController::edit/$1');
        $routes->post('hero-slides/(:num)', 'Admin\\HeroSlidesController::update/$1');
        $routes->post('hero-slides/(:num)/delete', 'Admin\\HeroSlidesController::delete/$1');

        $routes->get('services', 'Admin\\ServicesController::index');
        $routes->get('services/create', 'Admin\\ServicesController::create');
        $routes->post('services', 'Admin\\ServicesController::store');
        $routes->get('services/(:num)/edit', 'Admin\\ServicesController::edit/$1');
        $routes->post('services/(:num)', 'Admin\\ServicesController::update/$1');
        $routes->post('services/(:num)/delete', 'Admin\\ServicesController::delete/$1');

        $routes->get('gallery-items', 'Admin\\GalleryItemsController::index');
        $routes->get('gallery-items/create', 'Admin\\GalleryItemsController::create');
        $routes->post('gallery-items', 'Admin\\GalleryItemsController::store');
        $routes->get('gallery-items/(:num)/edit', 'Admin\\GalleryItemsController::edit/$1');
        $routes->post('gallery-items/(:num)', 'Admin\\GalleryItemsController::update/$1');
        $routes->post('gallery-items/(:num)/delete', 'Admin\\GalleryItemsController::delete/$1');
    });
});
