<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload CSV Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body
    class="bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 min-h-screen flex items-center justify-center p-6">

    <div class="bg-white rounded-2xl shadow-2xl p-8 max-w-lg w-full">
        @session('success')
            <div class="alert alert-success">

            </div>
        @endsession
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Upload CSV Document</h1>
        <p class="text-gray-600 text-sm mb-8">Select or drag a CSV file to upload</p>

        <form action="{{ route('users.import') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <label for="fileInput"
                class="block border-2 border-dashed border-indigo-400 rounded-xl p-12 text-center bg-indigo-50 hover:bg-indigo-100 transition-colors cursor-pointer">
                <div class="text-6xl mb-4">📊</div>
                <div class="text-gray-700 font-medium text-lg mb-2">Click to browse or drag & drop</div>
                <div class="text-gray-500 text-sm">CSV files only (Max 10MB)</div>
            </label>
            <input type="file" id="fileInput" name="file" accept=".csv" class="hidden">

            <div class="mt-6 p-4 bg-indigo-50 rounded-lg hidden">
                <div class="text-gray-800 font-medium mb-1">document.csv</div>
                <div class="text-gray-600 text-sm">2.5 MB</div>
            </div>

            <div class="text-red-500 text-sm mt-4 hidden">
                Please select a valid CSV file
            </div>

            <button type="submit"
                class="w-full mt-6 bg-gradient-to-r from-indigo-500 to-purple-600 text-white font-semibold py-3 px-6 rounded-lg hover:shadow-lg transition-shadow disabled:bg-gray-300 disabled:cursor-not-allowed">
                Upload Document
            </button>
        </form>

        <a href="{{ route('users.export') }}" class="btn btn-primary"></a>

     <div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Users List</h3>
    <a href="{{ route('users.export') }}" class="btn btn-success">Export Users</a>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
    </div>
</body>

</html>