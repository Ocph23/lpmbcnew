<section class="wrapper">

    <!-- ===== GALLERY SECTION ===== -->
    <div class="gallery-section">
        <h2 class="section-title">Gallery</h2>

        <div class="gallery-grid">
            <div class="gallery-card">
                <img src="images/galeri/1.jpg" alt="">
                <div class="gallery-text">
                    Audit Mutu Internal Program Studi Teknik Pertambangan
                </div>
            </div>

            <div class="gallery-card">
                <img src="images/galeri/2.jpg" alt="">
                <div class="gallery-text">
                    Pendampingan Mutu
                </div>
            </div>

            <div class="gallery-card">
                <img src="images/galeri/3.jpg" alt="">
                <div class="gallery-text">
                    Rapat Persiapan Pendampingan Mutu
                </div>
            </div>
            <div class="gallery-card">
                <img src="images/Pelepasan Mahasiswa KKN TEMATIK oleh Rektor UM Papua.jpg" alt="">
                <div class="gallery-text">
                    Penandatangan MOU UM Papua
                </div>
            </div>
        </div>

        <div class="view-all">
            <a href="#">VIEW ALL</a>
            <span class="arrow">➜</span>
        </div>
    </div>

    <!-- ===== AGENDA SECTION ===== -->
    <div id="agenda-list">
        <h2 class="section-title">Agenda</h2>

        @forelse($agendas as $agenda)
            <div class="agenda-item">
                <div class="agenda-date">
                    <span class="agenda-day">
                        {{ \Carbon\Carbon::parse($agenda->start_date)->format('d') }}
                    </span>
                    <span class="agenda-month">
                        {{ \Carbon\Carbon::parse($agenda->start_date)->translatedFormat('M') }}
                    </span>
                </div>

                <div class="agenda-title">
                    {{ $agenda->title }}
                </div>
            </div>
        @empty
            <p>Tidak ada agenda.</p>
        @endforelse

        <div class="view-all">
            <a href="#">VIEW ALL</a>
            <span class="arrow">➜</span>
        </div>

    </div>
</section>
