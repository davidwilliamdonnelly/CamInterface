from picamera import PiCamera
from os import system
import datetime
from time import sleep
from ReadConfig import Config, setConfig
import socket

hostname = socket.gethostname();
PiZero = hostname.find("PiZero") >= 0;
print (PiZero, hostname);

tlseconds = int(Config["video_split"]) #set this to the number of seconds you wish to run your timelapse camera
if (tlseconds < 600):
    tlseconds = 600;
    
secondsinterval = int(int(Config["tl_interval"]) / 10); #number of seconds delay between each photo taken
if (secondsinterval < 5):
    secondsinterval = 5;
    
fps = 25 #frames per second timelapse video
numphotos = int(tlseconds/secondsinterval) #number of photos to take

#testing
#numphotos = 30

print("number of photos to take = ", numphotos)
print ("take a photo every ", secondsinterval, " seconds for ", tlseconds, " seconds")

camera = PiCamera()
setConfig(camera)

counter = 0
system('rm -f /var/www/CamInterface/Pictures/*.jpg') #delete all photos in the Pictures folder before timelapse start

if (PiZero):
    system ('sudo rm -f /home/pi/RecroomShare/PiZ1Pictures/*.jpg')
    while (True):
        try:
            camera.annotate_text = datetime.datetime.now().strftime(" " + socket.gethostname() + "  " + Config["annotation"] + " ");
            camera.capture('/home/pi/RecroomShare/PiZ1Pictures/image{0:06d}.jpg'.format(counter))
        except:
            pass
        
        counter = counter + 1
        if counter > 32000 :
            counter = 0
        sleep(secondsinterval)    

# will only get here if we are not running a PiZero
while (True):
    
    StartDateTime = datetime.datetime.now().strftime("%Y-%m-%d_%H_%M_%S")

    for i in range(numphotos):
        try:
            camera.annotate_text = datetime.datetime.now().strftime(" " + socket.gethostname() + "  " + Config["annotation"] + " ");
            camera.capture('/var/www/CamInterface/Pictures/image{0:06d}.jpg'.format(i))
            print(i)
        except:
            pass
        
        sleep(secondsinterval)

    #system('/var/www/CamInterface/Code/test.sh')  no longer needed
    
    system(('ffmpeg -r {} -f image2 -s 1296x972 -nostats -loglevel 0 -pattern_type glob -i "/var/www/CamInterface/Pictures/*.jpg" -vcodec libx264 -crf 25  -pix_fmt yuv420p'+
    ' /var/www/CamInterface/Videos/{}.mp4').format(fps, StartDateTime))
    
    if (Config["archive_pics"] == '1'):
        arch_dir = "/var/www/CamInterface/Pictures/Ar_" + StartDateTime
        system ('mkdir ' + arch_dir)
        system('mv /var/www/CamInterface/Pictures/*.jpg ' + arch_dir) #delete all photos in the Pictures folder before timelapse start
    else:    
        system('rm -f /var/www/CamInterface/Pictures/*.jpg') #delete all photos in the Pictures folder before timelapse start
        


    


