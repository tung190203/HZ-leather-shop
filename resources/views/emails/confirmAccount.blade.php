{{-- confirmAccount.blade.php --}}

<p>Hello {{ $user->last_name }},</p>

<p>Thank you for registering an account. Please confirm your account using the following code:</p>

<p><strong>Your verification code:</strong> {{ $code }}</p>

<p>Thank you!</p>
