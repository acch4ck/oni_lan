(function () {
    'use strict';

    var reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');

    document.querySelectorAll('[data-gallery-carousel]').forEach(function (carousel) {
        var track = carousel.querySelector('.home-gallery-track');
        var slides = Array.prototype.slice.call(carousel.querySelectorAll('.home-gallery-slide'));
        var dots = Array.prototype.slice.call(carousel.querySelectorAll('[data-carousel-dot]'));
        var previous = carousel.querySelector('[data-carousel-prev]');
        var next = carousel.querySelector('[data-carousel-next]');
        var current = 0;
        var timer = null;
        var touchStart = null;

        if (!track || slides.length < 2) {
            return;
        }

        function show(index) {
            current = (index + slides.length) % slides.length;
            track.style.transform = 'translateX(-' + (current * 100) + '%)';

            slides.forEach(function (slide, slideIndex) {
                slide.setAttribute('aria-hidden', slideIndex === current ? 'false' : 'true');
                slide.setAttribute('tabindex', slideIndex === current ? '0' : '-1');
            });

            dots.forEach(function (dot, dotIndex) {
                if (dotIndex === current) {
                    dot.setAttribute('aria-current', 'true');
                } else {
                    dot.removeAttribute('aria-current');
                }
            });
        }

        function stop() {
            if (timer) {
                window.clearInterval(timer);
                timer = null;
            }
        }

        function play() {
            stop();
            if (!reducedMotion.matches && !document.hidden) {
                timer = window.setInterval(function () {
                    show(current + 1);
                }, 5000);
            }
        }

        previous.addEventListener('click', function () {
            show(current - 1);
            play();
        });

        next.addEventListener('click', function () {
            show(current + 1);
            play();
        });

        dots.forEach(function (dot) {
            dot.addEventListener('click', function () {
                show(Number(dot.getAttribute('data-carousel-dot')) || 0);
                play();
            });
        });

        carousel.addEventListener('mouseenter', stop);
        carousel.addEventListener('mouseleave', play);
        carousel.addEventListener('focusin', stop);
        carousel.addEventListener('focusout', function (event) {
            if (!carousel.contains(event.relatedTarget)) {
                play();
            }
        });
        carousel.addEventListener('touchstart', function (event) {
            touchStart = event.changedTouches[0].clientX;
            stop();
        }, { passive: true });
        carousel.addEventListener('touchend', function (event) {
            if (touchStart !== null) {
                var distance = event.changedTouches[0].clientX - touchStart;
                if (Math.abs(distance) > 45) {
                    show(current + (distance < 0 ? 1 : -1));
                }
            }
            touchStart = null;
            play();
        }, { passive: true });
        document.addEventListener('visibilitychange', play);

        show(0);
        play();
    });

    var galleryItems = Array.prototype.slice.call(document.querySelectorAll('[data-gallery-item]'));
    var openers = Array.prototype.slice.call(document.querySelectorAll('[data-gallery-open]'));

    if (!galleryItems.length) {
        return;
    }

    var lightbox = document.createElement('div');
    lightbox.className = 'gallery-lightbox';
    lightbox.setAttribute('role', 'dialog');
    lightbox.setAttribute('aria-modal', 'true');
    lightbox.setAttribute('aria-label', 'Photo viewer');
    lightbox.hidden = true;
    lightbox.innerHTML =
        '<button class="gallery-lightbox-close" type="button" aria-label="Close photo viewer">×</button>' +
        '<button class="gallery-lightbox-prev" type="button" aria-label="Previous photo">‹</button>' +
        '<figure class="gallery-lightbox-figure">' +
            '<img class="gallery-lightbox-image" src="" alt="">' +
            '<figcaption class="gallery-lightbox-caption"></figcaption>' +
            '<span class="gallery-lightbox-counter"></span>' +
        '</figure>' +
        '<button class="gallery-lightbox-next" type="button" aria-label="Next photo">›</button>';
    document.body.appendChild(lightbox);

    var image = lightbox.querySelector('.gallery-lightbox-image');
    var caption = lightbox.querySelector('.gallery-lightbox-caption');
    var counter = lightbox.querySelector('.gallery-lightbox-counter');
    var closeButton = lightbox.querySelector('.gallery-lightbox-close');
    var currentItems = [];
    var currentIndex = 0;
    var returnFocus = null;

    function itemsInGroup(group) {
        return galleryItems.filter(function (item) {
            return item.getAttribute('data-gallery-group') === group;
        });
    }

    function renderLightbox() {
        var item = currentItems[currentIndex];
        image.src = item.href;
        image.alt = item.getAttribute('data-alt') || '';
        caption.textContent = item.getAttribute('data-caption') || '';
        caption.hidden = !caption.textContent;
        counter.textContent = (currentIndex + 1) + ' / ' + currentItems.length;
        lightbox.classList.toggle('is-single', currentItems.length < 2);
    }

    function openLightbox(group, startItem, opener) {
        currentItems = itemsInGroup(group);
        if (!currentItems.length) {
            return;
        }

        currentIndex = startItem ? Math.max(0, currentItems.indexOf(startItem)) : 0;
        returnFocus = opener;
        renderLightbox();
        lightbox.hidden = false;
        document.documentElement.classList.add('gallery-lightbox-open');
        closeButton.focus();
    }

    function closeLightbox() {
        lightbox.hidden = true;
        image.src = '';
        document.documentElement.classList.remove('gallery-lightbox-open');
        if (returnFocus) {
            returnFocus.focus();
        }
    }

    function move(step) {
        currentIndex = (currentIndex + step + currentItems.length) % currentItems.length;
        renderLightbox();
    }

    galleryItems.forEach(function (item) {
        item.addEventListener('click', function (event) {
            event.preventDefault();
            openLightbox(item.getAttribute('data-gallery-group'), item, item);
        });
    });

    openers.forEach(function (opener) {
        opener.addEventListener('click', function (event) {
            event.preventDefault();
            openLightbox(opener.getAttribute('data-gallery-open'), null, opener);
        });
    });

    closeButton.addEventListener('click', closeLightbox);
    lightbox.querySelector('.gallery-lightbox-prev').addEventListener('click', function () { move(-1); });
    lightbox.querySelector('.gallery-lightbox-next').addEventListener('click', function () { move(1); });
    lightbox.addEventListener('click', function (event) {
        if (event.target === lightbox) {
            closeLightbox();
        }
    });
    document.addEventListener('keydown', function (event) {
        if (lightbox.hidden) {
            return;
        }
        if (event.key === 'Escape') closeLightbox();
        if (event.key === 'ArrowLeft') move(-1);
        if (event.key === 'ArrowRight') move(1);
    });
}());
