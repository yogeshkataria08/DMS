app.product = {

    events: {
        switch: function () {},

        delete: function () {
            $(document).on('click', ".deleteRecord", function () {
                var dpath = $(this).attr('formaction');
                var result = confirm("Are you sure you want to delete this "+dpath.toUpperCase()+"?");
                if (result) {
                    var id = $(this).attr('rel');
                    var url = app.config.SITE_PATH + dpath +'/delete';
                    app.deleteRecord(id, url);
                }
            });
        },

        init: function () {
            app.product.events.switch();
            app.product.events.delete();
            app.dataTable.search();
            app.dataTable.reset();

        },

    },

    init: function () {
        app.product.events.init();
        app.dataTable.custom({"url":'product/datatable'});
        app.dataTable.eventFire();
    }
}