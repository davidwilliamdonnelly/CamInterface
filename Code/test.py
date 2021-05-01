from os import system

f = open("/home/pi/RecroomShare/PiZ1Pictures/DirLocked.txt", "a")
f.write("Directory Locked")
f.close()

