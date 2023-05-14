@extends('layouts.uno')
@section('titulo')
    Inicio
@endsection
@section('cabecera')
    Articulos
@endsection
@section('contenido')
    <a href="{{ route('articles.index') }}"
        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Ver listado de articulos</a>
@endsection
