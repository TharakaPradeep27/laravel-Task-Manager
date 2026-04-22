<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Task Dashboard</title>
    
    <!-- Google Fonts: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --bg: #f8fafc;
            --card-bg: #ffffff;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --border: #e2e8f0;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-bottom: 50px;
        }

        /* Navbar Styling */
        nav {
            width: 100%;
            background: var(--card-bg);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }

        .nav-logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nav-user {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .logout-btn {
            background: none;
            border: 1px solid var(--border);
            padding: 8px 16px;
            border-radius: 8px;
            color: var(--text-muted);
            cursor: pointer;
            font-weight: 500;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .logout-btn:hover {
            background: var(--danger);
            color: white;
            border-color: var(--danger);
        }

        /* Main Container */
        .container {
            width: 90%;
            max-width: 1000px;
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        /* Card Styling */
        .card {
            background: var(--card-bg);
            border-radius: 16px;
            box-shadow: var(--shadow);
            padding: 2rem;
            border: 1px solid var(--border);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text-main);
        }

        /* Table Styling */
        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        th {
            padding: 12px 16px;
            background: #f1f5f9;
            color: var(--text-muted);
            font-weight: 600;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.025em;
        }

        td {
            padding: 16px;
            border-bottom: 1px solid var(--border);
            font-size: 0.95rem;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover td {
            background-color: #f8fafc;
        }

        /* Badge Styling */
        .badge {
            padding: 4px 10px;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: capitalize;
        }

        .badge-pending { background: #fef3c7; color: #d97706; }
        .badge-in_progress { background: #dbeafe; color: #2563eb; }
        .badge-completed { background: #d1fae5; color: #059669; }

        /* Form Styling */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }
        
        @media (max-width: 640px) {
            .form-grid { grid-template-columns: 1fr; }
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group.full-width {
            grid-column: span 2;
        }
        
        @media (max-width: 640px) {
            .form-group.full-width { grid-column: span 1; }
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--text-muted);
        }

        input, textarea, select {
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            border: 1px solid var(--border);
            background: #f8fafc;
            color: var(--text-main);
            font-family: inherit;
            font-size: 1rem;
            transition: all 0.2s;
        }

        input:focus, textarea:focus, select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
            background: white;
        }

        .submit-btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(to right, var(--primary), var(--primary-hover));
            color: white;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
            margin-top: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.4);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        /* Filter Bar Styling */
        .filter-bar {
            display: flex;
            gap: 1rem;
            align-items: flex-end;
            flex-wrap: wrap;
            background: var(--card-bg);
            padding: 1.25rem;
            border-radius: 16px;
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
            margin-bottom: 1rem;
        }

        .filter-group {
            flex: 1;
            min-width: 200px;
        }

        .filter-actions {
            display: flex;
            gap: 10px;
        }

        .filter-btn {
            padding: 10px 20px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .filter-btn:hover { background: var(--primary-hover); }

        .reset-btn {
            padding: 10px 20px;
            background: #f1f5f9;
            color: var(--text-muted);
            border: 1px solid var(--border);
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }

        .reset-btn:hover { background: #e2e8f0; color: var(--text-main); }

        /* Success & Error Messages */
        .alert {
            padding: 1rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 500;
        }

        .alert-success {
            background: #ecfdf5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .alert-error {
            background: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .empty-state {
            padding: 3rem;
            text-align: center;
            color: var(--text-muted);
        }

        .empty-state i {
            display: block;
            margin-bottom: 1rem;
            font-size: 3rem;
            color: var(--border);
        }
    </style>
</head>
<body>

    <nav>
        <div class="nav-logo">
            <i class="fas fa-tasks"></i>
            TaskMaster
        </div>
        <div class="nav-user">
            <span style="font-weight: 500; color: var(--text-muted);">
                Welcome, <span style="color: var(--text-main);">{{ Auth::user()->name }}</span>
            </span>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i>
                    Logout
                </button>
            </form>
        </div>
    </nav>

    <div class="container">
        
        <!-- Alerts Area -->
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle"></i>
                <ul style="list-style: none;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Filter Bar -->
        <form action="{{ route('user.dashboard') }}" method="GET" class="filter-bar">
            <div class="filter-group">
                <label>Search Tasks</label>
                <div style="position: relative;">
                    <i class="fas fa-search" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: var(--text-muted);"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by title..." style="padding-left: 38px;">
                </div>
            </div>

            <div class="filter-group" style="max-width: 200px;">
                <label>Status</label>
                <select name="status">
                    <option value="">All Statuses</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="in progress" {{ request('status') == 'in progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </div>

            <div class="filter-actions">
                <button type="submit" class="filter-btn">
                    <i class="fas fa-filter"></i>
                    Filter
                </button>
                @if(request('search') || request('status'))
                    <a href="{{ route('user.dashboard') }}" class="reset-btn">
                        <i class="fas fa-redo" style="margin-right: 8px;"></i>
                        Reset
                    </a>
                @endif
            </div>
        </form>

        <!-- Task List Card -->
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">My Tasks</h2>
                <span style="background: #f1f5f9; padding: 4px 12px; border-radius: 8px; font-size: 0.875rem; font-weight: 600; color: var(--text-muted);">
                    {{ count($tasks) }} Total
                </span>
            </div>
            
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Due Date</th>
                            <th style="text-align: center;">Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tasks as $task)
                            <tr>
                                <td style="font-weight: 500;">{{ $task->title }}</td>
                                <td>
                                    <span class="badge badge-{{ str_replace(' ', '_', $task->status) }}">
                                        {{ $task->status }}
                                    </span>
                                </td>
                                <td style="color: var(--text-muted); font-size: 0.875rem;">
                                    <i class="far fa-calendar-alt" style="margin-right: 5px;"></i>
                                    {{ \Carbon\Carbon::parse($task->due_date)->format('M d, Y') }}
                                </td>
                                <td style="text-align: center;">
                                    <div style="display: flex; justify-content: center; gap: 10px;">
                                        <a href="{{ route('task.edit', $task->id) }}" style="color: var(--primary); text-decoration: none; font-size: 1.1rem;" title="Edit Task">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('task.delete', $task->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this task?');" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="background: none; border: none; color: var(--danger); cursor: pointer; font-size: 1.1rem; padding: 0;" title="Delete Task">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">
                                    <div class="empty-state">
                                        <i class="fas fa-clipboard-list"></i>
                                        <p>No tasks found. Add your first task below!</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Add Task Card -->
        <div class="card" style="max-width: 600px; align-self: center; width: 100%;">
            <div class="card-header">
                <h2 class="card-title">Add New Task</h2>
            </div>

            <form action="{{ route('task.add') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label>Task Title</label>
                    <input type="text" name="title" placeholder="What needs to be done?" required>
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" rows="3" placeholder="Add some details..." required></textarea>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" required>
                            <option value="pending">Pending</option>
                            <option value="in progress">In Progress</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Due Date</label>
                        <input type="date" name="due_date" required>
                    </div>
                </div>

                <button type="submit" class="submit-btn">
                    <i class="fas fa-plus"></i>
                    Create Task
                </button>
            </form>
        </div>

    </div>

</body>
</html>
