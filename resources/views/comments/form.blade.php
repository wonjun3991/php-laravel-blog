<form method="post" action="{{route('posts.comments.store',['post'=>$post])}}">
    @csrf
    <label>Insert Your Comment
        <input name="content">
    </label>
    <button type="submit">Save</button>
</form>
