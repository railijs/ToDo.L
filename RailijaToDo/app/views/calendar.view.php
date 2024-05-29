<?php require "../app/views/components/header.php" ?>
<?php require "../app/views/components/navbar.php" ?>

<body class="bg-gray-100 flex justify-center items-center min-h-screen">
    <div id="calendar" class="bg-white p-6 rounded-lg shadow-md w-full max-w-4xl">
        <div id="calendar-header" class="flex justify-between items-center mb-4">
            <button id="prev-month" class="bg-blue-500 text-white px-4 py-2 rounded">Previous</button>
            <h2 id="month-year" class="text-xl font-bold"></h2>
            <button id="next-month" class="bg-blue-500 text-white px-4 py-2 rounded">Next</button>
        </div>
        <div id="calendar-body" class="grid grid-cols-7 gap-2">
            <div class="text-center font-bold">Sun</div>
            <div class="text-center font-bold">Mon</div>
            <div class="text-center font-bold">Tue</div>
            <div class="text-center font-bold">Wed</div>
            <div class="text-center font-bold">Thu</div>
            <div class="text-center font-bold">Fri</div>
            <div class="text-center font-bold">Sat</div>
            <div id="calendar-days" class="grid grid-cols-7 gap-2 mt-2"></div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tasks = <?php echo json_encode($tasks); ?>;

            let currentDate = new Date();

            function renderCalendar(year, month) {
                const calendarDays = document.getElementById('calendar-days');
                calendarDays.innerHTML = '';

                const firstDayOfMonth = new Date(year, month - 1, 1).getDay();
                const daysInMonth = new Date(year, month, 0).getDate();

                for (let i = 0; i < firstDayOfMonth; i++) {
                    const emptyCell = document.createElement('div');
                    emptyCell.classList.add('h-20', 'border');
                    calendarDays.appendChild(emptyCell);
                }

                for (let day = 1; day <= daysInMonth; day++) {
                    const dayCell = document.createElement('div');
                    dayCell.classList.add('h-20', 'border', 'relative', 'p-2');
                    dayCell.textContent = day;

                    const taskForDay = tasks.filter(task => new Date(task.deadline).getDate() === day && new Date(task.deadline).getMonth() + 1 === month && new Date(task.deadline).getFullYear() === year);

                    if (taskForDay.length > 0) {
                        const taskList = document.createElement('ul');
                        taskForDay.forEach(task => {
                            const taskItem = document.createElement('li');
                            taskItem.textContent = task.name;
                            taskItem.classList.add('bg-blue-100', 'rounded', 'px-1', 'mt-1', 'text-sm');
                            taskList.appendChild(taskItem);
                        });
                        dayCell.appendChild(taskList);
                    } else {
                        // If there are no tasks for the day, still append an empty cell
                        dayCell.innerHTML = '&nbsp;'; // Add a non-breaking space
                    }

                    calendarDays.appendChild(dayCell);
                }

                document.getElementById('month-year').textContent = `${year}-${month}`;
            }

            document.getElementById('prev-month').addEventListener('click', () => {
                currentDate.setMonth(currentDate.getMonth() - 1);
                renderCalendar(currentDate.getFullYear(), currentDate.getMonth() + 1);
            });

            document.getElementById('next-month').addEventListener('click', () => {
                currentDate.setMonth(currentDate.getMonth() + 1);
                renderCalendar(currentDate.getFullYear(), currentDate.getMonth() + 1);
            });

            renderCalendar(currentDate.getFullYear(), currentDate.getMonth() + 1);
        });
    </script>


<?php require "../app/views/components/footer.php" ?>