$('.tagsDeleteModal').click(function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    var name = $(this).data('name');
    $('#tagDelName').text('Подтвердите удаление тега: ' + name);
    $('.tagDelForm .tagDelId').val(id);
    $('#tagsDeleteModal').modal('toggle');
});

$('.btn-modal-close').click(function(e) {
    e.preventDefault();
    $('#tagDelName').text('');
    $('.tagDelForm .tagDelId').val('');
    $('#tagsDeleteModal').modal('toggle');
});

$('.btm-modal-send').click(function(e) {
    e.preventDefault();
    var id = $('.tagDelForm .tagDelId').val();
    var token = $('.tagDelForm .tokenInput').val();
    $.ajax(
        {
            url: "tags/"+id,
            type: 'DELETE',
            dataType: "JSON",
            data: {
                "id": id,
                "_method": 'DELETE',
                "_token": token,
            },
            success: function (msg)
            {
                if(msg.id > 0){
                    $('#tagId_' + msg.id).remove();
                }
            }
        });
    $('#tagDelName').text('');
    $('.tagDelForm .tagDelId').val('');
    $('#tagsDeleteModal').modal('toggle');
});





$('.groupsDeleteModal').click(function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    var title = $(this).data('title');
    $('#groupDelName').text('Подтвердите удаление группы: ' + title);
    $('.groupDelForm .groupDelId').val(id);
    $('#groupsDeleteModal').modal('toggle');
});

$('.groups-btn-modal-close').click(function(e) {
    e.preventDefault();
    $('#groupDelName').text('');
    $('.groupDelForm .groupDelId').val('');
    $('#groupsDeleteModal').modal('toggle');
});

$('.groups-btm-modal-send').click(function(e) {
    e.preventDefault();
    var id = $('.groupDelForm .groupDelId').val();
    var token = $('.groupDelForm .tokenInput').val();
    $.ajax(
        {
            url: "groups/"+id,
            type: 'DELETE',
            dataType: "JSON",
            data: {
                "id": id,
                "_method": 'DELETE',
                "_token": token,
            },
            success: function (msg)
            {
                if(msg.id > 0){
                    $('#groupId_' + msg.id).remove();
                }
            }
        });
    $('#groupDelName').text('');
    $('.groupDelForm .groupDelId').val('');
    $('#groupsDeleteModal').modal('toggle');
});