<?php
declare(strict_types=1);

namespace App\Authentication;

use Authentication\PasswordHasher\AbstractPasswordHasher;

/**
 * Plain Text Password Hasher
 * 
 * WARNING: This does NOT hash passwords - stores and compares as plain text
 * NOT SECURE - Only for local testing!
 */
class PlainTextPasswordHasher extends AbstractPasswordHasher
{
    /**
     * Hash password - returns plain text
     *
     * @param string $password Password to hash
     * @return string Plain text password
     */
    public function hash(string $password): string
    {
        return $password;
    }

    /**
     * Check password - compares plain text
     *
     * @param string $password Plain password to check  
     * @param string $hashedPassword Stored password (plain text)
     * @return bool True if passwords match
     */
    public function check(string $password, string $hashedPassword): bool
    {
        return $password === $hashedPassword;
    }
}
