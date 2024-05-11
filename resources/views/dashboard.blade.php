<x-app-layout>
<html>
    <head>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <link rel="dns-prefetch" href="//fonts.bunny.net"> -->
  <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
  
  <!-- Scripts -->
  @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    </head>
    <body>
            
       
    <div class="container mt-2">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Task Management') }}</div>

                    <div class="card-body">
                    <form method="POST" action="{{ route('tasks.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label">{{ __('Title') }}</label>
                                <input id="title" type="text" class="form-control" name="title" required autofocus>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">{{ __('Description') }}</label>
                                <textarea id="description" class="form-control" name="description" rows="3" required></textarea>
                            </div>
                        
                            <div class="mb-3">
                            <label for="assigned_to" class="form-label">{{ __('Assign Task To') }}</label>
    <select id="assigned_to" class="form-select" name="assigned_to" required>
        @foreach($user as $users)
            <option value="{{ $users->id }}">{{ $users->name }}</option>
        @endforeach
    </select>
                            </div>

                            <div class="mb-3">
                                <label for="file" class="form-label">{{ __('File') }}</label>
                                <input id="file" type="file" class="form-control" name="file">
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">{{ __('Status') }}</label>
                                <div class="btn-group" role="group" aria-label="Status">
                                <button type="button" class="btn btn-warning" onclick="setStatus('open', this)">Open</button>
        <button type="button" class="btn btn-danger" onclick="setStatus('progress', this)">In Progress</button>
        <button type="button" class="btn btn-success" onclick="setStatus('done', this)">Done</button>
    </div>
        <input type="hidden" id="status" name="status" value="">
</div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create Task') }}
                                </button>
                            </div>
                      
                   </form>
                        </div>
                </div>
            </div>
        </div>
    </div>
    </body>
</html>
</x-app-layout>

    <script>
    function setStatus(value, button) {
       
        var buttons = document.querySelectorAll('.btn-group button');
        buttons.forEach(function(btn) {
            btn.classList.remove('active');
        });

     
        button.classList.add('active');

     
        document.getElementById('status').value = value;
    }
</script>
    
