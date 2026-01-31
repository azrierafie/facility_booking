<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Facility Booking</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            background: linear-gradient(135deg, #1a0610 0%, #3d0a1f 25%, #5c0f30 50%, #800020 75%, #a61b3a 100%);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
            position: relative;
            overflow: auto;
        }
        
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        /* Subtle background pattern */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.05) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(255, 255, 255, 0.05) 0%, transparent 50%);
            pointer-events: none;
            z-index: 1;
        }
        
        /* Subtle animated shapes */
        .bg-shape {
            position: fixed;
            border-radius: 50%;
            opacity: 0.08;
            z-index: 1;
        }
        
        .bg-shape-1 {
            width: 400px;
            height: 400px;
            background: linear-gradient(135deg, #ffffff 0%, #f0f0f0 100%);
            top: -200px;
            right: -200px;
            animation: float 20s ease-in-out infinite;
        }
        
        .bg-shape-2 {
            width: 300px;
            height: 300px;
            background: linear-gradient(135deg, #ffffff 0%, #f0f0f0 100%);
            bottom: -150px;
            left: -150px;
            animation: float 25s ease-in-out infinite reverse;
        }
        
        @keyframes float {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(30px, 30px); }
        }
        
        .login-container {
            width: 100%;
            max-width: 440px;
            position: relative;
            z-index: 10;
        }
        
        .brand {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .brand-icon {
            width: 64px;
            height: 64px;
            background: linear-gradient(135deg, #800020 0%, #a61b3a 100%);
            border-radius: 16px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            font-size: 2rem;
            box-shadow: 0 10px 40px rgba(128, 0, 32, 0.2);
        }
        
        .brand h1 {
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
            color: white;
            letter-spacing: -0.02em;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }
        
        .brand p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.9rem;
            font-weight: 500;
        }
        
        .login-card {
            background: white;
            border-radius: 16px;
            padding: 2.5rem;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(226, 232, 240, 0.8);
        }
        
        .login-card h2 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: #1a202c;
        }
        
        .login-card .subtitle {
            color: #64748b;
            margin-bottom: 2rem;
            font-size: 0.9rem;
        }
        
        .role-selection {
            display: flex;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
        }
        
        .role-btn {
            flex: 1;
            padding: 0.875rem 1rem;
            border: 2px solid #e2e8f0;
            background: white;
            color: #64748b;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.2s ease;
            font-family: 'Inter', sans-serif;
            font-size: 0.875rem;
            font-weight: 600;
        }
        
        .role-btn.active {
            border-color: #800020;
            background: #800020;
            color: white;
            box-shadow: 0 4px 12px rgba(128, 0, 32, 0.2);
        }
        
        .role-btn:hover:not(.active) {
            border-color: #cbd5e1;
            background: #f8fafc;
        }
        
        .role-info {
            text-align: center;
            color: #64748b;
            margin-bottom: 1.5rem;
            font-size: 0.813rem;
            padding: 0.75rem 1rem;
            background: #f8fafc;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
        }
        
        .role-info span {
            font-weight: 600;
            color: #800020;
        }
        
        .guest-link {
            display: block;
            width: 100%;
            padding: 0.875rem 1rem;
            background: #f0fdf4;
            color: #059669;
            border: 2px solid #d1fae5;
            border-radius: 10px;
            text-align: center;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.875rem;
            transition: all 0.2s ease;
            margin-bottom: 1.5rem;
        }
        
        .guest-link:hover {
            background: #059669;
            color: white;
            border-color: #059669;
        }
        
        .form-group {
            margin-bottom: 1.25rem;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
            font-weight: 600;
            color: #334155;
        }
        
        .form-group input {
            width: 100%;
            padding: 0.875rem 1rem;
            background: #f8fafc;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            color: #1a202c;
            font-size: 0.938rem;
            transition: all 0.2s ease;
            font-family: 'Inter', sans-serif;
        }
        
        .form-group input:focus {
            outline: none;
            border-color: #800020;
            background: white;
            box-shadow: 0 0 0 3px rgba(128, 0, 32, 0.1);
        }
        
        .form-group input::placeholder {
            color: #94a3b8;
        }
        
        .login-btn {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, #800020 0%, #a61b3a 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 700;
            font-size: 0.938rem;
            cursor: pointer;
            transition: all 0.2s ease;
            margin-bottom: 1.25rem;
            box-shadow: 0 4px 12px rgba(128, 0, 32, 0.2);
        }
        
        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(128, 0, 32, 0.3);
        }
        
        .login-btn:active {
            transform: translateY(0);
        }
        
        .register-text {
            text-align: center;
            color: #64748b;
            font-size: 0.875rem;
        }
        
        .register-text a {
            color: #800020;
            text-decoration: none;
            font-weight: 600;
        }
        
        .register-text a:hover {
            text-decoration: underline;
        }
        
        .message {
            padding: 0.875rem 1rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            font-size: 0.875rem;
            font-weight: 500;
        }
        
        .message.error {
            background: #fef2f2;
            border: 2px solid #fecaca;
            color: #dc2626;
        }
        
        .message.success {
            background: #f0fdf4;
            border: 2px solid #bbf7d0;
            color: #059669;
        }
        
        /* Responsive */
        @media (max-width: 640px) {
            body {
                padding: 1rem;
            }
            
            .login-card {
                padding: 2rem 1.5rem;
            }
            
            .brand h1 {
                font-size: 1.5rem;
            }
            
            .role-selection {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <!-- Subtle background shapes -->
    <div class="bg-shape bg-shape-1"></div>
    <div class="bg-shape bg-shape-2"></div>
    
    <div class="login-container">
        <div class="brand">
            <div class="brand-icon">📋</div>
            <h1>Facility Booking</h1>
            <p>Professional Facility Management System</p>
        </div>
        
        <div class="login-card">
            <h2>Welcome Back</h2>
            <p class="subtitle">Please sign in to continue</p>
            
            <?php
            $flash = $this->Flash;
            if ($flash): 
                echo $flash->render();
            endif;
            ?>
            
            <div class="role-selection">
                <button type="button" class="role-btn" onclick="selectRole('admin')" data-role="admin">
                    🔥 Login as Admin
                </button>
                <button type="button" class="role-btn active" onclick="selectRole('user')" data-role="user">
                    👤 Login as User
                </button>
            </div>
            
            <p class="role-info">
                Selected: <span id="selected-role">User</span> 
                - You'll be redirected to <span id="redirect-target">Home</span>
            </p>
            
            <a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'display', 'home']) ?>" class="guest-link">
                🌐 Browse as Guest
            </a>
            
            <?= $this->Form->create(null) ?>
                <input type="hidden" name="login_type" id="loginType" value="user">
                
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>
                
                <button type="submit" class="login-btn">Login</button>
            <?= $this->Form->end() ?>
            
            <p class="register-text">
                Don't have an account? <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'register']) ?>">Register here</a>
            </p>
        </div>
    </div>
    
    <script>
        // Role selection function
        function selectRole(role) {
            const buttons = document.querySelectorAll('.role-btn');
            const roleText = document.getElementById('selected-role');
            const redirectTarget = document.getElementById('redirect-target');
            const loginTypeInput = document.getElementById('loginType');
            
            buttons.forEach(btn => {
                if (btn.getAttribute('data-role') === role) {
                    btn.classList.add('active');
                } else {
                    btn.classList.remove('active');
                }
            });
            
            loginTypeInput.value = role;
            
            if (role === 'admin') {
                roleText.textContent = 'Admin';
                redirectTarget.textContent = 'Dashboard';
            } else {
                roleText.textContent = 'User';
                redirectTarget.textContent = 'Home';
            }
        }
    </script>
</body>
</html>
