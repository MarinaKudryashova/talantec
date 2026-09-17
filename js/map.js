document.addEventListener('DOMContentLoaded', () => {
  const mapContainers = document.querySelectorAll('.page-contacts__map, .sec-contacts__map');

  if (!mapContainers.length || typeof ymaps === 'undefined') {
    return;
  }

  const pinSvg =
    '<div class="contacts-map__pin">' +
      '<svg width="44" height="54" viewBox="0 0 44 54" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">' +
        '<path fill-rule="evenodd" clip-rule="evenodd" d="M20.418 52.1486C21.485 52.1486 40.5504 31.7782 40.5504 20.6594C40.5504 9.54055 31.5368 0.526978 20.418 0.526978C9.29921 0.526978 0.285645 9.54055 0.285645 20.6594C0.285645 31.7782 19.351 52.1486 20.418 52.1486ZM20.4181 30.7289C26.0553 30.7289 30.6252 26.1589 30.6252 20.5217C30.6252 14.8844 26.0553 10.3146 20.4181 10.3146C14.7808 10.3146 10.2109 14.8844 10.2109 20.5217C10.2109 26.1589 14.7808 30.7289 20.4181 30.7289Z" fill="currentColor"></path>' +
        '<path fill-rule="evenodd" clip-rule="evenodd" d="M0.285645 20.6594C0.285645 31.7782 19.351 52.1486 20.418 52.1486V30.7289C14.7808 30.7287 10.2109 26.1589 10.2109 20.5217C10.2109 14.8845 14.7808 10.3146 20.418 10.3146V0.526978C9.29921 0.526978 0.285645 9.54055 0.285645 20.6594Z" fill="currentColor"></path>' +
      '</svg>' +
    '</div>';

  mapContainers.forEach((mapContainer) => {
    const centerAttr = mapContainer.dataset.center || '';
    const center = centerAttr
      .split(',')
      .map((coord) => parseFloat(coord.trim()))
      .filter((coord) => Number.isFinite(coord));

    if (center.length !== 2) {
      return;
    }

    const zoom = parseInt(mapContainer.dataset.zoom, 10) || 16;
    const address = mapContainer.dataset.address || '';

    const init = () => {
      const map = new ymaps.Map(mapContainer, {
        center,
        zoom,
        controls: ['zoomControl'],
      }, {
        suppressMapOpenBlock: true,
      });

      map.controls.remove('searchControl');
      map.controls.remove('trafficControl');
      map.controls.remove('typeSelector');
      map.controls.remove('fullscreenControl');
      map.controls.remove('rulerControl');
      map.behaviors.disable(['scrollZoom']);

      const PinLayout = ymaps.templateLayoutFactory.createClass(pinSvg);
      const placemark = new ymaps.Placemark(center, {
        hintContent: address,
        balloonContent: address,
      }, {
        iconLayout: PinLayout,
        iconShape: {
          type: 'Rectangle',
          coordinates: [[-22, -54], [22, 0]],
        },
      });

      map.geoObjects.add(placemark);
    };

    ymaps.ready(init);
  });
});
