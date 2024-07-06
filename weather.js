
const locationInput = "DELHI";
const apiKey = "9e0ca2b6b7ba2cae9c2034ca85c0559d";
const apiUrl = `https://api.openweathermap.org/data/2.5/weather?q=${locationInput}&appid=${apiKey}`;

fetch(apiUrl)
    .then(response => response.json())
    .then(data => {
        displayWeather(data);
    })
    .catch(error => {
        console.error("Error fetching weather data:", error);
    });


function displayWeather(data) {
const weatherInfo = document.getElementById("weatherInfo");

if (data.cod === 200) {
    const temperature = (data.main.temp - 273.15).toFixed(2); 
    const description = data.weather[0].description;
    const location = data.name;

    weatherInfo.innerHTML = `
        <h2 class="weatherInfo">Weather in ${location}</h2>
        <p class="weatherInfo">Temperature: ${temperature}°C</p>
        <p class="weatherInfo">Condition: ${description}</p>
    `;
} else {
    weatherInfo.innerHTML = `<p>Location not found. Please try again.</p>`;
}
}
