<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Registration Test</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .form-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #FF7B7B;
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }
        input, select {
            width: 100%;
            padding: 10px;
            border: 2px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }
        input:focus, select:focus {
            border-color: #FF7B7B;
            outline: none;
        }
        button {
            width: 100%;
            padding: 12px;
            background-color: #FF7B7B;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 10px;
        }
        button:hover {
            background-color: #FF6B6B;
        }
        .error {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }
        .success {
            color: green;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>🐷 PIGGY Registration</h2>
        <p style="text-align: center; color: #666; margin-bottom: 20px;">
            Create your PIGGY Bank account with real MySQL database storage
        </p>
        
        @if(session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="error">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register.submit') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" id="first_name" name="first_name" value="{{ old('first_name', 'Juan') }}" required>
            </div>

            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" id="last_name" name="last_name" value="{{ old('last_name', 'Dela Cruz') }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="{{ old('email', 'test@example.com') }}" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" id="phone" name="phone" value="{{ old('phone', '+639171234567') }}" required>
            </div>

            <div class="form-group">
                <label for="date_of_birth">Date of Birth:</label>
                <input type="date" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', '1990-01-01') }}" required>
            </div>

            <div class="form-group">
                <label for="gender">Gender:</label>
                <select id="gender" name="gender" required>
                    <option value="">Select Gender</option>
                    <option value="male" {{ old('gender') == 'male' ? 'selected' : 'selected' }}>Male</option>
                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                    <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>

            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" value="{{ old('address', '123 Rizal St., Makati City, Metro Manila') }}" required>
            </div>

            <div class="form-group">
                <label for="city">City:</label>
                <input type="text" id="city" name="city" value="{{ old('city', 'Makati City') }}" required>
            </div>

            <div class="form-group">
                <label for="zip_code">ZIP Code:</label>
                <input type="text" id="zip_code" name="zip_code" value="{{ old('zip_code', '1200') }}" required>
            </div>

            <div class="form-group">
                <label for="occupation">Occupation:</label>
                <input type="text" id="occupation" name="occupation" value="{{ old('occupation', 'Software Developer') }}" required>
            </div>

            <div class="form-group">
                <label for="monthly_income">Monthly Income (₱):</label>
                <input type="number" id="monthly_income" name="monthly_income" value="{{ old('monthly_income', '50000') }}" min="0" step="0.01" required>
            </div>

            <div class="form-group">
                <label for="initial_deposit">Initial Deposit (₱):</label>
                <input type="number" id="initial_deposit" name="initial_deposit" value="{{ old('initial_deposit', '5000') }}" min="500" step="0.01" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" value="password123" required>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" value="password123" required>
            </div>

            <button type="submit">Create PIGGY Account</button>
        </form>

        <div style="margin-top: 20px; text-align: center; color: #666; font-size: 14px;">
            <p>✅ Real MySQL database storage</p>
            <p>📧 Email verification system</p>
            <p>💰 Initial deposit with transaction records</p>
            <p><a href="{{ url('/admin/pending-registrations') }}" style="color: #FF7B7B;">View Admin Panel</a> | 
               <a href="{{ url('/status') }}" style="color: #FF7B7B;">System Status</a></p>
        </div>
    </div>
</body>
</html>