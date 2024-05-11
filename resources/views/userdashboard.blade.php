<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Assigned Tasks</title>
  <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
  
</head>
<body>
@include('usernav')
  <div class="container mt-5">
    <h1>My Assigned Tasks</h1>
    <table class="table mt-3">
      <thead>
        <tr>
          <th>Title</th>
          <th>Description</th>
          <th>Status</th>
          <th>Files</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($data as $datas)
        <tr>
          <td>{{$datas->title}}</td>
          <td>{{$datas->description}}</td>
          <td><img src="{{ asset('storage/' . $datas->file_path) }}" alt="File"  width="50" height="50"></td>
          <td>{{$datas->status}}</td>
          <td>
          <button onclick="openCommentModal('{{ $datas->id }}')" class="btn btn-primary">Comment</button>
          <button  onclick="openViewModal('taskModal{{$datas->id}}', '{{$datas->title}}', '{{$datas->description}}', '{{$datas->status}}')" type="button" class="btn btn-primary view-btn" data-toggle="modal" data-target="#taskModal{{$datas->id}}">View</button>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

 
  @foreach($data as $datas)
  <div class="modal fade" id="taskModal{{$datas->id}}" tabindex="-1" role="dialog" aria-labelledby="taskModal{{$datas->id}}Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="taskModal{{$datas->id}}Label">Task Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="CloseBtn">Close</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="modelcomment" tabindex="-1" aria-labelledby="modelConfirmDeleteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modelConfirmDeleteLabel">Comment Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="media-body bg-light rounded p-2" id="commentBody">
                    <!-- Existing comments will be dynamically added here -->
                </div>
                <form id="commentForm" method="POST" action="{{ route('comment.store', ['id' => $datas->id]) }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="task_id" id="task_id">
                    <p>Please Enter Your Comments here</p>
                    <div class="mb-3">
                        <label for="description" class="form-label">{{ __('Description') }}</label>
                        <textarea id="description" class="form-control" name="content" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="file" class="form-label">{{ __('File') }}</label>
                        <input id="file" type="file" class="form-control" name="file">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="commentForm" class="btn btn-success">Save</button>
            </div>
        </div>
    </div>
</div>
  
  @endforeach
    

 
</body>
</html>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script>
   function openViewModal(modalId, title, description, status) {
    $('#' + modalId + 'Label').text(title + ' Details');
    $('#' + modalId + ' .modal-body').html(
        '<p>Title: ' + title + '</p>' +
        '<p>Description: ' + description + '</p>' +
        '<p>Status: ' + status + '</p>'
    );
    $('#' + modalId).modal('show');
    $('#' + modalId + 'CloseBtn').click(function() {
        $('#' + modalId).modal('hide');
    });
}

    function openCommentModal(taskId) {
    // Make AJAX request to fetch comments for the task
    fetch(`/task/${taskId}/comments`)
        .then(response => response.json())
        .then(data => {
            const comments = data.comments;
            // Display existing comments in the modal
            const commentBody = document.getElementById('commentBody');
            commentBody.innerHTML = ''; // Clear previous comments
            if (comments.length > 0) {
    const table = document.createElement('table');
    table.classList.add('table');
    const tableBody = document.createElement('tbody');

    comments.forEach(comment => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${comment.user_name}</td>
            <td>${comment.content}</td>
            <td>${comment.created_at}</td>
        `;
        tableBody.appendChild(row);
    });

    table.appendChild(tableBody);
    commentBody.appendChild(table);
} else {
    commentBody.innerHTML = '<p>No comments found for this task.</p>';
}
            // Set the task_id value for the comment form
            document.getElementById('task_id').value = taskId;
            // Show the modal
            const modal = new bootstrap.Modal(document.getElementById("modelcomment"));
            modal.show();
            document.getElementById('commentForm').action = '{{ route("comment.store", ":id") }}'.replace(':id', taskId);
        })
        .catch(error => console.error('Error fetching comments:', error));
}


        // Function to close the modal
        function closeModal(modalId) {
            var modal = document.getElementById(modalId);
            modal.style.display = "none";
        }
    </script>
