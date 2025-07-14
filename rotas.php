<?php

use Pecee\SimpleRouter\SimpleRouter;
use sistema\Nucleo\Helpers_c;

try{
    SimpleRouter::setDefaultNamespace('sistema\Controlador');
    SimpleRouter::get(URL_SITE, 'SiteControlador@index');
    SimpleRouter::get(URL_SITE.'sobre-nos', 'SiteControlador@sobre');
    SimpleRouter::get(URL_SITE.'404', 'SiteControlador@erro404');
    SimpleRouter::get(URL_SITE.'post/{id}', 'SiteControlador@post');
    SimpleRouter::get(URL_SITE.'categoria/{id}', 'SiteControlador@categoria');
    SimpleRouter::post(URL_SITE.'buscar', 'SiteControlador@buscar');

    SimpleRouter::group(['namespace' => 'Admin'], function () {

        SimpleRouter::match(['get', 'post'], URL_ADMIN.'login', 'AdminLogin@login');

        //DASHBOARD
        SimpleRouter::get(URL_ADMIN.'dashboard', 'AdminDashboard@dashboard');
        SimpleRouter::get(URL_ADMIN.'sair', 'AdminDashboard@sair');

        //ADMIN Usuários
        SimpleRouter::get(URL_ADMIN.'usuarios/listar', 'AdminUsuarios@listar');
        SimpleRouter::get(URL_ADMIN.'usuarios/deletar{id}', 'AdminUsuarios@deletar');
        SimpleRouter::match(['get', 'post'], URL_ADMIN.'usuarios/cadastrar', 'AdminUsuarios@cadastrar');
        SimpleRouter::match(['get', 'post'], URL_ADMIN.'usuarios/editar/{id}', 'AdminUsuarios@editar');

        //ADMIN POSTS
        SimpleRouter::get(URL_ADMIN.'posts/listar', 'AdminPosts@listar');
        SimpleRouter::get(URL_ADMIN.'posts/deletar{id}', 'AdminPosts@deletar');
        SimpleRouter::match(['get', 'post'], URL_ADMIN.'posts/cadastrar', 'AdminPosts@cadastrar');
        SimpleRouter::match(['get', 'post'], URL_ADMIN.'posts/editar/{id}', 'AdminPosts@editar');

        //ADMIN CATEGORIAS
        SimpleRouter::get(URL_ADMIN.'categorias/listar', 'AdminCategorias@listar');
        SimpleRouter::get(URL_ADMIN.'categorias/deletar{id}', 'AdminCategorias@deletar');
        SimpleRouter::match(['get', 'post'], URL_ADMIN.'categorias/cadastrar', 'AdminCategorias@cadastrar');
        SimpleRouter::match(['get', 'post'], URL_ADMIN.'categorias/editar{id}', 'AdminCategorias@editar');
    });

    SimpleRouter::start();
}catch (Pecee\SimpleRouter\Exceptions\NotFoundHttpException $ex){
    if(!Helpers_c::localhost()){
        echo $ex;
    }else{
        Helpers_c::redirecionar('/blog/404');
    }
}
// SimpleRouter::setDefaultNamespace('sistema\Controlador');
// SimpleRouter::get(URL_SITE, 'SiteControlador@index');
// SimpleRouter::get(URL_SITE.'sobre-nos', 'SiteControlador@sobre');
// SimpleRouter::start();

?>