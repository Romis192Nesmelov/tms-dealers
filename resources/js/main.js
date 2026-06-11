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
        myMap = new ymaps.Map('map', {
            center: [57, 85],
            zoom: 4,
            controls: []
        });

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
                let menuCityPoint = $('<div></div>').attr('id','city' + city.id).addClass('cursor-pointer mb-2 text-white hover:opacity-55 font-semibold').html('<span id="span' + city.id + '" class="mr-2 text-green-600">►</span>' + city.name);
                menuCityPoint.click(() => {
                    let self = $(this),
                        id = self.attr('id'),
                        arrow = $('#span' + id),
                        subMenu = $('#dealers' + id);

                    if (arrow.hasClass('open')) {
                        arrow.removeClass('open');
                        arrow.html('►');
                    } else {
                        arrow.addClass('open');
                        arrow.html('▼');
                    }
                    subMenu.toggle('slow');
                });

                dealersMenu = $('<ul class="pl-5 mb-2"></ul>').attr('id','dealers' + city.id).css('display','none');

                menu.append(menuCityPoint);
                menu.append(dealersMenu);
            }

            $.each(city.dealers, function (k,point) {
                let pointAddress = city.name + ', ' + point.address,
                    menuDealerPoint = $('<li></li>').attr('id', 'point_' + placemarks.length).addClass('cursor-pointer text-green-600 hover:opacity-55').html(point.name);

                dealersMenu.append(menuDealerPoint);

                $.get('https://geocode-maps.yandex.ru/1.x/?apikey=' + window.geo_api_key + '&geocode=' + pointAddress + '&format=json', function (data) {
                    let intermediateСoordinates = data.response.GeoObjectCollection.featureMember[0].GeoObject.Point.pos.split(' '),
                        coordinates = [];

                    coordinates.push(parseFloat(intermediateСoordinates[1]));
                    coordinates.push(parseFloat(intermediateСoordinates[0]));

                    placemarks.push(
                        new ymaps.Placemark(coordinates, {
                            placemarkId: k,
                            balloonContentHeader: '<div class="text-green-800">' + point.name + '</div>',
                            balloonContentBody: '<b class="text-green-800">Адрес:</b> г. ' + pointAddress + '<br/>' +
                                '<b class="text-green-800">Конт. лицо/лица:</b> ' + point.contact + '<br/>' +
                                '<b class="text-green-800">Тел.:</b> ' + getPhones(point.phone) + '<br/>' +
                                '<b class="text-green-800">E-mail:</b> ' + getMails(point.mail) +
                                getSite(point.site)
                        }, {
                            preset: 'islands#darkGreenCircleDotIcon'
                        })
                    );

                    // Проверяем всех ли дилеров обработали
                    if (window.dealersCount == placemarks.length) {
                        let clusterer = new ymaps.Clusterer({
                            preset: 'islands#darkGreenClusterIcons',
                            clusterDisableClickZoom: true,
                            clusterOpenBalloonOnClick: false,

                            // Устанавливаем режим открытия балуна.
                            // В данном примере балун никогда не будет открываться в режиме панели.
                            // clusterBalloonPanelMaxMapArea: 0,
                            // По умолчанию опции балуна balloonMaxWidth и balloonMaxHeight не установлены для кластеризатора,
                            // так как все стандартные макеты имеют определенные размеры.
                            // clusterBalloonMaxHeight: 200,
                            // Устанавливаем собственный макет контента балуна.
                            // clusterBalloonContentLayout: customBalloonContentLayout,
                        });

                        clusterer.add(placemarks);
                        myMap.geoObjects.add(clusterer);

                        // Click on point
                        myMap.geoObjects.events.add('click', function (e) {
                            let target = e.get('target');
                            if (target.properties.get('geoObjects')) {
                                myMap.setBounds(target.getBounds(),{
                                    checkZoomRange: true,
                                    zoomMargin: 30
                                });
                            }
                        });

                        $('#logo').click(() => {
                            zoomToMap(myMap, clusterer.getBounds());
                        });
                        $(window).on("resize", () => {
                            zoomToMap(myMap, clusterer.getBounds());
                        });
                        zoomToMap(myMap, clusterer.getBounds());
                    }
                });
            });
        });

        menu.find('li').click(function () {
            let key = parseInt($(this).attr('id').replace('point_','')),
                coordinates = placemarks[key].geometry.getCoordinates();

            zoomToPoint(myMap, coordinates);
            placemarks[key].events.fire('click', {
                coordPosition: coordinates
            });

            if ($(window).width() < 720) {
                menu.toggle('slow');
            }
        });
    });
});

let zoomToPoint = (myMap, coordinates) => {
    myMap.setCenter(coordinates, 17);
}

let zoomToMap = (myMap, area) => {
    myMap.setBounds(area,{
        checkZoomRange: true,
        zoomMargin: 10
    });
}

let getPhones = (phones) => {
    let arrPhones = phones.split(';'),
        htmlStr = '';

    $.each(arrPhones, function (k,phone) {
        htmlStr += getHref('tel', phone.replace(['(',')','-','–','—',' ','[',']'," "],''), phone, (arrPhones.length > 1 ? '; ' : ''));
    });
    return htmlStr;
}

let getMails = (mails) => {
    let arrMails = mails.split(';'),
        htmlStr = '';

    $.each(arrMails, function (k,mail) {
        htmlStr += getHref('mailto', mail, mail, (arrMails.length > 1 ? '; ' : ''));
    });
    return htmlStr;
}

let getSite = (site) => {
    return site ? '<br/><b class="text-green-800">Сайт:</b> <a class="underline text-green-800 hover:text-green-500" href="' + site + '">' + site + '</a>' : '';
}

let getHref = (prefix, stringHref, stringShow, delimiter) => {
    return '<a class="underline text-green-800 hover:text-green-500" href="' + prefix + ':' + stringHref + '">' + stringShow + '</a>' + delimiter;
}

// let resizeWindow = (hamburger) => {
//     if ($(window).width() > 500) {
//         hamburger.click();
//     }
// }