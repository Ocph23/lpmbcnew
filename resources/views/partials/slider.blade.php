<div class="slideshow-container">

    <!-- Full-width images with number and caption text -->
    <div class="mySlides fade">
        <img src="{{ asset('images/UMP 1.png') }}" style="width:100%">
        <div class="text">PKKMB Universtias Muhammadiyah Papua</div>
    </div>

    <div class="mySlides fade">
        <img src="{{ asset('images/UMP 2.png') }}" style="width:100%">
        <div class="text">Peresmian Universitas Muhammaidyah Papua</div>
    </div>

    <div class="mySlides fade">
        <img src="{{ asset('images/Wisuda 2024.jpg') }}" style="width:100%">
        <div class="text">Rapat Senat Terbuka Universitas Muhammaidyah Papua</div>
    </div>
    <div class="mySlides fade">
        <img src="{{ asset('images/PKKMB UM Papua.jpg') }}" style="width:100%">
        <div class="text">PKKMB UM Papua</div>
    </div>

    <!-- Next and previous buttons -->
    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>
</div>
<br>

<!-- The dots/circles -->
<div style="text-align:center">
    <span class="dot" onclick="currentSlide(1)"></span>
    <span class="dot" onclick="currentSlide(2)"></span>
    <span class="dot" onclick="currentSlide(3)"></span>
    <span class="dot" onclick="currentSlide(4)"></span>
</div>


<script>
    let slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    function currentSlide(n) {
        showSlides(slideIndex = n);
    }

    function showSlides(n) {
        let i;
        let slides = document.getElementsByClassName("mySlides");
        let dots = document.getElementsByClassName("dot");
        if (n > slides.length) {
            slideIndex = 1
        }
        if (n < 1) {
            slideIndex = slides.length
        }
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " active";
    }

    // Auto slide
    setInterval(() => {
        plusSlides(1);
    }, 5000);
</script>
