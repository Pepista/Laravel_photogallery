<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style>
        /* Global styles */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f4f8;
            margin: 0;
            padding: 0;
            color: #333;
        }

        header {
            background-color: #2c3e50;
            color: white;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        h1 {
            margin: 0;
            font-size: 24px;
        }

        .sign-out-btn {
            padding: 10px 20px;
            background-color: #ff4b5c;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .sign-out-btn:hover {
            background-color: #e0394f;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 30px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .alert {
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .alert.success {
            background-color: #d4edda;
            color: #155724;
        }

        .alert.error {
            background-color: #f8d7da;
            color: #721c24;
        }

        h2 {
            font-size: 22px;
            margin-bottom: 15px;
            color: #333;
        }

        .form-input {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 15px;
            font-size: 16px;
            color: #333;
            background-color: #fafafa;
        }

        .form-input[type="file"] {
            padding: 5px;
        }

        .form-btn {
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .form-btn:hover {
            background-color: #2980b9;
        }

        .image-gallery {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .image-card {
            width: 250px;
            text-align: center;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .image-card:hover {
            transform: scale(1.05);
        }

        .image-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }

        .image-card p {
            padding: 10px;
            font-size: 16px;
            font-weight: bold;
            color: #333;
        }

        .remove-btn {
            padding: 8px 16px;
            background-color: #e74c3c;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .remove-btn:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>

<header>
    
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="sign-out-btn">Sign Out</button>
    </form>
</header>

<div class="container">

    @if(session('success'))
        <div class="alert success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert error">
            {{ session('error') }}
        </div>
    @endif

    <!-- Upload Image Section -->
    <section>
        
        </form>
    </section>

    <!-- Image Gallery Section -->
    <section>
        <h2>Uploaded Images</h2>
        <div class="image-gallery">
            @foreach($images as $image)
                <div class="image-card">
                    <p>{{ $image->description ?? 'No description' }}</p>
                    <a href="{{ asset('storage/images/'.$image->filename) }}" target="_blank">
                        <img src="{{ asset('storage/images/'.$image->filename) }}" alt="Uploaded Image">
                    </a>
                    <!-- Form for removing the image -->
                    <form action="{{ route('admin.remove', $image->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to remove this image?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="remove-btn">Remove</button>
                    </form>
                </div>
            @endforeach
        </div>
    </section>

</div>

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
