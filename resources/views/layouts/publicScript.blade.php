
<script>
  //*************** Modal *************//
$(function () {
        $("#modal-fullscreen").on("show.bs.modal", function (e) {
            var link = $(e.relatedTarget).data("link");
                $("#modal-fullscreen .modal-body").load(link, function(){
            });
        });
        $("#modal-xl").on("show.bs.modal", function (e) {
            var link = $(e.relatedTarget).data("link");
                $("#modal-xl .modal-xl ").load(link, function(){
            });
        });
        $("#modal-lg").on("show.bs.modal", function (e) {
            var link = $(e.relatedTarget).data("link");
                $("#modal-lg .modal-lg").load(link, function(){
            });
        });
        $("#modal-lgDB").on("show.bs.modal", function (e) {
            var link = $(e.relatedTarget).data("link");
                $("#modal-lgDB .modal-body").load(link, function(){
            });
        });
        $("#modal-lg-v2").on("show.bs.modal", function(e) {
            var link = $(e.relatedTarget).data("link");
            $("#modal-lg-v2 .modal-body").load(link, function() {});
        });
        $("#modal-xl-v2").on("show.bs.modal", function(e) {
            var link = $(e.relatedTarget).data("link");
            $("#modal-xl-v2 .modal-body").load(link, function() {});
        });
        $("#modal-md").on("show.bs.modal", function (e) {
            var link = $(e.relatedTarget).data("link");
                $("#modal-md .modal-body").load(link, function(){
            });
        });
        $("#modal-sm").on("show.bs.modal", function (e) {
            var link = $(e.relatedTarget).data("link");
                $("#modal-sm .modal-body").load(link, function(){
            });
        });
    });
</script>
