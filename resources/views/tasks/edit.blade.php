
@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-8 offset-md-2">
    <h3>Edit Task</h3>
    <form action="{{ route('tasks.update', $task) }}" method="POST">
      @csrf
      @method('PUT')

      <div class="mb-3">
        <label class="form-label">Title</label>
        <input name="title" type="text" class="form-control" value="{{ old('title', $task->title) }}" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="4">{{ old('description', $task->description) }}</textarea>
      </div>

      <div class="d-flex gap-2">
        <a href="{{ route('tasks.index') }}" class="btn btn-outline-primary">Cancel</a>
        <button class="btn btn-primary" type="submit">Save</button>
      </div>
    </form>
  </div>
</div>
@endsection
