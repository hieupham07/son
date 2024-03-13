<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {
    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('demo/users', UserController::class);
    $router->resource('loai-vat-tus', LoaiVatTuController::class);
    $router->resource('dong-gois', DongGoiController::class);
    $router->resource('vattus', VatTuController::class);

    $router->resource('khach-hangs', KhachHangController::class);
    $router->resource('goi-dieu-tris', GoiDieuTriController::class);
    $router->resource('dung-cu-gois', DungCuGoiController::class);
    $router->resource('khach-hang-gois', KhachHangGoiController::class);
    $router->resource('khach-dieu-tris', KhachDieuTriController::class);
    $router->resource('goi-dieu-tri-khaches', GoiDieuTriKhachController::class);
    $router->resource('goi-dieu-tri-details', GoiDieuTriDetailController1::class);
    $router->resource('phieu-thus', PhieuThuController::class);

    // $router->resources(['goi-dieu-tri-details'=>QuoteController::class ]);
});
