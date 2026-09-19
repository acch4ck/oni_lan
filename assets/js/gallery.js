document.addEventListener('DOMContentLoaded',function(){
  const items=[...document.querySelectorAll('[data-gallery-item]')];
  if(!items.length)return;
  let index=0,startX=0;
  const lb=document.createElement('div');
  lb.className='gallery-lightbox';lb.hidden=true;lb.setAttribute('role','dialog');lb.setAttribute('aria-modal','true');lb.setAttribute('aria-label','Image gallery');
  lb.innerHTML='<button class="gallery-lightbox-close" type="button" aria-label="Close gallery">×</button><button class="gallery-lightbox-prev" type="button" aria-label="Previous image">‹</button><button class="gallery-lightbox-next" type="button" aria-label="Next image">›</button><span class="gallery-lightbox-counter"></span><img class="gallery-lightbox-image" alt=""><div class="gallery-lightbox-caption"></div>';
  document.body.appendChild(lb);
  const img=lb.querySelector('.gallery-lightbox-image'),cap=lb.querySelector('.gallery-lightbox-caption'),counter=lb.querySelector('.gallery-lightbox-counter');
  function show(i){index=(i+items.length)%items.length;const a=items[index],src=a.getAttribute('href')||a.dataset.src,alt=a.dataset.alt||a.querySelector('img')?.alt||'';lb.classList.add('is-loading');img.src=src;img.alt=alt;cap.textContent=a.dataset.caption||'';counter.textContent=(index+1)+' / '+items.length;img.onload=()=>lb.classList.remove('is-loading');}
  function open(i){show(i);lb.hidden=false;document.body.classList.add('gallery-open');lb.querySelector('.gallery-lightbox-close').focus();}
  function close(){lb.hidden=true;document.body.classList.remove('gallery-open');img.removeAttribute('src');}
  items.forEach((a,i)=>a.addEventListener('click',e=>{e.preventDefault();open(i);}));
  lb.querySelector('.gallery-lightbox-close').onclick=close;
  lb.querySelector('.gallery-lightbox-prev').onclick=()=>show(index-1);
  lb.querySelector('.gallery-lightbox-next').onclick=()=>show(index+1);
  lb.addEventListener('click',e=>{if(e.target===lb)close();});
  document.addEventListener('keydown',e=>{if(lb.hidden)return;if(e.key==='Escape')close();if(e.key==='ArrowLeft')show(index-1);if(e.key==='ArrowRight')show(index+1);});
  lb.addEventListener('touchstart',e=>{startX=e.changedTouches[0].screenX;},{passive:true});
  lb.addEventListener('touchend',e=>{const dx=e.changedTouches[0].screenX-startX;if(Math.abs(dx)>50)show(index+(dx<0?1:-1));},{passive:true});
});