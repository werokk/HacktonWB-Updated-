var x = document.getElementById('demo');

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showWeather);
    } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
    }

}

function populateWeather(weather){
var weatherdescription= document.getElementById('weather');
var weatherMain= document.getElementById('wDescr');
var img = document.getElementById('icon');
weatherdescription.innerHTML= weather.main.temp + ' ℃' ;
weatherMain.innerHTML= weather.name;
var iconCode = weather.weather[0].icon;
console.log(iconCode);
var iconUrl = "http://openweathermap.org/img/w/" + iconCode + ".png";
img.innerHTML="<img src="+iconUrl+">";

}


function showWeather(position){
  var la = position.coords.latitude;
  var lo = position.coords.longitude;
  var request = new XMLHttpRequest();
request.open('GET', 'https://api.openweathermap.org/data/2.5/weather?lat='+la+'&lon='+lo+'&units=metric'+'&APPID=d0a10211ea3d36b0a6423a104782130e', true);

request.onload = function() {
  if (request.status >= 200 && request.status < 400) {
  var weather= JSON.parse(request.responseText);  // Success!
console.log( JSON.parse(request.responseText));
console.log( la);

populateWeather(weather);
  } else {
    // We reached our target server, but it returned an error
  }
};

request.onerror = function() {
  // There was a connection error of some sort
};

request.send();
}

getLocation();
