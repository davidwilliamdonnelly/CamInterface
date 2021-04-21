cd /var/www/CamInterface/Pictures
for file in *.jpg ; do
   convert "$file" \
      -pointsize 60 -fill white -annotate +50+50  \
      %[exif:DateTimeOriginal] "${file}"
done
