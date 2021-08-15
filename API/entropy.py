#!/usr/bin/python
## Distributed Urandom Increment Global CoOperative
# DUIGCO API
# entropy.py script
# Source Code produced by Willtech 2021
# v0.1 hand coded by HRjJ

## setup dependencies
import requests
import time

##URL for delay from API *should be on local system*
api_url = "http://127.0.0.1/urandomapi.php?delay"
api_entropy = "http://127.0.0.1/urandomapi.php?api"

## Flush API request 
#entropy_burn = True
entropy_burn = False

## MAIN Program
while True:
 try:
  ##get value for delay 
  r = requests.get(api_url)
 except:
  print "DELAY HTTP API GET FAILURE"

 try:
  if r.status_code == 200:
   print "Entropy Wait " + r.text[0:1]
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
   else:
    print "No Entropy Burn"
  except:
   print "Invalid API response detected"
   print "No Entropy Burn"
