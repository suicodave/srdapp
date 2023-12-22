<!DOCTYPE html>
<html>
<head>
    <title>HTML Calendar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ddd;
            text-align: center;
            padding: 10px;
            font-size: 14px;
        }
        th {
            background-color: #f2f2f2;
        }
        td {
            height: 100px;
            cursor: pointer;
        }
        td:hover {
            background-color: #f5f5f5;
        }
        .current-day {
            background-color: #b3d9ff;
        }
    </style>
</head>
<body>
    <h2>HTML Calendar</h2>
    <?php
        // Get current month and year
        $month = date("n");
        $year = date("Y");

        // Number of days in the month
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

        // Get the first day of the month
        $firstDay = date("N", strtotime("$year-$month-01"));

        // Create an array with the names of days
        $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
    ?>

    <h3><?= date("F Y", strtotime("$year-$month-01")) ?></h3>

    <table id="calendar">
        <tr>
            <?php foreach ($daysOfWeek as $day): ?>
                <th><?= substr($day, 0, 3) ?></th>
            <?php endforeach; ?>
        </tr>
        <tr>
            <?php
            $dayCounter = 1 - $firstDay;
            while ($dayCounter <= $daysInMonth):
            ?>
                <?php for ($i = 0; $i < 7; $i++): ?>
                    <?php if ($dayCounter > 0 && $dayCounter <= $daysInMonth): ?>
                        <td class="calendar-day"><?= $dayCounter ?></td>
                    <?php else: ?>
                        <td></td>
                    <?php endif; ?>
                    <?php $dayCounter++; ?>
                <?php endfor; ?>
            <?php endwhile; ?>
        </tr>
    </table>

    <script>
        const calendar = document.getElementById('calendar');
        const today = new Date();
        const currentMonth = <?= $month ?>;
        const currentYear = <?= $year ?>;

        // Highlight current day
        const days = calendar.getElementsByClassName('calendar-day');
        for (let day of days) {
            if (parseInt(day.innerHTML) === today.getDate() && currentMonth === today.getMonth() + 1 && currentYear === today.getFullYear()) {
                day.classList.add('current-day');
            }
        }

        // Add click event to navigate to previous month
        calendar.addEventListener('click', function (event) {
            const target = event.target;
            if (target.tagName === 'TD' && target.innerHTML !== '') {
                const selectedDay = parseInt(target.innerHTML);
                const newDate = new Date(currentYear, currentMonth - 1, selectedDay);
                const newMonth = newDate.getMonth() + 1;
                const newYear = newDate.getFullYear();

                window.location.href = `?date=${newYear}-${newMonth < 10 ? '0' + newMonth : newMonth}-${selectedDay < 10 ? '0' + selectedDay : selectedDay}`;
            }
        });
    </script>
</body>
</html>
