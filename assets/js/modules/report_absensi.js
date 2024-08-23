$("#user_id").select2();

$(document).ready(function () {
    $("#from_date").datepicker({
        format: "yyyy-mm-dd",
        maxDate: new Date(),
        yearRange: 2,
        autoClose: true,
    });

    $("#to_date").datepicker({
        format: "yyyy-mm-dd",
        maxDate: new Date(),
        yearRange: 2,
        autoClose: true,
        onOpen: function () {
            var d = new Date($("#from_date").val());
            var start_date = d.setDate(d.getDate() - 1);
            this.options.minDate = new Date(start_date);
        },
    });

    var url = $("#wrap-search").data("url");
    var from_date = $("#from_date").val();
    var to_date = $("#to_date").val();
    var user_id = $("#user_id").val();

    $.ajax({
        url: url,
        type: "POST",
        data: { from_date: from_date, to_date: to_date, user_id: user_id },
        success: function (response) {
            $("#showTable").html(response);
        },
    });
});

$(document).on("change", "#from_date", function () {
    var url = $("#wrap-search").data("url");
    var from_date = $("#from_date").val();
    var to_date = $("#to_date").val();
    var user_id = $("#user_id").val();

    $.ajax({
        url: url,
        type: "POST",
        data: { from_date: from_date, to_date: to_date, user_id: user_id },
        success: function (response) {
            $("#showTable").html(response);
        },
    });
});

$(document).on("change", "#to_date", function () {
    var url = $("#wrap-search").data("url");
    var from_date = $("#from_date").val();
    var to_date = $("#to_date").val();
    var user_id = $("#user_id").val();

    $.ajax({
        url: url,
        type: "POST",
        data: { from_date: from_date, to_date: to_date, user_id: user_id },
        success: function (response) {
            $("#showTable").html(response);
        },
    });
});

$(document).on("change", "#user_id", function () {
    var url = $("#wrap-search").data("url");
    var from_date = $("#from_date").val();
    var to_date = $("#to_date").val();
    var user_id = $("#user_id").val();

    $.ajax({
        url: url,
        type: "POST",
        data: { from_date: from_date, to_date: to_date, user_id: user_id },
        success: function (response) {
            $("#showTable").html(response);
        },
    });
});

$(document).on("change", ".select-flag", function () {
    const id = $(this).data("id");
    const flag = $(this).val();
    const url = $(this).data("url");
    const table = $("#wrap-search").data("url");
    const from_date = $("#from_date").val();
    const to_date = $("#to_date").val();
    const user_id = $("#user_id").val();

    $.ajax({
        url: url,
        type: "POST",
        data: { id, flag },
        success: function (response) {
            $.ajax({
                url: table,
                type: "POST",
                data: {
                    from_date: from_date,
                    to_date: to_date,
                    user_id: user_id,
                },
                success: function (response) {
                    $("#showTable").html(response);
                },
            });
        },
    });
});

$('button[name="download-pdf"]').click(function (e) {
    const url = $(this).data("url");
    const queries = $("#wrap-search").serialize();

    window.open(`${url}?${queries}`, "_blank");
});
