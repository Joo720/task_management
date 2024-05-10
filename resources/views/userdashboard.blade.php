<x-app-layout>
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
  <div class="container mt-5">
    <h1>My Assigned Tasks</h1>
    <table class="table mt-3">
      <thead>
        <tr>
          <th>Title</th>
          <th>Description</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($data as $datas)
        <!-- Loop through tasks assigned to the user and display them -->
        <!-- Replace this section with PHP/Laravel blade syntax to dynamically generate rows -->
        <tr>
          <td>{{$datas->title}}</td>
          <td>{{$datas->description}}</td>
          <td>{{$datas->status}}</td>
          <td>
            <button  onclick="openViewModal('taskModal{{$datas->id}}', '{{$datas->title}}', '{{$datas->description}}', '{{$datas->status}}')" type="button" class="btn btn-primary view-btn" data-toggle="modal" data-target="#taskModal{{$datas->id}}">View</button>
          </td>
        </tr>
        @endforeach
        <!-- End of task display loop -->
      </tbody>
    </table>
  </div>

  <!-- Modal for Task 1 -->
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
          <!-- Task details will be dynamically inserted here -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  @endforeach
    

  
    

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<script>
    function openViewModal(modalId, title, description, status) {
       
        $('#' + modalId + 'Label').text(title + ' Details');

        
        $('#' + modalId + ' .modal-body').html(
            '<p>Title: ' + title + '</p>' +
            '<p>Description: ' + description + '</p>' +
            '<p>Status: ' + status + '</p>'
        );

        $('#' + modalId).modal('show');
    }
    </script>
</x-app-layout>
        

                           
    