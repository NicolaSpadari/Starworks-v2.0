/* AJAX */
$(document).on("click", ".save", function(e) {
    e.preventDefault();
    var id = $(this).parent().parent().find('.bordered').attr('id');
    var question = $(this).parent().children().find('.quest').val();
    var answer = $(this).parent().children().children().find('.answ').val();
    $.ajax({
        url: 'functions-faqs.php',
        type: 'POST',
        data: { function: 'saveChanges',
                id: id,
                var1: question,
                var2: answer},
        success: function () {
            location.reload();
        },
        error: function (jqXhr, textStatus, errorThrown) {
            console.log(errorThrown);
        }
    });
});
$(document).on("click", ".saveSlide", function(e) {
    e.preventDefault();
    var id = $(this).parent().parent().attr('id');
    var caption = $(this).parent().parent().children('.capt').val();
    $.ajax({
        url: 'functions-slideshow.php',
        type: 'POST',
        data: { function: 'saveChanges',
                id: id,
                caption: caption},
        success: function () {
            location.reload();
        },
        error: function (jqXhr, textStatus, errorThrown) {
            console.log(errorThrown);
        }
    });
});
$(document).on("click", ".saveEvent", function(e) {
    e.preventDefault();
    var id = $(this).parent().attr('id');
    var title = $(this).parent().children('.eventTitle').val();
    var date = $(this).parent().children('.eventDate').val();
    var formdata = new FormData();
    formdata.append("id", id);
    formdata.append("title", title);
    formdata.append("date", date);
    formdata.append("image", $(this).parent().find('input[type=file]')[0].files[0]);
    formdata.append("function", "saveChanges");
    $.ajax({
        url: 'functions-gallery.php',
        type: "POST",
        data: formdata,
        processData: false,
        contentType: false,
        success: function () {
            location.reload();
        },
        error: function (jqXhr, textStatus, errorThrown) {
            console.log(errorThrown);
        }
    });
});
$(document).on("click", ".cancel", function(){
    location.reload();
});

/* EDIT SLIDESHOW */
$(document).on("click", ".editSlide", function(e){
    var caption = $(this).parent().children('.page-header').text();
    $(this).parent().children('.page-header').replaceWith("<input class='edit-field capt' type='text' autofocus value='"+caption+"'/>");
    $(this).parent().children('.deleteSlide').replaceWith("<button class='btn btn-warning cancel'>Cancel</button>");
    $(this).replaceWith("<button class='btn btn-success saveSlide'>Save</a>");
    e.preventDefault();
});
$(document).on("click", ".deleteSlide", function(e){
    return confirm('Are you sure you want to delete this slide?');
});

/* EDIT FAQ */
$(document).on("click", ".edit", function(e){
    var question = $(this).parent().find('.bg-dark').html();
    var replies = $(this).parent().find('p.m-0').html();
    $(this).parent().find('div.bg-dark').replaceWith("<div class='col-12 bg-dark text-white py-2 px-4 mb-1 faqQuestion'><input class='edit-field quest' type='text' autofocus value='"+question+"'/></div>");
    $(this).parent().find('p.m-0').replaceWith("<div class='col-12'><input class='edit-field answ' type='text' value='"+replies+"'/></div>");
    $(this).parent().find('a.btn-danger').replaceWith("<button class='btn btn-warning cancel'>Cancel</button>");
    $(this).replaceWith("<button class='btn btn-success save'>Save</a>");
    e.preventDefault();
});
$(document).on("click", ".remove", function(e){
    return confirm('Are you sure you want to delete this faq?');
});
$(document).on("click", ".cancel", function(e){
    if(confirm('Are you sure you want to cancel the changes?')){
        return true;
    }
    
    return false;
});

/* EDIT GALLERY */
$(document).on("click", ".editEvent", function(e){
    e.preventDefault();
    var id = $(this).parent().attr('id');
    var title = $(this).parent().children('.page-header').text();
    var date = $(this).parent().children('.text-muted').text();
    $(this).parent().children('img').replaceWith("<form id='update' method='post' enctype='multipart/form-data'><input type='text' name='id' value='"+id+"' style='display: none;'><input type='file' name='event_image' accept='image/*'>");
    $(this).parent().children('.page-header').replaceWith("<input form='update' class='edit-field eventTitle' name='editedTitle' type='text' autocomplete='off' value='"+title+"'/>");
    $(this).parent().children('.text-muted').replaceWith("<input form='update' class='edit-field eventDate' name='editedDate' type='date' value='"+date+"'/>");
    $(this).parent().find('a.btn-danger').replaceWith("<button class='btn btn-warning cancel'>Cancel</button>");
    $(this).replaceWith("<button form='update' type='submit' class='btn btn-success' name='saveEvent'>Save</a></form>");
});
$(document).on("click", ".removeEvent", function(){
    return confirm('Are you sure you want to delete this event?\nPlease note that the entire event will be deleted.');
});
$(document).on("click", ".deleteEvent", function(){
    return confirm('Are you sure you want to delete this event?');
});

/* EDIT ALBUM PHOTOS */
$(document).on("click", ".removePhoto", function(){
    return confirm('Are you sure you want to delete this photo?');
});