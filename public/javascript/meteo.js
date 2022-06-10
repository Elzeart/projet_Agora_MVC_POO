
let description = document.querySelector("#description");
let temperature = document.querySelector("#temperature");
let temperatureResentie = document.querySelector("#temperatureResentie");
let minTemperature = document.querySelector("#minTemperature");
let maxTemperature = document.querySelector("#maxTemperature");
let pressure = document.querySelector("#pressure");
let humidity = document.querySelector("#humidity");
let windSpeed = document.querySelector("#windSpeed");
let windDirection = document.querySelector("#windDirection");


const appId = "";
const link = `https://api.openweathermap.org/data/2.5/weather?q=cahors&appid=${appId}&units=metric&&lang=fr`;	

    fetch(link)
    .then((reponse) => {
        return reponse.json();
    })
    .then((data) => {
        // console.log(data.weather[0].main);
        let imgAffichage = document.getElementById("img");
        // description.innerHTML =  `<img src='http://openweathermap.org/img/wn/${data.weather[0].icon}.png'>` + data.weather[0].description;
        imgAffichage.src = 'http://openweathermap.org/img/wn/' + data.weather[0].icon+'.png';
        description.innerText = data.weather[0].description;
        temperature.innerText += ' : ' + data.main.temp + " °C";
        temperatureResentie.innerText += ' : ' + data.main.feels_like + " °C";
        minTemperature.innerText = data.main.temp_min + " °C";
        maxTemperature.innerText = data.main.temp_max + " °C";
        pressure.innerText = data.main.pressure +" hPa";
        humidity.innerText = data.main.humidity +" %";
        windSpeed.innerText = data.wind.speed + " m/s";
        windDirection.innerText = data.wind.deg + " m/s";
    })

/*     const appId2 = "";
    const link2 = `https://api.ambeedata.com/latest/pollen/by-place?place=Bengaluru"`;	 */

/*     fetch("https://api.ambeedata.com/latest/pollen/by-place?place=Bengaluru", {
            "method": "GET",
            "headers": {
                "x-api-key": "",
                "Content-type": "application/json"
            }
		})
        .then(response => {
            console.log(response);
        })
        .catch(err => {
            console.error(err);
        }); */

/*         fetch("https://api.ambeedata.com/latest/by-city?city=Bengaluru", {
            "method": "GET",
            "headers": {
                "x-api-key": "",
                "Content-type": "application/json"
            },
		})
        .then((reponse) => {
            return reponse.json();
        })
        .then((data) => {
            console.log(data);
        }).catch(err => {
            console.error(err);
        });; */

