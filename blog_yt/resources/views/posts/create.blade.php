<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Créer un poste') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="my-5">
            
        @foreach ($errors->all() as $item)
        <span>ok</span>
        <span class="block text-red-500">
            {{$item}}
        </span>
        @endforeach

        </div>
            
       

        <form action="{{route('posts.store')}}" method="post" enctype="multipart/form-data">
  
             @csrf

            <x-input-label for="title" value="Nom " />
            <x-text-input id="title" name="title" />

            <x-input-label for="content" value="Contenu du poste " />
            <textarea name="content" id="content">
            </textarea>

            <x-input-label for="image" value="Image du poste " />
            <x-text-input id="image" name="image" type="file" />

            <x-input-label for="category" value="Categorie du poste " />
            <select name="category" id="category" style="display: block important">
                @foreach ($categories as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
                    
                @endforeach
            </select>

            <x-primary-button style="display: block !important;" class="mt-5">Créer mon poste</x-secondary-button>

        </form>



    </div>
</x-app-layout>