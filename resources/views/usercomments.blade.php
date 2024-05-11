
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
    @include('usernav');
<div class="card">
    <div class="card-header">
        <h5 class="card-title">Comments Details</h5>
    </div>
    <div class="card-body">
        <div class="comments-section mt-4" style="max-height: 300px; overflow-y: auto;">
            <table class="table">
                <thead>
                    <tr>
                        <th>Comment By</th>
                        <th>Task Name</th>
                        <th>Comments</th>
                        <th>Files</th>
                        <th>Date and Time</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($comments as $comment)
                    <tr>
                        <td>{{ $comment->user->name }}</td>
                        <td>{{ $comment->task->title }}</td>
                        <td>{{ $comment->content }}</td>
                        <td><a href="{{ asset('storage/' . $comment->file_path) }}" target="_blank" >
        <img src="{{ asset('storage/' . $comment->file_path) }}" alt="File" width="50" height="50">
    </a></td>
                        <td>{{ $comment->updated_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>

