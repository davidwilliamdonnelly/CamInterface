import sys
import datetime
import socket
from picamera import PiCamera
from time import sleep
from ReadConfig import Config, setConfig

filename = sys.argv[1]
#filename = "test.jpg"

camera = PiCamera()
setConfig(camera)

camera.annotate_text = datetime.datetime.now().strftime(socket.gethostname() + "  " + Config["annotation"]);
      
camera.framerate = 15
camera.start_preview()
sleep(2)

try:
    camera.capture(filename)
except:
    pass

camera.stop_preview()
camera.close()



