{{-- forgotPassword.blade.php --}}

<p>Hello {{ $user->last_name }},</p>

<p>You have a request to change your password. Please confirm your password with the following code:</p>

<p><strong>Your verification code:</strong> {{ $code }}</p>

<p>Thank you!</p>