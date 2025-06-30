let slider = Array.from(document.querySelectorAll(".campaign-container"));

slider.map(slide => {
    slide.addEventListener('mousedown', (e) => {
        isDown = true;
        slide.classList.add('active');
        startX = e.pageX - slide.offsetLeft;
        scrollLeft = slide.scrollLeft;
    });
    slide.addEventListener('mouseleave', () => {
        isDown = false;
        slide.classList.remove('active');
    });
    slide.addEventListener('mouseup', () => {
        isDown = false;
        slide.classList.remove('active');
    });
    slide.addEventListener('mousemove', (e) => {
        if (!isDown) return;
        e.preventDefault();
        let x = e.pageX - slide.offsetLeft;
        let walk = (x - startX) * 1;
        slide.scrollLeft = scrollLeft - walk;
    });
});

let sliderArtikel = Array.from(document.querySelectorAll(".section-article"));


sliderArtikel.map(slide => {
    slide.addEventListener('mousedown', (e) => {
        isDown = true;
        slide.classList.add('active');
        startX = e.pageX - slide.offsetLeft;
        scrollLeft = slide.scrollLeft;
    });
    slide.addEventListener('mouseleave', () => {
        isDown = false;
        slide.classList.remove('active');
    });
    slide.addEventListener('mouseup', () => {
        isDown = false;
        slide.classList.remove('active');
    });
    slide.addEventListener('mousemove', (e) => {
        if (!isDown) return;
        e.preventDefault();
        let x = e.pageX - slide.offsetLeft;
        let walk = (x - startX) * 1;
        slide.scrollLeft = scrollLeft - walk;
    });
});


$(document).ready(function () {
    var modalShown = false;

    $(".avatar").click(function () {
        if (!modalShown) {
            $(".modal-user").removeClass("d-none");
            modalShown = true;
        } else {
            $(".modal-user").addClass("d-none");
            modalShown = false;
        }
    });
});

// SEARCH NAV MENU
document.addEventListener("click", function (event) {
    var searchWrap = document.getElementById('search-wrap');
    var btnSearch = document.getElementById('btn-search');
    var searchMe = document.getElementById('searchme');

    if (event.target.id === 'search-wrap' || searchWrap.contains(event.target)) {
        return;
    }

    if (event.target.id === 'btn-search') {
        searchWrap.classList.toggle('open');
        searchMe.focus();
    } else {
        searchWrap.classList.remove('open');
    }
});

window.addEventListener("scroll", function () {
    var navbar = document.getElementById("navbar");

    var scrollPosition = window.scrollY || document.documentElement.scrollTop;

    if (scrollPosition > 0) {
        navbar.classList.add("fixed-top");
    } else {
        navbar.classList.remove("fixed-top");
    }
});
