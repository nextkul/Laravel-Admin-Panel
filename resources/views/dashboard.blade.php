<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    
   
    <div class="font-semibold text-xl text-gray-800 leading-tight m-2 p-2">
        @role('writer|admin')
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           <a href="">Add Post</a> 
      </h2>
       @endrole
       <table class="table-auto">
  <thead>
    <tr>
      <th>No</th>
      <th>Title</th>
      <th>Adction</th>
    </tr>
  </thead>
  <tbody>
      @foreach(App\Models\Post::all() as $post )
      <tr>
      <td>{{ $post->id }}</td>
      <td>{{ $post->title }}</td>
      <td><a href="#" >Edit</a> <a href="#" class="bg-green-400" >Delete</a></td>
    </tr>
      @endforeach
   
  </tbody>
</table>
    </div>
</x-app-layout>
