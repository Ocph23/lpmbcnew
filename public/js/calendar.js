const calendarBody = document.getElementById("calendarBody");
const currentMonthText = document.getElementById("currentMonth");
let date = new Date();

/**
 * Render kalender
 */
function loadCalendar() {
    const year = date.getFullYear();
    const month = date.getMonth();

    const firstDay = new Date(year, month, 1).getDay();
    const lastDate = new Date(year, month + 1, 0).getDate();

    currentMonthText.innerText = date.toLocaleString("id-ID", {
        month: "long",
        year: "numeric"
    });

    calendarBody.innerHTML = "";

    // Kosong di awal jika hari pertama bukan Minggu
    for (let i = 0; i < firstDay; i++) {
        calendarBody.innerHTML += `<div></div>`;
    }

    // Buat setiap tanggal
    for (let day = 1; day <= lastDate; day++) {
        const fullDate = `${year}-${String(month + 1).padStart(2,'0')}-${String(day).padStart(2,'0')}`;
        let className = "";

        // Tanggal hari ini
        if (new Date().toDateString() === new Date(year, month, day).toDateString()) {
            className = "today";
        }

        // Tambahkan div dengan data-date
        calendarBody.innerHTML += `
            <div class="${className}" data-date="${fullDate}">
                <span class="date-number">${day}</span>
            </div>
        `;
    }

    // Setelah kalender render, tampilkan event
    fetchEvents();
}

/**
 * Ambil data agenda dari backend dan tampilkan di kalender
 */
function fetchEvents() {
    fetch('/agenda/list')
        .then(res => res.json())
        .then(events => {
            events.forEach(event => {
                const cell = document.querySelector(`[data-date="${event.start}"]`);
                if (cell) {
                    const eventEl = document.createElement('div');
                    eventEl.classList.add('calendar-event');
                    eventEl.textContent = event.title;
                    cell.appendChild(eventEl);
                }
            });
        })
        .catch(err => console.error("Gagal mengambil event:", err));
}

// Navigasi bulan
document.getElementById("prevMonth").addEventListener("click", () => {
    date.setMonth(date.getMonth() - 1);
    loadCalendar();
});

document.getElementById("nextMonth").addEventListener("click", () => {
    date.setMonth(date.getMonth() + 1);
    loadCalendar();
});

// Load kalender pertama kali
loadCalendar();
