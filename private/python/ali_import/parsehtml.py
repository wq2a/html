#!/usr/bin/python
# NOTE redirect file to this script 
import sys
import re
import time
import datetime
from lxml import html

#read file from stdin
infile = sys.stdin.read()
#infile = open('test.html','r')
# NOTE  utf-8 decode required
#tree = html.fromstring(infile.decode("utf-8"))
tree = html.fromstring(infile)

order_b = tree.xpath('//div[@class="order-buyer-info"]/ul/li/span')
order_id = order_b[0].text.strip()
order_date = tree.xpath('//div[@class="order-buyer-info"]/ul/li')[1].text.encode('utf-8').split()[1].strip()[:8]
createtime = time.mktime(datetime.datetime.strptime(order_date, "%Y%m%d").timetuple())
createtime = datetime.datetime.fromtimestamp(float(createtime))
createtime = createtime.strftime("%Y%m%d000000000+0800")
#createtime = datetime.datetime.strptime(order_date, "%Y%m%d").timetuple()
order_s = tree.xpath('//div[@class="order-seller-info"]/ul/li/span/a')
link = order_s[0].get('href')
supplier = order_s[0].text.strip()
products = tree.xpath('//dd[@class="description"]/a')
prices = tree.xpath('//div[@class="price"]')
quantities = tree.xpath('//div[@class="quantity"]')
imgs = tree.xpath('//a[@class="img-wrap"]')

names = []
quants = []
units = []
ims = []
links = []
ps = []

for i in products:
    if i.get('title')!='':
        names.append(i.get('title'))
for i in prices:
    if i.get('title')!='':
        ps.append(i.get('title'))
        units.append(i.text)
for i in quantities:
    q = i.get('title')
    if q!=None and q!='':
        quants.append(q)
h=0
for i in imgs:
    img = i.find('img')
    entry_id = i.get('href')
    if i.get('title')!='':
        q = img.get('src')
        if q!=None and q!='':
            directory = str(entry_id.split('=')[1].strip())[::-1]
            temp = q.split('/')[2].replace('.summ2','')
            temp = re.sub(r'\(.*?\)','',temp)
            # save html page only, not webpage complete!!!!!
            #ims.append('cbu01.alicdn.com/img/order/trading/'+directory[0:3]+'/'+directory[3:6]+'/'+directory[6:]+'/'+temp)
            ims.append(q.replace('.summ2','').replace('//',''))
            links.append(entry_id)
            h+=1

#cbu01.alicdn.com/img/order/trading/629/827/3787698431/1764250977_1597187969.310x310.jpg
outfile = open('./uploads/alipay/'+order_id+'.txt','w')
outfile.write(order_id+',')
outfile.write(supplier.encode('utf-8')+',')
outfile.write(str(createtime)+',')
outfile.write(link+'\n')

i=0
while i < len(names):
    outfile.write((names[i].encode('utf-8')).replace(","," ")+',')
    outfile.write(str(ps[i])+',')
    outfile.write(str(quants[i])+',')
    outfile.write(units[i].encode('utf-8').split('/')[1]+',')
    itemImage = 'http://'+ims[i].encode('utf-8')
    itemImage = itemImage.replace('.80x80','')
    outfile.write(itemImage+',')
    outfile.write(links[i].encode('utf-8')+'\n')
    i += 1
outfile.close()

print order_id + '.txt'
