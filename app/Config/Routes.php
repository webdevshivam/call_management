<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Admin routes
$routes->group('admin', function($routes) {
    $routes->get('login', 'Admin::login');
    $routes->post('login', 'Admin::login');
    $routes->get('logout', 'Admin::logout');
    $routes->get('/', 'Admin::index');
    $routes->get('dashboard', 'Admin::index');
    
    // Telecaller management
    $routes->get('telecallers', 'Admin::telecallers');
    $routes->get('add-telecaller', 'Admin::addTelecaller');
    $routes->post('add-telecaller', 'Admin::addTelecaller');
    
    // Company management
    $routes->get('companies', 'Admin::companies');
    $routes->get('add-company', 'Admin::addCompany');
    $routes->post('add-company', 'Admin::addCompany');
    
    // Number management
    $routes->get('numbers', 'Admin::numbers');
    $routes->get('upload-numbers', 'Admin::uploadNumbers');
    $routes->post('upload-numbers', 'Admin::uploadNumbers');
    $routes->get('assign-numbers', 'Admin::assignNumbers');
    $routes->post('assign-numbers', 'Admin::assignNumbers');
});
