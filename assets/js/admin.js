jQuery(function($){
let pdfFrame;
$(document).on('click','#ol_upload_pdf',function(e){e.preventDefault();if(pdfFrame){pdfFrame.open();return;}pdfFrame=wp.media({title:'Select PDF',button:{text:'Use PDF'},library:{type:'application/pdf'},multiple:false});pdfFrame.on('select',function(){const a=pdfFrame.state().get('selection').first().toJSON();$('#ol_pdf_id').val(a.id);$('#ol_pdf_url').val(a.url);});pdfFrame.open();});
$(document).on('click','#ol_remove_pdf',function(e){e.preventDefault();$('#ol_pdf_id').val('');$('#ol_pdf_url').val('');});
let galleryFrame;
$(document).on('click','#ol_upload_gallery',function(e){e.preventDefault();galleryFrame=wp.media({title:'Select Gallery Images',button:{text:'Use Images'},library:{type:'image'},multiple:true});galleryFrame.on('select',function(){let ids=[];galleryFrame.state().get('selection').each(function(a){ids.push(a.id);});$('#ol_post_gallery_ids').val(ids.join(', '));});galleryFrame.open();});
});

jQuery(function($){
    let galleryPhotoFrame;
    function renderGalleryPreview(selection){
        const ids=[]; const $preview=$('#ol_gallery_preview').empty();
        selection.each(function(model){
            if(ids.length>=10) return;
            const data=model.toJSON(); ids.push(data.id);
            const src=data.sizes?.thumbnail?.url || data.sizes?.medium?.url || data.url;
            $('<span/>',{class:'ol-gallery-preview-item','data-image-id':data.id}).append($('<img/>',{src:src,alt:''})).appendTo($preview);
        });
        $('#ol_gallery_image_ids').val(ids.join(','));
    }
    $(document).on('click','#ol_select_gallery_images',function(e){
        e.preventDefault();
        if(galleryPhotoFrame){ galleryPhotoFrame.open(); return; }
        galleryPhotoFrame=wp.media({title:'Select up to 10 Gallery Photos',button:{text:'Use Photos'},library:{type:'image'},multiple:true});
        galleryPhotoFrame.on('open',function(){
            const ids=($('#ol_gallery_image_ids').val()||'').split(',').map(Number).filter(Boolean);
            const selection=galleryPhotoFrame.state().get('selection'); selection.reset();
            ids.forEach(function(id){const attachment=wp.media.attachment(id);attachment.fetch();selection.add(attachment);});
        });
        galleryPhotoFrame.on('select',function(){renderGalleryPreview(galleryPhotoFrame.state().get('selection'));});
        galleryPhotoFrame.open();
    });
    $(document).on('click','#ol_remove_gallery_images',function(e){e.preventDefault();$('#ol_gallery_image_ids').val('');$('#ol_gallery_preview').empty();});
});
