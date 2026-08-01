<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Manage Services</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f6f7fb; color: #1f2937; margin: 0; padding: 32px; }
        .wrap { max-width: 1100px; margin: 0 auto; }
        .topbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; }
        .card { background: #fff; border-radius: 14px; box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08); padding: 20px; margin-bottom: 24px; }
        .grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 14px; }
        label { display: block; font-size: 13px; font-weight: 600; margin-bottom: 6px; }
        input, select, textarea { width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 10px; box-sizing: border-box; }
        textarea { min-height: 90px; resize: vertical; }
        button, .btn { background: #111827; color: #fff; border: 0; border-radius: 10px; padding: 10px 14px; cursor: pointer; text-decoration: none; display: inline-block; }
        .btn-light { background: #e5e7eb; color: #111827; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px; border-bottom: 1px solid #e5e7eb; text-align: left; vertical-align: top; }
        .actions { display: flex; gap: 8px; flex-wrap: wrap; }
        .status { color: #6b7280; font-size: 14px; }
        .flash { margin-bottom: 16px; padding: 12px 14px; border-radius: 10px; }
        .flash.success { background: #dcfce7; color: #166534; }
        .flash.error { background: #fee2e2; color: #991b1b; }
    </style>
</head>
<body>
<div class="wrap">
    <div class="topbar">
        <div>
            <h1 style="margin:0 0 6px;">Manage Services</h1>
            <div class="status">Admin catalog for bookable services.</div>
        </div>
        <div class="actions">
            <a class="btn-light btn" href="{{ route('admin.dashboard') }}">Dashboard</a>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    </div>

    @if (session('success'))
        <div class="flash success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="flash error">{{ $errors->first() }}</div>
    @endif

    <div class="card">
        <h2 style="margin-top:0;">Add Service</h2>
        <form method="POST" action="{{ route('manageservice.store') }}">
            @csrf
            <div class="grid">
                <div>
                    <label for="service_name">Name</label>
                    <input id="service_name" type="text" name="name" value="{{ old('name') }}" required>
                </div>
                <div>
                    <label for="category_id">Category</label>
                    <select id="category_id" name="category_id" required>
                        <option value="">Select category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected((string) old('category_id') === (string) $category->id)>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="price">Base Price</label>
                    <input id="price" type="number" step="0.01" min="0" name="price" value="{{ old('price') }}">
                </div>
            </div>
            <div style="margin-top:14px;">
                <label for="description">Description</label>
                <textarea id="description" name="description">{{ old('description') }}</textarea>
            </div>
            <div style="margin-top:14px;">
                <button type="submit">Create Service</button>
            </div>
        </form>
    </div>

    <div class="card">
        <h2 style="margin-top:0;">Existing Services</h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($services as $service)
                    <tr>
                        <td>{{ $service->name }}</td>
                        <td>{{ $service->category?->name ?? 'Unassigned' }}</td>
                        <td>{{ $service->price !== null ? number_format((float) $service->price, 2) : 'N/A' }}</td>
                        <td>{{ $service->description ?: 'No description' }}</td>
                        <td>
                            <div class="actions">
                                <form method="POST" action="{{ route('manageservice.update', $service->id) }}" style="display:grid; gap:8px; min-width:260px;">
                                    @csrf
                                    @method('PUT')
                                    <input type="text" name="name" value="{{ $service->name }}" required>
                                    <select name="category_id" required>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" @selected($service->category_id === $category->id)>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <input type="number" step="0.01" min="0" name="price" value="{{ $service->price }}">
                                    <textarea name="description">{{ $service->description }}</textarea>
                                    <button type="submit">Save</button>
                                </form>
                                <form method="POST" action="{{ route('manageservice.destroy', $service->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-light" onclick="return confirm('Delete this service?')">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">No services found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
