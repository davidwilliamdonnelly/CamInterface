import sys
from picamera import PiCamera
from time import sleep

filename = sys.argv[1]

camera = PiCamera()

camera.resolution = (2592, 1944)

camera.framerate = 15
camera.start_preview()
sleep(2)

camera.capture(filename)

camera.stop_preview()
camera.close()



