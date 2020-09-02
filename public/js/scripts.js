(function () {

    const table = $("#files-table");

    function showTooltip() {
        const el = $('#back-to-top');
        if (el.is(":visible") && $(".tooltip").length === 0) {
            $('#back-to-top').tooltip('show');
        }
    }

    function getCheckedCheckboxIds() {
        const checkboxes = $("#files-table tbody :checked");
        let ids = "";

        for (let box of checkboxes) {
            ids += $(box).attr("data-id") + ",";
        }
        return ids.slice(0, -1);
    }

    function startScrollHandlers() {
        $(window).scroll(function () {
            if ($(this).scrollTop() > 50) {
                $('#back-to-top').fadeIn();
                showTooltip();
            } else {
                $('#back-to-top').fadeOut();
                $('#back-to-top').tooltip('hide');
            }
        });
        // scroll body to 0px on click
        $('#back-to-top').click(function () {
            $('#back-to-top').tooltip('hide');
            $('body,html').animate({
                scrollTop: 0
            }, 800);
            return false;
        });
    }

    function startTableHandlers() {
        let selectAll = false;

        $("#head-checkbox").on("change", function (e) {
            e.preventDefault();

            selectAll = true;
            $("#files-table tbody tr").click();
            selectAll = false;
        });

        $("#download-button").on("click", function () {
            const ids = getCheckedCheckboxIds();

            if (ids === "") return;

            window.location.pathname = `/files/download/${ids}`;
        });

        $("#delete-button").on("click", function () {
            const ids = getCheckedCheckboxIds();

            if (ids === "") return;

            $.ajax({
                data:{
                    "_token": $("[name=csrf-token]").attr("content"),
                    "ids": ids
                },
                url: "/files/delete",
                method: "post"
            }).done((response) => {
                window.location.pathname = window.location.pathname;
            });
        });

        $("#files-table tbody tr").on("click", function () {
            let checkbox = $(":checkbox", this);


            if (selectAll) {
                //if head checkbox is checked, and the row's checkbox is not checked, then check the row's checkbox
                if ($("#head-checkbox").is(":checked")) {
                    if (checkbox.length > 0 && !checkbox.is(":checked")) {
                        checkbox[0].checked = true; // if
                    }
                    this.classList.add("table-primary");
                } else { //if head checkbox is unchecked, and the row's checkbox is checked, then uncheck the row's checkbox
                    if (checkbox.length > 0 && checkbox.is(":checked")) {
                        checkbox[0].checked = false;
                    }
                    this.classList.remove("table-primary");
                }
            } else {
                if (!checkbox[0].checked) {
                    checkbox[0].checked = true;
                    this.classList.add("table-primary");
                } else {
                    checkbox[0].checked = false;
                    this.classList.remove("table-primary");
                }
            }
        });

        $('#editModal').on('show.bs.modal', function (event) {
            const button = $(event.relatedTarget);
            const filename = $(".item-filename", event.relatedTarget.parentElement.parentElement).text();
            $(this).attr("data-item-id", button.data('item-id'));
            $('.modal-body input', this).val(filename);
        });

        $(".link-icon").on("click", function () {
            const id = this.previousElementSibling.getAttribute("data-item-id");
            const tt = $(".link-tooltip", this);


            tt.tooltip("show");

            navigator.clipboard.writeText(`${window.location.host}/files/download/${id}`);

            setTimeout(() => {
                tt.tooltip("hide");
            }, 2000);
        });

        $('#modal-save').on('click', function () {
            const id = $('#editModal').attr("data-item-id");
            const newName = $('#editModal .modal-body input').val();

            if (newName !== "") {
                $.ajax({
                    data:{
                        "_token": $("[name=csrf-token]").attr("content"),
                        "filename": newName
                    },
                    url: `/files/edit/${id}`,
                    method: "post"
                }).done((response) => {
                    window.location.pathname = window.location.pathname;
                });
            }
        });
    }

    function sort(by, order) {
        $("thead svg", table).addClass("d-none");

        if (order === "DESC") {
            $(`[data-name=${by}] svg.bi-arrow-down`).removeClass("d-none");
        } else {
            $(`[data-name=${by}] svg.bi-arrow-up`).removeClass("d-none");
        }

        $("tbody > tr", table).sort((a,b) => {
            a = $(`.item-${by}`, a);
            b = $(`.item-${by}`, b);

            if (by === "filename") {
                a = a.text();
                b = b.text();
                return (order === "ASC") ? a.localeCompare(b) : b.localeCompare(a);
            } else if (by === "date") {
                a = new Date(a.text());
                b = new Date(b.text());
                return (order === "ASC") ? b - a : a - b;
            } else if (by === "size") {
                a = parseInt(a.attr("data-kbsize"));
                b = parseInt(b.attr("data-kbsize"));
                return (order === "ASC") ? b - a : a - b;
            }

        }).appendTo($("tbody", table));
    };

    function handleSortClick(col) {
        const changeOrder = function (order) {
            if (order === "DESC") {
                table.attr("data-sort-order", "DESC");
            } else {
                table.attr("data-sort-order", "ASC");
            }

            sort(table.attr("data-sort-by"), order);
        }

        if (table.attr("data-sort-by") !== $(col).attr("data-name")) {
            table.attr("data-sort-by", $(col).attr("data-name"));
            changeOrder("DESC");
        } else {
            if (table.attr("data-sort-order") === "DESC") {
                changeOrder("ASC");
            } else {
                changeOrder("DESC");
            }
        }
    }

    function updateDefaultOrder() {
        $.ajax({
            data:{
                "_token": $("[name=csrf-token]").attr("content"),
                "by": table.attr("data-sort-by"),
                "order": table.attr("data-sort-order")
            },
            url: `/folder/change-order`,
            method: "post"
        });
    };

    function startSortHandlers() {
        $(".sortable", table).on("click", function () {
            handleSortClick(this);
            updateDefaultOrder();
        });
    }

    $(document).ready(function () {
        startScrollHandlers();
        startTableHandlers();
        startSortHandlers();
        showTooltip();

        sort(table.attr("data-sort-by"), table.attr("data-sort-order"));
    });
})();

