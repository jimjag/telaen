function delatt(rem) {
    $.post('upload.php', {rem: rem}, function(data) {
        $('#nm_attachs').html(data);
    });
    return false;
}
