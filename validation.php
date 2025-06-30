<?php
// validation.php
// Contains validation functions for email and username.

// Add your validation functions here
function validate_email(string $email): bool {
    return (bool)filter_var($email, FILTER_VALIDATE_EMAIL);
}
function validate_username(string $username): bool {
    return (bool)preg_match('/^[a-zA-Z0-9_]{3,20}$/', $username);
}
?>