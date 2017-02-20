#!/usr/bin/python
import matplotlib.pyplot as plt
import numpy as np
#from matplotlib.ticker import FuncFormatter, MaxNLocator
import MySQLdb
import sys
import time
import datetime

db = MySQLdb.connect("127.0.0.1","root","","alipay")
db.set_character_set('utf8')
cursor = db.cursor()
sql = "SELECT * FROM alipay_by_date"
cursor.execute(sql)
results = cursor.fetchall()
sql = "SELECT * FROM alipay_by_buyer"
cursor.execute(sql)
results_buyer = cursor.fetchall()
sql = "SELECT * FROM alipay"
cursor.execute(sql)
results_all = cursor.fetchall()
db.close()

x = []
y = []
x1 = []
y1 = []
month = []

for r in results:
    date = datetime.datetime.strptime(str(r[0]),'%Y%m%d')
    x.append(date)
    y.append(r[1])
    date = datetime.datetime.strptime(str(r[0])[:6],'%Y%m')
    if date not in x1:
        x1.append(date)
        y1.append(r[1])
        month.append([r[1]])
    else:
        month[-1].append(r[1])
    y1[-1] += r[1]

fig, ax = plt.subplots()
bp = ax.boxplot(month,1,'')
ax.set_xlabel('Month')
ax.set_ylabel('Payment')
plt.title('Alipay Average')
plt.setp(bp['whiskers'], color='k', linestyle='-')
plt.setp(bp['boxes'],color='k')
plt.setp(bp['fliers'], color='k', markersize=3.0)
plt.setp(bp['medians'], color='Green', linewidth=1.5)
plt.savefig("alipay_month_avg.png")
#plt.show()

plt.clf()

plt.subplot(2,1,1)
plt.plot(x, y,'g-',marker='o',markerfacecolor='k',markersize=2)
plt.ylabel('Amount')
plt.title('Alipay')
plt.subplot(2,1,2)
plt.bar(x1, y1,3,facecolor='g')
plt.xlabel('Month')
plt.ylabel('Amount')
plt.savefig("alipay.png")

plt.clf()

rr = {}
x = []
y = []
i = 0
for r in results_buyer:
    if r[0] not in rr:
        rr[r[0]] = 0
    rr[r[0]] += r[1]

i = 0
for key in rr:
    y.append(rr[key])
    x.append(i)
    i += 1

x1 = []
for i in range(24):
    x1.append(i)
y1 = [0]*24
y11 = [0]*24
rr = [0]*24
x2 = []
y2 = []
i = 0
for r in results_all:
    y1[int(r[4][:2])] += r[2]
    y11[int(r[4][:2])] += 1
    x2.append(i)
    y2.append(r[2])
    i += 1

plt.subplot(2,1,1)
plt.bar(x2, y2,0.1,color='g')
plt.title('Alipay by Customer')
plt.ylabel('Amount')

plt.subplot(2,1,2)
plt.bar(x, y,0.1,facecolor='g')
plt.xlabel('Customer')
plt.ylabel('Amount')

plt.savefig("alipay_buyer.png")

plt.clf()

fig, ax = plt.subplots()
bp = ax.boxplot(y,1,'')
ax.set_ylabel('Average')
plt.title('Alipay Customer Average')
plt.setp(bp['whiskers'], color='k', linestyle='-')
plt.setp(bp['boxes'],color='k')
plt.setp(bp['fliers'], color='k', markersize=3.0)
plt.setp(bp['medians'], color='Green', linewidth=1.5)
plt.savefig("alipay_customer_avg.png")

plt.clf()

# plt.subplot(3,1,3)
plt.subplot(3,1,1)
plt.title('Alipay by Datetime')
plt.bar(x1, y1,0.5,color='g')
plt.ylabel('Amount')
y3 = [0]*24
for i in range(24):
    if y11[i] != 0:
        y3[i] = y1[i]/y11[i]

plt.subplot(3,1,2)
plt.bar(x1, y3,0.5,color='g')
plt.ylabel('Average')

plt.subplot(3,1,3)
plt.bar(x1, y11,0.5,color='g')
plt.ylabel('Times')
plt.xlabel('Time')

plt.savefig("alipay_datetime.png")


# plt.show()
