function getEnderecoFromPosition(position) {
  console.log("Posição é ", position);
  fetch(`http://maps.googleapis.com/maps/api/geocode/json?latlng=
    ${position.coords.latitude},
    ${position.coords.longitude}`)
    .then(data => data.json())
    .then(dataJson => console.log("dataJson é ", dataJson));
}
