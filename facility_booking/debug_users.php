<?php
/**
 * Debug script to check users in database
 * Run with: php bin/cake.php console -f debug_users.php
 */

use Cake\ORM\TableRegistry;
use Authentication\PasswordHasher\DefaultPasswordHasher;

// Get Users table
$users = TableRegistry::getTableLocator()->get('Users');

echo "\n=== USERS IN DATABASE ===\n\n";

$allUsers = $users->find()->all();

foreach ($allUsers as $user) {
    echo "ID: " . $user->id . "\n";
    echo "Email: " . $user->email . "\n";
    echo "Role: " . $user->role . "\n";
    echo "------------------------\n";
}

echo "\nTotal users: " . $allUsers->count() . "\n\n";

// Check if admin exists
$admin = $users->find()->where(['role' => 'admin'])->first();

if ($admin) {
    echo "✅ Admin user found: " . $admin->email . "\n";
} else {
    echo "❌ No admin user found in database!\n";
    echo "\nTo create an admin user, run this in your database:\n";
    echo "UPDATE users SET role = 'admin' WHERE email = 'your-admin-email@example.com';\n";
}

echo "\n";
