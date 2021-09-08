<form method="post" action="{{ route('posts.destroy',['post'=>$post]) }}">
    @method('DELETE')
    @csrf
    <button type="submit">Delete Post</button>
</form>
