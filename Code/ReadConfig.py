import os.path
        
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
        
Config = {};       
readConfigs(Config);



