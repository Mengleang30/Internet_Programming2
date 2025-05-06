<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Upload Document</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f3f4f6;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .upload-container {
      background: #fff;
      padding: 30px 40px;
      border-radius: 12px;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
      text-align: center;
    }

    h3 {
      margin-bottom: 20px;
      color: #333;
    }

    input[type="file"] {
      margin-bottom: 20px;
      border: 1px solid #ccc;
      padding: 8px;
      border-radius: 6px;
    }

    button {
      background-color: #2563eb;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    button:hover {
      background-color: #1d4ed8;
    }
  </style>
</head>

<body>
  <div class="upload-container">

    <h3>Upload File</h3>
    <form action="/upload" method="POST" enctype="multipart/form-data">
      @csrf
      <input type="file" name="document" required />
      <br />
      <button type="submit">Upload</button>
    </form>
    <br>
    @if(session('success'))
    <div style="color: green; margin-bottom: 20px;">
      {{ session('success') }}
    </div>
    @endif
  </div>
</body>

</html>
