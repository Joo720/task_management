<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            All Task List 
        </h2>
    </x-slot>
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
    <div class="container p-5 mt-5 shadow-lg rounded-5" id="table-list">
    @if($tasks->isEmpty())
        <div class="text-center">
            <h3>No tasks found</h3>
            <a href="{{ route('tasks.view') }}" class="btn btn-primary btn-lg">Create Task for users</a>
        </div>
        @else

        <table class="table table-responsive-lg   table-striped ">

            <thead>

                <tr>

                    <th>Sno</th>

                    <th>Title</th>

                    <th>Description</th>

                    <th>Assigned user</th>

                    <th>Status</th>
                    <th>Action</th>

                </tr>
            </thead>
            <tbody>
            @foreach($tasks as $task)
                <tr>
<td>{{$task->id}}</td>
                    <td>{{$task->title}}</td>

                    <td>
                    {{$task->description}} 
                    </td>

                    <td>{{$task->assigned_to}}</td>
                    <td>{{$task->status}}</td>

                    <td>
                        <button onclick="openEditModal('modelConfirm', '{{$task->id}}', '{{$task->title}}', '{{$task->description}}', '{{$task->assigned_to}}', '{{$task->status}}')"
                            type="button" class="btn btn-success"><i class="bi bi-pencil-fill"></i></button>
                        <button onclick="openDeleteModal('modelConfirmDelete', '{{$task->id}}')" type="button" class="btn btn-danger"><i class="bi bi-trash-fill"></i></button>
                    </td>
                </tr>
@endforeach

                </tbody>     

        </table>
        <a href="{{ route('tasks.view')}}">
        <button type="button" class="btn btn-primary btn-lg btn-block">Back To Task Creation</button>
        </a>
<div class="modal fade" id="modelConfirm" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="edit_form"  method="post" >
                     @csrf 
                        <input type="hidden" id="editTaskId">
                        <div class="mb-3">
                            <label for="editTaskTitle" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="editTaskDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="editTaskAssignedTo" class="form-label">Assigned To</label>
                            <input type="text" class="form-control" id="assigned_to" name="assigned_to" required>
                        </div>
                        <div class="mb-3">
                            <label for="editTaskStatus" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="open">Pending</option>
                                <option value="Progress">In Progress</option>
                                <option value="done">Completed</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
<div class="modal fade" id="modelConfirmDelete" tabindex="-1" aria-labelledby="modelConfirmDeleteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modelConfirmDeleteLabel">Delete Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this task?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteTaskForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="task_id" id="deleteTaskId">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endif

@php
    $updateRoute = route('task.update', '');
    $deleteRoute = route('task.delete', '');
@endphp

</x-app-layout>


    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    
    <script>
      function openEditModal(modalId, id, title, description, assignedTo, status) {
    var modal = new bootstrap.Modal(document.getElementById(modalId));
    var editTaskId = document.getElementById("editTaskId");
    var editTaskTitle = document.getElementById("title");
    var editTaskDescription = document.getElementById("description");
    var editTaskAssignedTo = document.getElementById("assigned_to");
    var editTaskStatus = document.getElementById("status");

    editTaskId.value = id;
    editTaskTitle.value = title;
    editTaskDescription.value = description;
    editTaskAssignedTo.value = assignedTo;
    editTaskStatus.value = status;

    modal.show();
    document.getElementById('edit_form').action = '{{ route("task.update", ":id") }}'.replace(':id', id);
}
        function openDeleteModal(modalId, taskId) {
        var modal = new bootstrap.Modal(document.getElementById(modalId));
        var deleteTaskIdInput = document.getElementById("deleteTaskId");
        deleteTaskIdInput.value = taskId;
        modal.show();
        document.getElementById('deleteTaskForm').action = '{{ route("task.delete", "") }}/' + taskId;

    }

        // Function to close the modal
        function closeModal(modalId) {
            var modal = document.getElementById(modalId);
            modal.style.display = "none";
        }
    </script>
</body>

</html>