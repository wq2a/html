#!/usr/bin/python
# -*- coding: utf-8 -*-
#coding=utf-8
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
tree = html.fromstring(infile.decode("gbk"))
#tree = html.fromstring(infile)

names = []
quants = []
units = []
ims = []
links = []
ps = []
prices = []

user_info = tree.find_class('unit-buyer-info')
order_str = user_info[0].xpath('//div/div/div[@class="panel-content"]/ul/li')[0].text_content().strip()

m = re.match('([^\d]*)(\d+)',order_str)
order_id = m.group(2)

seller_info = tree.find_class('unit-seller-info')
seller = seller_info[0].xpath('//div/div/div[@class="panel-content"]/ul/li/a')[0]
supplier = seller.text_content().strip()
link = seller.get('href')

t = tree.find_class('stage-label-down')

if t is not None:
    createtime = t[0].text_content()
    order_date = createtime[:10]
    createtime = time.mktime(datetime.datetime.strptime(order_date, "%Y-%m-%d").timetuple())
    createtime = datetime.datetime.fromtimestamp(float(createtime))
    createtime = createtime.strftime("%Y%m%d000000000+0800")
    #createtime = datetime.datetime.strptime(order_date, "%Y%m%d").timetuple()


#else:
#    createtime = time.now()

pl = tree.find_class('product-detail-list')
if pl is not None:
    imgs = pl[0].find_class('a-img')
    products = map(lambda foo: foo.find('a'), pl[0].find_class('offer-title'))
    
    items = pl[0].find_class('item')
    for item in items:
        tds = item.findall('td')
        temp = tds[1].text.strip().replace(' ','')
        m = re.match('(\d+).(\d+)([^/]*)/(.*)',temp)
        prices.append(m.group(1)+'.'+m.group(2))
        units.append(m.group(4))
        quants.append(tds[2].text.strip())
#cbu01.alicdn.com/img/order/trading/629/827/3787698431/1764250977_1597187969.310x310.jpg
#outfile = open(order_id+'.txt','w')
outfile = open('./uploads/alipay/'+order_id+'.txt','w')
outfile.write(order_id+',')
outfile.write(supplier.encode('utf-8')+',')
outfile.write(str(createtime)+',')
outfile.write(link+'\n')

i=0
while i < len(products):
    outfile.write((products[i].get('title').encode('utf-8')).replace(","," ")+',')
    outfile.write(str(prices[i])+',')
    outfile.write(str(quants[i])+',')
    outfile.write(units[i].encode('utf-8')+',')
    #outfile.write(units[i].encode('utf-8').split('/')[1]+',')
    itemImage = imgs[i].find('img').get('src').encode('utf-8')
    itemImage = itemImage.replace('.80x80','')
    outfile.write(itemImage+',')
    outfile.write(products[i].get('href').encode('utf-8')+'\n')
    i += 1
outfile.close()

print order_id + '.txt'
