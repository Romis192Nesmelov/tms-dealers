let placemarks = [],
    myMap;
$(document).ready(function() {
    ymaps.ready(() => {
        myMap = new ymaps.Map('map', {
            center: [57, 85],
            zoom: 4,
            controls: []
        });

        $.each(window.dealers, function (k,point) {
            placemarks.push(
                new ymaps.Placemark([point.latitude, point.longitude], {
                    placemarkId: k,
                    balloonContentHeader: '<div class="text-green-800">' + point.name + '</div>',
                    balloonContentBody: '<b class="text-green-800">Адрес:</b> г. ' + point.city.name + ', ' + point.address + '<br/>' +
                                        '<b class="text-green-800">Конт. лицо/лица:</b> ' + point.contact + '<br/>' +
                                        '<b class="text-green-800">Тел.:</b> ' + getPhones(point.phone) + '<br/>' +
                                        '<b class="text-green-800">E-mail:</b> ' + getMails(point.mail) +
                                        getSite(point.site)
                }, {
                    preset: 'islands#darkGreenCircleDotIcon'
                })
            );
        });

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

        myMap.setBounds(clusterer.getBounds(),{
            checkZoomRange: true,
            zoomMargin: 10
        });
    });
});

let zoomAndCenterMap = (myMap, point) => {
    myMap.setCenter(point, 17);
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