import sys
from picamera import PiCamera
from time import sleep
from ReadConfig import Config, setConfig

filename = sys.argv[1]

camera = PiCamera()
setConfig(camera)

camera.framerate = 15
camera.start_preview()
sleep(2)

try:
    camera.capture(filename)
except:
    pass

camera.stop_preview()
camera.close()



