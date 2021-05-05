import sys
import datetime
import socket
from picamera import PiCamera, Color
from time import sleep
from ReadConfig import Config, setConfig

if (len(sys.argv) > 1):
    filename = sys.argv[1]
else:
    filename = "test.jpg"

camera = PiCamera()
setConfig(camera)

camera.annotate_text = datetime.datetime.now().strftime(" " + socket.gethostname() + "  " + Config["annotation"] + " ");

#print (Color(y=100, u=150, v=30));

camera.framerate = 15
camera.start_preview()
sleep(2)

try:
    camera.capture(filename)
except:
    pass

camera.stop_preview()
camera.close()



