<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sideways Scroll Section</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
        @csrf
        <button type="submit" class="btn btn-danger">Sign Out</button>
    </form>

    <style>
        /* Reset body styles */
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
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
            min-width: 100vw; /* Each section occupies full viewport width */
            height: 100%; /* Each section occupies full viewport height */
            flex-shrink: 0;
            scroll-snap-align: start;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            background-color: #e0e0e0;
            border-radius: 8px;
            overflow: hidden; /* Prevent any overflow from sections */
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

        /* Style every even section with a different background */
        .section:nth-child(even) {
            background-color: #ccc;
        }

        /* Hide the scrollbar */
        .scroll-container::-webkit-scrollbar {
            display: none;
        }

        /* Optional: Add transition effects for smooth scrolling */
        .scroll-container {
            transition: transform 0.5s ease;
        }
    </style>
</head>
<body>

    <div class="scroll-container">
        <!-- Generate 20 sections with placeholder images -->
        @for ($i = 1; $i <= 20; $i++)
            <div class="section">
                <img src="https://via.placeholder.com/1500x1000?text=Image+{{ $i }}" alt="Image {{ $i }}">
                <div class="text-content">Section {{ $i }}</div>
            </div>
        @endfor
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
