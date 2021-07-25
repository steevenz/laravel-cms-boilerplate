<h1>Frontpage</h1>
<ul>
    @foreach($posts as $post)
    <li>{{$post->title}}</li>
    @endforeach
</ul>
