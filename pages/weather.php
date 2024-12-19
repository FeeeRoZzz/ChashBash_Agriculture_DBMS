<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stylish Weather App</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background: linear-gradient(to bottom, #000428, #004e92);
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            overflow: hidden;
        }

        .weather-container {
            background: rgba(0, 0, 0, 0.8);
            color: #fff;
            padding: 20px 30px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.6);
            text-align: center;
            max-width: 400px;
            width: 100%;
            position: relative;
            animation: fadeIn 1.2s ease-in-out;
        }

        h1 {
            margin-bottom: 15px;
            font-size: 2rem;
            color: #00d4ff;
            text-shadow: 0 0 10px #00d4ff;
        }

        .input-container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            box-shadow: 0 2px 4px rgba(255, 255, 255, 0.2);
            background-color: rgba(255, 255, 255, 0.2);
            color: #fff;
        }

        .input-container input::placeholder {
            color: #ccc;
        }

        .input-container button {
            background-color: #004e92;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 8px;
            cursor: pointer;
            transition: transform 0.3s ease, background-color 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 78, 146, 0.6);
        }

        .input-container button:hover {
            background-color: #002a5b;
            transform: translateY(-2px);
        }

        .weather-display {
            margin-top: 20px;
        }

        .weather-display h2 {
            font-size: 1.8rem;
            margin-bottom: 10px;
            text-shadow: 0 0 5px #00d4ff;
        }

        .weather-display p {
            font-size: 1.2rem;
            margin: 5px 0;
        }

        /* Floating graphic elements */
        .floating-element {
            position: absolute;
            width: 50px;
            height: 50px;
            background: rgba(0, 212, 255, 0.2);
            border-radius: 50%;
            animation: float 5s infinite ease-in-out;
        }

        .floating-element:nth-child(1) {
            top: 10%;
            left: 15%;
            animation-duration: 6s;
        }

        .floating-element:nth-child(2) {
            top: 30%;
            left: 70%;
            animation-duration: 7s;
        }

        .floating-element:nth-child(3) {
            top: 70%;
            left: 30%;
            animation-duration: 8s;
        }

        /* Animations */
        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-15px);
            }
        }
    </style>
</head>
<body>
    <!-- Floating graphical elements -->
    <div class="floating-element"></div>
    <div class="floating-element"></div>
    <div class="floating-element"></div>

    <div class="weather-container">
        <h1>Weather App</h1>
        <div class="input-container">
            <input type="text" id="city" placeholder="Enter city name">
            <button onclick="getWeather()">Get Weather</button>
        </div>
        <div class="weather-display" id="weather-display">
            <!-- Weather data will appear here -->
        </div>
    </div>

    <script>
        async function getWeather() {
            const city = document.getElementById('city').value;
            const weatherDisplay = document.getElementById('weather-display');
            const apiKey = 'ecbd34f7bc9fe909cea366937a2e9829'; // Replace with your OpenWeatherMap API key

            if (city === '') {
                weatherDisplay.innerHTML = '<p>Please enter a city name!</p>';
                return;
            }

            try {
                const response = await fetch(`https://api.openweathermap.org/data/2.5/weather?q=${city}&appid=${apiKey}&units=metric`);
                if (!response.ok) {
                    throw new Error('City not found');
                }

                const data = await response.json();

                const weatherData = {
                    city: data.name,
                    temperature: Math.round(data.main.temp),
                    condition: data.weather[0].main,
                };

                weatherDisplay.innerHTML = `
                    <h2>${weatherData.city}</h2>
                    <p>Temperature: ${weatherData.temperature}&deg;C</p>
                    <p>Condition: ${weatherData.condition}</p>
                `;
            } catch (error) {
                weatherDisplay.innerHTML = '<p>Unable to fetch weather data. Please try again!</p>';
            }
        }
    </script>
</body>
</html>
