

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary view-btn" data-toggle="modal" data-target="#taskModal">
  View
</button>

<!-- Modal -->
<div class="modal fade" id="taskModal" tabindex="-1" role="dialog" aria-labelledby="taskModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="taskModalLabel">Task Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Comments Section -->
        <div class="comments-section mt-4" style="max-height: 300px; overflow-y: auto;">
          <!-- Single Comment -->
          <div class="media">
            <img class="mr-3 rounded-circle" src="https://via.placeholder.com/64" alt="User Avatar">
            <div class="media-body bg-light rounded p-2">
              <h6 class="mt-0 mb-1" style="font-size: smaller;">User 1</h6>
              <p class="m-0" style="font-size: smaller;">Comment 1</p>
            </div>
          </div>
          <!-- End of Single Comment -->
          <!-- Single Comment -->
          <div class="media mt-3">
            <img class="mr-3 rounded-circle" src="https://via.placeholder.com/64" alt="User Avatar">
            <div class="media-body bg-light rounded p-2">
              <h6 class="mt-0 mb-1" style="font-size: smaller;">User 2</h6>
              <p class="m-0" style="font-size: smaller;">Comment 2</p>
            </div>
          </div>
          <!-- End of Single Comment -->
          <!-- Add dynamic content for comments using PHP/Laravel -->
        </div>
        <!-- Add New Comment Form -->
        <div class="add-comment-form mt-4">
          <h6>Add New Comment:</h6>
          <form>
            <div class="form-group">
              <textarea class="form-control" id="commentTextarea" rows="3" placeholder="Write your comment here..." style="font-size: smaller;"></textarea>
            </div>
            <div class="form-group">
              <label for="fileUpload">Add Attachment:</label>
              <input type="file" class="form-control-file" id="fileUpload">
            </div>
            <button type="submit" class="btn btn-primary">Post Comment</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>