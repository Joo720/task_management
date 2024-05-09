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
    <div class="container p-5 mt-3  shadow-lg rounded-5" id="table-list">

        <table class="table table-responsive-lg   table-striped ">

            <thead>

                <tr>

                    <th>Sno</th>

                    <th>Profile</th>

                    <th>Name</th>

                    <th>Operations</th>

                </tr>
            </thead>
            <tbody>
                <tr>

                    <td><img src="<%= user.getProfile() %>" alt="Profile Image" width="100" height="100"
                            class="rounded-circle"></td>

                    <td>
                        <%= user.getAnimeId() %>
                    </td>

                    <td></td>

                    <td>
    <button onclick="openModal('modelConfirm')"
           type="button" class="btn btn-primary"><span class="bi bi-eye"></span></button>
    <button type="button" class="btn btn-success"><span class="bi bi-pencil-fill"></span></button>
    <button type="button" class="btn btn-danger"><span class="bi bi-trash-fill"></span></button>
</td>
                </tr>


                </tbody>     

        </table>


<div id="modelConfirm" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('modelConfirm')">&times;</span>
        <p>This is your modal content.</p>
    </div>
</div>
<body>

</body>

</html>
<script>
    function openModal(modalId) {
        var modal = document.getElementById(modalId);
        modal.style.display = "block";
    }

    // Function to close the modal
    function closeModal(modalId) {
        var modal = document.getElementById(modalId);
        modal.style.display = "none";
    }

    </script>