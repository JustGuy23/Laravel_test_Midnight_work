<!DOCTYPE html>
    <div class="container">
        <h1>All Posts</h1>

        @foreach($posts as $post)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="card-text">{{ $post->content }}</p>
                </div>
                <div class="card-footer">
                    <small class="text-muted">{{ $post->created_at }}</small>
                </div>
            </div>
        @endforeach

        {{ $posts->links() }}
    </div>
<html>