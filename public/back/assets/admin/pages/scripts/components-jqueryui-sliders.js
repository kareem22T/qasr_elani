
var ComponentsjQueryUISliders = function () {

    return {
        //main function to initiate the module
        init: function () {
            // basic
            $(".ProductsAds-basic").slider(); // basic sliders

             // vertical range sliders
            $("#ProductsAds-range").slider({
                isRTL: Metronic.isRTL(),
                range: true,
                values: [17, 67],
                slide: function (event, ui) {
                    $("#ProductsAds-range-amount").text("$" + ui.values[0] + " - $" + ui.values[1]);
                }
            });

            // snap inc
            $("#ProductsAds-snap-inc").slider({
                isRTL: Metronic.isRTL(),
                value: 100,
                min: 0,
                max: 1000,
                step: 100,
                slide: function (event, ui) {
                    $("#ProductsAds-snap-inc-amount").text("$" + ui.value);
                }
            });

            $("#ProductsAds-snap-inc-amount").text("$" + $("#ProductsAds-snap-inc").slider("value"));

            // range ProductsAds
            $("#ProductsAds-range").slider({
                isRTL: Metronic.isRTL(),
                range: true,
                min: 0,
                max: 500,
                values: [75, 300],
                slide: function (event, ui) {
                    $("#ProductsAds-range-amount").text("$" + ui.values[0] + " - $" + ui.values[1]);
                }
            });

            $("#ProductsAds-range-amount").text("$" + $("#ProductsAds-range").slider("values", 0) + " - $" + $("#ProductsAds-range").slider("values", 1));

            //range max

            $("#ProductsAds-range-max").slider({
                isRTL: Metronic.isRTL(),
                range: "max",
                min: 1,
                max: 10,
                value: 2,
                slide: function (event, ui) {
                    $("#ProductsAds-range-max-amount").text(ui.value);
                }
            });

            $("#ProductsAds-range-max-amount").text($("#ProductsAds-range-max").slider("value"));

            // range min
            $("#ProductsAds-range-min").slider({
                isRTL: Metronic.isRTL(),
                range: "min",
                value: 37,
                min: 1,
                max: 700,
                slide: function (event, ui) {
                    $("#ProductsAds-range-min-amount").text("$" + ui.value);
                }
            });

            $("#ProductsAds-range-min-amount").text("$" + $("#ProductsAds-range-min").slider("value"));

            // vertical ProductsAds
            $("#ProductsAds-vertical").slider({
                isRTL: Metronic.isRTL(),
                orientation: "vertical",
                range: "min",
                min: 0,
                max: 100,
                value: 60,
                slide: function (event, ui) {
                    $("#ProductsAds-vertical-amount").text(ui.value);
                }
            });
            $("#ProductsAds-vertical-amount").text($("#ProductsAds-vertical").slider("value"));

            // vertical range sliders
            $("#ProductsAds-range-vertical").slider({
                isRTL: Metronic.isRTL(),
                orientation: "vertical",
                range: true,
                values: [17, 67],
                slide: function (event, ui) {
                    $("#ProductsAds-range-vertical-amount").text("$" + ui.values[0] + " - $" + ui.values[1]);
                }
            });

            $("#ProductsAds-range-vertical-amount").text("$" + $("#ProductsAds-range-vertical").slider("values", 0) + " - $" + $("#ProductsAds-range-vertical").slider("values", 1));

        }

    };

}();
