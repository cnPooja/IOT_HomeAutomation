# IOT_HomeAutomation

The project focuses on home automation system to control and manage home appliances. The user controls the appliances using the developed android app. The android app and Raspberry Pi interact with the database in the XAMPP server based on MySQL in order to control the devices.

Overview:
1) The app is designed so as to control all the Electrical Equipment in the house.
2) The house consists of 2 floors and a raspberry Pi that represents each floor.
3) Each floor has 2 lights to indicate various electrical equipment that might exist and has 2 proximity sensors that detect any movement which occurs on that floor.
4) It is also assumed that a livestream is not required and instead a saved video needs to store on the server and then viewed on the app.
5) It is also assumed that the utility can view only what is currently turned on and what electrical equipment is turned off. It cannot control it.
6) The power generator, contrary to the name can view the amount of power that is being used in the house.
7) It is assumed that any new accounts that are made on the app are user / homeowner accounts. These accounts do not have access to the power generation or the Utility information.
8) The NMAP is performed on a separate Raspberry PI which keeps track of the network. Any Device with the network including the server and Router performs a notification when disconnected.

Design decisions:
1) Python is used for coding on the Raspberry Pi.
2) If the user turns on lights on either of the floors with the app on the android device, It does a DB update and subsequently the PI does a DB query. The reverse happens with the proximity sensors.
3) When a User registers with the server, the server doesn’t store the password for various reasons. We use a hash function called md5 in order to encrypt the data and not store it.
4) When the user subsequently signs in, the server checks the hashed password with the stored hashed password. If the hashed passwords match, the user is logged into the server and can access all the DB’s.
5) The user can also view the weather and can also change the location and view the weather there. The weather information is derived from OpenWeatherMap.org. OpenWeatherMap.org provides an API upon signup which is used to retrieve the weather information for a selected city. We send a Json request with the city name as a parameter. Once the city is successfully found in the server, we get a response with a predetermined set of parameters like pressure, temp etc.
6) User can also view the security camera footage.
7) User can also control the thermostat through the app.
8) A Toast message is performed when a button is clicked on the Security page on which device is within the network.
