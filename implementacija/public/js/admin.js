$('.delete-tournament-button').on('click', function () {
    $('#delete-tournament-form').attr('action', $(this).data('delete-link'));
});