#!/usr/bin/python
## Distributed Urandom Increment Global CoOperative
# DUIGCO API
# externalentropy.py script
# Source Code produced by Willtech 2021
# v0.1 hand coded by HRjJ

## setup dependencies
import requests
import time
import RPi.GPIO as GPIO

##URL for delay from API *should be on local system*
api_url = "http://127.0.0.1/urandomapi.php?delay"
api_entropy = "http://127.0.0.1/urandomapi.php?api"

###Configuration Parameters
##GPIO to use
gpio_pin = 25

## Flush API request 
#entropy_burn = True
entropy_burn = False

#debug = True
debug = False

#Configure the GPIO
GPIO.setwarnings(False)
GPIO.setmode(GPIO.BCM)
GPIO.setup(gpio_pin, GPIO.IN)

## MAIN Program
print "Checking for HDD Entropy"
while True:
 while GPIO.input(gpio_pin) == True:
  while GPIO.input(gpio_pin) == True:
   print "Sleep True"
   time.sleep(1)

  try:
   ##get value for delay 
   r = requests.get(api_url)
  except:
   print "DELAY HTTP API GET FAILURE"

  try:
   if r.status_code == 200:
    print "HDD Entropy:"
    print "Wait Delay " + r.text[0:1]
    time.sleep(int(r.text[0:1]))
   else:
    print "Invalid API response detected"
    print "Retry Wait 10"
    time.sleep(10)
  except:
    print "Invalid API response detected"
    print "Wait 10"
    time.sleep(10)

  if entropy_burn == True:
   try:
    ##get entropy
    e = requests.get(api_entropy)
   except:
    print "ENTROPY HTTP API GET FAILURE"

   try:
    if e.status_code == 200:
     print "Entropy Burn"
     entropy = e.text[0:1000]
     if debug == True:
      print entropy
      print(len(entropy)) #684
    else:
     print "No Entropy Burn"
   except:
    print "Invalid API response detected"
    print "No Entropy Burn"


 while GPIO.input(gpio_pin) == False:
  while GPIO.input(gpio_pin) == False:
   print "Sleep False"
   time.sleep(1)

  try:
   ##get value for delay 
   r = requests.get(api_url)
  except:
   print "DELAY HTTP API GET FAILURE"

  try:
   if r.status_code == 200:
    print "HDD Entropy:"
    print "Wait Delay " + r.text[0:1]
    time.sleep(int(r.text[0:1]))
   else:
    print "Invalid API response detected"
    print "Retry Wait 10"
    time.sleep(10)
  except:
    print "Invalid API response detected"
    print "Wait 10"
    time.sleep(10)

  if entropy_burn == True:
   try:
    ##get entropy
    e = requests.get(api_entropy)
   except:
    print "ENTROPY HTTP API GET FAILURE"

   try:
    if e.status_code == 200:
     print "Entropy Burn"
     entropy = e.text[0:1000]
     if debug == True:
      print entropy
      print(len(entropy)) #684
    else:
     print "No Entropy Burn"
   except:
    print "Invalid API response detected"
    print "No Entropy Burn"
