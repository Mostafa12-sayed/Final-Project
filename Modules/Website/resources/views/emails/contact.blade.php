<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <style>
    body {
      font-family: Arial, sans-serif;
      color: #333;
      line-height: 1.6;
      background-color: #f9f9f9;
      padding: 20px;
    }
    .container {
      background-color: #fff;
      padding: 25px;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      max-width: 600px;
      margin: auto;
    }
    h2 {
      color: #2c3e50;
    }
    .label {
      font-weight: bold;
    }
    .message-box {
      background-color: #f4f4f4;
      border-left: 4px solid #3498db;
      padding: 10px 15px;
      white-space: pre-wrap;
      font-family: monospace;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>New Contact Form Message</h2>
    <p><span class="label">Name:</span> {{ $data['name'] }}</p>
    <p><span class="label">Email:</span> {{ $data['email'] }}</p>
    <p><span class="label">Message:</span></p>
    <div class="message-box">
      Regarding your problem<br>
      "{{ $data['message'] }}"<br><br>
      We received your message and will get back to you as soon as possible.
    </div>
  </div>
</body>
</html>

