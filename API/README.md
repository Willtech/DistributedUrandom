#Instructions for API

## urandomapi.php
This resides on you local FAMP / Pi 4 nginx server with PHP  
Locate correctly at /urandomapi.php to provide a public URL for access eg. myserver.dyndns.org/urandomapi.php  
Notify the project so your server can be added to the DUIGCO API pool api.duigco.org/urandom.php?delay

## entropy.py  
Setup requires `pip install requests` if not installed.  
`chmod +x ./entropy.py` to allow execution  
CTRL + C twice to exit  

## externalentropy.py
Collects entropy from an external source i.e. the HDD light on a seperate computer (esp. the one not the API is running on)
Setup requires `pip install requests` if not installed.  
`chmod +x ./entropy.py` to allow execution  
CTRL + C twice to exit  
