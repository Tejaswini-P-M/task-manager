<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Task Manager</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

 <style>
  body {
    background: linear-gradient(135deg, #74ebd5 0%, #9face6 100%);
    min-height: 100vh;
    font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
  }
  .navbar {
    background: rgba(255, 255, 255, 0.9) !important;
    backdrop-filter: blur(6px);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
  }
  .container {
    background: #fff;
    padding: 2rem;
    border-radius: 15px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    margin-top: 2rem;
  }
  .task-item {
    cursor: grab;
    background: #f8f9fa;
    border: 1px solid #e0e0e0;
    border-radius: 10px;
    padding: 12px 16px;
    margin-bottom: 10px;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
  }

  .task-item:hover {
    transform: scale(1.02);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  }

  .task-item.completed .task-title {
    text-decoration: line-through;
    opacity: 0.6;
  }
  .btn-primary {
    background: linear-gradient(45deg, #667eea, #764ba2);
    border: none;
    border-radius: 30px;
    padding: 10px 20px;
    transition: background 0.3s ease, transform 0.2s ease;
  }

  .btn-primary:hover {
    background: linear-gradient(45deg, #5a67d8, #6b46c1);
    transform: translateY(-2px);
  }
  .alert {
    border-radius: 12px;
    font-weight: 500;
  }
</style>

  @stack('styles')
</head>
<body>


<style>
  .navbar-title {
    margin-left: 20px; 
    font-weight: 600;  
    font-size: 1.4rem; 
  }
</style>


  <div class="container">
    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    @endif

    @yield('content')
  </div>
  <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
  <script>
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
  </script>

  @stack('scripts')
</body>
</html>
