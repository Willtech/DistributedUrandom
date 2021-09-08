# Main API Node Specification

## Description
The API will operate from an independant node Pi 4, the first of which will include, and further nodes optionally, a CCD sensor to monitor the Hard Disk activity light, or bridging wiring to monitor the Hard Disk activity output pins, of a seperate computer. The urandom on the API node will be randomly incremented.

The API node will perform the following:
* Update urandom by making a request from urandom every 0-3.14 seconds.
* Update urandom by operation of the optional Hard Disk activity on a seperate computer input with both on and off conditions causing an additional request.
* Respond to request on an internet API to provide a 64-bit encoded 512 Byte random number from urandom.
* Participate in an optional group to distribute requests on one global URI for API calls on the project.

*The remote node is seperately provided for the service user.*

### Update by random
request _delay
python launch with input for delay to request new delay to launch self.

### Update by sensor
On input change request random from _delay.

### API Request
According to manual for [rand_int](https://php.willtech.net.au/manual/en/function.random-int.php) the [getrandom(2)](https://man7.org/linux/man-pages/man2/getrandom.2.html) syscall is used and this makes use of /dev/urandom


**Need to turn off caching headers in php config**
