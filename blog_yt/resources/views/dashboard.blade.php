<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (Session("success"))
            {{Session("success")}}
                
            @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @foreach ($posts as $item)
                <div class=" flex items-center">
                    <a href="{{route('posts.edit',$item)}}" class="bg-yellow-500 px-2 py-3 block">Editer   |   {{$item->title}}</a>
                    <a href="#" 
                     onclick="
                     event.preventDefault;
                     document.querySelector('#destroy-post').submit();
                     "
                     class="bg-orange-500 px-2 py-3 block">
                     Supprimer   |  {{$item->title}}
                     <form action="{{route('posts.destroy',$item)}}" method="post" id="destroy-post">
                        @csrf
                        @method("delete")
                    </form>
                    </a>
                </div>
                    
                @endforeach
                
            </div>
        </div>
    </div>
</x-app-layout>
