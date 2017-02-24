#!/bin/bash
#/opt/vc/bin/vcgencmd "measure_temp"
echo "<html><head>"
echo "</head><body>"
cat /sys/class/thermal/thermal_zone0/temp
echo "<br>put out mode gp25"
sudo gpio mode 25 out
echo "<br>write 25 1"
sudo gpio write 25 1 &
echo "<br>Play Title.mp3"
sox /var/www/html/cgi-bin/title.wav -r 22050 -c 1 -b 16 -t wav - | sudo ./FM_Transmitter_RPi3/fm_transmitter -f 100.6 - &
sleep 11 
echo "<br>write 25 0"
sudo gpio write 25 0 &
sudo gpio mode 25 in
echo "<br>Today is $(date)"
sleep 1
echo "</body></html>"
