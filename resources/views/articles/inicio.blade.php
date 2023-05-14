@extends('layouts.uno')
@section('titulo')
    Articulos
@endsection
@section('cabecera')
    Listado articulos
@endsection
@section('contenido')
    <div class="relative overflow-x-auto">
        <div class="flex flex-row-reverse my-3">
            <a href="{{ route('articles.create') }}"
                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"><i class="fas fa-add">
                    NUEVO</i></a>
        </div>
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr class="text-center">
                    <th scope="col" class="px-6 py-3">INFORMACION</th>
                    <th scope="col" class="px-6 py-3">TITULO</th>
                    <th scope="col" class="px-6 py-3">ESTADO</th>
                    <th scope="col" class="px-6 py-3">ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($articulos as $articulo)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-center">
                        <th scope="row" class="px-6 py-4 dark:text-white"><a
                                href="{{ route('articles.show', $articulo) }}"><i class="fa-solid fa-circle-info"></i></a>
                        </th>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $articulo->titulo }}</td>
                        <td @CLASS([
                            'px-6 py-4',
                            'text-red-800 font-bold' => $articulo->estado == 'Borrador',
                            'text-green-800 font-bold' => $articulo->estado == 'Publicado',
                        ])>{{ $articulo->estado }}</td>
                        <td class="px-6 py-4">
                            <form method="POST" action="{{ route('articles.destroy', $articulo) }}">
                                @csrf
                                @method('delete')
                                <a href="{{ route('articles.edit', $articulo) }}" class=" mr-3 text-yellow-500"><i
                                        class="fas fa-edit"></i></a>
                                <button type="submit" class="text-red-700"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">{{ $articulos->links() }}</div>
    </div>
@endsection
@section('js')
    @if (session('info'))
        <script>
            Swal.fire({
                icon: 'success',
                title: "{{ session('info') }}",
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif
@endsection

