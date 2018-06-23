function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(getEnderecoFromPosition);
  } else {
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}
function showPosition(position) {
  console.log("A posição é ", position);
}
function getEnderecoFromPosition(position) {
  console.log("Posição é ", position);
  fetch(`http://maps.googleapis.com/maps/api/geocode/json?latlng=
    ${position.coords.latitude},
    ${position.coords.longitude}`)
    .then(data => data.json())
    .then(dataJson => console.log("dataJson é ", dataJson));
}
