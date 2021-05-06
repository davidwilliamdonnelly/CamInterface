import os.path
from picamera import Color

#Local define of base diretory for routines here
LBASE_DIR = "/var/www/html";
#Global defines and utility functions
# version string 
APP_VERSION = 'v6.6.13';
# file where default settings changes are stored
CONFIG_FILE1 ='raspimjpeg';
# file where user specific settings changes are stored
CONFIG_FILE2= 'uconfig';

def readConfig(config, configFile):
    if (os.path.exists(configFile)):
        f = open(configFile, "r")
        for x in f:
            if (len(x) > 1 and x[0] != '#'):
                SpaceIndex = x.find(" ");
                key = x[:SpaceIndex];
                value = x[SpaceIndex + 1: len(x) - 1];
                config[key] = value;                            
        f.close();
        
def readConfigs (Config):
    readConfig (Config, LBASE_DIR + '/' + CONFIG_FILE1);
    readConfig (Config, LBASE_DIR + '/' + CONFIG_FILE2);
    
def setConfig(camera):
    camera.resolution = (int(Config["video_width"]), int(Config["video_height"]));
    camera.brightness = (int(Config["brightness"]));
    camera.sharpness = (int(Config["sharpness"]));
    camera.contrast = (int(Config["contrast"]));
    camera.saturation = (int(Config["saturation"]));
    camera.iso = (int(Config["iso"]));
    camera.meter_mode = Config["metering_mode"];
    camera.annotate_text_size = int(Config["anno_text_size"]);
    
    if (Config["anno_background"] == "1"):
        camera.annotate_background = Color(r=int(Config["anno3_custom_background_Y"]), g=int(Config["anno3_custom_background_U"]), b=int(Config["anno3_custom_background_V"]));
    if (Config["anno3_custom_text_colour"] == "1"):
        camera.annotate_foreground = Color(y=2 * int(Config["anno3_custom_text_Y"]), u=0, v=0);
    
Config = {};       
readConfigs(Config);
#print (Config);



