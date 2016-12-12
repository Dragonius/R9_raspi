#!/bin/bash
#/opt/vc/bin/vcgencmd "measure_temp"
echo "<html><body>"
cat /sys/class/thermal/thermal_zone0/temp
echo "<br>put out mode gp25"
gpio mode 25 out
echo "<br>write 25 1"
gpio write 25 1 &
echo "<br>sleep 2"
sleep 2
echo "<br>write 25 0"
gpio write 25 0 &
gpio mode 25 in
echo "<br>Today is $(date)"
echo "</body></html>"
