import sys
import os

import nmap                         # import nmap.py module
try:
    nm = nmap.PortScanner()         # instantiate nmap.PortScanner object
except nmap.PortScannerError:
    print('Nmap not found', sys.exc_info()[0])
    sys.exit(1)
except:
    print("Unexpected error:", sys.exc_info()[0])
    sys.exit(1)

nm.scan('172.16.2.1', '24')      # scan host 127.0.0.1, ports from 22 to 443
nm.command_line()                   # get command line used for the scan : nmap -oX - -p 22-443 127.0.0.1
nm.scaninfo()                       # get nmap scan informations {'tcp': {'services': '22-443', 'method': 'connect'}}
nm.all_hosts()                      # get all hosts that were scanned
nm['172.16.2.1'].hostname()          # get one hostname for host 127.0.0.1, usualy the user record
nm['172.16.2.1'].hostnames()         # get list of hostnames for host 127.0.0.1 as a list of dict [{'name':'hostname1', 'type':'PTR'}, {'name':'hostname2', 'type':'user'}]
nm['172.16.2.1'].state()             # get state of host 127.0.0.1 (up|down|unknown|skipped)
nm['172.16.2.1'].all_protocols()     # get all scanned protocols ['tcp', 'udp'] in (ip|tcp|udp|sctp)
if ('tcp' in nm['172.16.2.1']):
    list(nm['172.16.2.1']['tcp'].keys()) # get all ports for tcp protocol

nm['172.16.2.1'].all_tcp()           # get all ports for tcp protocol (sorted version)
nm['172.16.2.1'].all_udp()           # get all ports for udp protocol (sorted version)
nm['172.16.2.1'].all_ip()            # get all ports for ip protocol (sorted version)
nm['172.16.2.1'].all_sctp()          # get all ports for sctp protocol (sorted version)
if nm['172.16.2.1'].has_tcp(22):     # is there any information for port 22/tcp on host 127.0.0.1
    nm['172.16.2.1']['tcp'][22]          # get infos about port 22 in tcp on host 127.0.0.1
    nm['172.16.2.1'].tcp(22)             # get infos about port 22 in tcp on host 127.0.0.1
    nm['172.16.2.1']['tcp'][22]['state'] # get state of port 22/tcp on host 127.0.0.1 (open


# a more usefull example :
for host in nm.all_hosts():
    print('----------------------------------------------------')
    print('Host : {0} ({1})'.format(host, nm[host].hostname()))
    print('State : {0}'.format(nm[host].state()))

    for proto in nm[host].all_protocols():
        print('----------')
        print('Protocol : {0}'.format(proto))

        lport = list(nm[host][proto].keys())
        lport.sort()
        for port in lport:
            print('port : {0}\tstate : {1}'.format(port, nm[host][proto][port]))


print('----------------------------------------------------')
# print result as CSV
print(nm.csv())



print('----------------------------------------------------')
# If you want to do a pingsweep on network 192.168.1.0/24:
nm.scan(hosts='172.16.2.1/24', arguments='-n -sP -PE -PA21,23,80,3389')
hosts_list = [(x, nm[x]['status']['state']) for x in nm.all_hosts()]
for host, status in hosts_list:
    print('{0}:{1}'.format(host, status))

# hosts_list = [(x, nm[x]['status']['state']) #use this in if condition to check ip and assign a variable with 1 if ip exits and 0 if ip doesnt exits
# Update the db value using python script of floor 1 and floor2
