@extends('layouts.app')

@section('content')
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Tasks</h3>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createTaskModal">+ New Task</button>
  </div>


  <div class="mb-3">
    <a href="{{ route('tasks.index', ['filter' => 'all']) }}"
      class="btn btn-sm {{ $filter === 'all' ? 'btn-secondary' : 'btn-outline-secondary' }}">All</a>
    <a href="{{ route('tasks.index', ['filter' => 'completed']) }}"
      class="btn btn-sm {{ $filter === 'completed' ? 'btn-secondary' : 'btn-outline-secondary' }}">Completed</a>
    <a href="{{ route('tasks.index', ['filter' => 'incomplete']) }}"
      class="btn btn-sm {{ $filter === 'incomplete' ? 'btn-secondary' : 'btn-outline-secondary' }}">Incomplete</a>
  </div>


  <div class="card">
    <div class="card-body">
      <ul id="task-list" class="list-group">
        @forelse($tasks as $task)
          <li
            class="list-group-item d-flex justify-content-between align-items-start task-item {{ $task->is_completed ? 'completed' : '' }}"
            data-id="{{ $task->id }}">
            <div class="ms-2 me-auto">
              <div class="fw-bold task-title">{{ $task->title }}</div>
              <div class="small text-muted">{{ $task->description }}</div>
            </div>

            <div class="d-flex gap-2">
              <button class="btn btn-sm btn-outline-success toggle-complete" data-id="{{ $task->id }}">
                @if($task->is_completed) Mark Incomplete @else Mark Complete @endif
              </button>

              <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-outline-primary">
                Edit
              </a>

              <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                onsubmit="return confirm('Delete this task?');" class="m-0">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-outline-danger">
                  Delete
                </button>
              </form>
            </div>

          </li>
        @empty
          <li class="list-group-item">No tasks yet. Add one!</li>
        @endforelse
      </ul>
    </div>
  </div>
  <div class="modal fade" id="createTaskModal" tabindex="-1" aria-labelledby="createTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form action="{{ route('tasks.store') }}" method="POST" class="modal-content">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="createTaskModalLabel">Create Task</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Title</label>
            <input name="title" type="text" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="3"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Create</button>

        </div>
      </form>
    </div>
  </div>

@endsection

@push('scripts')
  <script>
    (function () {
    
      const el = document.getElementById('task-list');
      if (el) {
        const sortable = Sortable.create(el, {
          animation: 150,
          onEnd: function (evt) {
          
            const ids = Array.from(el.querySelectorAll('li')).map(li => li.dataset.id);
          
            $.post("{{ route('tasks.reorder') }}", { order: ids })
              .done(function (res) {
              }).fail(function () {
                alert('Failed to save new order.');
              });
          }
        });
      }

     
      $(document).on('click', '.toggle-complete', function () {
        const id = $(this).data('id');
        const btn = $(this);
        $.post(`/tasks/${id}/toggle`)
          .done(function (res) {
            if (res.success) {
              const li = btn.closest('li');
              if (res.is_completed) {
                li.addClass('completed');
                btn.text('Mark Incomplete');
              } else {
                li.removeClass('completed');
                btn.text('Mark Complete');
              }
            }
          }).fail(function () {
            alert('Failed to toggle task.');
          });
      });
    })();
  </script>
@endpush