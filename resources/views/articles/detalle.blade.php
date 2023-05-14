@extends('layouts.uno')
@section('titulo')
    Articulo
@endsection
@section('cabecera')
    Detalle articulo
@endsection
@section('contenido')
    <div class="p-8 rounded-xl shadow-xl w-1/2 mx-auto bg-gray-800">
        <div class="px-6 py-4">
            <label class="block text-gray-400 text-sm font-medium mb-2 text-center" for="doblada">
                TITULO DEL ARTICULO
            </label>
            <div class="block dark:text-white text-sm font-bold py-3 mb-2 text-center">{{ $article->titulo }}</div>
            <label class="block text-gray-400 text-sm font-medium mb-2 text-center" for="doblada">
                DESCRIPCION DEL ARTICULO
            </label>
            <p class="dark:text-white text-center py-3">{{ $article->contenido }} </p>
        </div>
        <label class="block text-gray-400 text-sm font-medium mb-2 text-center" for="doblada">
            AUTOR DEL ARTICULO
        </label>
        <div class="block dark:text-white text-sm font-bold py-3 mb-2 text-center">{{ $article->user->name }}</div>
        <label class="block text-gray-400 text-sm font-medium mb-2 text-center" for="doblada">
            ESTADO DEL ARTICULO
        </label>
        <div class="py-3 pb-2 text-center">
            <span
                    class="text-sm font-semibold dark:text-white">{{ $article->estado }}</span>
        </div>
        <div class="py-3 pb-2 mx-1">
            <img src="{{Storage::url($article->imagen)}}">
        </div>
        <div class="flex flex-row-reverse mr-3 mb-3">
            <a href="{{ route('articles.index') }}"
                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"><i class="fas fa-xmark">
                    Volver</i></a>
        </div>
    </div>
@endsection