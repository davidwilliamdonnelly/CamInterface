import sys
from picamera import PiCamera

filename = sys.argv[1]

camera = PiCamera()
camera.start_preview()

camera.capture(filename)

camera.stop_preview()

