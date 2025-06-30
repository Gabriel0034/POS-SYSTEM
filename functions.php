<?php
// functions.php
// Contains reusable helper functions for the POS system.

// Add your reusable functions here

function e($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}
?>