window.initMap = () => {
    let myMap = new ymaps.Map('map', {
        center: [57, 85],
        zoom: 4,
        controls: []
    });
    return myMap;
}

window.addPointsToArr = (placemarks, coordinates, k, pointName, pointAddress, pointContact, pointPhone, pointMail, pointSite, pointNote) => {
    placemarks.push(
        new ymaps.Placemark(coordinates, {
            placemarkId: k,
            balloonContentHeader: '<div class="text-green-800">' + pointName + '</div>',
            balloonContentBody: '<b class="text-green-800">Адрес:</b> г. ' + pointAddress + '<br/>' +
                '<b class="text-green-800">Конт. лицо/лица:</b> ' + pointContact + '<br/>' +
                '<b class="text-green-800">Тел.:</b> ' + getPhones(pointPhone) + '<br/>' +
                '<b class="text-green-800">E-mail:</b> ' + getMails(pointMail) +
                getSite(pointSite) +
                getNote(pointNote)
        }, {
            preset: 'islands#darkGreenCircleDotIcon'
        })
    );
    return placemarks;
}

window.addPointsToMap = (myMap, placemarks) => {
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

    return clusterer;
}

window.removeAllPoints = (myMap) => {
    myMap.geoObjects.removeAll();
}

window.zoomToPoint = (myMap, coordinates) => {
    myMap.setCenter(coordinates, 17);
}

window.zoomToMap = (myMap, area) => {
    myMap.setBounds(area,{
        checkZoomRange: true,
        zoomMargin: 10
    });
}

window.clickToPoint = (point, coordinates) => {
    point.events.fire('click', {
        coordPosition: coordinates
    });
}

window.definePoint = (latitudeInput,longitudeInput) => {
    let coordinates= [latitudeInput.val(), longitudeInput.val()],
        pointName = $('input[name=name]').val(),
        pointAddress = 'г.' + $('select[name=city_id] option:selected').text() + ', ' + $('input[name=address]').val(),
        pointContact = $('input[name=contact]').val(),
        pointPhone = $('input[name=phone]').val(),
        pointMail = $('input[name=mail]').val(),
        pointSite = $('input[name=site]').val(),
        pointNote = $('input[name=note]').val();

    let placemarks = window.addPointsToArr([], coordinates, 0, pointName, pointAddress, pointContact, pointPhone, pointMail, pointSite, pointNote),
        clusterer = window.addPointsToMap(myMap, placemarks);

    window.zoomToMap(myMap, clusterer.getBounds());
}

window.getCoordinatesByAddress = (pointAddress, geo_api_key, latitudeInput, longitudeInput, callback) => {
    $.get('https://geocode-maps.yandex.ru/1.x/?apikey=' + geo_api_key + '&geocode=' + pointAddress + '&format=json', function (data) {
        let intermediateCoordinates = data.response.GeoObjectCollection.featureMember[0].GeoObject.Point.pos.split(' ');

        latitudeInput.val(parseFloat(intermediateCoordinates[1]));
        longitudeInput.val(parseFloat(intermediateCoordinates[0]));

        callback();
    });
}

const getPhones = (phones) => {
    let arrPhones = phones.split(';'),
        htmlStr = '';

    $.each(arrPhones, function (k,phone) {
        htmlStr += getHref('tel', phone.replace(['(',')','-','–','—',' ','[',']'," "],''), phone, (arrPhones.length > 1 ? '; ' : ''));
    });
    return htmlStr;
}

const getMails = (mails) => {
    let arrMails = mails.split(';'),
        htmlStr = '';

    $.each(arrMails, function (k,mail) {
        htmlStr += getHref('mailto', mail, mail, (arrMails.length > 1 ? '; ' : ''));
    });
    return htmlStr;
}

const getSite = (site) => {
    return site ? '<br/><b class="text-green-800">Сайт:</b> <a class="underline text-green-800 hover:text-green-500" href="' + site + '">' + site + '</a>' : '';
}

const getNote = (note) => {
    return note ? '<p class="text-gray-800 italic my-2"><b class="text-green-800">Примечание:</b> ' + note + '</p>' : '';
}

const getHref = (prefix, stringHref, stringShow, delimiter) => {
    return '<a class="underline text-green-800 hover:text-green-500" href="' + prefix + ':' + stringHref + '">' + stringShow + '</a>' + delimiter;
}