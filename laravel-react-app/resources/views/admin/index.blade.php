<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Image Upload</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Sign Out Form -->
    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
        @csrf
        <button type="submit" class="btn btn-danger sign-out-btn">Sign Out</button>
    </form>

    @if(Auth::check() && Auth::user()->email == 's2022CechakPetr@skolabaltaci.cz')
        <h1>Welcome, Pedro! (Admin Panel)</h1>

        @if(session('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif

        @if(session('error'))
            <p style="color: red;">{{ session('error') }}</p>
        @endif

        <!-- Image Upload Form -->
        <form action="{{ route('admin.upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="image">Upload Image:</label>
            <input type="file" name="image" id="image" required>
            <button type="submit">Upload</button>
        </form>

        <h2>Uploaded Images</h2>
        <!-- Display Images -->
        <div class="scroll-container">
            @if(count($images) > 0)
                @foreach($images as $index => $image)
                    <div class="section">
                        <img src="{{ Storage::url($image) }}" alt="Uploaded Image {{ $index + 1 }}">
                        <div class="text-content">Section {{ $index + 1 }}</div>
                    </div>
                @endforeach
            @else
                <p>No images uploaded yet.</p>
            @endif
        </div>

    @else
        <h1>Welcome to the Site!</h1>
        <p>You are logged in, but do not have access to the admin panel.</p>
    @endif

    <style>
        /* Sign Out Button Styling */
        .sign-out-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: 600;
            color: #fff;
            background-color: #ff4b5c;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .sign-out-btn:hover {
            background-color: #e0394f;
        }

        /* Scroll container settings */
        .scroll-container {
            display: flex;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            scroll-behavior: smooth;
            height: 100vh; /* Ensures full height of viewport */
            padding: 20px 0;
        }

        /* Individual section settings */
        .section {
            min-width: 100vw;  /* Each section occupies full viewport width */
            height: 100vh;     /* Each section occupies full viewport height */
            flex-shrink: 0;
            scroll-snap-align: start;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            background-color: #e0e0e0;
            border-radius: 8px;
            overflow: hidden;
        }

        .section img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 8px;
        }

        .section .text-content {
            position: absolute;
            color: white;
            text-align: center;
            font-size: 2rem;
            font-weight: 600;
            z-index: 1;
        }

        .section:nth-child(even) {
            background-color: #ccc;
        }

        /* Hide the scrollbar */
        .scroll-container::-webkit-scrollbar {
            display: none;
        }
    </style>
</head>
<body>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
