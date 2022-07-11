
let description = document.querySelector("#description");
let temperature = document.querySelector("#temperature");
let temperatureResentie = document.querySelector("#temperatureResentie");
let minTemperature = document.querySelector("#minTemperature");
let maxTemperature = document.querySelector("#maxTemperature");
let pressure = document.querySelector("#pressure");
let humidity = document.querySelector("#humidity");
let windSpeed = document.querySelector("#windSpeed");
let windDirection = document.querySelector("#windDirection");


const appId = "5a3fca82987095b9779a5a979905469e"; //Renseigner la clef api ici
const link = `https://api.openweathermap.org/data/2.5/weather?q=cahors&appid=${appId}&units=metric&&lang=fr`;	

    fetch(link)
    .then((reponse) => {
        return reponse.json();
    })
    .then((data) => {
        console.log(data);
        let imgAffichage = document.getElementById("img");
        imgAffichage.src = 'http://openweathermap.org/img/wn/' + data.weather[0].icon+'.png';
        description.innerText = data.weather[0].description;
        console.log("console.log de data.weather[0].description : "+ data.weather[0].description);
        temperature.innerText += ' : ' + data.main.temp + " °C";
        temperatureResentie.innerText += ' : ' + data.main.feels_like + " °C";
        minTemperature.innerText = data.main.temp_min + " °C";
        maxTemperature.innerText = data.main.temp_max + " °C";
        pressure.innerText = data.main.pressure +" hPa";
        humidity.innerText = data.main.humidity +" %";
        windSpeed.innerText = data.wind.speed + " m/s";
        windDirection.innerText = data.wind.deg + " m/s";
    })

/*     const appId2 = "c75e4b8b5cd28e8494baac31a2e3365368b2ccb30b21898dd88c7529c348a811";
    const link2 = `https://api.ambeedata.com/latest/pollen/by-place?place=Bengaluru"`;	 */

/*     fetch("https://api.ambeedata.com/latest/pollen/by-place?place=Bengaluru", {
            "method": "GET",
            "headers": {
                "x-api-key": "adde060b1df3cd8b98967ce99f7bb58f73e8466f0003c50e6a8d9faed6c7df5a",
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
                "x-api-key": "c75e4b8b5cd28e8494baac31a2e3365368b2ccb30b21898dd88c7529c348a811",
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

