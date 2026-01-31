<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Booking $booking
 */
?>
<!DOCTYPE html>
<html>
<head>
    <title>Booking Receipt #<?= $booking->id ?></title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <style>
        * {
            box-sizing: border-box;
        }

        :root {
            --color-primary: #800020;
            --color-text: #0f172a;
            --color-text-secondary: #475569;
            --border-color: #e2e8f0;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: #f1f5f9;
            padding: 2rem;
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .actions-bar {
            margin-bottom: 1.5rem;
            display: flex;
            gap: 1rem;
        }

        .btn-download {
            background: var(--color-primary);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            transition: opacity 0.2s;
        }

        .btn-download:hover {
            opacity: 0.9;
        }

        .receipt-container {
            background: white;
            width: 720px; /* Standard width (7.5 inches at 96 DPI) to fit A4/Letter with margin */
            padding: 2.5rem;
            margin: 0 auto;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden; /* Prevent any small overflows from being visible */
        }

        @media print {
            body { background: white; padding: 0; }
            .actions-bar { display: none; }
            .receipt-container { box-shadow: none; border-radius: 0; width: 100%; max-width: 100%; }
        }

        .header {
            display: flex;
            justify-content: space-between;
            border-bottom: 2px solid var(--color-primary);
            padding-bottom: 2rem;
            margin-bottom: 2rem;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--color-primary);
        }

        .receipt-info {
            text-align: right;
        }

        .receipt-title {
            font-size: 2rem;
            color: var(--color-text);
            margin: 0 0 0.5rem 0;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .receipt-id {
            color: var(--color-text-secondary);
            font-size: 1rem;
        }

        .details-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .info-group h3 {
            font-size: 0.9rem;
            text-transform: uppercase;
            color: var(--color-text-secondary);
            margin-bottom: 0.5rem;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 0.25rem;
        }

        .info-group p {
            margin: 0.25rem 0;
            font-size: 1rem;
            color: var(--color-text);
            font-weight: 500;
        }

        .booking-summary {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 2rem;
        }

        .booking-summary th {
            text-align: left;
            background: #f8fafc;
            padding: 1rem;
            border-bottom: 2px solid var(--border-color);
            color: var(--color-text-secondary);
            font-weight: 600;
        }

        .booking-summary td {
            padding: 1rem;
            border-bottom: 1px solid var(--border-color);
            color: var(--color-text);
        }

        .status-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 600;
            background: #d1fae5;
            color: #065f46;
        }

        .footer {
            margin-top: 4rem;
            text-align: center;
            color: var(--color-text-secondary);
            font-size: 0.875rem;
            border-top: 1px solid var(--border-color);
            padding-top: 1rem;
        }
    </style>
</head>
<body>

    <div class="actions-bar">
        <button onclick="generatePDF()" class="btn-download">
            <span>⬇️</span> Download PDF
        </button>
        <button onclick="window.close()" class="btn-download" style="background-color: #64748b;">
            Close
        </button>
    </div>

    <div id="receipt-content" class="receipt-container">
        <div class="header">
            <div class="logo">FACILITY BOOKING</div>
            <div class="receipt-info">
                <h1 class="receipt-title">RECEIPT</h1>
                <div class="receipt-id">#<?= str_pad((string)$booking->id, 6, '0', STR_PAD_LEFT) ?></div>
                <div style="margin-top: 5px; color: #64748b;"><?= h($booking->has('created_at') ? $booking->created_at->format('M d, Y') : date('M d, Y')) ?></div>
            </div>
        </div>

        <div class="details-grid">
            <div class="info-group">
                <h3>Issued To</h3>
                <p><?= $booking->has('user') ? h($booking->user->email) : 'N/A' ?></p>
                <p>User ID: <?= h($booking->user_id) ?></p>
            </div>
            <div class="info-group">
                <h3>Facility Details</h3>
                <p><?= $booking->has('facility') ? h($booking->facility->name) : 'Unknown Facility' ?></p>
            </div>
        </div>

        <table class="booking-summary">
            <thead>
                <tr>
                    <th>Description</th>
                    <th style="text-align: right;">Details</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Booking Date</strong></td>
                    <td style="text-align: right;"><?= h($booking->booking_date->format('M d, Y')) ?></td>
                </tr>
                <tr>
                    <td><strong>Time Slot</strong></td>
                    <td style="text-align: right;"><?= h($booking->start_time->format('h:i A')) ?> - <?= h($booking->end_time->format('h:i A')) ?></td>
                </tr>
                <tr>
                    <td><strong>Purpose</strong></td>
                    <td style="text-align: right;"><?= h($booking->purpose) ?></td>
                </tr>
                <tr>
                    <td><strong>Status</strong></td>
                    <td style="text-align: right;"><span class="status-badge"><?= h(strtoupper($booking->status)) ?></span></td>
                </tr>
                <?php if ($booking->hasValue('approval') && !empty($booking->approval->person_in_charge)): ?>
                <tr>
                    <td><strong>Person in Charge</strong></td>
                    <td style="text-align: right;">👤 <?= h($booking->approval->person_in_charge) ?></td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="footer">
            <p>This is a computer-generated receipt. No signature is required.</p>
            <p>&copy; <?= date('Y') ?> Facility Booking System</p>
        </div>
    </div>

    <script>
        function generatePDF() {
            const element = document.getElementById('receipt-content');
            const opt = {
                margin: 0.5, // 0.5 inch margins
                filename: 'Booking_Receipt_#<?= $booking->id ?>.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { 
                    scale: 2,
                    useCORS: true,
                    letterRendering: true,
                    scrollX: 0,
                    scrollY: 0
                },
                jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
            };
            
            // Generate and save PDF
            html2pdf().from(element).set(opt).save();
        }

        // Auto-download helper (optional, uncomment if desired)
        // window.onload = function() { generatePDF(); };
    </script>
</body>
</html>
