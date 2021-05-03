from picamera import PiCamera
from os import system
import datetime
from time import sleep
from ReadConfig import Config

#import os, getpass
#print ("Env thinks the user is [%s]" % (os.getlogin()));
#print ("Effective user is [%s]" % (getpass.getuser()));

tlseconds = int(Config["video_split"]) #set this to the number of seconds you wish to run your timelapse camera
if (tlseconds < 60):
    tlseconds = 60;
secondsinterval = int(int(Config["tl_interval"]) / 10); #number of seconds delay between each photo taken
if (secondsinterval < 5):
    secondsinterval = 5;
    
fps = 25 #frames per second timelapse video
numphotos = int(tlseconds/secondsinterval) #number of photos to take
print("number of photos to take = ", numphotos)
print ("take a photo every ", secondsinterval, " seconds for ", tlseconds, " seconds")

camera = PiCamera()

camera.resolution = (int(Config["video_width"]), int(Config["video_height"]))
camera.brightness = (int(Config["brightness"]))

while (True):
    
    system('rm /var/www/CamInterface/Pictures/*.jpg') #delete all photos in the Pictures folder before timelapse start
    dateraw= datetime.datetime.now()
    datetimeformat = dateraw.strftime("%Y-%m-%d_%H_%M")
    print("RPi started taking photos for your timelapse at: " + datetimeformat)

    for i in range(numphotos):
        camera.capture('/var/www/CamInterface/Pictures/image{0:06d}.jpg'.format(i))
        #currentTime = datetime.datetime.now()
        #currentTimeFormatted = currentTime.strftime("%Y-%m-%d  %H:%M:%S")
        #print('Picture {0:03d}'.format(i) + ' taken at ' + currentTimeFormatted)
        sleep(secondsinterval)

    print("Done taking photos for this video.")
    print("Please standby as your timelapse video is created.")
    currentTime = datetime.datetime.now()
    currentTimeFormatted = currentTime.strftime("%Y-%m-%d  %H:%M:%S")
    print('Annotating photos: Current Time is ' + currentTimeFormatted)

    system('/var/www/CamInterface/Code/test.sh')
    
    currentTime = datetime.datetime.now()
    currentTimeFormatted = currentTime.strftime("%Y-%m-%d  %H:%M:%S")
    print('Creating movie: Current Time is ' + currentTimeFormatted)
    
    system('ffmpeg -r {} -f image2 -s 1296x972 -nostats -loglevel 0 -pattern_type glob -i "/var/www/CamInterface/Pictures/*.jpg" -vcodec libx264 -crf 25  -pix_fmt yuv420p /var/www/CamInterface/Videos/{}.mp4'.format(fps, datetimeformat))
    print('Timelapse video is complete. Video saved as /var/www/CamInterface/Videos/{}.mp4'.format(datetimeformat))
    
    currentTime = datetime.datetime.now()
    currentTimeFormatted = currentTime.strftime("%Y-%m-%d  %H:%M:%S")
    print('Completed movie: Current Time is ' + currentTimeFormatted)
    
print('Completed the sequence for this running of the program.')

