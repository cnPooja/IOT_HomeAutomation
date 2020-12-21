#import the GPIO and time package
import RPi.GPIO as GPIO
import time
import requests
import json
GPIO.setmode(GPIO.BCM)
GPIO.setup(21, GPIO.IN)
GPIO.setup(20, GPIO.IN)
GPIO.setup(26, GPIO.OUT)
GPIO.setup(19, GPIO.OUT)
url = 'http://10.220.122.133/Android/v1/floor2sensor.php'
urllight = 'http://10.220.122.133/Android/v1/floor2get.php'
while(True):
    if(GPIO.input(21)==0):
        a = 1
        print("Object Found");
        time.sleep(1)
    else:
        print("Nothing")
        a = 0
        time.sleep(1)
    if(GPIO.input(20)==0):
        b = 1
        print("Object Found");
        time.sleep(1)
    else:
        print("Nothing")
        b = 0
        time.sleep(1)
    payload = {'sensor1' : a, 'sensor2' : b}    
    payload = {'sensor1' : a, 'sensor2' : b}
    r = requests.post(url,data = payload)
    #res = json.loads(r.text)
    #print(res)
    rlight = requests.post(urllight,data = payload)
    print(rlight.text)
    if(rlight.text[37]=='1'):
        GPIO.output(26,True)
    else:
        GPIO.output(26,False)
    if(rlight.text[48]=='1'):
        GPIO.output(19,True)
    else:
        GPIO.output(19,False)
    
    
