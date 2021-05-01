# modified for Pi Zero

from picamera import PiCamera
from os import system
import datetime
from time import sleep

secondsinterval = 5 #number of seconds delay between each photo takencamera = PiCamera()
camera = PiCamera()
camera.resolution = (1296, 972)
counter = 0
system('rm -f /var/www/CamInterface/Pictures/*.jpg') #delete all photos in the Pictures folder before timelapse start
system ('sudo rm -f /home/pi/RecroomShare/PiZ1Pictures/*.jpg')

while (True):

    try:
        camera.capture('/home/pi/RecroomShare/PiZ1Pictures/image{0:06d}.jpg'.format(counter))
    except:
        pass
    
    counter = counter + 1
    if counter > 32000 :
        counter = 0
    sleep(secondsinterval)
    
    
    





