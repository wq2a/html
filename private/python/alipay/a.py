#!/usr/bin/env python3
import sys,re
import base64
print(sys.argv[1])
fileo = open(sys.argv[1],'r',encoding='gbk',errors='ignore')
line = fileo.readline()
date_ana = {}
time_ana = {}

fileout = open('temp0.txt','w')

while line != '':
    temp = line.strip().split(',')
    if len(temp)>12 and temp[10].strip()=='收入' and temp[11].strip()=='交易成功' and '余额宝' not in line:
        alipay_id = temp[0].strip()
        paytime = temp[3].strip()
        paydate = paytime.split(' ')[0].replace('-','')
        #print(paytime)
        payt = paytime.split(' ')[1].replace(':','')
        buyer = temp[7].strip()
        total = temp[9].strip()
        if date_ana.get(paydate) == None:
            date_ana[paydate] = 0.0
        date_ana[paydate] += float(total)
        if time_ana.get(payt) == None:
            time_ana[payt] = 0.0
        time_ana[payt] += float(total)
        #print(buyer)
        b = base64.b64decode((buyer[5:])[:-6])
        b = b.decode('utf-8')
        fileout.write(alipay_id+','+paytime+','+b+','+total+','+paydate+','+payt+'\n')
        #print(alipay_id,paytime,b,total,paydate,payt,sep=',')
        
    line = fileo.readline()
dates = []
pay = []
i = 0
for key,value in sorted(time_ana.items()):
    dates.append(i)
    pay.append(value)
    i += 1
