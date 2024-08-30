const usersSelect = $("#user_id").select2();
const accessesSelect = $("#access_id").select2();

let dtb;
$(document).ready(function () {
    const maxRangeDays = 30;
    $(".tooltipped").tooltip();

    // Initialize from_date datepicker
    $("#from_date").datepicker({
        format: "yyyy-mm-dd",
        maxDate: new Date(),
        yearRange: 2,
        autoClose: true,
        onOpen: function () {
            const toDate = new Date($("#to_date").val());
            if (toDate) {
                const minDate = new Date(
                    toDate.getTime() - maxRangeDays * 24 * 60 * 60 * 1000
                );
                this.options.minDate = minDate;
                this.options.maxDate = toDate;
            }
        },
    });

    // Initialize to_date datepicker
    $("#to_date").datepicker({
        format: "yyyy-mm-dd",
        maxDate: new Date(),
        yearRange: 2,
        autoClose: true,
        onOpen: function () {
            const fromDate = new Date($("#from_date").val());
            if (fromDate) {
                const maxDate = new Date(
                    fromDate.getTime() + maxRangeDays * 24 * 60 * 60 * 1000
                );
                this.options.minDate = fromDate;
                this.options.maxDate = maxDate;
            }
        },
    });

    dtb = $("#data-table-absen").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: $("#data-table-absen").data("url"),
            type: "POST",
            data: function (d) {
                d.from_date = $("#from_date").val();
                d.to_date = $("#to_date").val();
                d.user_id = $("#user_id").val();
                d.access_id = $("#access_id").val();
            },
        },
        order: [[0, "desc"]], // Default ordering
        pageLength: 10,
    });
});

const handleFilterChange = function () {
    if (this.id === "access_id") {
        const url = $(this).data("url");
        const access_id = $(this).val();
        const access_name = !access_id
            ? "Pegawai"
            : $(`#access_id option[value="${access_id}"]`).text();

        if (url) {
            $.ajax({
                url: `${url}/${access_id}`,
                type: "GET",
                success: function (users) {
                    $("#user_id").select2("destroy");
                    $("#user_id").empty();
                    $("#user_id").append(
                        `<option value="" selected="selected">Semua ${access_name}</option>`
                    );
                    users.forEach((user) => {
                        $("#user_id").append(
                            `<option value="${user.id}">${user.name}</option>`
                        );
                    });
                    $("#user_id").select2();
                },
                error: function (xhr, status, error) {
                    console.error("AJAX Error:", status, error);
                },
            });
        } else {
            console.warn("No URL defined in data-url attribute");
        }
    }
    dtb.ajax.reload();
};

// Change event listener
$(document).on(
    "change",
    "#from_date, #to_date, #user_id, #access_id",
    handleFilterChange
);

$(document).on("click", ".reset-button", function () {
    // Temporarily unbind the change event to avoid multiple triggers
    $(document).off("change", "#from_date, #to_date, #user_id, #access_id");

    $("#from_date").val("").datepicker("setDate", null);
    $("#to_date").val("").datepicker("setDate", null);
    $("#user_id").val("").trigger("change");
    $("#access_id").val("").trigger("change");

    $("#user_id").select2("val", "");
    $("#access_id").select2("val", "");

    // Rebind the change event and reload the datatable
    $(document).on(
        "change",
        "#from_date, #to_date, #user_id, #access_id",
        handleFilterChange
    );

    // Manually trigger the reload once after resetting
    dtb.ajax.reload();
});

$(document).on("change", ".select-flag", function () {
    const id = $(this).data("id");
    const flag = $(this).val();
    const url = $(this).data("url");

    $.ajax({
        url: url,
        type: "POST",
        data: { id, flag },
        success: function (response) {
            dtb.ajax.reload();
        },
    });
});

$('button[name="download-pdf"]').click(function (e) {
    const url = $(this).data("url");
    const queries = $("#wrap-search").serialize();

    window.open(`${url}?${queries}`, "_blank");
});
