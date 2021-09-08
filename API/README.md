#Instructions for API  
##Setup  
**Instructions:** 
 - [] On Raspberry Pi setup Raspbian OS Lite is sufficient. 
 - [] Install nginx, php-fpm, fail2ban, supervisor, python3, python-requests, webalizer
 - [] Configure nginx site to run DUIGCO API
 - [] Copy urandomapi.php to site and check with /urandomapi.php?api
 - [] Copy entropy.py and externalentropy.py to ~/.distributedurandom/ and `sudo chmod -R +x ~/.distributedurandom/`
 - [] Confirm each script runs from the command line after editing to enable `Debug = True` run `entropy.py` 
 - [] Edit the scripts to set Debug to False
 - [] Configure supervisor to run each script so that they run when the Raspberry Pi turns on. Supervisor config files go in `/etc/supervisor/conf.d/`
 - [] Confirm everything is operating correctly
 - [] Notify the DUIGCO API project so that your API URL can be included in the load balance to contribute to this global project
 - [] If also gathering entropy from the Hard Disk light on an external computer you will need to run `externalentropy.py` using supervisor.
 - [] If the Hard Disk light on a seperate computer is another Raspberry Pi you can configure the HDD light output to operate some pins there. On the seperate Raspberry Pi edit `/boot/config.txt` and insert line `dtparam=act_led_gpio=18`<sup>\[[1]\]</sup> checking there are no conflicts. Does not seem to work with every GPIO but might work with others eg. try GPIO 18-21 then watching to correctly connect GND at both ends bridge to pins 12 & 14 (GPIO 18) to 20 & 22 (GPIO 25) on the Raspberry Pi running the DUIGCO API
 
rel:  
[\[1\]][1] [Act Led GPIO][1] - How can I extend Act Led via gpio on B+ Raspbian?

 
**You can bypass the traditional requirements of hosting to have port forwarding and static IP addressed by using ARGO Tunnel from CloudFlare**

## Components
### urandomapi.php
This resides on you local FAMP / Pi 4 nginx server with PHP  
Locate correctly at /urandomapi.php to provide a public URL for access eg. myserver.dyndns.org/urandomapi.php  
Notify the project so your server can be added to the DUIGCO API pool api.duigco.org

### entropy.py  
Setup requires `pip install requests` if not installed.  
`chmod +x ./entropy.py` to allow execution  
CTRL + C twice to exit  

### externalentropy.py
Collects entropy from an external source i.e. the HDD light on a seperate computer (esp. the one not the API is running on)
Setup requires `pip install requests` if not installed.  
`chmod +x ./entropy.py` to allow execution  
CTRL + C twice to exit  

[1]: https://www.raspberrypi.org/forums/viewtopic.php?p=700603 "Act Led GPIO"
