let placemarks = [],
    mapObj,
    myMap,
    hamburger,
    menu,
    dealersMenu;

$(document).ready(function() {
    mapObj = $('#map');
    hamburger = $('#hamburger');
    menu = $('#menu');

    hamburger.click(() => {
        menu.toggle('slow');
    });

    ymaps.ready(() => {
        myMap = window.initMap();

        // ymaps.geocode('г.Москва, ул. Криворожская д.17').then(
        //     (res) => {
        //         let pointCoordinates = res.geoObjects.get(0).geometry.getCoordinates();
        //         console.log(pointCoordinates);
        //     }, (err) => {
        //         console.log(err.message);
        //     }
        // );

        $.each(window.cities, function (c,city) {

            if (city.dealers.length) {
                let menuCityPoint = $('<div></div>').attr('id','city' + city.id).addClass('cursor-pointer mb-2 text-white hover:opacity-55 font-semibold').html('<span id="span' + city.id + '" class="mr-2 text-green-600 icon-arrow-right13"></span>' + city.name);
                menuCityPoint.click(() => {
                    let self = $(this),
                        id = self.attr('id'),
                        arrow = $('#span' + id),
                        subMenu = $('#dealers' + id);

                    if (arrow.hasClass('icon-arrow-right13')) {
                        arrow.removeClass('icon-arrow-right13').addClass('icon-arrow-down12');
                    } else {
                        arrow.removeClass('icon-arrow-down12').addClass('icon-arrow-right13');
                    }
                    subMenu.toggle('slow');
                });

                dealersMenu = $('<ul class="pl-5 mb-2"></ul>').attr('id','dealers' + city.id).css('display','none');

                menu.append(menuCityPoint);
                menu.append(dealersMenu);
            }

            $.each(city.dealers, function (k,point) {
                let pointAddress = city.name + ', ' + point.address,
                    menuDealerPoint = $('<li></li>').attr('id', 'point_' + placemarks.length).addClass('cursor-pointer text-green-600 hover:opacity-55').html('<span class="icon-location4 text-white mr-2"></span>' + point.name);

                dealersMenu.append(menuDealerPoint);

                placemarks = window.addPointsToArr(
                    placemarks,
                    [point.latitude, point.longitude],
                    k,
                    point.name,
                    pointAddress,
                    point.contact,
                    point.phone,
                    point.mail,
                    point.site,
                    point.note
                );
            });
        });

        let clusterer = window.addPointsToMap(myMap, placemarks);

        $('#logo').click(() => {
            window.zoomToMap(myMap, clusterer.getBounds());
        });
        $(window).on("resize", () => {
            window.zoomToMap(myMap, clusterer.getBounds());
        });
        window.zoomToMap(myMap, clusterer.getBounds());

        menu.find('li').click(function () {
            let key = parseInt($(this).attr('id').replace('point_','')),
                coordinates = placemarks[key].geometry.getCoordinates();

            window.zoomToPoint(myMap, coordinates);
            window.window.clickToPoint(placemarks[key], coordinates);

            if ($(window).width() < 720) {
                menu.toggle('slow');
            }
        });
    });
});



// let resizeWindow = (hamburger) => {
//     if ($(window).width() > 500) {
//         hamburger.click();
//     }
// }