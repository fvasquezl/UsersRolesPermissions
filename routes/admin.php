<?php

use App\Http\Controllers\Admin\Permissions\PermissionController;
use App\Http\Controllers\Admin\Roles\RoleController;
use App\Http\Controllers\Admin\Users\UserController;
use App\Http\Controllers\Admin\Users\UsersPermissionsController;
use App\Http\Controllers\Admin\Users\UsersRolesController;
use Illuminate\Support\Facades\Route;


Route::resource('users', UserController::class)->names('users');
Route::resource('roles', RoleController::class)
    ->names('roles')
    ->except('show');
Route::resource('permissions', PermissionController::class)
    ->names('permissions')
    ->only('index','edit','update');

Route::middleware('role:Admin')
    ->put('users/{user}/roles', [
        UsersRolesController::class, 'update'
    ])->name('users.roles.update');

Route::middleware('role:Admin')
    ->put('users/{user}/permissions', [
        UsersPermissionsController::class, 'update'
    ])->name('users.permissions.update');
