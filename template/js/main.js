$(document).ready(function () {
    function bottomFooter() {
        if ($('section').height() + $('#header').height() + 70 < $(window).height()) {
            $('.page-footer').css("position", "absolute");
        }
        else $('.page-footer').css("position", "relative");
    }

    bottomFooter();
    $(window).resize(bottomFooter);

    $("#new").click();
    $('#datetimepicker1').datetimepicker({
        format: 'YYYY-MM-DD HH:mm'

    });

    $(':checkbox[name="taskBox"]').change(function () {
        var element = $(this);
        var id = element.attr("data-id");
        if (this.checked) {
            $.post('/task/updatetask/' + id + '', {complete: 1, id: id}, function (data) {
                var time = moment().format("YYYY-MM-DD HH:mm:ss");
                $(element.context.parentNode.parentNode.childNodes[7]).html(time);
            });
        }
        else {
            $.post('/task/updatetask/' + id + '', {complete: 0, id: id}, function (data) {
                $(element.context.parentNode.parentNode.childNodes[7]).html('');
            });
        }
    });
    $(':checkbox[name="dealBox"]').change(function () {
        var element = $(this);
        var id = element.attr("data-id");
        if (this.checked) {
            $.post('/task/updatedeal/' + id + '', {complete: 1, id: id}, function (data) {
                var time = moment().format("YYYY-MM-DD HH:mm:ss");
                $(element.context.parentNode.parentNode.childNodes[9]).html(time);
            });
        }
        else {
            $.post('/task/updatedeal/' + id + '', {complete: 0, id: id}, function (data) {
                $(element.context.parentNode.parentNode.childNodes[9]).html('');
            });
        }
    });
//Выбор исполнителя
    $(".dev").change(function () {

        var id = $(this).val();
        var id_task = $(this).find(':selected').data('id');
        $.post('/task/updatedev/' + id + '', {id: id, id_task: id_task}, function (data) {
        });

    });


    $('.datepicker').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 17 // Creates a dropdown of 15 years to control year
    });
});
