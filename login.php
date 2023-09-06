<?php
 //Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
     //Get the submitted username and password
    $submittedUsername = $_POST["username"];
    $submittedPassword = $_POST["password"];

     //Replace these with your actual username and password for authentication
    $correctUsername = "admin";
    $correctPassword = "alten@2023";

     //Check if the submitted credentials are correct
    if ($submittedUsername === $correctUsername && $submittedPassword === $correctPassword) {
         //Authentication successful, redirect to admin.php
        header("Location: admin.php");
        exit();
    } else {
         //Authentication failed, set an error message
        $error_message = "Incorrect username or password. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https:cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Login</title>
</head>
<body class="bg-gray-100 h-screen flex justify-center items-center">
    <header class="bg-blue-500 p-4">
        <div class="logo text-center">
            <img src="altenLogo2.png" alt="Logo" class="max-w-xs mx-auto">
        </div>
    </header>
    
    <div class="bg-white p-8 rounded shadow-md w-96">
        <h1 class="text-2xl mb-4 text-center">Login</h1>
        <form method="post">
            <div class="mb-4">
                <label for="username" class="block text-gray-700">Username:</label>
                <input type="text" id="username" name="username"
                    class="border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    required>
            </div>
            <div class="mb-6">
                <label for="password" class="block text-gray-700">Password:</label>
                <div class="relative">
                    <input type="password" id="password" name="password"
                        class="border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        required>
                    <span id="toggle-password" class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer">
                        <svg xmlns="http:www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.293 8.293a1 1 0 011.414 1.414l-6 6a1 1 0 01-1.414 0l-6-6a1 1 0 111.414-1.414L12 14.586l3.293-3.293z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4a7.999 7.999 0 014 14.794V19a2 2 0 01-2 2H10a2 2 0 01-2-2v-.206A7.999 8 0 0112 4zm-2 13a2 2 0 100-4 2 2 0 000 4z" />
                        </svg>
                    </span>
                </div>
            </div>
            <div class="text-red-600 mb-4"><?php if (isset($error_message)) echo $error_message; ?></div>
            <div class="text-center">
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full focus:outline-none focus:shadow-outline">
                    Login
                </button>
            </div>
        </form>
    </div>

    <script>
         Toggle password visibility
        const passwordInput = document.getElementById('password');
        const togglePassword = document.getElementById('toggle-password');

        togglePassword.addEventListener('click', () => {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
        });
    </script>
</body>
</html>
