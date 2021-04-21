from picamera import PiCamera
from os import system
import datetime
from time import sleep

camera = PiCamera()
camera.resolution = (1024, 768)
#camera.start_preview()

for i in range(30):
    camera.capture('image{0:04d}.jpg'.format(i))
    sleep(1)    
  
#camera.stop_preview()
print("Done taking photos!")  
