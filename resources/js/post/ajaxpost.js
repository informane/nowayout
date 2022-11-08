import $ from 'jquery';
window.$ = window.jQuery = $;

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
    }
});

$('.post_submit').click(function (e) {
    e.preventDefault();


    /*var data = {title: $("#title").val(), text: $('#text').val()};
    if($('#id').val() !== ''){
        data.id = $('#id').val();
    }*/
    $.ajax({
        url: $('.post_form').attr('action'),
        method: 'POST',
        dataType: 'json',
        data: $('.post_form').serialize(),
        //data: data,
        success: function (data) {
            if(data.result === 'success'){
                window.location = '/view-post/'+data.post_id;
            }

        },
        error: function (data) {
            var errors = $.parseJSON(data.responseText);
            errors = errors.errors;
                $.each(errors, function (key,value) {
                    console.log(value);
                    $('#' + key + ' + div').text(value);

                });
        }
    })
})

$('.remove').click(function (e) {
    e.preventDefault();

    $.ajax({
        url: $(this).attr('href'),
        method: 'get',
        success: function (data) {
            if(data.result === 'success'){
                window.location = '/index';
            }
        },
        fail: function (data) {
            var errors = $.parseJSON(data.responseText);
            errors = errors.errors;
            $.each(errors, function (key,value) {
                console.log(value);
            });
        }
    })
})
