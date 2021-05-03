import sys
from picamera import PiCamera
from time import sleep
from ReadConfig import Config

filename = sys.argv[1]

camera = PiCamera()

camera.resolution = (int(Config["video_width"]), int(Config["video_height"]))
camera.brightness = (int(Config["brightness"]))

camera.framerate = 15
camera.start_preview()
sleep(2)

camera.capture(filename)

camera.stop_preview()
camera.close()



