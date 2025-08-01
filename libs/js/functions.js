function suggestion() {
    $('#sug_input').keyup(function (e) {
        var formData = {
            'product_name': $('input[name=title]').val()
        };

        if (formData['product_name'].length >= 1) {
            $.ajax({
                type: 'POST',
                url: 'ajax.php',
                data: formData,
                dataType: 'json',
                encode: true
            })
            .done(function (data) {
                $('#result').html(data).fadeIn();
                $('#result li').click(function () {
                    $('#sug_input').val($(this).text());
                    $('#result').fadeOut(500);
                });

                $("#sug_input").blur(function () {
                    $("#result").fadeOut(500);
                });
            })
            .fail(function (xhr, status, error) {
                console.error("AJAX Error:", error);
                $('#result').html('<li class="list-group-item">Error fetching data</li>').fadeIn();
            });
        } else {
            $("#result").hide();
        }
        e.preventDefault();
    });
}

$('#sug-form').submit(function (e) {
    var formData = {
        'p_name': $('input[name=title]').val()
    };

    $.ajax({
        type: 'POST',
        url: 'ajax.php',
        data: formData,
        dataType: 'json',
        encode: true
    })
    .done(function (data) {
        $('#product_info').html(data).show();
        total();
        $('.datePicker').datepicker('update', new Date());
    })
    .fail(function (xhr, status, error) {
        console.error("AJAX Error:", error);
        $('#product_info').html('<tr><td>Error loading product details</td></tr>').show();
    });

    e.preventDefault();
});

function total() {
    $(document).on('input', 'input[name=price], input[name=quantity]', function () {
        var price = parseFloat($('input[name=price]').val()) || 0;
        var qty = parseInt($('input[name=quantity]').val()) || 0;

        var total = qty * price;
        $('input[name=total]').val(total.toFixed(2));
    });
}


$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
    $('.submenu-toggle').click(function () {
        $(this).parent().children('ul.submenu').toggle(200);
    });
    suggestion();
    total(); // Call total function on page load
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        todayHighlight: true,
        autoclose: true
    });
});
