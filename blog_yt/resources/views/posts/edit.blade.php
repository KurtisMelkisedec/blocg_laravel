<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editer {{ $post->title }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">





        <form action="{{route('posts.update',$post)}}" method="post" enctype="multipart/form-data">

            @method("put");
            @csrf

            <x-input-label for="title" value="Nom " />
            <x-text-input id="title" name="title" value='{{$post->title}}' />

            <x-input-label for="content" value="Contenu du poste " />
            <textarea name="content" id="content">
            {{$post->content}}
            </textarea>

            <x-input-label for="image" value="Image du poste " />
            <x-text-input id="image" name="image" type="file" />

            <x-input-label for="category" value="Categorie du poste " />
            <select name="category" id="category" style="display: block important">
                @foreach ($categories as $item)
                <option value="{{$item->id}}"  {{ $post->category->id == $item->id ? 'selected':''}} >{{$item->name}}</option>

                @endforeach
            </select>

            <x-primary-button style="display: block !important;" class="mt-5">Modifier mon poste</x-secondary-button>

        </form>



    </div>
</x-app-layout>