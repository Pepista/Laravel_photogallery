<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Sign Out Form -->
    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
        @csrf
        <button type="submit" class="btn btn-danger sign-out-btn">Sign Out</button>
    </form>

    <h1>Welcome, Admin!</h1>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if(session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    <!-- Image Upload Form -->
    <h2>Upload Image</h2>
    <form action="{{ route('admin.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="image" required>
        <button type="submit">Upload Image</button>
    </form>

    <!-- Display Uploaded Images -->
    <h2>Uploaded Images</h2>
    <div class="scroll-container">
        @foreach($images as $image)
            <div class="section">
                <!-- Displaying the uploaded image -->
                <img src="{{ asset('storage/images/'.$image->filename) }}" alt="Uploaded Image" style="max-width: 100%; height: auto;">
                <div class="text-content">
                    <p>{{ $image->filename }}</p>
                    <!-- Form to remove the image (no sign-out involved) -->
                    <form action="{{ route('admin.remove', $image->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="remove-btn">Remove</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    <style>
        /* Styling for the admin page, image display, and buttons */
        .scroll-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            padding: 20px;
        }

        .section {
            width: 300px;
            text-align: center;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 8px;
            background-color: #f4f4f4;
        }

        .section img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .remove-btn {
            padding: 8px 16px;
            background-color: #ff4b5c;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .remove-btn:hover {
            background-color: #e0394f;
        }

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
    </style>
</head>
<body>

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
