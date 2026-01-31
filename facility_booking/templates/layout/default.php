<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$cakeDescription = 'Facility Booking System';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Global CSS -->
    <!-- Global CSS -->
    <?= $this->Html->css(['global']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

    <style>
        /* Aggressive Override for Input Colors */
        body input[type="text"],
        body input[type="password"],
        body input[type="email"],
        body input[type="number"],
        body input[type="tel"],
        body input[type="date"],
        body select,
        body textarea {
            background-color: #dbeafe !important; /* Richer Light Blue */
            color: #1e293b !important;
            border: 1px solid #94a3b8 !important; /* Slightly darker border for contrast */
        }

        body input:focus,
        body select:focus,
        body textarea:focus {
            background-color: #ffffff !important;
            border-color: #800020 !important;
            box-shadow: 0 0 0 3px rgba(128, 0, 32, 0.15) !important;
        }
    </style>
</head>
<body>
    <nav class="top-nav">
        <div class="top-nav-title">
            <a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'display', 'home']) ?>">
                <!-- Using a simple text logo for now, but configured for an icon if needed -->
                <span>Facility</span>Booking
            </a>
        </div>
        <div class="top-nav-links">
            <?php
            $identity = $this->request->getAttribute('identity');
            $isLoggedIn = $identity !== null;
            $userRole = $isLoggedIn ? strtolower($identity->role ?? 'user') : 'guest';
            
            // Get current controller and action for active state
            $curController = $this->request->getParam('controller');
            $curAction = $this->request->getParam('action');
            ?>
            
            <?php if ($userRole === 'admin'): ?>
                <!-- Admin Navigation -->
                <a href="<?= $this->Url->build(['controller' => 'Dashboard', 'action' => 'index']) ?>" class="nav-link <?= $curController === 'Dashboard' ? 'active' : '' ?>">Dashboard</a>
                <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'index']) ?>" class="nav-link <?= $curController === 'Users' ? 'active' : '' ?>">Users</a>
                <a href="<?= $this->Url->build(['controller' => 'Facilities', 'action' => 'index']) ?>" class="nav-link <?= $curController === 'Facilities' ? 'active' : '' ?>">Facilities</a>
                <a href="<?= $this->Url->build(['controller' => 'Bookings', 'action' => 'index']) ?>" class="nav-link <?= $curController === 'Bookings' ? 'active' : '' ?>">Booking List</a>
                <a href="<?= $this->Url->build(['controller' => 'Departments', 'action' => 'index']) ?>" class="nav-link <?= $curController === 'Departments' ? 'active' : '' ?>">Departments</a>
                <a href="<?= $this->Url->build(['controller' => 'Approvals', 'action' => 'index']) ?>" class="nav-link <?= $curController === 'Approvals' ? 'active' : '' ?>">Approvals</a>
                <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'logout']) ?>" class="nav-btn">Logout</a>
            <?php elseif ($userRole === 'user'): ?>
                <!-- Regular User Navigation -->
                <a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'display', 'home']) ?>" class="nav-link <?= $curController === 'Pages' && $curAction === 'display' ? 'active' : '' ?>">Home</a>
                <a href="<?= $this->Url->build(['controller' => 'Facilities', 'action' => 'browse']) ?>" class="nav-link <?= $curController === 'Facilities' && ($curAction === 'browse' || $curAction === 'details') ? 'active' : '' ?>">Browse Facilities</a>
                <a href="<?= $this->Url->build(['controller' => 'Bookings', 'action' => 'index']) ?>" class="nav-link <?= $curController === 'Bookings' ? 'active' : '' ?>">My Bookings</a>
                <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'logout']) ?>" class="nav-btn">Logout</a>
            <?php else: ?>
                <!-- Guest Navigation -->
                <a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'display', 'home']) ?>" class="nav-link <?= $curController === 'Pages' && $curAction === 'display' ? 'active' : '' ?>">Home</a>
                <a href="<?= $this->Url->build(['controller' => 'Facilities', 'action' => 'browse']) ?>" class="nav-link <?= $curController === 'Facilities' && ($curAction === 'browse' || $curAction === 'details') ? 'active' : '' ?>">Browse Facilities</a>
                <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'login']) ?>" class="nav-link <?= $curController === 'Users' && $curAction === 'login' ? 'active' : '' ?>">Login</a>
                <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'register']) ?>" class="nav-btn">Get Started</a>
            <?php endif; ?>
        </div>
    </nav>
    <main class="main">
        <?php if (isset($fullWidth) && $fullWidth): ?>
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        <?php else: ?>
            <div class="container">
                <?= $this->Flash->render() ?>
                <?= $this->fetch('content') ?>
            </div>
        <?php endif; ?>
    </main>
</body>
</html>
