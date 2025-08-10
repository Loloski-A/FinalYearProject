<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Disaster Response</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center p-8">
        <div class="max-w-md w-full bg-white p-8 rounded-2xl shadow-lg">
            <h2 class="text-3xl font-bold text-gray-800 mb-2 text-center">Admin Sign In</h2>
            <p class="text-gray-600 mb-8 text-center">Enter your credentials to access the dashboard.</p>

            @include('_message')

            <form action="{{ url('login_admin')}}" method="post">
                {{ csrf_field() }}
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <input type="email" name="email" id="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="you@example.com" required>
                </div>
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" id="password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="••••••••" required>
                </div>
                <div class="flex items-center justify-between mb-6">
                    <a href="{{ url('forgot') }}" class="text-sm text-blue-600 hover:underline">Forgot Password?</a>
                </div>
                <button type="submit" class="w-full bg-blue-600 text-white font-semibold py-3 px-4 rounded-lg hover:bg-blue-700 transition-colors">Sign In</button>
            </form>
            <p class="text-center text-sm text-gray-600 mt-8">
                Don't have an account? <a href="{{ url('register') }}" class="font-medium text-blue-600 hover:underline">Register here</a>
            </p>
        </div>
    </div>
</body>
</html>
