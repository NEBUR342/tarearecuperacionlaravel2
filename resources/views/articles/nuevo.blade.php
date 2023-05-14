@extends('layouts.uno')
@section('titulo')
    Articulo
@endsection
@section('cabecera')
    Crear articulo
@endsection
@section('contenido')
    <div class="p-8 rounded-xl shadow-xl w-1/2 mx-auto bg-gray-800">
        <form name="as" method="POST" action="{{ route('articles.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="block dark:text-white text-sm font-bold mb-2" for="titulo">
                    TITULO
                </label>
                <input value="{{ @old('titulo') }}"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="titulo" type="text" placeholder="Titulo del articulo" name="titulo" />
                @error('titulo')
                    <p class="text-red-700 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block dark:text-white text-sm font-bold mb-2" for="contenido">
                    CONTENIDO
                </label>
                <textarea
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="contenido" type="text" placeholder="Contenido del articulo" name="contenido" rows="8">{{ @old('contenido') }}</textarea>
                @error('contenido')
                    <p class="text-red-700 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block dark:text-white text-sm font-bold mb-2" for="autor">
                    AUTOR
                </label>
                <select
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="autor" name="user_id">
                    <option value='-1'>SELECCIONA UN AUTOR</option>
                    @foreach ($autores as $autor)
                        <option value="{{ $autor->id }}" @selected($autor->id == @old('user_id'))>{{ $autor->name }}</option>
                    @endforeach
                </select>
            </div>
            @error('user_id')
                <p class="text-red-700 text-xs italic mt-2">{{ $message }}</p>
            @enderror
            <label class="block dark:text-white text-sm font-bold mb-2" for="imagen">
                IMAGEN DEL ARTICULO
            </label>
            <div class="flex items-center content-center mb-4">
                    <img src="{{ Storage::url('default.png') }}" id="imagen">
            </div>
            <div class="flex-1 mr-4 mb-3">
                <input type="file" accept="image/*" id="img" name="imagen"
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                @error('imagen')
                    <p class="text-red-700 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>
            <label class="block dark:text-white text-sm font-bold mb-2" for="estado">
                ESTADO DEL ARTICULO
            </label>
            <div class="flex mb-4">
                <div class="flex items-center mr-4">
                    <input id="publicado" type="radio" value="Publicado" name="estado" @checked(@old('estado') == 'Publicado')
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="publicado"
                        class="ml-2 text-sm font-bold text-green-800 dark:text-black-300">Publicado</label>
                </div>
                <div class="flex items-center mr-4">
                    <input id="borrador" type="radio" value="Borrador" name="estado" @checked(@old('estado') == 'Borrador')
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="borrador" class="ml-2 text-sm font-bold text-red-800 dark:text-black-300">Borrador</label>
                </div>
            </div>
            @error('estado')
                <p class="text-red-700 text-xs italic mt-2">{{ $message }}</p>
            @enderror
            <div class="flex flex-row-reverse mb-3">
                <a href="{{ route('articles.index') }}"
                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"><i class="fas fa-xmark">
                        Cancelar</i></a>
                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 mr-3 rounded"><i
                        class="fas fa-save"> Guardar</i></button>
            </div>
        </form>
    </div>
@endsection
@section('js')
    <script>
        function init() {
            var inputFile = document.getElementById('img');
            inputFile.addEventListener('change', mostrarImagen, false);
        }

        function mostrarImagen(event) {
            var file = event.target.files[0];
            var reader = new FileReader();
            reader.onload = function(event) {
                var img = document.getElementById('imagen');
                img.src = event.target.result;
            }
            reader.readAsDataURL(file);
        }
        window.addEventListener('load', init, false);
    </script>
@endsection
