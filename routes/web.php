<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/',[
    'as'=> 'trang-chu',
    'uses' => 'PageController@getIndex'
]);

Route::get('dangki',[
    'as'=> 'dangki',
    'uses' => 'PageController@getDangKi'
]);

Route::post('dangki',[
    'as'=> 'dangki',
    'uses' => 'PageController@postDangKi'
]);

Route::get('dangnhap',[
    'as'=> 'dangnhap',
    'uses' => 'PageController@getDangNhap'
]);


Route::post('dangnhap',[
    'as'=> 'dangnhap',
    'uses' => 'PageController@postDangNhap'
]);

Route::get('dangxuat',[
    'as'=> 'dangxuat',
    'uses' => 'PageController@postDangXuat'
]);



Route::get('lienhe', [
    'as'=>'lienhe',
    'uses'=>'PageController@getLienHe'
]);

Route::post('lienhe', [
    'as'=>'lienhe',
    'uses'=>'PageController@postLienHe'
]);


Route::get('adminabc',[
    'as'=> 'index-admin',
    'uses' => 'PageController@getIndexAdmin'
]);

Route::get('admin-add-form',[
    'as'=> 'getadminadd',
    'uses' => 'PageController@getAdminAdd'
]);

Route::post('admin-add',[
    'as'=> 'adminadd',
    'uses' => 'PageController@postAdminAdd'
]);

Route::get('admin-edit-form/{id}',[
    'as'=> 'getadminedit',
    'uses' => 'PageController@getAdminEdit'
]);

Route::post('admin-edit',[
    'as'=> 'adminedit',
    'uses' => 'PageController@postAdminEdit'
]);

Route::post('admin-delete/{id}',[
    'as'=> 'admindelete',
    'uses' => 'PageController@postAdminDelete'
]);

//thêm sản phẩm vào giỏ hàng
Route::get('/Add-Cart/{id}','PageController@AddCart');

// xóa sản phẩm khỏi giỏ hàng
Route::get('/Delete-Item-Cart/{id}','PageController@DeleteItemCart');

// hiển thị giỏ hàng trong view cart
Route::get('/List-Carts','PageController@ViewListCart');

// xóa sản phẩm trong view cart
Route::get('/Delete-Item-List-Cart/{id}','PageController@DeleteListItemCart');

// lưu 1 sản phẩm trong view cart
Route::get('/Save-Item-List-Cart/{id}/{quanty}','PageController@SaveListItemCart');

// lưu toàn bộ sản phẩm trong view cart
Route::post('/Save-All','PageController@SaveAllListItemCart'); // dùng post vì nhiều dữ liệu

// xoa toàn bộ sản phẩm trong view cart
Route::post('/Delete-All','PageController@DeleteAllListItemCart'); // dùng post vì nhiều dữ liệu



Route::get('/Check-Out-Carts',[
    'as'=>'checkout',
    'uses'=>'PageController@ViewCheckOutCart']);
Route::post('/Check-Out-Carts',[
    'as'=> 'checkout',
    'uses' => 'PageController@postCheckout'
]);

