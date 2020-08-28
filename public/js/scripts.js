(function () {

    const table = $("#files-table");
    const el = $('#back-to-top');
    function showTooltip() {
        if (el.is(":visible") && $(".tooltip").length === 0) {
            el.tooltip('show');
        }
    }

    function startScrollHandlers() {
        $(window).scroll(function () {
            if ($(this).scrollTop() > 50) {
                el.fadeIn();
                showTooltip();
            } else {
                el.fadeOut();
                el.tooltip('hide');
            }
        });
        // scroll body to 0px on click
        el.click(function () {
            el.tooltip('hide');
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

        $("#delete-button").on("click", function(){
            const checkboxes = $("#files-table tbody :checked");
            if (checkboxes.length === 0) return;

            let ids = "";
            for (let box of checkboxes){
                ids+= $(box).attr("data-id")+",";
            }
            $.ajax({
                data:{
                    "_token":$("[name=csrf-token]").attr("content"),
                    "ids":ids
                },
                url: "/files/delete",
                method: "post"
            }).done((response)=>{
                window.location.pathname = window.location.pathname;
            })

        })

        $("#files-table tbody tr").on("click", function () {
            let checkbox = $(":checkbox", this);

            if (selectAll) {
                if ($("#head-checkbox").is(":checked")) {
                    if (checkbox.length > 0 && !checkbox.is(":checked")) {
                        checkbox[0].checked = true;
                    }
                    this.classList.add("table-primary");
                } else {
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
    }

    function sortBy(col) {

        const sort = function (by, order) {
            console.log(by, order)
            $("tbody> tr", table).sort((a,b) =>{
                a = $(`.item-${by}`,a);
                b = $(`.item-${by}`,b);

                if (by === "filename"){
                    a = a.text();
                    b = b.text();
                    return (order === "ASC") ? a.localeCompare(b): b.localeCompare(a);
                } else if (by === "date"){
                    a = new Date(a.text());
                    b = new Date(b.text());
                    return (order ==="ASC") ? b-a : a-b;
                } else if (by === "size") {
                    a = parseInt(a.attr("data-kbsize"));
                    b = parseInt(b.attr("data-kbsize"));
                    return (order === "ASC") ? b-a : a-b;
                }

            }).appendTo($("tbody"), table)

        }


        const changeOrder = function (item, order) {
            $("svg", table).addClass("d-none");
            if (order === "DESC"){
                table.attr("data-sort-order", "DESC");
                $("svg.bi-arrow-down", item).removeClass("d-none");
            } else {
                table.attr("data-sort-order", "ASC");
                $("svg.bi-arrow-up", item).removeClass("d-none");
            }
            sort(table.attr("data-sort-by"), order);
        }
        if (table.attr("data-sort-by") !== $(col).attr("data-name")){
            table.attr("data-sort-by", $(col).attr("data-name"));
            changeOrder(col, "DESC");
        } else{
            if(table.attr("data-sort-order") === "DESC"){
                changeOrder(col, "ASC");
            } else{
                changeOrder(col, "DESC");
            }
        }

    }
    function startSortHandlers(){
        $(".sortable", table).on("click",function () {
            sortBy(this);
        })
    }

    $(document).ready(function () {
        const column = $(`[data-name=${table.attr("data-sort-by")}]`)

        startScrollHandlers();
        startTableHandlers();
        startSortHandlers();
        showTooltip();
        sortBy(column[0]);
    });
})();

