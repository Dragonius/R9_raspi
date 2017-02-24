#!/usr/bin/perl
#
# copyright Martin Pot 2003-2005
# http://martybugs.net/wireless/rrdtool/
#
# rrd_wlan.pl

use RRDs;

# define location of rrdtool databases
my $rrd = '/var/www/html/rrd/rrd';
# define location of images
my $img = '/var/www/html/rrd';

# process data for each interface (add/delete as required)
&ProcessInterface("cpu");

sub ProcessInterface
{
# process wireless interface
# inputs: $_[0]: interface name (ie, eth0/eth1/eth2)
#         $_[1]: interface description

        # get wireless link details
        my $temp = `cat /sys/class/thermal/thermal_zone0/temp`;

        # remove eol chars
        chomp($cpu);

	#print "$_[0] temp $temp\n";

	#put temp in Celsius
	$temp = $temp/1000;
#	print "$_[0] temp $temp\n";

        # if rrdtool database doesn't exist, create it
        if (! -e "$rrd/w$_[0].rrd")
        {
                print "creating rrd database for $_[0] interface...\n";
                RRDs::create "$rrd/w$_[0].rrd",
                        "-s 300",
                        "DS:cpu:GAUGE:600:0:60",
                        "RRA:AVERAGE:0.5:1:576",
                        "RRA:AVERAGE:0.5:6:672",
                        "RRA:AVERAGE:0.5:24:732",
                        "RRA:AVERAGE:0.5:144:1460";
                if ($ERROR = RRDs::error) { print "$0: failed to create rrd: $ERROR\n"; }
        }

        # insert values into rrd
        RRDs::update "$rrd/w$_[0].rrd",
                "-t", "cpu",
                "N:$temp";
        if ($ERROR = RRDs::error) { print "$0: failed to insert data into rrd: $ERROR\n"; }

        # create traffic graphs
        &CreateGraphs($_[0], "day", $_[1]);
        &CreateGraphs($_[0], "week", $_[1]);
        &CreateGraphs($_[0], "month", $_[1]);
        &CreateGraphs($_[0], "year", $_[1]);
}

sub CreateGraphs
{
# creates graph
# inputs: $_[0]: interface name (ie, eth0/eth1/eth2/ppp0)
#         $_[1]: interval (ie, day, week, month, year)
#         $_[2]: interface description

        # generate SNR graph
        RRDs::graph "$img/$_[0]-$_[1].png",
                "-s -1$_[1]",
                "-t", "Temp : $_[0] ",
                "-h", "80", "-w", "600",
                "-a", "PNG",
                #"-y", "1:2",
                "-v", "C",
                "-l", "0",
                "DEF:cpu=$rrd/w$_[0].rrd:cpu:AVERAGE",
                "LINE2:cpu#0000FF:temp",
                "GPRINT:cpu:MIN:     Min\\: %2.lf",
                "GPRINT:cpu:MAX: Max\\: %2.lf",
                "GPRINT:cpu:AVERAGE: Avg\\: %4.1lf",
                "GPRINT:cpu:LAST: Current\\: %2.lf C\\n";
        if ($ERROR = RRDs::error) { print "$0: unable to generate Cpu graph: $ERROR\n"; }

}

