

<x-app-layout>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

</head>
<body>
<!-- Modal -->
<div class="card">
    <div class="card-header">
        <h5 class="card-title">Comments Details</h5>
    </div>
    @forEach($comments as $comment)
    <div class="card-body">
        <div class="comments-section mt-4" style="max-height: 300px; overflow-y: auto;">
            <div class="media">
                <div class="media-body bg-light rounded p-2">
                    <h6 class="mt-0 mb-1" >CommentBy: {{ $comment->user->name }}</h6>
                    <p class="m-0" > <p>Task Name: {{ $comment->task->title }}</p></p>
                    <h6 class="mt-0 mb-1" >Comments:  {{ $comment->content }}</h6>
                    <h6 class="mt-0 mb-1" >Date and Time:  {{ $comment->updated_at }}</h6>
                </div>
            </div>
    </div>
    @endforeach
</div>

</body>
</html>
</x-app-layout>
