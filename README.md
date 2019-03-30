# AWDigie
AWDigie is a sophisticated web tool providing [Active Worlds](https://activeworlds.com/) users the ability to control and monitor TV stations with live broadcasting and predefined programming.

# Directions
Clone repository or grab the [latest release](oliverbooth/awdigie/releases)

# Requirements
## Client
* JavaScript-enabled web browser

## Server
* PHP (v<7)
* libGD for PHP

# Usage
To use this in [Active Worlds](https://activeworlds.com/) or [Virtual Paradise](https://virtualparadise.org/), apply this action to an object that supports images:

```
create picture <url>/tv.php update=<n>
```

where \<url\> is the path to your webserver, and \<n\> is recommended to be 5.