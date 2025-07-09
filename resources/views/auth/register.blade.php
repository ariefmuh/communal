<html>

<head>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            /* Menerapkan font Poppins ke seluruh body */
        }

        .input-focused {
            border-color: #0073A4;
            box-shadow: 0 0 0 3px #73C69C;
        }

        .input-filled {
            position: absolute;
            top: 1rem;
            left: 1rem;
            font-size: 1rem;
            color: #a0aec0;
            transition: all 0.3s ease;
            pointer-events: none;
        }

        .input-container {
            position: relative;
            border-radius: 0.375rem;
            padding: 0.25rem;
        }

        .password-toggle {
            position: absolute;
            right: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #4a5568;
            transition: color 0.3s ease, transform 0.3s ease;
        }

        .password-toggle:hover {
            color: #008DA6;
            transform: translateY(-50%) scale(1.2);
            /* Smooth hover scaling */
        }

        .password-toggle.active {
            color: #008DA6;
        }

        .checkbox-container {
            display: flex;
            align-items: center;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .checkbox-container:hover {
            color: #008DA6;
        }

        .checkbox-container input[type="checkbox"] {
            appearance: none;
            width: 1rem;
            height: 1rem;
            border: 2px solid #4a5568;
            border-radius: 0.25rem;
            transition: background-color 0.3s ease, border-color 0.3s ease, transform 0.3s ease;
            cursor: pointer;
        }

        .checkbox-container input[type="checkbox"]:checked {
            background-color: #008DA6;
            border-color: #008DA6;
            transform: scale(1.1);
            position: relative;
        }

        .checkbox-container input[type="checkbox"]:checked::after {
            content: '\f00c';
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            position: absolute;
            top: 0;
            left: 50%;
            transform: translate(-50%, -5%) scale(1);
            font-size: 0.7rem;
            color: white;
            transition: transform 0.3s ease, opacity 0.3s ease;
        }
    </style>
</head>

<body class="bg-[whitesmoke] flex items-center justify-center min-h-screen">
    <div class="bg-white rounded-lg shadow-lg flex overflow-hidden max-w-4xl">
        <div class="w-1/2">
            <img alt="Custom image" class="w-full h-full object-cover" src="https://i.ibb.co.com/2WyW0YH/frame1.jpg" />
        </div>
        <div class="w-1/2 bg-white p-8 flex flex-col justify-center">
            <div class="flex items-center mb-6">
                <img alt="Logo" class="h-12 mr-2" src="{{ asset('assets/img/logo.png')}}" />
            </div>
            <h2 class="text-xl text-black-300 mb-6"> Sign into your account </h2>
            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf

                <!-- Username -->
                <div>
                    <input class="w-full px-3 py-2 border border-green-700 rounded bg-gray-200 text-black-300 focus:outline-none focus:border-gray-500 @error('name') border-red-500 @enderror" id="name" placeholder="Name" type="text" name="name" value="{{ old('name') }}" required autofocus />
                    @error('name')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mt-4">
                    <input class="w-full px-3 py-2 border border-green-700 rounded bg-gray-200 text-black-300 focus:outline-none focus:border-gray-500 @error('no_wa') border-red-500 @enderror" id="no_wa" placeholder="Nomor WhatsApp" type="text" name="no_wa" value="{{ old('no_wa') }}" required autofocus oninput="this.value = this.value.replace(/[^0-9]/g, '')" />
                    @error('no_wa')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mt-4">
                    <input class="w-full px-3 py-2 border border-green-700 rounded bg-gray-200 text-black-300 focus:outline-none focus:border-gray-500 @error('email') border-red-500 @enderror" id="email" placeholder="Email" type="email" name="email" value="{{ old('email') }}" required autofocus />
                    @error('email')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mt-4">
                    <input class="w-full px-3 py-2 border border-green-700 rounded bg-gray-200 text-black-300 focus:outline-none focus:border-gray-500 @error('alamat') border-red-500 @enderror" id="alamat" placeholder="Alamat" type="text" name="alamat" value="{{ old('alamat') }}" required autofocus />
                    @error('alamat')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mt-4">
                    <input class="w-full px-3 py-2 border border-green-700 rounded bg-gray-200 text-black-300 focus:outline-none focus:border-gray-500 @error('password') border-red-500 @enderror" id="password" placeholder="Password" type="password" name="password" required autofocus />
                    @error('password')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="ms-3">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>

            <div class="mt-6 text-black-400 text-sm">
                <a href="#"> Already have an account ? <a href="{{ route('login') }}" class="text-blue-500"> Login </a> </a>
            </div>
        </div>
    </div>
    <script>
        document.querySelectorAll('input').forEach((input) => {
            input.addEventListener('focus', (e) => {
                e.target.classList.add('input-focused');
                const label = e.target.nextElementSibling;
                label.style.top = '-1.15rem';
                label.style.left = '0.75rem';
                label.style.fontSize = '0.75rem';
                label.style.color = '#008DA6';
            });
            input.addEventListener('blur', (e) => {
                e.target.classList.remove('input-focused');
                if (e.target.value === '') {
                    const label = e.target.nextElementSibling;
                    label.style.top = '1rem';
                    label.style.left = '1rem';
                    label.style.fontSize = '1rem';
                    label.style.color = '#a0aec0';
                }
            });
        });
        // Toggle password visibility with smooth transition
        const togglePassword = document.getElementById('togglePassword');
        const passwordField = document.getElementById('password');
        togglePassword.addEventListener('click', function() {
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            // Toggle eye icon
            this.classList.toggle('fa-eye-slash');
            this.classList.toggle('active');
        });
    </script>
</body>

</html>