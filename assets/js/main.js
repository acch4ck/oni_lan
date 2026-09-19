
document.addEventListener('DOMContentLoaded', function () {
    const preloader = document.getElementById('oni-lana-preloader');
    const hidePreloader = function () {
        if (!preloader) return;
        preloader.classList.add('loaded');
        document.body.classList.remove('preloader-active');
    };
    if (preloader) {
        document.body.classList.add('preloader-active');
        window.addEventListener('load', function () { setTimeout(hidePreloader, 120); }, { once: true });
        window.setTimeout(hidePreloader, 5000);
    }

    const toggle = document.querySelector('.menu-toggle');
    const nav = document.querySelector('.primary-nav');
    if (toggle && nav) {
        toggle.addEventListener('click', () => {
            const open = toggle.getAttribute('aria-expanded') === 'true';
            toggle.setAttribute('aria-expanded', String(!open));
            nav.classList.toggle('is-open', !open);
        });
        nav.querySelectorAll('li').forEach(li => {
            const sub = li.querySelector(':scope > .sub-menu');
            if (sub) {
                const a = li.querySelector(':scope > a');
                if (a) {
                    a.addEventListener('click', function(e) {
                        if (window.innerWidth <= 900) {
                            e.preventDefault();
                            li.classList.toggle('submenu-open');
                        }
                    });
                }
            }
        });
    }

    const track = document.querySelector('.slider-track');
    const slides = document.querySelectorAll('.slide');
    const dotsWrap = document.querySelector('.slider-dots');
    const prev = document.querySelector('.slider-prev');
    const next = document.querySelector('.slider-next');
    let index = 0, timer;

    function renderSlider() {
        if (!track || !slides.length) return;
        track.style.transform = `translateX(-${index * 100}%)`;
        document.querySelectorAll('.slider-dot').forEach((d, i) => d.classList.toggle('active', i === index));
    }
    function go(i) {
        index = (i + slides.length) % slides.length;
        renderSlider();
    }
    function start() {
        if (slides.length > 1) timer = setInterval(() => go(index + 1), 6000);
    }
    function restart() { clearInterval(timer); start(); }

    if (dotsWrap && slides.length) {
        slides.forEach((_, i) => {
            const b = document.createElement('button');
            b.className = 'slider-dot' + (i === 0 ? ' active' : '');
            b.setAttribute('aria-label', 'Go to slide ' + (i + 1));
            b.addEventListener('click', () => { go(i); restart(); });
            dotsWrap.appendChild(b);
        });
    }
    if (prev) prev.addEventListener('click', () => { go(index - 1); restart(); });
    if (next) next.addEventListener('click', () => { go(index + 1); restart(); });
    renderSlider(); start();
});


document.addEventListener('DOMContentLoaded', function(){ document.querySelectorAll('[data-gallery-slider]').forEach(function(album){ const track=album.querySelector('.gallery-carousel-track'), slides=album.querySelectorAll('.gallery-carousel-slide'), prev=album.querySelector('[data-gallery-prev]'), next=album.querySelector('[data-gallery-next]'), count=album.querySelector('[data-gallery-count]'); if(!track||!slides.length)return; let i=0; function render(){track.style.transform='translateX(-'+(i*100)+'%)';if(count)count.textContent=(i+1)+' / '+slides.length;} if(prev)prev.addEventListener('click',function(){i=(i-1+slides.length)%slides.length;render();});if(next)next.addEventListener('click',function(){i=(i+1)%slides.length;render();});render();}); });


(function () {
    const popup = document.getElementById('ol-home-popup');
    if (popup) {
        document.body.classList.add('ol-popup-open');
        const close = function () {
            popup.classList.add('is-closed');
            document.body.classList.remove('ol-popup-open');
        };
        popup.querySelectorAll('[data-popup-close]').forEach(function (el) {
            el.addEventListener('click', close);
        });
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') close();
        });
    }

    document.querySelectorAll('[data-copy-url]').forEach(function (btn) {
        btn.addEventListener('click', async function () {
            try {
                await navigator.clipboard.writeText(btn.dataset.copyUrl);
                btn.textContent = 'Copied!';
                setTimeout(function () { btn.textContent = 'Copy Link'; }, 1500);
            } catch (e) {
                // Clipboard API may be unavailable in older/non-secure contexts.
            }
        });
    });
})();


/* Homepage gallery: responsive 10-photo carousel, 3/2/1 visible by viewport. */
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('[data-front-gallery]').forEach(function (carousel) {
        const track = carousel.querySelector('.front-gallery-track');
        const cards = Array.from(carousel.querySelectorAll('.front-gallery-card'));
        const prev = carousel.querySelector('.front-gallery-prev');
        const next = carousel.querySelector('.front-gallery-next');
        const dots = carousel.querySelector('.front-gallery-dots');
        if (!track || !cards.length) return;
        let perView = 3, index = 0;
        const getPerView = function () {
            if (window.innerWidth <= 600) return 2;
            if (window.innerWidth <= 900) return 2;
            return 3;
        };
        const pages = function () { return Math.max(1, Math.ceil(cards.length / perView)); };
        function renderDots() {
            if (!dots) return;
            dots.innerHTML = '';
            for (let i = 0; i < pages(); i++) {
                const b = document.createElement('button');
                b.type = 'button'; b.className = 'front-gallery-dot' + (i === index ? ' active' : '');
                b.setAttribute('aria-label', 'Show gallery slide ' + (i + 1));
                b.addEventListener('click', function () { index = i; render(); });
                dots.appendChild(b);
            }
        }
        function render() {
            perView = getPerView();
            const maxIndex = pages() - 1;
            index = Math.min(index, maxIndex);
            const offset = index * 100;
            track.style.transform = 'translateX(-' + offset + '%)';
            track.style.width = (cards.length / perView * 100) + '%';
            cards.forEach(function (card) {
                card.style.flexBasis = (100 / cards.length) + '%';
                card.style.width = (100 / cards.length) + '%';
            });
            renderDots();
        }
        if (prev) prev.addEventListener('click', function () { index = (index - 1 + pages()) % pages(); render(); });
        if (next) next.addEventListener('click', function () { index = (index + 1) % pages(); render(); });
        let resizeTimer;
        window.addEventListener('resize', function () { clearTimeout(resizeTimer); resizeTimer = setTimeout(render, 120); });
        render();
    });
});
