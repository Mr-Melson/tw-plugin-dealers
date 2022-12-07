$(document).ready(() => {
    if ($('#dealers_list').length) {
        window.dealersController = new dealersController();
    }
});

function dealersController() {

    this.init = function () {
        this.bindPageElements();
        this.bindListeners();
    }

    this.bindPageElements = function () {

        this.page = {
            cities: $('#cities'),
            dealers: $('.dealer_toogle')
        }
    }

    this.bindListeners = function () {

        $(this.page.cities).on('change', e => {
            this.toggleDealers();
        });
    }

    this.toggleDealers = function () {

        let city_id = +$(this.page.cities).val();

        if (-1 === city_id) {

            Object.values(this.page.dealers).map(dealer => {
                $(dealer).css('display', 'block');
            });

            return;
        }

        this.page.dealers.map((index, dealer) => {

            $(dealer).css('display', 'none');

            let dealer_town_ids = JSON.parse($(dealer).attr('data-town'));

            dealer_town_ids.map(town_id => {

                if (town_id === city_id) {
                    $(dealer).css('display', 'block');
                }
            })
        });
    }

    this.init();
}