#!/bin/bash
> hostname.txt
> user.txt
> port.txt
> processname.txt
> cmdline.txt
ss -ltn4 |grep "^LISTEN"|awk '{print $4}'|awk -F":" '{print $2}'|while read hao
do

lsof -ni:"$hao"|grep "(LISTEN)"|awk '{print $3}' >> user.txt

lsof -ni:"$hao"|grep "(LISTEN)"|awk '{print $2}'|while read proce
do
  hostname >> hostname.txt
  echo "$hao" >> port.txt
  processname1=`cat /proc/"$proce"/status|sed -n '1p'|awk '{print $2}'`
  echo "$processname1" >> processname.txt
done

lsof -ni:"$hao"|grep "(LISTEN)"|awk '{print $2}'|while read cmdl
do
  cmdline1=`cat /proc/"$cmdl"/cmdline` 
  echo "$cmdline1" >> cmdline.txt
done

paste hostname.txt user.txt port.txt processname.txt cmdline.txt > scannew.log 

cat scannew.log |while read hostn user port processname cmdline
do
  curl "http://cmdb.foneshare.cn/?r=receive-host-port/get&hostname=${hostn}&user=${user}&port=${port}&processname=${processname}&cmdline=${cmdline}"
done

done
