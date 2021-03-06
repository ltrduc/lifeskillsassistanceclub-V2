$(document).ready(function() { setTimeout(function() { $('#simpletable').DataTable();
        $('#order-table').DataTable({ "order": [
                [3, "desc"]
            ] });
        $('#multi-colum-dt').DataTable({ columnDefs: [{ targets: [0], orderData: [0, 1] }, { targets: [1], orderData: [1, 0] }, { targets: [4], orderData: [4, 0] }] });
        $('#complex-dt').DataTable();
        $('#DOM-dt').DataTable({ "dom": '<"top"i>rt<"bottom"flp><"clear">' });
        $('#alt-pg-dt').DataTable({ "pagingType": "full_numbers" });
        $('#scr-vrt-dt').DataTable({ "scrollY": "200px", "scrollCollapse": true, "paging": false });
        $('#scr-vtr-dynamic').DataTable({ scrollY: '50vh', scrollCollapse: true, paging: false });
        $('#lang-dt').DataTable({ "language": { "decimal": ",", "thousands": "." } }); }, 350); });